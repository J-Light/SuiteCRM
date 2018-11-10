<?php

class AOSInvoicesHook {

    public function updateTaxCode(&$bean, $event, $arguments) {
        global $db;
    }

    public function updateActiveLineItems(&$bean, $event, $arguments) {
        global $db;
				
		$req_module = $_REQUEST['module'];
		$req_action = $_REQUEST['action'];

        $id = $bean->id;	
		/* =========================== START ==================================== */
			
		// NOTE: EDIT ALSO custom/AOS_Products_Quotes/after_save.php
		$query = "
			SELECT *
			FROM cm3_renewals_aos_invoices_1_c
			WHERE cm3_renewals_aos_invoices_1aos_invoices_idb = '{$id}'
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
					WHERE apq.parent_id = '{$id}'
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
					WHERE apq.parent_id = '{$id}'
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
					AND cm3_renewals_aos_invoices_1aos_invoices_idb != '{$id}'
				";
				
				$result = $GLOBALS["db"]->query($query);
				
				while ($row = $GLOBALS["db"]->fetchByAssoc($result) ) {
					$inner_invoice_id = $row['cm3_renewals_aos_invoices_1aos_invoices_idb'];
					
					// $GLOBALS['log']->fatal('==== AOS_INVOICE HOOK :LOG: while loop entered ====');
					// $GLOBALS['log']->fatal('AOS_INVOICE HOOK : req_module: ' . $req_module);
					// $GLOBALS['log']->fatal('AOS_INVOICE HOOK : req_action: ' . $req_action);
					
					/*if($req_module == 'AOS_Quotes' && $req_action == 'converToInvoice') {
						$GLOBALS['log']->fatal('LOG: Renewal line item status updated');
						
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
													
							$renewed_product_ids_result = $GLOBALS["db"]->query($renewed_product_ids_query);
						}
						
						// Set previous invoice line items to ACTIVE again
						if($deleted_product_ids) {
							$deleted_ids = "'" . implode("','", $deleted_product_ids) . "'";

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
									AND ai.id != '{$id}'
									ORDER BY ai.date_entered DESC
									LIMIT 1)
								AND apq.product_id IN ($deleted_ids)
							";
							
							$inactive_product_ids_result = $GLOBALS["db"]->query($inactive_product_ids_query);
						}
					}*/
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
		
		/* =========================== END ==================================== */

        /*$query = "
            SELECT *
            FROM cm3_renewals_aos_invoices_1_c
            WHERE cm3_renewals_aos_invoices_1aos_invoices_idb = '{$id}'
        ";

        $result = $db->query($query);

        // get all renewal ids and update their line items and renewal date
        while ($item = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $renewalid = $item['cm3_renewals_aos_invoices_1cm3_renewals_ida'];
						
			// NOTE: EDIT ALSO custom/AOS_Products_Quotes/after_save.php
			// Get the current line items from the current invoice and set the previous invoice line items to renewed
			$current_product_ids = array();
			$current_product_ids_query = "
				SELECT *
				FROM aos_products_quotes apq
				WHERE apq.parent_id = '{$id}'
				AND apq.deleted = 0
			";
			
			$current_product_ids_result = $db->query($current_product_ids_query);
			
			while ($item = $GLOBALS["db"]->fetchByAssoc($current_product_ids_result) ) {
				$current_product_ids[] = $item['product_id'];
			}
			
			// Get the deleted line items from the current invoice and set the previous invoice line items to active
			$deleted_product_ids = array();
			$deleted_product_ids_query = "
				SELECT *
				FROM aos_products_quotes apq
				WHERE apq.parent_id = '{$id}'
				AND apq.deleted = 1
			";
			
			$deleted_product_ids_result = $db->query($deleted_product_ids_query);
			
			while ($item = $GLOBALS["db"]->fetchByAssoc($deleted_product_ids_result) ) {
				$deleted_product_ids[] = $item['product_id'];
			}
			
			// Set previous invoice line items to RENEWED
			if($current_product_ids) {
				$current_ids = "'" . implode("','", $current_product_ids) . "'";
				$renewed_product_ids_query = "
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
						AND ai.id != '{$id}'
						ORDER BY ai.date_entered DESC
						LIMIT 1)
					AND apq.product_id IN ($current_ids)
				";
				
				$renewed_product_ids_result = $db->query($renewed_product_ids_query);
			}
			
			// Set previous invoice line items to ACTIVE again
			if($deleted_product_ids) {
				$deleted_ids = "'" . implode("','", $deleted_product_ids) . "'";
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
						AND ai.id != '{$id}'
						ORDER BY ai.date_entered DESC
						LIMIT 1)
					AND apq.product_id IN ($deleted_ids)
				";
				
				$inactive_product_ids_result = $db->query($inactive_product_ids_query);
			}						

            // update renewal date
            $db->query("UPDATE cm3_renewals
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
        }*/

        // RUN THIS TO UPDATE THE hdn_purchase_id IN aos_products_quotes_cstm table
        $query_select_po = "
            SELECT *
            FROM cm4_purchases cp
            WHERE cp.aos_invoices_id_c = '{$id}'
        ";

        $result = $db->query($query_select_po);

        while ($item = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $po_id = $item['id'];

            $query_delete_po = "
                DELETE 
                FROM cm4_purchases_aos_products_quotes_1_c
                WHERE cm4_purchases_aos_products_quotes_1cm4_purchases_ida = '{$po_id}'
            ";

            $db->query($query_delete_po);
        }

        $query_insert_po = "
            INSERT INTO cm4_purchases_aos_products_quotes_1_c (id, date_modified, deleted, cm4_purchases_aos_products_quotes_1cm4_purchases_ida, cm4_purchases_aos_products_quotes_1aos_products_quotes_idb)
            SELECT UUID(), NULL, 0, cp.id, aos_products_quotes.id
            FROM cm4_purchases cp
            INNER JOIN aos_invoices ai
               ON ai.id = cp.aos_invoices_id_c
            LEFT JOIN accounts a
               ON a.id = ai.billing_account_id
            INNER JOIN aos_products_quotes
               ON aos_products_quotes.parent_id = ai.id
               AND aos_products_quotes.parent_type = 'AOS_Invoices'
            INNER JOIN aos_products_quotes_cstm apqc
               ON apqc.id_c = aos_products_quotes.id
            INNER JOIN aos_products ap
               ON ap.id = aos_products_quotes.product_id
            INNER JOIN aos_product_categories apc
               ON apc.id = ap.aos_product_category_id
            INNER JOIN aos_product_categories apc2
               ON apc2.id = apc.parent_category_id
               AND apc2.is_parent = 1
               AND apc2.id = cp.aos_product_categories_id_c
            WHERE ai.id = '{$id}'";

        $db->query($query_insert_po);
    }

}
