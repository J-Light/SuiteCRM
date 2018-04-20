<?php
$module_name = 'CM2_Leap_Leads';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'contacts_cm2_leap_leads_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
        'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'contacts_cm2_leap_leads_1_name',
      ),
      'aos_product_categories_cm2_leap_leads_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
        'id' => 'AOS_PRODUCB617EGORIES_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'aos_product_categories_cm2_leap_leads_1_name',
      ),
      'role' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_ROLE',
        'width' => '10%',
        'default' => true,
        'name' => 'role',
      ),
      'interest' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_INTEREST',
        'width' => '10%',
        'default' => true,
        'name' => 'interest',
      ),
    ),
    'advanced_search' => 
    array (
      'contacts_cm2_leap_leads_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'CONTACTS_CM2_LEAP_LEADS_1CONTACTS_IDA',
        'name' => 'contacts_cm2_leap_leads_1_name',
      ),
      'aos_product_categories_cm2_leap_leads_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'AOS_PRODUCB617EGORIES_IDA',
        'name' => 'aos_product_categories_cm2_leap_leads_1_name',
      ),
      'role' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_ROLE',
        'width' => '10%',
        'default' => true,
        'name' => 'role',
      ),
      'interest' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_INTEREST',
        'width' => '10%',
        'default' => true,
        'name' => 'interest',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
