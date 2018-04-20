<?php
// created: 2017-01-31 11:54:46
$subpanel_layout['list_fields'] = array (
  'supplier' =>
  array (
      'vname' => 'LBL_PURCHASE_SUPPLIER',
      'widget_class' => 'SubPanelDetailViewLink',
      'target_record_key' => 'supplierid',
      'target_module' => 'AOS_Product_Categories',
      'width' => '10%',
      'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_PURCHASE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'id',
    'target_module' => 'CM4_Purchases',
    'width' => '10%',
    'default' => true,
  ),
  'date_sent' => 
  array (
    'vname' => 'LBL_PURCHASE_DATE_SENT',
    'width' => '10%',
    'default' => true,
  ),
  'date_booked' => 
  array (
    'vname' => 'LBL_PURCHASE_DATE_BOOKED',
    'width' => '10%',
    'default' => true,
  ),
  'supplier_invoice' => 
  array (
    'vname' => 'LBL_PURCHASE_SUPPLIER_INVOICE',
    'width' => '10%',
    'default' => true,
  ),
  'myob_purchase_id' => 
  array (
    'vname' => 'LBL_PURCHASE_MYOB_PURCHASE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'purchase_date_paid' => 
  array (
    'vname' => 'LBL_PURCHASE_PURCHASE_DATE_PAID',
    'width' => '10%',
    'default' => true,
  ),
  'license_process_step' => 
  array (
    'vname' => 'LBL_PURCHASE_LICENSE_PROCESS',
    'width' => '30%',
    'default' => true,
  ),
);