<?php
// created: 2018-06-15 12:02:46
$subpanel_layout['list_fields'] = array (
  'aos_product_categories_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
    'id' => 'AOS_PRODUCB617EGORIES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'AOS_Product_Categories',
    'target_record_key' => 'aos_producb617egories_ida',
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