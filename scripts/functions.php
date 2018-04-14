<?PHP

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

function generate_update_script($table, $data) {
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

function csv_to_variable($csv, $key, $val) {
	$fh = fopen($csv, 'r');
	$columns = fgetcsv($fh, 0, ",");
	$column_count = count($columns);

	while(($row = fgetcsv($fh, 0, ",")) !== FALSE) {
		for($i = 0; $i < $column_count; $i++) {
			// FIELDS ON EXCEL
			if(array_key_exists($columns[$i], $fields)) { // Assign to data array if it is a column we need
			
			}
		}
	}
}

function cleanup_script($code) {
	$sql = array(
		"accounts_departments" => "
			DELETE t1 
			FROM accounts_cm1_department_1_c t1, accounts_cm1_department_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.accounts_cm1_department_1accounts_ida = t2.accounts_cm1_department_1accounts_ida 
			AND t1.accounts_cm1_department_1cm1_department_idb = t2.accounts_cm1_department_1cm1_department_idb
		",
		"accounts_myobcard" =>  "
			DELETE t1 
			FROM cm5_myob_card_accounts_c t1, cm5_myob_card_accounts_c t2 
			WHERE t1.id > t2.id 
			AND t1.cm5_myob_card_accountsaccounts_ida = t2.cm5_myob_card_accountsaccounts_ida
			AND t1.cm5_myob_card_accountscm5_myob_card_idb = t2.cm5_myob_card_accountscm5_myob_card_idb
		",
		"accounts_contacts" => "
			DELETE t1 
			FROM accounts_contacts t1, accounts_contacts t2 
			WHERE t1.id > t2.id 
			AND t1.contact_id = t2.contact_id 
			AND t1.account_id = t2.account_id
		",
        "contacts_departments" => "
			DELETE t1 
			FROM cm1_department_contacts_1_c t1, cm1_department_contacts_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.cm1_department_contacts_1cm1_department_ida = t2.cm1_department_contacts_1cm1_department_ida 
			AND t1.cm1_department_contacts_1contacts_idb = t2.cm1_department_contacts_1contacts_idb
		",
		"accounts_opportunities" => "
			DELETE t1 
			FROM accounts_opportunities t1, accounts_opportunities t2 
			WHERE t1.id > t2.id 
			AND t1.opportunity_id = t2.opportunity_id 
			AND t1.account_id = t2.account_id
		",

		"leads_contacts" => "
			DELETE t1 
			FROM contacts_cm2_leap_leads_1_c t1, contacts_cm2_leap_leads_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.contacts_cm2_leap_leads_1contacts_ida = t2.contacts_cm2_leap_leads_1contacts_ida 
			AND t1.contacts_cm2_leap_leads_1cm2_leap_leads_idb = t2.contacts_cm2_leap_leads_1cm2_leap_leads_idb
		",
		"leads_products_categories" => "
			DELETE t1 
			FROM aos_product_categories_cm2_leap_leads_1_c t1, aos_product_categories_cm2_leap_leads_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.aos_producb617egories_ida = t2.aos_producb617egories_ida 
			AND t1.aos_product_categories_cm2_leap_leads_1cm2_leap_leads_idb = t2.aos_product_categories_cm2_leap_leads_1cm2_leap_leads_idb
		",

		"cases_contacts" => "
			DELETE t1 
			FROM contacts_cases t1, contacts_cases t2 
			WHERE t1.id > t2.id 
			AND t1.contact_id = t2.contact_id 
			AND t1.case_id = t2.case_id
		",
		"cases_products_categories" => "
			DELETE t1 
			FROM aos_product_categories_cases_1_c t1, aos_product_categories_cases_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.aos_product_categories_cases_1aos_product_categories_ida = t2.aos_product_categories_cases_1aos_product_categories_ida 
			AND t1.aos_product_categories_cases_1cases_idb = t2.aos_product_categories_cases_1cases_idb
		",

		"email_addresses_accounts" => "
			DELETE
			FROM email_addr_bean_rel
			WHERE email_address_id IN (
				SELECT *
				FROM (
					SELECT t1.id
					FROM email_addresses t1, email_addresses t2 
					WHERE t1.id > t2.id 
					AND t1.email_address = t2.email_address
					AND t1.primary_address = t2.primary_address
				) a
			)
		",
		"email_addr_bean_rel_accounts" => "
			DELETE t1 
			FROM email_addresses t1, email_addresses t2 
			WHERE t1.id > t2.id 
			AND t1.email_address = t2.email_address
		",

		"email_addresses_contacts" => "
			DELETE
			FROM email_addr_bean_rel
			WHERE email_address_id IN (
				SELECT *
				FROM (
					SELECT t1.id
					FROM email_addresses t1, email_addresses t2 
					WHERE t1.id > t2.id 
					AND t1.email_address = t2.email_address
					AND t1.primary_address = t2.primary_address
				) a
			)
		",
		"email_addr_bean_rel_contacts" => "
			DELETE t1 
			FROM email_addresses t1, email_addresses t2 
			WHERE t1.id > t2.id 
			AND t1.email_address = t2.email_address
		",
		"acl_roles_users" => "
			DELETE t1 
			FROM acl_roles_users t1, acl_roles_users t2 
			WHERE t1.id > t2.id 
			AND t1.role_id = t2.role_id 
			AND t1.user_id = t2.user_id
		",
		"aos_product_categories" => "
			DELETE t1
			FROM aos_product_categories t1, aos_product_categories t2 
			WHERE t1.id > t2.id 
			AND t1.name = t2.name
			AND t1.parent_category_id = t2.parent_category_id
		",
		"aos_product_categories_cstm" => "
			DELETE
			FROM aos_product_categories_cstm
			WHERE id_c IN (
				SELECT *
				FROM (
					SELECT t1.id
					FROM aos_product_categories t1, aos_product_categories t2 
					WHERE t1.id > t2.id 
					AND t1.name = t2.name
					AND t1.parent_category_id = t2.parent_category_id
				) a
			)
		",
		"aos_quotes_aos_invoices_c" =>  "
			DELETE t1 
			FROM aos_quotes_aos_invoices_c t1, aos_quotes_aos_invoices_c t2 
			WHERE t1.id > t2.id 
			AND t1.aos_quotes77d9_quotes_ida = t2.aos_quotes77d9_quotes_ida
			AND t1.aos_quotes6b83nvoices_idb = t2.aos_quotes6b83nvoices_idb
		",
		"cm3_renewals_aos_invoices_1_c" =>  "
			DELETE t1 
			FROM cm3_renewals_aos_invoices_1_c t1, cm3_renewals_aos_invoices_1_c t2 
			WHERE t1.id > t2.id 
			AND t1.cm3_renewals_aos_invoices_1cm3_renewals_ida = t2.cm3_renewals_aos_invoices_1cm3_renewals_ida
			AND t1.cm3_renewals_aos_invoices_1aos_invoices_idb = t2.cm3_renewals_aos_invoices_1aos_invoices_idb
		",
		"aos_quotes_os_contracts_c" =>  "
			DELETE t1 
			FROM aos_quotes_os_contracts_c t1, aos_quotes_os_contracts_c t2 
			WHERE t1.id > t2.id 
			AND t1.aos_quotese81e_quotes_ida = t2.aos_quotese81e_quotes_ida
			AND t1.aos_quotes4dc0ntracts_idb = t2.aos_quotes4dc0ntracts_idb
		"
	);
	
	return isset($sql[$code]) ? $sql[$code] : null;
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

function print_log($filename, $str){
	$fh = fopen('logs/'.$filename, 'w');
	chmod($filename, 0755);
	fwrite($fh, $str);
	fclose($fh);
	exit;
}

function print_pre($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

if (!function_exists('number_unformat')) {
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
}