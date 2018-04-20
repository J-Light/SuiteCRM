<?php
// created: 2018-03-12 13:15:50
$viewdefs['AOS_Invoices']['DetailView'] = array (
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
        4 => 
        array (
          'customCode' => '<input type="button" class="button" onClick="showPopup(\'pdf\');" value="{$MOD.LBL_PRINT_AS_PDF}">',
        ),
        5 => 
        array (
          'customCode' => '<input type="button" class="button" onClick="showPopup(\'emailpdf\');" value="{$MOD.LBL_EMAIL_PDF}">',
        ),
        6 => 
        array (
          'customCode' => '<input type="button" class="button" onClick="showPopup(\'email\');" value="{$MOD.LBL_EMAIL_INVOICE}">',
        ),
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
    'useTabs' => true,
    'tabDefs' => 
    array (
      'LBL_PANEL_OVERVIEW' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_DETAILVIEW_PANEL1' => 
      array (
        'newTab' => false,
        'panelDefault' => 'expanded',
      ),
      'LBL_INVOICE_TO' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_LINE_ITEMS' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
    ),
    'includes' => 
    array (
      0 => 
      array (
        'file' => 'custom/modules/AOS_Invoices/custom2.js',
      ),
    ),
  ),
  'panels' => 
  array (
    'LBL_PANEL_OVERVIEW' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'name',
          'label' => 'LBL_NAME',
        ),
        1 => 
        array (
          'name' => 'number',
          'label' => 'LBL_INVOICE_NUMBER',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'quote_number',
          'label' => 'LBL_QUOTE_NUMBER',
        ),
        1 => 
        array (
          'name' => 'quote_date',
          'label' => 'LBL_QUOTE_DATE',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'due_date',
          'label' => 'LBL_DUE_DATE',
        ),
        1 => 
        array (
          'name' => 'invoice_date',
          'label' => 'LBL_INVOICE_DATE',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
        ),
        1 => 
        array (
          'name' => 'customer_purchase_order_c',
          'label' => 'LBL_CUSTOMER_PURCHASE_ORDER',
        ),
      ),
      4 => 
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
      5 => 
      array (
        0 => 
        array (
          'name' => 'company_c',
          'studio' => 'visible',
          'label' => 'LBL_COMPANY',
        ),
        1 => 
        array (
          'name' => 'cm3_renewals_aos_invoices_1_name',
          'label' => 'LBL_CM3_RENEWALS_AOS_INVOICES_1_FROM_CM3_RENEWALS_TITLE',
        ),
      ),
    ),
    'lbl_detailview_panel1' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'myob_card_lookup_c',
          'studio' => 'visible',
          'label' => 'LBL_MYOB_CARD_LOOKUP',
        ),
        1 => 
        array (
          'name' => 'tax_code_c',
          'studio' => 'visible',
          'label' => 'LBL_TAX_CODE',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'myob_sale_id_c',
          'label' => 'LBL_MYOB_SALE_ID',
        ),
        1 => 
        array (
          'name' => 'myob_sale_date_c',
          'label' => 'LBL_MYOB_SALE_DATE',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'myob_sale_total_c',
          'label' => 'LBL_MYOB_SALE_TOTAL',
        ),
        1 => 
        array (
          'name' => 'myob_sale_outstanding_c',
          'label' => 'LBL_MYOB_SALE_OUTSTANDING',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'myob_sale_paid_c',
          'label' => 'LBL_MYOB_SALE_PAID',
        ),
        1 => 
        array (
          'name' => 'myob_sale_date_paid_c',
          'label' => 'LBL_MYOB_SALE_DATE_PAID',
        ),
      ),
    ),
    'LBL_INVOICE_TO' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'billing_account',
          'label' => 'LBL_BILLING_ACCOUNT',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'billing_contact',
          'label' => 'LBL_BILLING_CONTACT',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'billing_address_street',
          'label' => 'LBL_BILLING_ADDRESS',
          'type' => 'address',
          'displayParams' => 
          array (
            'key' => 'billing',
          ),
        ),
        1 => 
        array (
          'name' => 'shipping_address_street',
          'label' => 'LBL_SHIPPING_ADDRESS',
          'type' => 'address',
          'displayParams' => 
          array (
            'key' => 'shipping',
          ),
        ),
      ),
    ),
    'lbl_line_items' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'currency_id',
          'studio' => 'visible',
          'label' => 'LBL_CURRENCY',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'line_items',
          'label' => 'LBL_LINE_ITEMS',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'total_amt',
          'label' => 'LBL_TOTAL_AMT',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'subtotal_amount',
          'label' => 'LBL_SUBTOTAL_AMOUNT',
        ),
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'shipping_amount',
          'label' => 'LBL_SHIPPING_AMOUNT',
        ),
      ),
      5 => 
      array (
        0 => 
        array (
          'name' => 'shipping_tax_amt',
          'label' => 'LBL_SHIPPING_TAX_AMT',
        ),
      ),
      6 => 
      array (
        0 => 
        array (
          'name' => 'tax_amount',
          'label' => 'LBL_TAX_AMOUNT',
        ),
      ),
      7 => 
      array (
        0 => 
        array (
          'name' => 'total_amount',
          'label' => 'LBL_GRAND_TOTAL',
        ),
      ),
    ),
    'LBL_PANEL_ASSIGNMENT' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'date_entered',
          'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
        ),
        1 => 
        array (
          'name' => 'date_modified',
          'label' => 'LBL_DATE_MODIFIED',
          'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
        ),
      ),
    ),
  ),
);