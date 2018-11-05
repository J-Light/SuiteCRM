<?php
/**
* Advanced OpenSales, Advanced, robust set of sales modules.
* @package Advanced OpenSales for SugarCRM
* @copyright SalesAgility Ltd http://www.salesagility.com
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
* the Free Software Foundation; either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
* along with this program; if not, see http://www.gnu.org/licenses
* or write to the Free Software Foundation,Inc., 51 Franklin Street,
* Fifth Floor, Boston, MA 02110-1301  USA
*
* @author SalesAgility <info@salesagility.com>
*/

global $timedate;
global $current_user;
global $sugar_config;

if(!(ACLController::checkAccess('AOS_Invoices', 'edit', true))){
	ACLController::displayNoAccess();
	die;
}

// Check if user can edit the quote
if(!(ACLController::checkAccess('AOS_Quotes', 'edit', true))){
    ACLController::displayNoAccess();
    die;
}

$defaultInvoiceUser = '';
if(isset($sugar_config['defaultInvoiceUser'])) {
    $defaultInvoiceUser = $sugar_config['defaultInvoiceUser'];
}
else {
    $defaultInvoiceUser = '1';
}

if (!function_exists('create_guid')) {
	function create_guid()
	{
		$microTime = microtime();
		list($a_dec, $a_sec) = explode(" ", $microTime);
		$dec_hex = sprintf("%x", $a_dec* 1000000);
		$sec_hex = sprintf("%x", $a_sec);
		ensure_length($dec_hex, 5);
		ensure_length($sec_hex, 6);
		$guid = "";
		$guid .= $dec_hex;
		$guid .= create_guid_section(3);
		$guid .= '-';
		$guid .= create_guid_section(4);
		$guid .= '-';
		$guid .= create_guid_section(4);
		$guid .= '-';
		$guid .= create_guid_section(4);
		$guid .= '-';
		$guid .= $sec_hex;
		$guid .= create_guid_section(6);
		return $guid;
	}
}

if (!function_exists('create_guid_section')) {
	function create_guid_section($characters)
	{
		$return = "";
		for($i=0; $i<$characters; $i++)
		{
			$return .= sprintf("%x", mt_rand(0,15));
		}
		return $return;

	}
}

if (!function_exists('ensure_length')) {
	function ensure_length(&$string, $length)
	{
		$strlen = strlen($string);
		if($strlen < $length)
		{
			$string = str_pad($string,$length,"0");
		}
		else if($strlen > $length)
		{
			$string = substr($string, 0, $length);
		}
	}
}

if (!function_exists('dateDifference')) {
	function dateDifference($date_1, $date_2, $differenceFormat = '%a')
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

		$interval = date_diff($datetime1, $datetime2);

		return $interval->format($differenceFormat);

	}
}

require_once('modules/AOS_Quotes/AOS_Quotes.php');
require_once('modules/AOS_Invoices/AOS_Invoices.php');
require_once('modules/AOS_Products_Quotes/AOS_Products_Quotes.php');

//global $timedate;
global $db;

// Check if quote has invoice
$query = "SELECT aos_invoices.*
FROM aos_quotes_aos_invoices_c
JOIN aos_invoices ON aos_invoices.id = aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb
WHERE aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida = '{$_REQUEST['record']}'
AND aos_quotes_aos_invoices_c.deleted = 0
AND aos_invoices.deleted = 0";

$invoice_count = 0;
$result = $this->bean->db->query($query);

while ($row = $this->bean->db->fetchByAssoc($result)) {
	$invoice_count++;
}

if($invoice_count > 0) {
	SugarApplication::appendErrorMessage('Selected quote already has an invoice.');

	$params = array(
		'module'=> 'AOS_Quotes',
		'action'=>'DetailView',
		'record' => $_REQUEST['record'],
	);

	SugarApplication::redirect('index.php?' . http_build_query($params));
	die();
}

//Setting values in Quotes
$quote = new AOS_Quotes();
$quote->retrieve($_REQUEST['record']);

$customer_po = $quote->customer_purchase_order_c;
$customer_po = trim($customer_po);

