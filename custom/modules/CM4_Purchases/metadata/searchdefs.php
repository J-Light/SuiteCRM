<?php
$module_name = 'CM4_Purchases';
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
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
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
      'supplier' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_SUPPLIER',
        'id' => 'AOS_PRODUCT_CATEGORIES_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'supplier',
      ),
      'license_process_step' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_LICENSE_PROCESS_STEP',
        'width' => '10%',
        'default' => true,
        'name' => 'license_process_step',
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
