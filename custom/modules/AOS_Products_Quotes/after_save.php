<?php
	
class after_save {
    function after_save(&$bean, $event, $arguments){

		global $current_user;

		$product_id = $bean->product_id;
		$product_quote_id = $bean->id;

		$parent_type = $bean->parent_type;
		
		$product_quote = new AOS_Products_Quotes($product_quote_id);

		if($product_id) {
			$product = new AOS_Products();
			$product->retrieve($product_id);
			$currencies = self::get_currencies_by_symbol();
			$currencies_symbol = self::get_currencies_symbol_by_id();
			$currencies_rate = self::get_currencies_rate();
			
			$cost_price = self::number_unformat($product->cost_2_c);
			$cost_currency_symbol = $product->cost_currency_c;
			$cost_currency_id = $currencies[$cost_currency_symbol];
			$cost_rate = $currencies_rate[$cost_currency_id];
			
			$price = self::number_unformat($bean->product_unit_price);
			$price_currency_symbol = $currencies_symbol[$bean->currency_id];
			$price_currency_id = $bean->currency_id;
			$price_rate = $currencies_rate[$price_currency_id];
			
			// Converting currencies
			$converted_cost = ($cost_rate * $cost_price) / $price_rate;
			
			// Compute for Margin
			// $margin = (($price - $converted_cost) / $price) * 100;
			
			$data = array(
				array(
					'id_c' => $product_quote_id,
					'price_c' => $price, 
					'price_currency_symbol_c' => $price_currency_symbol, 
					'price_currency_c' => $price_currency_id, 
					'price_rate_c' => $price_rate, 
					//'cost_c' => $cost_price,
					'cost_currency_symbol_c' => $cost_currency_symbol, 
					'cost_currency_c' => $cost_currency_id, 
					'cost_rate_c' => $cost_rate,
					'cost_discount_c' => $bean->cost_discount_c == NULL ? 0 : $bean->cost_discount_c,
					'current_active_lineitem_c' => $bean->current_active_lineitem_c,
				),
			);
			
			$sql = self::generate_insert_script('aos_products_quotes_cstm', $data);
			$GLOBALS['db']->query($sql);
		}
		
		if($bean->parent_type == 'AOS_Invoices') {
			$invoice_id = $bean->parent_id;
			
			// NOTE: EDIT ALSO custom/AOS_Invoices/AOSInvoicesHook.php
			$query = "
				SELECT *
				FROM cm3_renewals_aos_invoices_1_c
				WHERE cm3_renewals_aos_invoices_1aos_invoices_idb = '{$invoice_id}'
			";
			
			$result = $GLOBALS["db"]->query($query);
			
			// get all renewal ids and update their line items and renewal date
			while ($item = $GLOBALS["db"]->fetchByAssoc($result) ) {
				$renewalid = $item['cm3_renewals_aos_invoices_1cm3_renewals_ida'];
				
				if($renewalid) {
				
					$current_product_ids = array();
					$current_product_ids_query = "
						SELECT *
						FROM aos_products_quotes apq
						WHERE apq.parent_id = '{$invoice_id}'
						AND apq.deleted = 0
					";
					
					$current_product_ids_result = $GLOBALS["db"]->query($current_product_ids_query);
					
					while ($item = $GLOBALS["db"]->fetchByAssoc($current_product_ids_result) ) {
						$current_product_ids[] = $item['product_id'];
					}
					
					// Get the deleted line items from the current invoice and set the previous invoice line items to active
					$deleted_product_ids = array();
					$deleted_product_ids_query = "
						SELECT *
						FROM aos_products_quotes apq
						WHERE apq.parent_id = '{$invoice_id}'
						AND apq.deleted = 1
					";
					
					$deleted_product_ids_result = $GLOBALS["db"]->query($deleted_product_ids_query);
					
					while ($item = $GLOBALS["db"]->fetchByAssoc($deleted_product_ids_result) ) {
						$deleted_product_ids[] = $item['product_id'];
					}
					
					// Get all invoices of a renewal
					$query = "
						SELECT *
						FROM cm3_renewals_aos_invoices_1_c
						WHERE cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewalid}'
						AND cm3_renewals_aos_invoices_1aos_invoices_idb != '{$invoice_id}'
					";
					
					$result = $GLOBALS["db"]->query($query);
					
					while ($row = $GLOBALS["db"]->fetchByAssoc($result) ) {
						$inner_invoice_id = $row['cm3_renewals_aos_invoices_1aos_invoices_idb'];
						
						// Set previous invoice line items to RENEWED
						if($current_product_ids) {
							$current_ids = "'" . implode("','", $current_product_ids) . "'";
							
							$renewed_product_ids_query = "
								UPDATE aos_products_quotes apq
								JOIN aos_products_quotes_cstm apqc ON apqc.id_c = apq.id
								SET apqc.status_c = '13'
								WHERE apq.parent_id = '{$inner_invoice_id}'
								AND apq.product_id IN ($current_ids)
							";
							
							/*$renewed_product_ids_query = "
								UPDATE aos_products_quotes apq
								JOIN aos_products_quotes_cstm apqc ON apqc.id_c = apq.id
								SET apqc.status_c = '13'
								WHERE apq.parent_id = (SELECT ai.id
									FROM cm3_renewals cr
									JOIN cm3_renewals_aos_invoices_1_c crai ON cr.id = crai.cm3_renewals_aos_invoices_1cm3_renewals_ida
									JOIN aos_invoices ai ON ai.id = cm3_renewals_aos_invoices_1aos_invoices_idb
									WHERE cr.id = '{$renewalid}'
									AND crai.deleted = 0
									AND ai.deleted = 0
									AND ai.id != '{$inner_invoice_id}'
									ORDER BY ai.date_entered DESC
									LIMIT 1)
								AND apq.product_id IN ($current_ids)
							";*/
							
							$renewed_product_ids_result = $GLOBALS["db"]->query($renewed_product_ids_query);
						}
						
						// Set previous invoice line items to ACTIVE again
						if($deleted_product_ids) {
							$deleted_ids = "'" . implode("','", $deleted_product_ids) . "'";
							/*$inactive_product_ids_query = "
								UPDATE aos_products_quotes apq
								JOIN aos_products_quotes_cstm apqc ON apqc.id_c = apq.id
								SET apqc.status_c = '1'
								WHERE apq.parent_id = '{$inner_invoice_id}'
								AND apq.product_id IN ($deleted_ids)
							";*/
							$inactive_product_ids_query = "
								UPDATE aos_products_quotes apq
								JOIN aos_products_quotes_cstm apqc ON apqc.id_c = apq.id
								SET apqc.status_c = '1'
								WHERE apq.parent_id = (SELECT ai.id
									FROM cm3_renewals cr
									JOIN cm3_renewals_aos_invoices_1_c crai ON cr.id = crai.cm3_renewals_aos_invoices_1cm3_renewals_ida
									JOIN aos_invoices ai ON ai.id = cm3_renewals_aos_invoices_1aos_invoices_idb
									WHERE cr.id = '{$renewalid}'
									AND crai.deleted = 0
									AND ai.deleted = 0
									AND ai.id != '{$invoice_id}'
									ORDER BY ai.date_entered DESC
									LIMIT 1)
								AND apq.product_id IN ($deleted_ids)
							";
							
							$inactive_product_ids_result = $GLOBALS["db"]->query($inactive_product_ids_query);
						}
					}
					
					$GLOBALS['db']->query("UPDATE cm3_renewals
						SET renewal_date = (
						SELECT
							MIN(aos_products_quotes_cstm.end_date_c)
						FROM
							aos_products_quotes
						JOIN aos_products_quotes_cstm
							ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
						JOIN aos_products
							ON aos_products.id = aos_products_quotes.product_id
							AND aos_products.deleted = 0
						JOIN aos_invoices
							ON aos_invoices.id = aos_products_quotes.parent_id
							AND aos_invoices.deleted = 0
							AND aos_products_quotes.deleted = 0
						JOIN cm3_renewals_aos_invoices_1_c
						ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
						WHERE (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
						AND aos_products_quotes_cstm.end_date_c != '0000-00-00'
						AND aos_products_quotes_cstm.status_c = 1
						AND cm3_renewals_aos_invoices_1_c.deleted = 0
						AND cm3_renewals.id = cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida
						AND cm3_renewals.id = '{$renewalid}')
						WHERE cm3_renewals.id = '{$renewalid}'");
				}	
			}
		}

		/*if($parent_type == "AOS_Invoices") {
			$invoiceid = $bean->parent_id;

			$query = "
				SELECT *
				FROM cm3_renewals_aos_invoices_1_c
				WHERE cm3_renewals_aos_invoices_1aos_invoices_idb = '{$invoiceid}'
			";

			$result = $GLOBALS['db']->query($query);

			// get all renewal ids and update their line items and renewal date
			while ($item = $GLOBALS["db"]->fetchByAssoc($result) ) {
				$renewalid = $item['cm3_renewals_aos_invoices_1cm3_renewals_ida'];

				$get_active_line_items = "
					SELECT
						aos_products_quotes.*,
						aos_products_quotes_cstm.*,
						aos_quotes.id as `quote_id`,
						aos_invoices.number as `invoice_number`,
						aos_quotes.number as `quote_number`,
						aos_quotes.name as `quote_name`,
						aos_invoices.name as `parent_name`
					FROM
						aos_products_quotes
					JOIN aos_products_quotes_cstm
						ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
					JOIN aos_products
						ON aos_products.id = aos_products_quotes.product_id
						AND aos_products.deleted = 0
					JOIN aos_invoices 
						ON aos_invoices.id = aos_products_quotes.parent_id 
						AND aos_invoices.deleted = 0 
						AND aos_products_quotes.deleted = 0
					JOIN aos_quotes_aos_invoices_c 
						ON aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb = aos_invoices.id
					JOIN aos_quotes
						ON aos_quotes.id = aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida
					JOIN cm3_renewals_aos_invoices_1_c
						ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
						AND cm3_renewals_aos_invoices_1_c.deleted = 0
					WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewalid}'
					AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
					AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')
					AND aos_products_quotes.parent_type = 'AOS_Invoices'
					AND aos_invoices.id != '{$invoiceid}'
					AND aos_products_quotes_cstm.current_active_lineitem_c = '1'
				";
				
				$product_ids = array();
				$result_active_line_items = $GLOBALS["db"]->query($get_active_line_items);
				
				while ($item = $GLOBALS["db"]->fetchByAssoc($result_active_line_items) ) {
					$product_ids[] = $row['product_id'];
				}
				
				$renewed_condition = '';

				if($product_ids) {
					$renewed_condition = " AND aos_products_quotes.product_id IN ('" . implode("','", $product_ids) . "') ";
					
					// set previous line items to renewed
					$set_renewed_query = "UPDATE aos_products_quotes_cstm
					SET status_c = '13'
					WHERE id_c IN (SELECT id_c FROM (SELECT
								aos_products_quotes_cstm.id_c
							FROM
								aos_products_quotes
							JOIN aos_products_quotes_cstm
								ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
							JOIN aos_products
								ON aos_products.id = aos_products_quotes.product_id
								AND aos_products.deleted = 0
							JOIN aos_invoices 
								ON aos_invoices.id = aos_products_quotes.parent_id 
								AND aos_invoices.deleted = 0 
								AND aos_products_quotes.deleted = 0
							JOIN aos_quotes_aos_invoices_c 
								ON aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb = aos_invoices.id
							JOIN aos_quotes
								ON aos_quotes.id = aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida
							JOIN cm3_renewals_aos_invoices_1_c
								ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
							WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewalid}'
							AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
							{$renewed_condition}
							AND aos_products_quotes.parent_type = 'AOS_Invoices'
							AND aos_products_quotes.parent_id != '".$invoiceid."'
							AND aos_products_quotes_cstm.current_active_lineitem_c = '1'
							AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')) AS T1)";
							
					$GLOBALS["db"]->query($set_renewed_query);
				}
				
				// update line items to inactive
				$GLOBALS['db']->query("UPDATE aos_products_quotes_cstm
                SET status_c = '-2'
                WHERE id_c IN (SELECT id_c FROM (SELECT
                            aos_products_quotes_cstm.id_c
                        FROM
                            aos_products_quotes
                        JOIN aos_products_quotes_cstm
                            ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
                        JOIN aos_products
                            ON aos_products.id = aos_products_quotes.product_id
                            AND aos_products.deleted = 0
                        JOIN aos_invoices 
                            ON aos_invoices.id = aos_products_quotes.parent_id 
                            AND aos_invoices.deleted = 0 
                            AND aos_products_quotes.deleted = 0
                        JOIN aos_quotes_aos_invoices_c 
                            ON aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb = aos_invoices.id
                        JOIN aos_quotes
                            ON aos_quotes.id = aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida
                        JOIN cm3_renewals_aos_invoices_1_c
                            ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
                        WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewalid}'
                        AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
                        AND aos_products_quotes.parent_type = 'AOS_Invoices'
                        AND aos_products_quotes.parent_id != '".$invoiceid."'
                        AND aos_products_quotes_cstm.status_c = '1') AS T1)");


				// update renewal date
				$GLOBALS['db']->query("UPDATE cm3_renewals
                SET renewal_date = (
                SELECT
                    MIN(aos_products_quotes_cstm.end_date_c)
                FROM
                    aos_products_quotes
                JOIN aos_products_quotes_cstm
                    ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
                JOIN aos_products
                    ON aos_products.id = aos_products_quotes.product_id
                    AND aos_products.deleted = 0
                JOIN aos_invoices
                    ON aos_invoices.id = aos_products_quotes.parent_id
                    AND aos_invoices.deleted = 0
                    AND aos_products_quotes.deleted = 0
                JOIN cm3_renewals_aos_invoices_1_c
                ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
                WHERE (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
                AND aos_products_quotes_cstm.end_date_c != '0000-00-00'
                AND aos_products_quotes_cstm.status_c = 1
                AND cm3_renewals_aos_invoices_1_c.deleted = 0
                AND cm3_renewals.id = cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida
                AND cm3_renewals.id = '{$renewalid}')
                WHERE cm3_renewals.id = '{$renewalid}'");
			}
		}*/
	}
	
	function number_unformat($number, $force_number = true, $dec_point = '.', $thousands_sep = ',') {
		if ($force_number) {
			$number = preg_replace('/^[^\d]+/', '', $number);
		} else if (preg_match('/^[^\d]+/', $number)) {
			return false;
		}
		$type = (strpos($number, $dec_point) === false) ? 'int' : 'float';
		$number = str_replace(array($dec_point, $thousands_sep), array('.', ''), $number);
		settype($number, $type);
		return $number;
	}

	public function get_currencies_by_symbol() {
		$query = "
			SELECT c.id as val, c.symbol as `key`
			FROM currencies c
		";

		$result = $GLOBALS['db']->query($query);
		$result_array = $this->result_to_array($result);
		$result_array['AUD'] = '-99';

		return $result_array;
	}

	public function get_currencies_symbol_by_id() {
		$query = "
			SELECT c.symbol as val, c.id as `key`
			FROM currencies c
		";

		$result = $GLOBALS['db']->query($query);
		$result_array = $this->result_to_array($result);
		$result_array[-99] = 'AUD';

		return $result_array;
	}

	public function get_currencies_rate() {
		$query = "
			SELECT c.conversion_rate as val, c.id as `key`
			FROM currencies c
		";

		$result = $GLOBALS['db']->query($query);
		$result_array = $this->result_to_array($result);
		$result_array[-99] = 1.000000;

		return $result_array;
	}

	private function result_to_array($result) {
		$data = array();

		while($row = $GLOBALS["db"]->fetchByAssoc($result)) {
			$data[$row['key']] = $row['val'];
		}

		return $data;
	}

	function generate_insert_script($table, $data) {
		$values = "";
		$fields = $update = array();

		$ctr = 0;
		foreach($data as $item) {
			$_values = array();

			foreach($item as $key => $val) {
				if($ctr==0) {
					$fields[] = $key;
					$update[] = "$key=VALUES($key)";
				}

				if($val == 'NULL') {
					$_values[] = "NULL";
				} else {
					$_values[] = "'".addslashes($val)."'";
				}
			}

			$values .= "(".implode($_values, ",")."),";

			$ctr++;
		}

		$sql = "INSERT INTO ".$table." (".implode(",", $fields).") VALUES ".rtrim($values, ',')." ON DUPLICATE KEY UPDATE ".implode(",", $update);
		return $sql;
	}
}
?>