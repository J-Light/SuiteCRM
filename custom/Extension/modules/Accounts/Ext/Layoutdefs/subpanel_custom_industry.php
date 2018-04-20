<?php
	
///public_html/custom/Extension/modules/Accounts/Ext/Layoutdefs
	
$layout_defs['Accounts']['subpanel_setup']['my_industries'] = array(
	'order' => 15,
	'module' => 'CM7_AccountIndustry',
	'subpanel_name' => 'ForAccounts',
	'get_subpanel_data' => 'function:accounts_cm7_accountindustry_1',
	'title_key' => 'LBL_ACCOUNT_MY_INDUSTRIES',
	'top_buttons' => array(
		array('widget_class' => 'SubPanelIndustrySelectButton', 'mode' => 'multiselect'),
	),
);