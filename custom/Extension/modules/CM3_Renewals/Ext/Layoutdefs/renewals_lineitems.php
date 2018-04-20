<?php
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems'] =
    array('order' => 49,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForRenewals',
        'get_subpanel_data' => 'function:getProductsServicesPurchasedQuery',
        'title_key' => 'LBL_PRODUCTS_SERVICES_PURCHASED_SUBPANEL_TITLE',
        'top_buttons' => array(),
);
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_lineitems_inactive'] =
    array('order' => 50,
        'module' => 'AOS_Products_Quotes',
        'subpanel_name' => 'ForInactiveRenewals',
        'get_subpanel_data' => 'function:getInactiveProductsServicesPurchasedQuery',
        'title_key' => 'LBL_HISTORICAL_PRODUCTS_SERVICES_PURCHASED_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_quotes'] =
    array('order' => 80,
        'module' => 'AOS_Quotes',
        'subpanel_name' => 'ForRenewalsQuotes',
        'get_subpanel_data' => 'function:getQuotes',
        'title_key' => 'LBL_QUOTES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );
$layout_defs['CM3_Renewals']['subpanel_setup']['renewals_opportunities'] =
    array('order' => 90,
        'module' => 'Opportunities',
        'subpanel_name' => 'ForRenewalsOpportunities',
        'get_subpanel_data' => 'function:getOpportunities',
        'title_key' => 'LBL_OPPORTUNITIES_SUBPANEL_TITLE',
        'top_buttons' => array(),
    );