if(strlen($customer_po) < 3) {
	SugarApplication::appendErrorMessage('Customer Purchase Order field is empty. Failed to convert to invoice.');

	$params = array(
		'module'=> 'AOS_Quotes',
		'action'=>'DetailView',
		'record' => $_REQUEST['record'],
	);

	SugarApplication::redirect('index.php?' . http_build_query($params));
	die();
}

$quote->stage = 'Closed Accepted';
$quote->invoice_status = 'Invoiced';
$quote->total_amt = format_number($quote->total_amt);
$quote->discount_amount = format_number($quote->discount_amount);
$quote->subtotal_amount = format_number($quote->subtotal_amount);
$quote->tax_amount = format_number($quote->tax_amount);
if($quote->shipping_amount != null)
{
	$quote->shipping_amount = format_number($quote->shipping_amount);
}
$quote->total_amount = format_number($quote->total_amount);
$quote->save();

// Get MYOB Card Name
$account_id = $quote->billing_account_id;
$query = "SELECT * FROM accounts_cstm WHERE accounts_cstm.id_c = '{$account_id}'";
$result = $this->bean->db->query($query, true);
$row = $this->bean->db->fetchByAssoc($result);

$myob_card_name_id = $row['myob_card_name_dd_c'];
$myob_card_name = isset($app_list_strings['myob_card_name_list'][$myob_card_name_id]) ? $app_list_strings['myob_card_name_list'][$myob_card_name_id] : '';

// Check Tax Code
$vat_sales_sql = "
	SELECT DISTINCT aos_products_quotes.vat
	FROM aos_products_quotes 
	WHERE aos_products_quotes.parent_type = 'AOS_Quotes' 
	AND aos_products_quotes.parent_id = '{$quote->id}' 
	AND aos_products_quotes.deleted = 0
";
$result = $this->bean->db->query($vat_sales_sql);

$tax_code_sales = "";
while ($row = $this->bean->db->fetchByAssoc($result)) {
	if($row['vat'] == '10.0') {
		$tax_code_sales = "GST";
	} else {
		$tax_code_sales = "FRE";
	}

	break;
}

$vat_purchase_sql = "
	SELECT DISTINCT accounts.billing_address_country
	FROM aos_products_quotes 
	INNER JOIN aos_products ON
		aos_products.id = aos_products_quotes.product_id
	INNER JOIN aos_product_categories apc1 ON
		apc1.id = aos_products.aos_product_category_id
	INNER JOIN aos_product_categories apc2 ON
		apc2.id = apc1.parent_category_id
	INNER JOIN aos_product_categories_cstm apcc ON
		apcc.id_c = apc2.id
	INNER JOIN accounts ON
		accounts.id = apcc.account_id_c
	WHERE aos_products_quotes.parent_type = 'AOS_Quotes' 
	AND aos_products_quotes.parent_id = '{$quote->id}' 
	AND aos_products_quotes.deleted = 0
";
$result = $this->bean->db->query($vat_purchase_sql);

$tax_code_purchase = "FRE";
while ($row = $this->bean->db->fetchByAssoc($result)) {
	if($row['billing_address_country'] == 'AUSTRALIA') {
		$tax_code_purchase = "GST";
	} else {
		$tax_code_purchase = "FRE";
	}

	break;
}

// GET STATE
$state_sql = "
	SELECT LEFT(a.billing_address_state, 1) as 'state'
	FROM aos_quotes aq
	INNER JOIN accounts a ON
		aq.billing_account_id = a.id
	WHERE aq.id = '{$quote->id}'
";
$result = $this->bean->db->query($state_sql);
$row = $this->bean->db->fetchByAssoc($result);
$job_state = $row['state'] ? $row['state'] : '';

