<?php
$module_name = 'CM3_Renewals';
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
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
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => '',
          1 => '',
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'account_c',
            'studio' => 'visible',
            'label' => 'LBL_ACCOUNT',
          ),
          1 => 
          array (
            'name' => 'it_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_IT_CONTACT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'department_c',
            'studio' => 'visible',
            'label' => 'LBL_DEPARTMENT',
          ),
          1 => 
          array (
            'name' => 'tech_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_TECH_CONTACT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'supplier_c',
            'studio' => 'visible',
            'label' => 'LBL_SUPPLIER',
          ),
          1 => 
          array (
            'name' => 'billing_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_BILLING_CONTACT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'product_group_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_GROUP',
          ),
          1 => 
          array (
            'name' => 'renewal_date',
            'label' => 'LBL_RENEWAL_DATE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'agreementstatus_c',
            'studio' => 'visible',
            'label' => 'LBL_AGREEMENTSTATUS',
          ),
        ),
        6 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
