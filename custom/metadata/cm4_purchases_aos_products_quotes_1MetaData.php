<?php
// created: 2017-02-03 15:07:24
$dictionary["cm4_purchases_aos_products_quotes_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'cm4_purchases_aos_products_quotes_1' => 
    array (
      'lhs_module' => 'CM4_Purchases',
      'lhs_table' => 'cm4_purchases',
      'lhs_key' => 'id',
      'rhs_module' => 'AOS_Products_Quotes',
      'rhs_table' => 'aos_products_quotes',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cm4_purchases_aos_products_quotes_1_c',
      'join_key_lhs' => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
      'join_key_rhs' => 'cm4_purchases_aos_products_quotes_1aos_products_quotes_idb',
    ),
  ),
  'table' => 'cm4_purchases_aos_products_quotes_1_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cm4_purchases_aos_products_quotes_1aos_products_quotes_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cm4_purchases_aos_products_quotes_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cm4_purchases_aos_products_quotes_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cm4_purchases_aos_products_quotes_1cm4_purchases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cm4_purchases_aos_products_quotes_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cm4_purchases_aos_products_quotes_1aos_products_quotes_idb',
      ),
    ),
  ),
);