<?php
$layout_defs['CM4_Purchases']['subpanel_setup']['purchase_lineitems'] =
    array('order' => 1,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForPurchasesLineItems',
        'get_subpanel_data' => 'function:getPurchaseLineItems',
        'title_key' => 'LBL_PURCHASE_LINE_ITEM_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );