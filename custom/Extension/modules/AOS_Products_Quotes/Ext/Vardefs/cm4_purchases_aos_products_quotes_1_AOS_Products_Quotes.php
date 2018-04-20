<?php
// created: 2017-02-03 15:07:24
$dictionary["AOS_Products_Quotes"]["fields"]["cm4_purchases_aos_products_quotes_1"] = array (
  'name' => 'cm4_purchases_aos_products_quotes_1',
  'type' => 'link',
  'relationship' => 'cm4_purchases_aos_products_quotes_1',
  'source' => 'non-db',
  'module' => 'CM4_Purchases',
  'bean_name' => 'CM4_Purchases',
  'vname' => 'LBL_CM4_PURCHASES_AOS_PRODUCTS_QUOTES_1_FROM_CM4_PURCHASES_TITLE',
  'id_name' => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
);
$dictionary["AOS_Products_Quotes"]["fields"]["cm4_purchases_aos_products_quotes_1_name"] = array (
  'name' => 'cm4_purchases_aos_products_quotes_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM4_PURCHASES_AOS_PRODUCTS_QUOTES_1_FROM_CM4_PURCHASES_TITLE',
  'save' => true,
  'id_name' => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
  'link' => 'cm4_purchases_aos_products_quotes_1',
  'table' => 'cm4_purchases',
  'module' => 'CM4_Purchases',
  'rname' => 'name',
);
$dictionary["AOS_Products_Quotes"]["fields"]["cm4_purchases_aos_products_quotes_1cm4_purchases_ida"] = array (
  'name' => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
  'type' => 'link',
  'relationship' => 'cm4_purchases_aos_products_quotes_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM4_PURCHASES_AOS_PRODUCTS_QUOTES_1_FROM_AOS_PRODUCTS_QUOTES_TITLE',
);