//Setting Invoice Values
$invoice = new AOS_Invoices();
$rawRow = $quote->fetched_row;
$rawRow['id'] = '';
$rawRow['template_ddown_c'] = ' ';
$rawRow['quote_number'] = $rawRow['number'];
$rawRow['number'] = '';
$dt = explode(' ',$rawRow['date_entered']);
$rawRow['quote_date'] = $dt[0];
$rawRow['invoice_date'] = date('Y-m-d');
$rawRow['total_amt'] = format_number($rawRow['total_amt']);
$rawRow['discount_amount'] = format_number($rawRow['discount_amount']);
$rawRow['subtotal_amount'] = format_number($rawRow['subtotal_amount']);
$rawRow['tax_amount'] = format_number($rawRow['tax_amount']);
$rawRow['due_date'] = date('Y-m-d', strtotime('+14 day'));
$rawRow['date_entered'] = '';
$rawRow['date_modified'] = '';
if($rawRow['shipping_amount'] != null)
{
	$rawRow['shipping_amount'] = format_number($rawRow['shipping_amount']);
}
$rawRow['total_amount'] = format_number($rawRow['total_amount']);
$rawRow['myob_card_name_c'] = $myob_card_name;
$rawRow['tax_code_c'] = $tax_code_sales;
$rawRow['status'] = 'Unpaid';
$rawRow['assigned_user_id'] = $defaultInvoiceUser;
$invoice->populateFromRow($rawRow);
$invoice->process_save_dates =false;
$invoice->save();

//Setting invoice quote relationship
require_once('modules/Relationships/Relationship.php');
$key = Relationship::retrieve_by_modules('AOS_Quotes', 'AOS_Invoices', $GLOBALS['db']);
if (!empty($key)) {
	$quote->load_relationship($key);
	$quote->$key->add($invoice->id);
}

//Setting Group Line Items
$sql = "SELECT * FROM aos_line_item_groups WHERE parent_type = 'AOS_Quotes' AND parent_id = '".$quote->id."' AND deleted = 0";
$result = $this->bean->db->query($sql);
while ($row = $this->bean->db->fetchByAssoc($result)) {
	$row['id'] = '';
	$row['parent_id'] = $invoice->id;
	$row['parent_type'] = 'AOS_Invoices';
	if($row['total_amt'] != null) $row['total_amt'] = format_number($row['total_amt']);
	if($row['discount_amount'] != null) $row['discount_amount'] = format_number($row['discount_amount']);
	if($row['subtotal_amount'] != null) $row['subtotal_amount'] = format_number($row['subtotal_amount']);
	if($row['tax_amount'] != null) $row['tax_amount'] = format_number($row['tax_amount']);
	if($row['subtotal_tax_amount'] != null) $row['subtotal_tax_amount'] = format_number($row['subtotal_tax_amount']);
	if($row['total_amount'] != null) $row['total_amount'] = format_number($row['total_amount']);
	$group_invoice = new AOS_Line_Item_Groups();
	$group_invoice->populateFromRow($row);
	$group_invoice->save();
}

//Setting Line Items
//$sql = "SELECT * FROM aos_products_quotes INNER JOIN aos_products_quotes_cstm ON aos_products_quotes_cstm.id_c = aos_products_quotes.id WHERE parent_type = 'AOS_Quotes' AND parent_id = '".$quote->id."' AND deleted = 0";
$sql = "
	SELECT 
		aos_products_quotes.*, 
		aos_products_quotes_cstm.*, 
		aos_products_cstm.myob_accnum_sales_c, 
		aos_products_cstm.myob_accnum_purchase_c,
		aos_products_cstm.myob_job_groupid_c
	FROM aos_products_quotes 
	INNER JOIN aos_products_quotes_cstm ON 
		aos_products_quotes_cstm.id_c = aos_products_quotes.id
	INNER JOIN aos_quotes ON
		aos_quotes.id = aos_products_quotes.parent_id
	INNER JOIN aos_products ON
		aos_products_quotes.product_id = aos_products.id
	INNER JOIN aos_products_cstm ON
		aos_products_cstm.id_c = aos_products.id
	WHERE aos_products_quotes.parent_type = 'AOS_Quotes' 
	AND aos_products_quotes.parent_id = '{$quote->id}' 
	AND aos_products_quotes.deleted = 0
