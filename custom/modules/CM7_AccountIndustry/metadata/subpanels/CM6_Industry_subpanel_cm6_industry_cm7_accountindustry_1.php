<?php
// created: 2017-09-04 12:40:28
$subpanel_layout['list_fields'] = array (
  'accounts_cm7_accountindustry_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1ACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'accounts_cm7_accountindustry_1accounts_ida',
  ),
  'cm6_industry_cm7_accountindustry_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
    'id' => 'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1CM6_INDUSTRY_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'CM6_Industry',
    'target_record_key' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
  ),
  'sic_type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SIC_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'CM7_AccountIndustry',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'CM7_AccountIndustry',
    'width' => '5%',
    'default' => true,
  ),
);