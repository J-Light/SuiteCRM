<?php
$layout_defs['Accounts']['subpanel_setup']['accounts_tecs'] =
    array('order' => 49,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForAccountsTECS',
        'get_subpanel_data' => 'function:getProductsServicesforTECS',
        'title_key' => 'LBL_PRODUCTS_SERVICES_FOR_TECS_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );