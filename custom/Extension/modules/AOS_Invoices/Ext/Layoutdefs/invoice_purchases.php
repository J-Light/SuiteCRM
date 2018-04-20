<?php
$layout_defs['AOS_Invoices']['subpanel_setup']['invoice_purchases'] =
    array('order' => 49,
        'module' => 'CM4_Purchases',
        'subpanel_name' => 'ForInvoicePurchase',
        'get_subpanel_data' => 'function:getInvoicePurchases',
        'title_key' => 'LBL_INVOICE_PURCHASES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );