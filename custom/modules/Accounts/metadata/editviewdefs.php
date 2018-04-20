<?php
$viewdefs ['Accounts'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Accounts/Account.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'phone_office',
            'label' => 'LBL_PHONE_OFFICE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'website',
            'type' => 'link',
            'label' => 'LBL_WEBSITE',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'label' => 'LBL_FAX',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL',
          ),
          1 => 
          array (
            'name' => 'crn_c',
            'label' => 'LBL_CRN',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'organisation_address_street_c',
            'label' => 'LBL_ORGANISATION_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'organisation_address_city_c',
            'label' => 'LBL_ORGANISATION_ADDRESS_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'organisation_address_state_c',
            'label' => 'LBL_ORGANISATION_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'organisation_address_pcode_c',
            'label' => 'LBL_ORGANISATION_ADDRESS_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'organisation_address_country_c',
            'label' => 'LBL_ORGANISATION_ADDRESS_COUNTRY',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'organisation_po_street_c',
            'label' => 'LBL_ORGANISATION_PO_STREET',
          ),
          1 => 
          array (
            'name' => 'organisation_po_city_c',
            'label' => 'LBL_ORGANISATION_PO_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'organisation_po_state_c',
            'label' => 'LBL_ORGANISATION_PO_STATE',
          ),
          1 => 
          array (
            'name' => 'organisation_po_pcode_c',
            'label' => 'LBL_ORGANISATION_PO_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'organisation_po_country_c',
            'label' => 'LBL_ORGANISATION_PO_COUNTRY',
          ),
          1 => '',
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 'account_type',
          1 => 'industry',
        ),
        1 => 
        array (
          0 => 'annual_revenue',
          1 => 'employees',
        ),
        2 => 
        array (
          0 => 'parent_name',
        ),
        3 => 
        array (
          0 => 'campaign_name',
        ),
      ),
    ),
  ),
);
?>
