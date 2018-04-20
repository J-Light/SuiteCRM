<?php
// created: 2017-01-27 17:47:45
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'company' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_COMPANY',
    'width' => '10%',
    'default' => true,
  ),
  'cm5_myob_card_accounts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id' => 'CM5_MYOB_CARD_ACCOUNTSACCOUNTS_IDA',
    'width' => '25%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'cm5_myob_card_accountsaccounts_ida',
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'CM5_MYOB_Card',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'CM5_MYOB_Card',
    'width' => '5%',
    'default' => true,
  ),
);