";
$result = $this->bean->db->query($sql);
while ($row = $this->bean->db->fetchByAssoc($result)) {
	$row['id'] = '';
	$row['parent_id'] = $invoice->id;
	$row['parent_type'] = 'AOS_Invoices';
	if($row['product_cost_price'] != null)
	{
		$row['product_cost_price'] = format_number($row['product_cost_price']);
	}
	$row['product_list_price'] = format_number($row['product_list_price']);
	if($row['product_discount'] != null)
	{
		$row['product_discount'] = format_number($row['product_discount']);
		$row['product_discount_amount'] = format_number($row['product_discount_amount']);
	}
	$row['product_unit_price'] = format_number($row['product_unit_price']);
	$row['vat_amt'] = format_number($row['vat_amt']);
	$row['product_total_price'] = format_number($row['product_total_price']);
	$row['product_qty'] = format_number($row['product_qty']);
	$prod_invoice = new AOS_Products_Quotes();
	$prod_invoice->populateFromRow($row);
	$lid = $prod_invoice->save();

	$cstm_query = "
		INSERT INTO aos_products_quotes_cstm(
			id_c, 
			account_number_sales_c,
			account_number_purchase_c, 
			job_number_text_c, 
			supplier_amount_c, 
			supplier_margin_c, 
			license_type_c, 
			start_date_c, 
			end_date_c, 
			current_active_lineitem_c, 
			status_c)
		VALUES(
			'".$prod_invoice->id."',
			'".$row['myob_accnum_sales_c']."',
			'".$row['myob_accnum_purchase_c']."',
			'".$job_state.$row['myob_job_groupid_c']."',
			'".$row['supplier_amount_c']."',
			'".$row['supplier_margin_c']."',
			'".$row['license_type_c']."',
			'".$row['start_date_c']."',
			'".$row['end_date_c']."',
			'1',
			'1')
		ON DUPLICATE KEY UPDATE 
			id_c='".$prod_invoice->id."', 
			account_number_sales_c='".$row['myob_accnum_sales_c']."', 
			account_number_purchase_c='".$row['myob_accnum_purchase_c']."', 
			job_number_text_c='".$job_state.$row['myob_job_groupid_c']."', 
			supplier_amount_c='".$row['supplier_amount_c']."', 
			supplier_margin_c='".$row['supplier_margin_c']."', 
			license_type_c='".$row['license_type_c']."', 
			start_date_c='".$row['start_date_c']."', 
			end_date_c='".$row['end_date_c']."', 
			current_active_lineitem_c='1', 
			status_c='1'";

	$db->query($cstm_query);
	
	var_dump($cstm_query);

}

// CHeck if quote line items have maintenance or lease

