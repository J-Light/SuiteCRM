<?php 
function get_my_industries($params) {
    $args = func_get_args();
    $accountId = $args[0]['account_id'];
	
    $return_array['select'] = " SELECT 
		ci.id,
		ci.name,
		ci.sic,
		ci.segment,
		cai.sic_type,
		ci2.id as 'parent_id',
		ci2.name as 'parent_name'";
	
    $return_array['from'] = " FROM cm6_industry ci2 ";
	
    $return_array['where'] = " WHERE a.id = '" . $accountId . "'";
	
    $return_array['join'] = " 
		JOIN cm6_industry_cm6_industry_c cicic 
			ON cm6_industry.id = cicic.cm6_industry_cm6_industrycm6_industry_idb
			
		JOIN cm6_industry ci 
			ON cicic.cm6_industry_cm6_industrycm6_industry_ida = ci.id
			
		JOIN cm6_industry_cm7_accountindustry_1_c cicai 
			ON ci.id = cicai.cm6_industry_cm7_accountindustry_1cm6_industry_ida
			
		JOIN cm7_accountindustry cai
			ON cai.id = cicai.cm6_industry_cm7_accountindustry_1cm7_accountindustry_idb
			
		JOIN accounts_cm7_accountindustry_1_c acai
			ON cai.id =  acai.accounts_cm7_accountindustry_1cm7_accountindustry_idb
			
		JOIN accounts a
			ON a.id = acai.accounts_cm7_accountindustry_1accounts_ida
	";
	
    $return_array['join_tables'] = '';
	
    return $return_array;
}