<?php 
 //WARNING: The contents of this file are auto-generated


$layout_defs['AOS_Invoices']['subpanel_setup']['invoice_purchases'] =
    array('order' => 49,
        'module' => 'CM4_Purchases',
        'subpanel_name' => 'ForInvoicePurchase',
        'get_subpanel_data' => 'function:getInvoicePurchases',
        'title_key' => 'LBL_INVOICE_PURCHASES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );

 // created: 2018-08-07 15:41:32
$layout_defs["AOS_Invoices"]["subpanel_setup"]['aos_invoices_documents_1'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'aos_invoices_documents_1',
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


//auto-generated file DO NOT EDIT
$layout_defs['AOS_Invoices']['subpanel_setup']['invoice_purchases']['override_subpanel_name'] = 'AOS_Invoices_subpanel_invoice_purchases';

?>