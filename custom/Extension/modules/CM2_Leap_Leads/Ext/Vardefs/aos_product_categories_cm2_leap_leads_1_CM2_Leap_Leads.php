<?php
// created: 2016-07-14 04:35:03
$dictionary["CM2_Leap_Leads"]["fields"]["aos_product_categories_cm2_leap_leads_1"] = array (
  'name' => 'aos_product_categories_cm2_leap_leads_1',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cm2_leap_leads_1',
  'source' => 'non-db',
  'module' => 'AOS_Product_Categories',
  'bean_name' => 'AOS_Product_Categories',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'id_name' => 'aos_producb617egories_ida',
);
$dictionary["CM2_Leap_Leads"]["fields"]["aos_product_categories_cm2_leap_leads_1_name"] = array (
  'name' => 'aos_product_categories_cm2_leap_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'save' => true,
  'id_name' => 'aos_producb617egories_ida',
  'link' => 'aos_product_categories_cm2_leap_leads_1',
  'table' => 'aos_product_categories',
  'module' => 'AOS_Product_Categories',
  'rname' => 'name',
);
$dictionary["CM2_Leap_Leads"]["fields"]["aos_producb617egories_ida"] = array (
  'name' => 'aos_producb617egories_ida',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cm2_leap_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_CM2_LEAP_LEADS_TITLE',
);
