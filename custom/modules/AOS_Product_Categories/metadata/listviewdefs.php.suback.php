<?php
$module_name = 'AOS_Product_Categories';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'SUPPLIER_GROUP_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SUPPLIER_GROUP',
    'width' => '10%',
  ),
  'BUSINESS_UNIT_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_BUSINESS_UNIT',
    'width' => '10%',
  ),
  'PARENT_CATEGORY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PRODUCT_CATEGORYS_NAME',
    'id' => 'PARENT_CATEGORY_ID',
    'width' => '10%',
    'default' => true,
  ),
);
?>
