<?php
$module_name = 'CM6_Industry';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'cm6_industry_cm6_industry_name',
            'label' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sic',
            'label' => 'LBL_SIC',
          ),
          1 => 
          array (
            'name' => 'segment',
            'studio' => 'visible',
            'label' => 'LBL_SEGMENT',
          ),
        ),
      ),
    ),
  ),
);
?>
