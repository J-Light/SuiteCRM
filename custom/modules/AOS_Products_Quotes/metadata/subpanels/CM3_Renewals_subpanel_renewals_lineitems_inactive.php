<?php
// created: 2017-05-23 16:59:47
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_PRODUCTS_SERVICES',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'product_id',
    'target_module' => 'AOS_Products',
    'width' => '15%',
    'default' => true,
  ),
  'quote_number' => 
  array (
    'vname' => 'LBL_QUOTE_LINK',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'quote_id',
    'target_module' => 'AOS_Quotes',
    'width' => '5%',
    'default' => true,
  ),
  'invoice_number' => 
  array (
    'vname' => 'LBL_INVOICE_LINK',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'parent_id',
    'target_module_key' => 'parent_type',
    'width' => '5%',
    'default' => true,
  ),
  'license_type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_LICENSE_TYPE',
    'width' => '5%',
  ),
  'status_c' => 
  array (
    'link' => false,
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'start_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_START_DATE',
    'width' => '5%',
  ),
  'end_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_END_DATE',
    'width' => '5%',
  ),
  'product_qty' => 
  array (
    'vname' => 'LBL_PRODUCT_QTY',
    'width' => '3%',
    'default' => true,
  ),
  'product_list_price' => 
  array (
    'vname' => 'LBL_PRODUCT_LIST_PRICE',
    'width' => '7%',
    'default' => true,
  ),
  'product_discount' => 
  array (
    'vname' => 'LBL_PRODUCT_DISCOUNT',
    'width' => '7%',
    'default' => true,
  ),
  'product_unit_price' => 
  array (
    'vname' => 'LBL_ACCOUNT_PRODUCT_SALE_PRICE',
    'width' => '7%',
    'default' => true,
  ),
  'product_total_price' => 
  array (
    'vname' => 'LBL_PRODUCT_TOTAL_PRICE',
    'width' => '7%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'widget_class' => 'SubPanelChangeLineItemStatusToActiveButton',
    'module' => 'AOS_Products_Quotes',
    'width' => '20%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'widget_class' => 'SubPanelChangeLineItemStatusToInactiveButton',
    'module' => 'AOS_Products_Quotes',
    'width' => '20%',
    'default' => true,
  ),
  'close_button' => 
  array (
    'widget_class' => 'SubPanelChangeLineItemStatusToActnumButton',
    'module' => 'AOS_Products_Quotes',
    'width' => '20%',
    'default' => true,
  ),
    'cstm1_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToManageGlobalAccountButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
    'cstm2_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToOverseasOrderButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
    'cstm3_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToRestructuredButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
    'cstm4_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToTransferredButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
    'cstm5_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToUpgradedButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
    'cstm6_button' =>
        array (
            'widget_class' => 'SubPanelChangeLineItemStatusToRenewedButton',
            'module' => 'AOS_Products_Quotes',
            'width' => '20%',
            'default' => true,
        ),
);