<?php
$module_name = 'CM3_Renewals';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'account_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ACCOUNT',
        'id' => 'ACCOUNT_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'account_c',
      ),
      'supplier_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SUPPLIER',
        'id' => 'AOS_PRODUCT_CATEGORIES_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'supplier_c',
      ),
      'renewal_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_RENEWAL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'renewal_date',
      ),
      'agreementstatus_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_AGREEMENTSTATUS',
        'width' => '10%',
        'name' => 'agreementstatus_c',
      ),
    ),
    'advanced_search' => 
    array (
      'account_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ACCOUNT',
        'link' => true,
        'width' => '10%',
        'id' => 'ACCOUNT_ID_C',
        'name' => 'account_c',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'supplier_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SUPPLIER',
        'link' => true,
        'width' => '10%',
        'id' => 'AOS_PRODUCT_CATEGORIES_ID_C',
        'name' => 'supplier_c',
      ),
      'renewal_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_RENEWAL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'renewal_date',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'agreementstatus_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_AGREEMENTSTATUS',
        'width' => '10%',
        'name' => 'agreementstatus_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
;
?>
