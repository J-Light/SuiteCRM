<?php
// created: 2017-08-21 11:58:39
$subpanel_layout['list_fields'] = array (
  'name' =>
  array (
    'vname' => 'LBL_PRODUCTS_SERVICES',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'product_id',
    'target_module' => 'AOS_Products',
    'width' => '20%',
    'default' => true,
  ),
  'invoice_number' =>
  array (
    'link' => true,
    'vname' => 'LBL_INVOICE_LINK',
    'widget_class' => 'SubPanelDetailViewLink',
      'target_record_key' => 'invoice_id',
      'target_module' => 'AOS_Invoices',
    'width' => '5%',
    'default' => true,
  ),
  'part_number' =>
  array (
      'vname' => 'LBL_PART_NUMBER',
      'width' => '10%',
      'default' => true,
  ),
  'product_qty' =>
  array (
    'vname' => 'LBL_PRODUCT_QTY',
    'width' => '5%',
    'default' => true,
  ),
  'product_list_price' =>
  array (
    'vname' => 'LBL_PRODUCT_LIST_PRICE',
    'width' => '10%',
    'default' => true,
  ),
  'product_discount' =>
  array (
    'vname' => 'LBL_PRODUCT_DISCOUNT',
    'width' => '5%',
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
  'end_date_c' =>
  array (
    'vname' => 'LBL_TECS_END_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'status_c' =>
  array (
    'link' => false,
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => '5%',
  ),
  'agreement_name2' =>
  array (
    'link' => true,
    'vname' => 'LBL_TECS_AGREEMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'renewal_id',
    'target_module' => 'CM3_Renewals',
    'width' => '10%',
    'default' => true,
  ),
);
