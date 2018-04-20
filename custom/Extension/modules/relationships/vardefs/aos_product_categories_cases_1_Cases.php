<?php
// created: 2016-07-29 02:29:38
$dictionary["Case"]["fields"]["aos_product_categories_cases_1"] = array (
  'name' => 'aos_product_categories_cases_1',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cases_1',
  'source' => 'non-db',
  'module' => 'AOS_Product_Categories',
  'bean_name' => 'AOS_Product_Categories',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'id_name' => 'aos_product_categories_cases_1aos_product_categories_ida',
);
$dictionary["Case"]["fields"]["aos_product_categories_cases_1_name"] = array (
  'name' => 'aos_product_categories_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'save' => true,
  'id_name' => 'aos_product_categories_cases_1aos_product_categories_ida',
  'link' => 'aos_product_categories_cases_1',
  'table' => 'aos_product_categories',
  'module' => 'AOS_Product_Categories',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["aos_product_categories_cases_1aos_product_categories_ida"] = array (
  'name' => 'aos_product_categories_cases_1aos_product_categories_ida',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_CASES_TITLE',
);
