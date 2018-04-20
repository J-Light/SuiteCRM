<?php
$module_name = 'CM2_Leap_Leads';
$viewdefs [$module_name] = 
array (
  'EditView' => 
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
            'name' => 'contacts_cm2_leap_leads_1_name',
          ),
          1 => 
          array (
            'name' => 'aos_product_categories_cm2_leap_leads_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'role',
            'studio' => 'visible',
            'label' => 'LBL_ROLE',
          ),
          1 => 
          array (
            'name' => 'interest',
            'studio' => 'visible',
            'label' => 'LBL_INTEREST',
          ),
        ),
      ),
    ),
  ),
);
?>
