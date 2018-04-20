<?php
$module_name = 'CM7_AccountIndustry';
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
          0 => 
          array (
            'name' => 'accounts_cm7_accountindustry_1_name',
            'label' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
          ),
          1 => 
          array (
            'name' => 'cm6_industry_cm7_accountindustry_1_name',
            'label' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sic_type',
            'studio' => 'visible',
            'label' => 'LBL_SIC_TYPE',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
