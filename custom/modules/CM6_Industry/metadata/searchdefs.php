<?php
$module_name = 'CM6_Industry';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
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
      'sic' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_SIC',
        'width' => '10%',
        'default' => true,
        'name' => 'sic',
      ),
      'segment' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SEGMENT',
        'width' => '10%',
        'default' => true,
        'name' => 'segment',
      ),
      'cm6_industry_cm6_industry_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
        'id' => 'CM6_INDUSTRY_CM6_INDUSTRYCM6_INDUSTRY_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'cm6_industry_cm6_industry_name',
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
?>
