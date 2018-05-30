<?php
$module_name = 'CM4_Purchases';
$listViewDefs [$module_name] = 
array (
  'SUPPLIER' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_SUPPLIER',
    'id' => 'AOS_PRODUCT_CATEGORIES_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'INVOICE' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_INVOICE',
    'id' => 'AOS_INVOICES_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'LICENSE_PROCESS_STEP' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_LICENSE_PROCESS_STEP',
    'width' => '10%',
    'default' => true,
  ),
  'PURCHASE_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_PURCHASE_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
;
?>
