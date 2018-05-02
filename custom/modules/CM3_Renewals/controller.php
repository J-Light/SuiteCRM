<?php
/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 3:54 PM
 */

include('./scripts/functions.php');

class CM3_RenewalsController extends SugarController {

    public function action_SubPanelViewer() {
        require_once 'include/SubPanel/SubPanelViewer.php';
        global $db;
        $id = $_GET['record'];

        /* TODO: continue to work on this */
        if($_REQUEST['subpanel'] == 'cm3_renewals_aos_invoices_1') {
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
                            AND cm3_renewals.id = '{$id}')
                            WHERE cm3_renewals.id = '{$id}'");

            //echo '<script> document.location = "index.php?module=CM3_Renewals&action=DetailView&record='.$id.'"; </script>';
        }
    }

    public function action_generate_quote() {
        global $db;
        global $current_user;
        global $timedate;

        $data = array();
        $table = 'aos_quotes';
        $mode = 'insert';
        $time = date('Y-m-d H:i:s', time());

        $id = $_GET['record'];
        $renewal = self::get_renewal($id);
        $account = self::get_account($renewal['account_id_c']);
        $account_id = $account['id'];
		
		$currencies_by_symbol = self::get_currencies_by_symbol();
		
		// Set current_active_lineitem to 1
		$set_active_line_items = "
			UPDATE
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
			SET aos_products_quotes_cstm.current_active_lineitem_c = 1
			WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$id}'
			AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
			AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')
			AND aos_products_quotes.parent_type = 'AOS_Invoices'
		";
		$db->query($set_active_line_items);

        if($account_id) {
            $quote_id = self::create_quote($account_id, $id);

            if($quote_id) {
                $line_item_group_id = self::create_line_item_group($quote_id);

                if($line_item_group_id) {
                    /*$query = "
                        SELECT
                            aos_products_quotes.*,
                            aos_products_quotes_cstm.*
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
                        JOIN cm3_renewals_cstm
                            ON cm3_renewals_cstm.account_id_c = aos_invoices.billing_account_id
                        WHERE cm3_renewals_cstm.id_c = '{$id}'
                        AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance')
                    ";*/

                    $licdaterenewal = array(
                        '1' => 1,	//1 Month Lease
                        '10' => 10,	//10 Month Lease
                        '11' => 11,	//11 Month Lease
                        '12' => 12,	//12 Month Lease
                        '2'	=> 2, //2 Month Lease
                        '3'	=> 3, //3 Month Lease
                        '4'	=> 4, //4 Month Lease
                        '5'	=> 5, //5 Month Lease
                        '6'	=> 6, //6 Month Lease
                        '7'	=> 7, //7 Month Lease
                        '8'	=> 8, //8 Month Lease
                        '9'	=> 9, //9 Month Lease
                        '25' => 12,	//Admin & Services (Misc)
                        '99' => 12,	//Budget
                        '40' => 12,	//Consulting
                        '90' => 12,	//Costs
                        '100' => 12,	//LEAP COS
                        '-15' => 12,	//Licence Transfer
                        '14' => 12,	//No Maint (Optional Maint)
                        '13' => 12,	//Paid Up License
                        '20' => 12,	//Stock
                        '30' => 12,	//Training
                        '0' => 12,	//Trial License
                        '101' => 1,	//Upgrade To 1 Month Lease
                        '110' => 10,	//Upgrade To 10 Month Lease
                        '111' => 11,	//Upgrade To 11 Month Lease
                        '112' => 12,	//Upgrade To 12 Month Lease
                        '102' => 2, 	//Upgrade To 2 Month Lease
                        '103' => 3, 	//Upgrade To 3 Month Lease
                        '104' => 4, 	//Upgrade To 4 Month Lease
                        '105' => 5,	    //Upgrade To 5 Month Lease
                        '106' => 6,  	//Upgrade To 6 Month Lease
                        '107' => 7, 	//Upgrade To 7 Month Lease
                        '108' => 8, 	//Upgrade To 8 Month Lease
                        '109' => 9, 	//Upgrade To 9 Month Lease
                        '113' => 12,	//Upgrade To Paid Up License
                        '-1' => 1,  	//Upgraded 1 Month Lease
                        '-10' => 10,	//Upgraded 10 Month Lease
                        '-11' => 11,	//Upgraded 11 Month Lease
                        '-12' => 12,	//Upgraded 12 Month Lease
                        '-2' => 2,	//Upgraded 2 Month Lease
                        '-3' => 3,	//Upgraded 3 Month Lease
                        '-4' => 4,	//Upgraded 4 Month Lease
                        '-5' => 5,	//Upgraded 5 Month Lease
                        '-6' => 6,	//Upgraded 6 Month Lease
                        '-7' => 7,	//Upgraded 7 Month Lease
                        '-8' => 8,	//Upgraded 8 Month Lease
                        '-9' => 9,	//Upgraded 9 Month Lease
                        '-13' => 12,	//Upgraded Paid Up License
                        '15' => 12,	//WAN Access Fee from Australia
                        '16' => 12,	//WAN Access Fee to Australia
                        '-99' => 12	//Z DELETE
                    );

                    $query = "
                        SELECT
                            aos_products_quotes.*,
                            aos_products_quotes_cstm.*,
                            aos_quotes.id as `quote_id`,
                            aos_quotes.name as `quote_name`
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
                        WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$id}'
                        AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
                        AND aos_products_quotes.parent_type = 'AOS_Invoices'
                        AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')
                    ";

                    $result = $db->query($query);

                    while ($item = $GLOBALS["db"]->fetchByAssoc($result) ) {
                        $guid = create_guid();

                        $months = $licdaterenewal[$item['license_type_c']];
                        $months = $months ? $months : 12;

                        $start_timestamp = $item['start_date_c'] == '1970-01-01' ? strtotime($time) : strtotime($item['start_date_c']);
                        $end_timestamp = $item['end_date_c'] == '1970-01-01' ? strtotime($time) : strtotime($item['end_date_c']);

                        $new_start_date = strtotime('+1 days', $end_timestamp);
                        $new_end_date_1 = strtotime('+'.$months.' months', $new_start_date);
                        $new_end_date_2 = strtotime('-1 days', $new_end_date_1);
						
						$product = self::get_product($item['product_id']);
						$product_cost_currency = $product['cost_currency_c'];
						$cost_currency = isset($currencies_by_symbol[$product_cost_currency]) ? $currencies_by_symbol[$product_cost_currency] : '';
						
						$data[$mode]['aos_products_quotes'][] = array(
                            'id' => $guid,
                            'name' => $item['name'],
                            'part_number' => $item['part_number'],
                            'item_description' => $item['item_description'],
                            'currency_id' => $product['currency_id'],
                            'product_qty' => $item['product_qty'] != '' ? $item['product_qty'] : '0',
                            'discount' => 'Percentage',
                            'parent_type' => 'AOS_Quotes',
                            'parent_id' => $quote_id,
                            'product_id' => $item['product_id'],
                            'group_id' => $line_item_group_id,
                            'product_cost_price' => '0',
                            'product_cost_price_usdollar' => '0',
                            'product_list_price' => $product['price'] != '' ? $product['price'] : '0.00',
                            'product_list_price_usdollar' => $product['price'] != '' ? $product['price'] : '0.00',
                            'product_discount' => '0', //$item['product_discount'] != '' ? $item['product_discount'] : '0',
                            'product_discount_usdollar' => '0', //$item['product_discount_usdollar'] != '' ? $item['product_discount_usdollar'] : '0',
                            'product_discount_amount' => '0', //$item['product_discount_amount'] != '' ? $item['product_discount_amount'] : '0',
                            'product_discount_amount_usdollar' => '0.', //$item['product_discount_amount_usdollar'],
                            'product_unit_price' => '0.00', //$item['product_unit_price'] != '' ? $item['product_unit_price'] : '0.00',
                            'product_unit_price_usdollar' => '0.00', //$item['product_unit_price'] != '' ? $item['product_unit_price'] : '0.00',
                            'vat' => $item['vat'] ? $item['vat'] : '0.0',
                            'vat_amt' => $item['vat_amt'] != '' ? $item['vat_amt'] : '0',
                            'vat_amt_usdollar' => $item['vat_amt_usdollar'] != '' ? $item['vat_amt_usdollar'] : '0',
                            'product_total_price' => '0.00', //$item['product_total_price'] != '' ? $item['product_total_price'] : '0.00',
                            'product_total_price_usdollar' => '0.00', //$item['product_total_price'] != '' ? $item['product_total_price'] : '0.00',
                            'deleted' => '0',
                            'date_entered' => $time,
                            'date_modified' => $time,
                        );

                        // aos_products_quotes tables
                        $data[$mode]['aos_products_quotes_cstm'][] = array(
                            'id_c' => $guid,
                            'license_type_c' => $item['license_type_c'] != '' ? $item['license_type_c'] : 12,
                            'start_date_c' => date('Y-m-d', $new_start_date),
                            'end_date_c' => date('Y-m-d', $new_end_date_2),
                            'account_number_c' => $item['account_number_c'],
                            'job_number_c' => $item['job_number_c'],
                            'status_c' => $item['status_c'],
							
                            'cost_c' => $product['cost_2_c'],
                            'cost_currency_c' => $cost_currency,
							'cost_currency_symbol_c' => $item['cost_currency_symbol_c'],
							'cost_rate_c' => $item['cost_rate_c'],
							
							'price_c' => $item['price_c'],
							'price_currency_c' => $item['price_currency_c'],
							'price_currency_symbol_c' => $item['price_currency_symbol_c'],
							'price_rate_c' => $item['price_rate_c'],
							
							'cost_rate_c' => $item['cost_rate_c'],
							'cost_discount_c' => '0',
							'margin_c' => '0', //$item['margin_c'],
							'supplier_amount_c' => '0', // $item['supplier_amount_c'],
							'supplier_margin_c' => $product['supplier_margin_c'],
                        );

                        /*$data[$mode]['aos_products_quotes'][] = array(
                            'id' => $guid,
                            'name' => $item['name'],
                            'part_number' => $item['part_number'],
                            'item_description' => $item['item_description'],
                            'currency_id' => $item['currency_id'],
                            'product_qty' => $item['product_qty'] != '' ? $item['product_qty'] : '0',
                            'discount' => $item['discount'] != '' ? $item['discount'] : '0',
                            'parent_type' => 'AOS_Quotes',
                            'parent_id' => $quote_id,
                            'product_id' => $item['product_id'],
                            'group_id' => $line_item_group_id,
                            'product_cost_price' => '0',
                            'product_cost_price_usdollar' => '0',
                            'product_list_price' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'product_list_price_usdollar' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'product_discount' => $item['product_discount'] != '' ? $item['product_discount'] : '0',
                            'product_discount_usdollar' => $item['product_discount_usdollar'] != '' ? $item['product_discount_usdollar'] : '0',
                            'product_discount_amount' => $item['product_discount_amount'] != '' ? $item['product_discount_amount'] : '0',
                            'product_discount_amount_usdollar' => $item['product_discount_amount_usdollar'],
                            'product_unit_price' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'product_unit_price_usdollar' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'vat' => $item['vat'],
                            'vat_amt' => $item['vat_amt'] != '' ? $item['vat_amt'] : '0',
                            'vat_amt_usdollar' => $item['vat_amt_usdollar'] != '' ? $item['vat_amt_usdollar'] : '0',
                            'product_total_price' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'product_total_price_usdollar' => $item['product_list_price'] != '' ? $item['product_list_price'] : '0.00',
                            'deleted' => '0',
                            'date_entered' => $time,
                            'date_modified' => $time,
                        );

                        // aos_products_quotes tables
                        $data[$mode]['aos_products_quotes_cstm'][] = array(
                            'id_c' => $guid,
                            'license_type_c' => $item['license_type_c'],
                            'start_date_c' => date('Y-m-d', $new_start_date),
                            'end_date_c' => date('Y-m-d', $new_end_date_2),
                            'account_number_c' => $item['account_number_c'],
                            'job_number_c' => $item['job_number_c'],
                            'status_c' => $item['status_c'],
                        );*/
                    }

                    foreach($data['insert'] as $table => $data) {
                        $db->query(generate_insert_script($table, $data));
                    }

                    $db->query("UPDATE aos_quotes
                        SET total_amt = (SELECT SUM(b.product_total_price * b.product_qty)
                        FROM aos_products_quotes AS b
                        WHERE b.parent_id = aos_quotes.id)
                        WHERE EXISTS (SELECT *
                        FROM aos_products_quotes AS b
                        WHERE b.parent_id = aos_quotes.id)
                        AND id = '{$quote_id}'");

                    $db->query("UPDATE aos_quotes as t1 
                        INNER JOIN aos_quotes as t2 ON 
                            t1.id = t2.id
                        SET t1.total_amt_usdollar = t2.total_amt,
                            t1.subtotal_amount = t2.total_amt,
                            t1.subtotal_amount_usdollar = t2.total_amt,
                            t1.total_amount = t2.total_amt,
                            t1.total_amount_usdollar = t2.total_amt
                        WHERE t1.id = t2.id
                        AND t1.id = '{$quote_id}'");

                    $db->query("UPDATE aos_line_item_groups as t1 
                        INNER JOIN aos_quotes as t2 ON 
                            t1.parent_id = t2.id
                        SET t1.total_amt = t2.total_amt,
                            t1.total_amt_usdollar = t2.total_amt,
                            t1.subtotal_amount = t2.total_amt,
                            t1.subtotal_amount_usdollar = t2.total_amt,
                            t1.total_amount = t2.total_amt,
                            t1.total_amount_usdollar = t2.total_amt,
                            t1.currency_id = t2.currency_id
                        WHERE t1.parent_id = t2.id
                        AND t1.id = '{$quote_id}'");

                    // set old line items to inactive
                    /*$query_set_inactive = "
                    UPDATE aos_products_quotes_cstm
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
                                WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$id}'
                                AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance')
                                AND aos_products_quotes.parent_type = 'AOS_Invoices'
                                AND aos_products_quotes_cstm.status_c = '1') AS T1)
                    ";
                    $db->query($query_set_inactive);*/

                    // CREATE OPPORTUNITY

                    $renewal = new CM3_Renewals();
                    $renewal->retrieve($id);

                    $quote = new AOS_Quotes();
                    $quote->retrieve($quote_id);

                    $guid = create_guid();

                    $CurrenrDateTime1 = $timedate->getInstance()->nowDb();
                    $RealDateTime = strtotime($timedate->httpTime());
                    $time = strtotime($CurrenrDateTime1);

                    $time_name = date('YmdHi', $RealDateTime);
                    $date_entered = date('Y-m-d H:i:s', $time);
                    $name = 'Renewal - '.$renewal->name.' - '.$time_name;

                    $minus_one_day = "";

                    if($renewal->renewal_date) {
                        $date = explode('/', $renewal->renewal_date);

                        if(count($date) == 3) {
                            $date = $date[2].'-'.$date[1].'-'.$date[0];
                            $timestamp = strtotime($date);
                            $minus_one_day = date('Y-m-d', strtotime('-1 day', $timestamp));
                        }
                    }

                    $opportunity = new Opportunity();
                    $opportunity->name = $name;
                    $opportunity->sales_stage = 'Contract_Signed';
                    $opportunity->probability = 70;
                    $opportunity->opportunity_type = 'Existing Business';
                    $opportunity->amount = $quote->subtotal_amount;
                    $opportunity->amount_usdollar = $quote->subtotal_amount;
                    $opportunity->date_closed = $minus_one_day;
                    $opportunity->assigned_user_id = $current_user->id;
                    $opportunity->created_by = $current_user->id;
                    $opportunity->modified_user_id = $current_user->id;
                    $opportunity->date_entered =  date('Y-m-d H:i:s', $time);
                    $opportunity->date_modified = date('Y-m-d H:i:s', $time);
                    $opportunity->save();

                    $db->query("
                        UPDATE opportunities_cstm
                        SET auto_generated_name = '$name'
                        WHERE id_c = '$opportunity->id'
                    ");

                    $db->query("
                        UPDATE aos_quotes
                        SET opportunity_id = '$opportunity->id'
                        WHERE id = '$quote->id'
                    ");

                    $db->query("
                        INSERT INTO accounts_opportunities
                        VALUES('{$guid}', '{$opportunity->id}', '{$quote->billing_account_id}', '{$date_entered}', 0)
                    ");

                    echo '<script> document.location = "index.php?module=AOS_Quotes&offset=1&return_module=AOS_Quotes&action=EditView&record='.$quote_id.'&renewed=true"; </script>';
                }
            }
        }
    }

    private function get_renewal($id) {
        global $db;
        $data = null;

        $query = "SELECT *
            FROM cm3_renewals
            INNER JOIN cm3_renewals_cstm
            ON cm3_renewals_cstm.id_c = cm3_renewals.id
            WHERE cm3_renewals.id = '{$id}'";

        $result = $db->query(($query));

        while ($record = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $data = $record;
        }

        return $data;
    }

    private function get_account($id) {
        global $db;
        $data = null;

        $query = "SELECT *
            FROM accounts
            INNER JOIN accounts_cstm
            ON accounts_cstm.id_c = accounts.id
            WHERE accounts.id = '{$id}'";

        $result = $db->query(($query));

        while ($record = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $data = $record;
        }

        return $data;
    }
	
	private function get_product($id) {
		global $db;
        $data = null;

        $query = "SELECT *
            FROM aos_products
            INNER JOIN aos_products_cstm
            ON aos_products_cstm.id_c = aos_products.id
            WHERE aos_products.id = '{$id}'";

        $result = $db->query(($query));

        while ($record = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $data = $record;
        }

        return $data;
	}

    private function get_quote_number() {
        global $db;
        $num = 0;

        $query = "SELECT MAX(number) as number
            FROM aos_quotes";

        $result = $db->query(($query));

        while ($record = $GLOBALS["db"]->fetchByAssoc($result) ) {
            $num = $record['number'];
        }

        return $num + 1;
    }

    private function create_quote($account_id, $agreement_number = '') {
        global $db;
		global $current_user;

        $guid = create_guid();
        $time = date('Y-m-d H:i:s', time());
        $number = self::get_quote_number();
		
		$account = self::get_account($account_id);

        $query = "
            INSERT INTO aos_quotes (id, date_entered, date_modified, assigned_user_id, modified_user_id, created_by, deleted, billing_account_id, number, currency_id, billing_address_street, billing_address_city, billing_address_state, billing_address_postalcode, billing_address_country)
            VALUES ('{$guid}', '{$time}', '{$time}', '{$current_user->id}', '{$current_user->id}', '{$current_user->id}', 0, '{$account_id}', $number, -99, '{$account['organisation_address_street_c']}', '{$account['organisation_address_city_c']}', '{$account['organisation_address_state_c']}', '{$account['organisation_address_pcode_c']}', '{$account['organisation_address_country_c']}');
        ";

        $result = $db->query(($query));

        $query = "
            INSERT INTO aos_quotes_cstm (id_c, quote_type_c, cm3_renewals_id_c)
            VALUES ('{$guid}', '2', '{$agreement_number}');
        ";

        $result = $db->query(($query));

        if($result) {
            return $guid;
        }

        return false;
    }

    private function create_line_item_group($quote_id) {
        global $db;
		global $current_user;

        $guid = create_guid();
        $time = date('Y-m-d H:i:s', time());

        $query = "
            INSERT INTO aos_line_item_groups (id, date_entered, date_modified, assigned_user_id, modified_user_id, created_by, deleted, parent_id, number, currency_id)
            VALUES ('{$guid}', '{$time}', '{$time}', '{$current_user->id}', '{$current_user->id}', '{$current_user->id}', 0, '{$quote_id}', 1, -99);
        ";

        $result = $db->query(($query));

        if($result) {
            return $guid;
        }

        return false;
    }
	
	private function get_currencies_by_symbol() {
		global $db;
		
		$query = "
			SELECT c.id as val, c.symbol as `key`
			FROM currencies c
		";
		
		$result = $db->query($query);	
		$result_array = self::result_to_array($result);
		$result_array['AUD'] = '-99';
		
		return $result_array;
	}
	
	private function result_to_array($result) {
		$data = array();

		while($row = $result->fetch_assoc()) {
			$data[$row['key']] = $row['val'];
		}
		
		return $data;
	}

}