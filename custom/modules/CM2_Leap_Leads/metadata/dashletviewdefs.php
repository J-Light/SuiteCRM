<?php
$dashletData['CM2_Leap_LeadsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'type' => 'assigned_user_name',
    'default' => 'Administrator',
  ),
);
$dashletData['CM2_Leap_LeadsDashlet']['columns'] = array (
  'contacts_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'aos_product_categories_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
    'id' => 'AOS_PRODUCB617EGORIES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'role' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_ROLE',
    'width' => '10%',
    'default' => true,
  ),
  'interest' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_INTEREST',
    'width' => '10%',
    'default' => true,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
    'name' => 'date_entered',
  ),
  'name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => false,
    'name' => 'name',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
);