$query = "
	SELECT
		aos_products_quotes.*,
		aos_quotes.id as `quote_id`,
		aos_quotes.name as `quote_name`
	FROM
		aos_products_quotes
	JOIN aos_products
		ON aos_products.id = aos_products_quotes.product_id
		AND aos_products.deleted = 0
	JOIN aos_quotes
		ON aos_quotes.id = aos_products_quotes.parent_id
	WHERE (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
	AND aos_products_quotes.parent_type = 'AOS_Quotes'
	AND aos_quotes.id = '{$quote->id}';
";

$maintleaseitems = $this->bean->db->query($query);
$new_renewal = false;

if($maintleaseitems->num_rows > 0) {
// Get the Quote's Agreement NUmber
	$hdn_agreement_number = $quote->cm3_renewals_id_c;

	// check if renewal exist
	$query = "
			SELECT *
			FROM cm3_renewals
			WHERE id = '{$hdn_agreement_number}' AND deleted = 0;
		";
	$agreementnumber_exist = $this->bean->db->query($query);

	$currenttimestamp = strtotime($timedate->httpTime());
	$renewal_temp_name = 'Renewal-' . date('YmdHi', $currenttimestamp) . '-' . $currenttimestamp;

	// Check if there is an existing agreement number
	$renewal = new CM3_Renewals();
	if(!$hdn_agreement_number || $agreementnumber_exist->num_rows == 0) {
		$renewal->name = $renewal_temp_name;
		$renewal->date_entered = '';
		$renewal->date_modified = '';
		$renewal->description = '';
		$renewal->deleted = '0';
		$renewal->account_id_c = $quote->billing_account_id;
		$renewal->contact_id_c = $quote->billing_contact_id;
		$renewal->assigned_user_id = $current_user->id;
		$renewal->created_by = $current_user->id;
		$renewal->modified_user_id = $current_user->id;
		$renewal->save();

		$db->query("
			UPDATE aos_quotes_cstm
			SET cm3_renewals_id_c = '$renewal->id'
			WHERE id_c = '$quote->id'
		");

		$new_renewal = true;
	} else {
		$renewal->retrieve($hdn_agreement_number);
		$new_renewal = false;
	}

	// Get product id's of the quote
	$quote_line_items = "
		SELECT
			aos_products_quotes.*,
			aos_quotes.id as `quote_id`,
			aos_quotes.name as `quote_name`
		FROM
			aos_products_quotes
		JOIN aos_products
			ON aos_products.id = aos_products_quotes.product_id
			AND aos_products.deleted = 0
		JOIN aos_quotes
			ON aos_quotes.id = aos_products_quotes.parent_id
		WHERE (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
		AND aos_products_quotes.parent_type = 'AOS_Quotes'
		AND aos_products_quotes.deleted = 0
		AND aos_quotes.id = '{$quote->id}';
	";

	$result_quote_line_items = $db->query($quote_line_items);

	$product_ids = array();
	while($row = $db->fetchByAssoc($result_quote_line_items)) {
		$product_ids[] = $row['product_id'];
	}

	// Set Renewal and Invoice relationship
	$key = Relationship::retrieve_by_modules('CM3_Renewals', 'AOS_Invoices', $GLOBALS['db']);
	if (!empty($key)) {
		$renewal->load_relationship($key);
		$renewal->$key->add($invoice->id);

		$renewed_condition = $inactive_condition = '';
		
		// Update the line items status_c of renewals
		$invoice_id = $invoice->id;
		
		$query = "
			SELECT *
			FROM cm3_renewals_aos_invoices_1_c
			WHERE cm3_renewals_aos_invoices_1aos_invoices_idb = '{$invoice_id}'
		";
		
		$result = $GLOBALS["db"]->query($query);
		
		// get all renewal ids and update their line items and renewal date
		// 1 = New
		if($quote->quote_type_c != 1) {
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

		/*if($product_ids) {
			$renewed_condition = " AND aos_products_quotes.product_id IN ('" . implode("','", $product_ids) . "') ";
			$inactive_condition = " AND aos_products_quotes.product_id NOT IN ('" . implode("','", $product_ids) . "') ";
			
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
					WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewal->id}'
					AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
					{$renewed_condition}
					AND aos_products_quotes.parent_type = 'AOS_Invoices'
					AND aos_products_quotes.parent_id != '".$invoice->id."'
					AND aos_products_quotes_cstm.current_active_lineitem_c = '1'
					AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')) AS T1)";

			$db->query($set_renewed_query);


			// set previous line items to inactive
			$set_inactive_query = "UPDATE aos_products_quotes_cstm
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
					WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$renewal->id}'
					AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
					{$inactive_condition}
					AND aos_products_quotes.parent_type = 'AOS_Invoices'
					AND aos_products_quotes.parent_id != '".$invoice->id."'
					AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')) AS T1)";

			$db->query($set_inactive_query);

			//$GLOBALS['log']->fatal($set_renewed_query);
			//$GLOBALS['log']->fatal($set_inactive_query);
		}*/

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
		AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')
		AND cm3_renewals_aos_invoices_1_c.deleted = 0
		AND cm3_renewals.id = cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida
		AND cm3_renewals.id = '{$renewal->id}')
		WHERE cm3_renewals.id = '{$renewal->id}'");
	}
}

$purchases = new CM4_Purchases();
$user_m = new User();

// create purchase number per vendor
$query_purchase = "
		SELECT DISTINCT
			apc2.id
		FROM aos_products_quotes apq
		INNER JOIN aos_products ap
			ON ap.id = apq.product_id
		INNER JOIN aos_product_categories apc
			ON apc.id = ap.aos_product_category_id
		INNER JOIN aos_product_categories apc2
			ON apc2.id = apc.parent_category_id
			AND apc2.is_parent = 1
		WHERE apq.parent_type = 'AOS_Invoices'
		AND apq.parent_id = '{$invoice->id}'
	";

$result_purchases = $db->query($query_purchase);

$employee_id = $quote->assigned_user_id;

while($row = $db->fetchByAssoc($result_purchases)) {
	$supplier_id = $row['id'];

	// Get date (formatted to 0000)
	$CurrentDateTime = $timedate->getInstance()->nowDb();
	$date_entered_timestamp = strtotime($CurrentDateTime);
	$date_entered = date('Y-m-d H:i:s', $date_entered_timestamp);
	$purchase_date = date('Y-m-d', $date_entered_timestamp);

	/*$subtracted_date = "2000-01-01";
	$days = dateDifference($purchase_date, $subtracted_date);
	$formatted_days = str_pad($days, 4, "0", STR_PAD_LEFT);

	// Get User Abbreviation
	$user_abbr = "";
	$user = $user_m->retrieve($employee_id);
	if($user) {
		$first_name = $user->first_name;
		$last_name = $user->last_name;
		$user_abbr = ucwords(substr($first_name, 0, 1).substr($last_name, 0, 1));
	}

	// Get Purchase Number
	$query_po_number = "
			SELECT *
			FROM cm4_purchases cp
			INNER JOIN aos_invoices ai
				ON ai.id = cp.aos_invoices_id_c
			WHERE cp.assigned_user_id = '{$employee_id}'
			AND cp.deleted = '0'
		";

	$result_po_number = $db->query($query_po_number);
	$count = $result_po_number->num_rows + 1;
	$count = str_pad($count, 2, "0", STR_PAD_LEFT);

	$purchase_order_name = $formatted_days.$user_abbr.$count;*/

	$purchases->id = '';
	$purchases->name = '';
	$purchases->purchase_date = $purchase_date;
	$purchases->date_entered = $date_entered;
	$purchases->date_modified = $date_entered;
	$purchases->assigned_user_id = $employee_id;
	$purchases->created_by = $employee_id;
	$purchases->modified_user_id = $employee_id;
	$purchases->aos_invoices_id_c = $invoice->id;
	$purchases->aos_product_categories_id_c = $supplier_id;
	$purchases->tax_code_c = $tax_code_purchase;
	$purchases->deleted = '0';
	$purchases->save();
}

// RUN THIS TO UPDATE THE hdn_purchase_id IN aos_products_quotes_cstm table
$query_select_po = "
            SELECT *
            FROM cm4_purchases cp
            WHERE cp.aos_invoices_id_c = '{$invoice->id}'
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
	WHERE ai.id = '{$invoice->id}'";

$db->query($query_insert_po);

// create opportunity
if(!$quote->opportunity_id) {
	$guid = create_guid();

	$CurrenrDateTime1 = $timedate->getInstance()->nowDb();
	$RealDateTime = strtotime($timedate->httpTime());
	$time = strtotime($CurrenrDateTime1);

	$time_name = date('YmdHi', $RealDateTime);
	$date_entered = date('Y-m-d H:i:s', $time);
	$name = ($new_renewal ? $time_name : 'Renewal - '.$renewal->name.' - '.$time_name);

	$renewal_updated = new CM3_Renewals();
	$renewal_updated->retrieve($renewal->id);

	$minus_one_day = "";

	if($renewal_updated->renewal_date) {
		$date = explode('/', $renewal_updated->renewal_date);

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
	$opportunity->amount = $quote->subtotal_amount;
	$opportunity->amount_usdollar = $quote->subtotal_amount;
	$opportunity->assigned_user_id = $current_user->id;
	$opportunity->created_by = $current_user->id;
	$opportunity->modified_user_id = $current_user->id;
	$opportunity->date_closed = $minus_one_day;
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
}

ob_clean();
header('Location: index.php?module=AOS_Invoices&action=DetailView&record='.$invoice->id);

?>
