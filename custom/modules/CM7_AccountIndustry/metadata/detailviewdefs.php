<?php
$module_name = 'CM7_AccountIndustry';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
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
      'syncDetailEditViews' => true,
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
          ),
          1 => 
          array (
            'name' => 'cm6_industry_cm7_accountindustry_1_name',
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
