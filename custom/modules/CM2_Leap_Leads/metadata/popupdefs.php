<?php
$popupMeta = array (
    'moduleMain' => 'CM2_Leap_Leads',
    'varName' => 'CM2_Leap_Leads',
    'orderBy' => 'cm2_leap_leads.name',
    'whereClauses' => array (
  'contacts_cm2_leap_leads_1_name' => 'cm2_leap_leads.contacts_cm2_leap_leads_1_name',
  'aos_product_categories_cm2_leap_leads_1_name' => 'cm2_leap_leads.aos_product_categories_cm2_leap_leads_1_name',
  'role' => 'cm2_leap_leads.role',
  'interest' => 'cm2_leap_leads.interest',
),
    'searchInputs' => array (
  4 => 'contacts_cm2_leap_leads_1_name',
  5 => 'aos_product_categories_cm2_leap_leads_1_name',
  6 => 'role',
  7 => 'interest',
),
    'searchdefs' => array (
  'contacts_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
    'width' => '10%',
    'name' => 'contacts_cm2_leap_leads_1_name',
  ),
  'aos_product_categories_cm2_leap_leads_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
    'id' => 'AOS_PRODUCB617EGORIES_IDA',
    'width' => '10%',
    'name' => 'aos_product_categories_cm2_leap_leads_1_name',
  ),
  'role' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_ROLE',
    'width' => '10%',
    'name' => 'role',
  ),
  'interest' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_INTEREST',
    'width' => '10%',
    'name' => 'interest',
  ),
),
);
