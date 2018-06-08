<?php 
 //WARNING: The contents of this file are auto-generated


$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems'] =
    array('order' => 49,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForRenewals',
        'get_subpanel_data' => 'function:getProductsServicesPurchasedQuery',
        'title_key' => 'LBL_PRODUCTS_SERVICES_PURCHASED_SUBPANEL_TITLE',
        'top_buttons' => array(),
);
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems_inactive'] =
    array('order' => 50,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForInactiveRenewals',
        'get_subpanel_data' => 'function:getInactiveProductsServicesPurchasedQuery',
        'title_key' => 'LBL_HISTORICAL_PRODUCTS_SERVICES_PURCHASED_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_quotes'] =
    array('order' => 80,
        'module' => 'AOS_Quotes',
        'subpanel_name' => 'ForRenewalsQuotes',
        'get_subpanel_data' => 'function:getQuotes',
        'title_key' => 'LBL_QUOTES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_opportunities'] =
    array('order' => 90,
        'module' => 'Opportunities',
        'subpanel_name' => 'ForRenewalsOpportunities',
        'get_subpanel_data' => 'function:getOpportunities',
        'title_key' => 'LBL_OPPORTUNITIES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );

 // created: 2016-08-12 08:02:33
$layout_defs["CM3_Renewals"]["subpanel_setup"]['cm3_renewals_aos_invoices_1'] = array (
  'order' => 100,
  'module' => 'AOS_Invoices',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CM3_RENEWALS_AOS_INVOICES_1_FROM_AOS_INVOICES_TITLE',
  'get_subpanel_data' => 'cm3_renewals_aos_invoices_1',
  'top_buttons' => 
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


//auto-generated file DO NOT EDIT
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems']['override_subpanel_name'] = 'CM3_Renewals_subpanel_renewals_lineitems';


//auto-generated file DO NOT EDIT
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems_inactive']['override_subpanel_name'] = 'CM3_Renewals_subpanel_renewals_lineitems_inactive';


//auto-generated file DO NOT EDIT
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_quotes']['override_subpanel_name'] = 'CM3_Renewals_subpanel_renewals_quotes';


//auto-generated file DO NOT EDIT
$layout_defs['CM3_Renewals']['subpanel_setup']['cm3_renewals_aos_products_quotes_1']['override_subpanel_name'] = 'CM3_Renewals_subpanel_cm3_renewals_aos_products_quotes_1';

?>