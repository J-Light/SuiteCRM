<?php
// created: 2018-04-19 19:01:31
$subpanel_layout['list_fields'] = array (
  'number' => 
  array (
    'vname' => 'LBL_RENEWAL_QUOTE_NUM',
    'width' => '10%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_RENEWAL_QUOTE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'id',
    'target_module_key' => 'AOS_Quotes',
    'width' => '10%',
    'default' => true,
  ),
  'account_name' => 
  array (
    'vname' => 'LBL_RENEWAL_QUOTE_ACCOUNT',
    'width' => '10%',
    'default' => true,
  ),
  'subtotal_amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_SUBTOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'expiration' => 
  array (
    'vname' => 'LBL_RENEWAL_QUOTE_VALID_UNTIL',
    'width' => '10%',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'vname' => 'LBL_RENEWAL_QUOTE_USER',
    'width' => '10%',
    'default' => true,
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
);