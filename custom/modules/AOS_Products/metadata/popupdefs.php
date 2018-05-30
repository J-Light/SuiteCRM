<?php
$popupMeta = array (
    'moduleMain' => 'AOS_Products',
    'varName' => 'AOS_Products',
    'orderBy' => 'aos_products.name',
    'whereClauses' => array (
  'name' => 'aos_products.name',
  'part_number' => 'aos_products.part_number',
  'price' => 'aos_products.price',
  'aos_product_category_name' => 'aos_products.aos_product_category_name',
  'obsolete_c' => 'aos_products_cstm.obsolete_c',
  'is_service_c' => 'aos_products_cstm.is_service_c',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'part_number',
  6 => 'price',
  9 => 'aos_product_category_name',
  10 => 'obsolete_c',
  11 => 'is_service_c',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'part_number' => 
  array (
    'name' => 'part_number',
    'width' => '10%',
  ),
  'aos_product_category_name' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_AOS_PRODUCT_CATEGORYS_NAME',
    'id' => 'AOS_PRODUCT_CATEGORY_ID',
    'link' => true,
    'width' => '10%',
    'name' => 'aos_product_category_name',
  ),
  'price' => 
  array (
    'name' => 'price',
    'width' => '10%',
  ),
  'obsolete_c' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_OBSOLETE',
    'width' => '10%',
    'name' => 'obsolete_c',
  ),
  'is_service_c' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_IS_SERVICE',
    'width' => '10%',
    'name' => 'is_service_c',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
    'name' => 'name',
  ),
  'PART_NUMBER' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PART_NUMBER',
    'default' => true,
    'name' => 'part_number',
  ),
  'AOS_PRODUCT_CATEGORY_NAME' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_AOS_PRODUCT_CATEGORYS_NAME',
    'id' => 'AOS_PRODUCT_CATEGORY_ID',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'PRICE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRICE',
    'default' => true,
    'name' => 'price',
  ),
  'COST_2_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'label' => 'LBL_COST_2',
    'width' => '10%',
    'name' => 'cost_2_c',
  ),
  'IS_SERVICE_C' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_IS_SERVICE',
    'width' => '10%',
    'name' => 'is_service_c',
  ),
),
);
