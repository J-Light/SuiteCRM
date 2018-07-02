<?php
// created: 2018-06-04 12:04:57
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_PRODUCTS_SERVICES',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'product_id',
    'target_module' => 'AOS_Products',
    'width' => '25%',
    'default' => true,
  ),
  'invoice_number' => 
  array (
    'link' => true,
    'vname' => 'LBL_ACCOUNTS_PRODUCTS_SERVICES_INVOICE',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => NULL,
    'target_module' => NULL,
    'width' => '10%',
    'default' => true,
  ),
  'invoice_date' => 
  array (
    'vname' => 'LBL_INVOICE_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'product_qty' => 
  array (
    'vname' => 'LBL_PRODUCT_QTY',
    'width' => '10%',
    'default' => true,
  ),
  'product_list_price' => 
  array (
    'vname' => 'LBL_PRODUCT_LIST_PRICE',
    'width' => '10%',
    'default' => true,
  ),
  'status_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'product_discount' => 
  array (
    'vname' => 'LBL_PRODUCT_DISCOUNT',
    'width' => '10%',
    'default' => true,
  ),
  'product_unit_price' => 
  array (
    'vname' => 'LBL_ACCOUNT_PRODUCT_SALE_PRICE',
    'width' => '10%',
    'default' => true,
  ),
  'product_total_price' => 
  array (
    'vname' => 'LBL_PRODUCT_TOTAL_PRICE',
    'width' => '10%',
    'default' => true,
  ),
);