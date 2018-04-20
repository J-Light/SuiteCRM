<?php
// created: 2017-09-04 12:38:38
$dictionary["cm6_industry_cm7_accountindustry_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'cm6_industry_cm7_accountindustry_1' => 
    array (
      'lhs_module' => 'CM6_Industry',
      'lhs_table' => 'cm6_industry',
      'lhs_key' => 'id',
      'rhs_module' => 'CM7_AccountIndustry',
      'rhs_table' => 'cm7_accountindustry',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cm6_industry_cm7_accountindustry_1_c',
      'join_key_lhs' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
      'join_key_rhs' => 'cm6_industry_cm7_accountindustry_1cm7_accountindustry_idb',
    ),
  ),
  'table' => 'cm6_industry_cm7_accountindustry_1_c',
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
      'name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cm6_industry_cm7_accountindustry_1cm7_accountindustry_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cm6_industry_cm7_accountindustry_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cm6_industry_cm7_accountindustry_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cm6_industry_cm7_accountindustry_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cm6_industry_cm7_accountindustry_1cm7_accountindustry_idb',
      ),
    ),
  ),
);