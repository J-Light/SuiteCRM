<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2017-02-03 15:07:24
$layout_defs["CM4_Purchases"]["subpanel_setup"]['cm4_purchases_aos_products_quotes_1'] = array (
  'order' => 100,
  'module' => 'AOS_Products_Quotes',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CM4_PURCHASES_AOS_PRODUCTS_QUOTES_1_FROM_AOS_PRODUCTS_QUOTES_TITLE',
  'get_subpanel_data' => 'cm4_purchases_aos_products_quotes_1',
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


$layout_defs['CM4_Purchases']['subpanel_setup']['purchase_lineitems'] =
    array('order' => 1,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForPurchasesLineItems',
        'get_subpanel_data' => 'function:getPurchaseLineItems',
        'title_key' => 'LBL_PURCHASE_LINE_ITEM_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );


unset($layout_defs['CM4_Purchases']['subpanel_setup']['cm4_purchases_aos_products_quotes_1']);

//auto-generated file DO NOT EDIT
$layout_defs['CM4_Purchases']['subpanel_setup']['purchase_lineitems']['override_subpanel_name'] = 'CM4_Purchases_subpanel_purchase_lineitems';


//auto-generated file DO NOT EDIT
$layout_defs['CM4_Purchases']['subpanel_setup']['cm4_purchases_aos_products_quotes_1']['override_subpanel_name'] = 'CM4_Purchases_subpanel_cm4_purchases_aos_products_quotes_1';

?>