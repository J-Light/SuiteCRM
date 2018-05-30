<?php
$module_name = 'CM1_Department';
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
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
          0 => 'name',
          1 => 
          array (
            'name' => 'accounts_cm1_department_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'webpage',
            'label' => 'LBL_WEBPAGE',
          ),
          1 => 
          array (
            'name' => 'email',
            'label' => 'LBL_EMAIL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'phone',
            'label' => 'LBL_PHONE',
          ),
          1 => 
          array (
            'name' => 'fax',
            'label' => 'LBL_FAX',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'dept_address_street_c',
            'label' => 'LBL_DEPT_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'dept_address_city_c',
            'label' => 'LBL_DEPT_ADDRESS_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'dept_address_state_c',
            'label' => 'LBL_DEPT_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'dept_address_pcode_c',
            'label' => 'LBL_DEPT_ADDRESS_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'dept_address_country_c',
            'label' => 'LBL_DEPT_ADDRESS_COUNTRY',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'dept_po_street_c',
            'label' => 'LBL_DEPT_PO_STREET',
          ),
          1 => 
          array (
            'name' => 'dept_po_city_c',
            'label' => 'LBL_DEPT_PO_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'dept_po_state_c',
            'label' => 'LBL_DEPT_PO_STATE',
          ),
          1 => 
          array (
            'name' => 'dept_po_pcode_c',
            'label' => 'LBL_DEPT_PO_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'dept_po_country_c',
            'label' => 'LBL_DEPT_PO_COUNTRY',
          ),
        ),
      ),
    ),
  ),
);
;
?>
