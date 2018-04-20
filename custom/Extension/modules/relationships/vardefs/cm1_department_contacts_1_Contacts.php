<?php
// created: 2016-07-12 02:03:34
$dictionary["Contact"]["fields"]["cm1_department_contacts_1"] = array (
  'name' => 'cm1_department_contacts_1',
  'type' => 'link',
  'relationship' => 'cm1_department_contacts_1',
  'source' => 'non-db',
  'module' => 'CM1_Department',
  'bean_name' => 'CM1_Department',
  'vname' => 'LBL_CM1_DEPARTMENT_CONTACTS_1_FROM_CM1_DEPARTMENT_TITLE',
  'id_name' => 'cm1_department_contacts_1cm1_department_ida',
);
$dictionary["Contact"]["fields"]["cm1_department_contacts_1_name"] = array (
  'name' => 'cm1_department_contacts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM1_DEPARTMENT_CONTACTS_1_FROM_CM1_DEPARTMENT_TITLE',
  'save' => true,
  'id_name' => 'cm1_department_contacts_1cm1_department_ida',
  'link' => 'cm1_department_contacts_1',
  'table' => 'cm1_department',
  'module' => 'CM1_Department',
  'rname' => 'name',
);
$dictionary["Contact"]["fields"]["cm1_department_contacts_1cm1_department_ida"] = array (
  'name' => 'cm1_department_contacts_1cm1_department_ida',
  'type' => 'link',
  'relationship' => 'cm1_department_contacts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM1_DEPARTMENT_CONTACTS_1_FROM_CONTACTS_TITLE',
);
