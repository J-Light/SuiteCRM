<?php
$viewdefs ['Contacts'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">',
          1 => '<input type="hidden" name="case_id" value="{$smarty.request.case_id}">',
          2 => '<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">',
          3 => '<input type="hidden" name="email_id" value="{$smarty.request.email_id}">',
          4 => '<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">',
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
        'LBL_CONTACT_INFORMATION' => 
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
        'LBL_EDITVIEW_PANEL3' => 
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
      'lbl_contact_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'last_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_work',
            'comment' => 'Work phone number of the contact',
            'label' => 'LBL_OFFICE_PHONE',
          ),
          1 => 
          array (
            'name' => 'phone_mobile',
            'comment' => 'Mobile phone number of the contact',
            'label' => 'LBL_MOBILE_PHONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'title',
            'comment' => 'The title of the contact',
            'label' => 'LBL_TITLE',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'comment' => 'Contact fax number',
            'label' => 'LBL_FAX_PHONE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'displayParams' => 
            array (
              'key' => 'billing',
              'copy' => 'primary',
              'billingKey' => 'primary',
              'additionalFields' => 
              array (
                'phone_office' => 'phone_work',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'cm1_department_contacts_1_name',
            'displayParams' => 
            array (
              'initial_filter' => '&accounts_cm1_department_1_name_advanced="+this.form.{$fields.account_name.name}.value+"',
            ),
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL_ADDRESS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'contact_address_street_c',
            'label' => 'LBL_CONTACT_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'contact_address_city_c',
            'label' => 'LBL_CONTACT_ADDRESS_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'contact_address_state_c',
            'label' => 'LBL_CONTACT_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'contact_address_pcode_c',
            'label' => 'LBL_CONTACT_ADDRESS_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contact_address_country_c',
            'label' => 'LBL_CONTACT_ADDRESS_COUNTRY',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'contact_po_street_c',
            'label' => 'LBL_CONTACT_PO_STREET',
          ),
          1 => 
          array (
            'name' => 'contact_po_city_c',
            'label' => 'LBL_CONTACT_PO_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'contact_po_state_c',
            'label' => 'LBL_CONTACT_PO_STATE',
          ),
          1 => 
          array (
            'name' => 'contact_po_pcode_c',
            'label' => 'LBL_CONTACT_PO_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contact_po_country_c',
            'label' => 'LBL_CONTACT_PO_COUNTRY',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'contact_home_street_c',
            'label' => 'LBL_CONTACT_HOME_STREET',
          ),
          1 => 
          array (
            'name' => 'contact_home_city_c',
            'label' => 'LBL_CONTACT_HOME_CITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'contact_home_state_c',
            'label' => 'LBL_CONTACT_HOME_STATE',
          ),
          1 => 
          array (
            'name' => 'contact_home_pcode_c',
            'label' => 'LBL_CONTACT_HOME_PCODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contact_home_country_c',
            'label' => 'LBL_CONTACT_HOME_COUNTRY',
          ),
          1 => '',
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'lead_source',
            'comment' => 'How did the contact come about',
            'label' => 'LBL_LEAD_SOURCE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'report_to_name',
            'label' => 'LBL_REPORTS_TO',
          ),
          1 => 'campaign_name',
        ),
      ),
    ),
  ),
);
?>
