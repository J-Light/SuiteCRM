<?php
// created: 2018-03-12 13:15:50
$searchdefs['AOS_Products'] = array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      1 => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_OBSOLETE',
        'width' => '10%',
        'name' => 'obsolete_c',
      ),
      2 => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_IS_SERVICE',
        'width' => '10%',
        'name' => 'is_service_c',
      ),
    ),
    'advanced_search' => 
    array (
      0 => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      1 => 
      array (
        'name' => 'part_number',
        'default' => true,
        'width' => '10%',
      ),
      2 => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_AOS_PRODUCT_CATEGORYS_NAME',
        'id' => 'AOS_PRODUCT_CATEGORY_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'aos_product_category_name',
      ),
      3 => 
      array (
        'name' => 'cost',
        'default' => true,
        'width' => '10%',
      ),
      4 => 
      array (
        'name' => 'price',
        'default' => true,
        'width' => '10%',
      ),
      5 => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_OBSOLETE',
        'width' => '10%',
        'name' => 'obsolete_c',
      ),
      6 => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_IS_SERVICE',
        'width' => '10%',
        'name' => 'is_service_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
    'maxColumnsBasic' => '3',
  ),
);