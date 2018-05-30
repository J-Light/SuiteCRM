<?php
$module_name = 'AOS_Products';
$searchdefs [$module_name] = 
array (
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
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'part_number' => 
      array (
        'name' => 'part_number',
        'default' => true,
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
        'default' => true,
        'name' => 'aos_product_category_name',
      ),
      'cost' => 
      array (
        'name' => 'cost',
        'default' => true,
        'width' => '10%',
      ),
      'price' => 
      array (
        'name' => 'price',
        'default' => true,
        'width' => '10%',
      ),
      'obsolete_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_OBSOLETE',
        'width' => '10%',
        'name' => 'obsolete_c',
      ),
      'is_service_c' => 
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
;
?>
