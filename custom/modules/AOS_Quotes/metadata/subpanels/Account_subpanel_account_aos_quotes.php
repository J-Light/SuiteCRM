<?php
// created: 2017-01-20 10:55:13
$subpanel_layout['list_fields'] = array (
  'number' => 
  array (
    'width' => '5%',
    'vname' => 'LBL_LIST_NUM',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '25%',
    'default' => true,
  ),
  'billing_account' => 
  array (
    'width' => '20%',
    'vname' => 'LBL_BILLING_ACCOUNT',
    'default' => true,
  ),
  'stage' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STAGE',
    'width' => '10%',
  ),
  'total_amount' => 
  array (
    'type' => 'currency',
    'width' => '15%',
    'currency_format' => true,
    'vname' => 'LBL_GRAND_TOTAL',
    'default' => true,
  ),
  'invoice_status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_INVOICE_STATUS',
    'width' => '10%',
  ),
  'expiration' => 
  array (
    'width' => '15%',
    'vname' => 'LBL_EXPIRATION',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'link' => 'assigned_user_link',
    'type' => 'relate',
    'vname' => 'LBL_ASSIGNED_USER',
    'width' => '15%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'edit_button' => 
  array (
    'widget_class' => 'SubPanelEditButton',
    'module' => 'AOS_Quotes',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'AOS_Quotes',
    'width' => '5%',
    'default' => true,
  ),
  'currency_id' => 
  array (
    'usage' => 'query_only',
  ),
);