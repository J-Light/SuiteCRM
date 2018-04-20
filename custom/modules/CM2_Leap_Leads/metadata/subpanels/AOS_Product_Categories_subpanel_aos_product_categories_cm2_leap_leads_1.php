<?php
// created: 2016-07-14 04:43:10
$subpanel_layout['list_fields'] = array (
  'contacts_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contacts_cm2_leap_leads_1contacts_ida',
  ),
  'role' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_ROLE',
    'width' => '10%',
    'default' => true,
  ),
  'interest' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_INTEREST',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'CM2_Leap_Leads',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'CM2_Leap_Leads',
    'width' => '5%',
    'default' => true,
  ),
);