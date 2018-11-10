<?php 
 //WARNING: The contents of this file are auto-generated


$layout_defs['Accounts']['subpanel_setup']['accounts_tecs'] =
    array('order' => 49,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForAccountsTECS',
        'get_subpanel_data' => 'function:getProductsServicesforTECS',
        'title_key' => 'LBL_PRODUCTS_SERVICES_FOR_TECS_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );


$layout_defs['Accounts']['subpanel_setup']['project']['order'] = 1000;
$layout_defs['Accounts']['subpanel_setup']['bugs']['order'] = 1001;


 // created: 2017-01-27 17:03:49
$layout_defs["Accounts"]["subpanel_setup"]['cm5_myob_card_accounts'] = array (
  'order' => 100,
  'module' => 'CM5_MYOB_Card',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_CM5_MYOB_CARD_TITLE',
  'get_subpanel_data' => 'cm5_myob_card_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


unset($layout_defs['Accounts']['subpanel_setup']['accounts_cm7_accountindustry_1']);  

 // created: 2016-07-12 01:07:07
$layout_defs["Accounts"]["subpanel_setup"]['accounts_cm1_department_1'] = array (
  'order' => 100,
  'module' => 'CM1_Department',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_CM1_DEPARTMENT_TITLE',
  'get_subpanel_data' => 'accounts_cm1_department_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


// created: 2017-09-04 12:38:00
// $layout_defs["Accounts"]["subpanel_setup"]['accounts_cm7_accountindustry_1'] = array (
//   'order' => 100,
//   'module' => 'CM7_AccountIndustry',
//   'subpanel_name' => 'default',
//   'sort_order' => 'asc',
//   'sort_by' => 'id',
//   'title_key' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
//   'get_subpanel_data' => 'accounts_cm7_accountindustry_1',
//   'top_buttons' => 
//   array (
//     0 => 
//     array (
//       'widget_class' => 'SubPanelTopButtonQuickCreate',
//     ),
//     1 => 
//     array (
//       'widget_class' => 'SubPanelTopSelectButton',
//       'mode' => 'MultiSelect',
//     ),
//   ),
// );


	
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


$layout_defs['Accounts']['subpanel_setup']['account_aos_quotes']['sort_order'] = 'desc';
$layout_defs['Accounts']['subpanel_setup']['account_aos_quotes']['sort_by'] = 'number';

$layout_defs['Accounts']['subpanel_setup']['account_aos_invoices']['sort_order'] = 'desc';
$layout_defs['Accounts']['subpanel_setup']['account_aos_invoices']['sort_by'] = 'number';



//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['cm5_myob_card_accounts']['override_subpanel_name'] = 'Account_subpanel_cm5_myob_card_accounts';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['accounts_tecs']['override_subpanel_name'] = 'Account_subpanel_accounts_tecs';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['documents']['override_subpanel_name'] = 'Account_subpanel_documents';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['contacts']['override_subpanel_name'] = 'Account_subpanel_contacts';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['account_aos_quotes']['override_subpanel_name'] = 'Account_subpanel_account_aos_quotes';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['project']['override_subpanel_name'] = 'Account_subpanel_project';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['products_services_purchased']['override_subpanel_name'] = 'Account_subpanel_products_services_purchased';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['accounts_cm7_accountindustry_1']['override_subpanel_name'] = 'Account_subpanel_accounts_cm7_accountindustry_1';


//auto-generated file DO NOT EDIT
$layout_defs['Accounts']['subpanel_setup']['bugs']['override_subpanel_name'] = 'Account_subpanel_bugs';

?>