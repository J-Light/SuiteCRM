<?php
$module_name = 'CM3_Renewals';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'AGREEMENTSTATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_AGREEMENTSTATUS',
    'width' => '10%',
  ),
  'ACCOUNT_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'SUPPLIER_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SUPPLIER',
    'id' => 'AOS_PRODUCT_CATEGORIES_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'PRODUCT_GROUP_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRODUCT_GROUP',
    'id' => 'AOS_PRODUCT_CATEGORIES_ID1_C',
    'link' => true,
    'width' => '10%',
  ),
  'RENEWAL_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_RENEWAL_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
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
