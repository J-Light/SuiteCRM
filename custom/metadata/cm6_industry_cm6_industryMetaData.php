<?php
// created: 2017-09-04 12:32:56
$dictionary["cm6_industry_cm6_industry"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'cm6_industry_cm6_industry' => 
    array (
      'lhs_module' => 'CM6_Industry',
      'lhs_table' => 'cm6_industry',
      'lhs_key' => 'id',
      'rhs_module' => 'CM6_Industry',
      'rhs_table' => 'cm6_industry',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cm6_industry_cm6_industry_c',
      'join_key_lhs' => 'cm6_industry_cm6_industrycm6_industry_ida',
      'join_key_rhs' => 'cm6_industry_cm6_industrycm6_industry_idb',
    ),
  ),
  'table' => 'cm6_industry_cm6_industry_c',
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
      'name' => 'cm6_industry_cm6_industrycm6_industry_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cm6_industry_cm6_industrycm6_industry_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cm6_industry_cm6_industryspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cm6_industry_cm6_industry_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cm6_industry_cm6_industrycm6_industry_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cm6_industry_cm6_industry_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cm6_industry_cm6_industrycm6_industry_idb',
      ),
    ),
  ),
);