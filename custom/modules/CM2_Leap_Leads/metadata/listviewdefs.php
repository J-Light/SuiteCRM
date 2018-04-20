<?php
$module_name = 'CM2_Leap_Leads';
$listViewDefs [$module_name] = 
array (
  'CONTACTS_CM2_LEAP_LEADS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
    'id' => 'AOS_PRODUCB617EGORIES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'ROLE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_ROLE',
    'width' => '10%',
    'default' => true,
  ),
  'INTEREST' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_INTEREST',
    'width' => '10%',
    'default' => true,
  ),
);
?>
