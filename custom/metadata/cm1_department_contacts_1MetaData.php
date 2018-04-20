<?php
// created: 2016-07-12 02:03:34
$dictionary["cm1_department_contacts_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'cm1_department_contacts_1' => 
    array (
      'lhs_module' => 'CM1_Department',
      'lhs_table' => 'cm1_department',
      'lhs_key' => 'id',
      'rhs_module' => 'Contacts',
      'rhs_table' => 'contacts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cm1_department_contacts_1_c',
      'join_key_lhs' => 'cm1_department_contacts_1cm1_department_ida',
      'join_key_rhs' => 'cm1_department_contacts_1contacts_idb',
    ),
  ),
  'table' => 'cm1_department_contacts_1_c',
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
      'name' => 'cm1_department_contacts_1cm1_department_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cm1_department_contacts_1contacts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cm1_department_contacts_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cm1_department_contacts_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cm1_department_contacts_1cm1_department_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cm1_department_contacts_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cm1_department_contacts_1contacts_idb',
      ),
    ),
  ),
);