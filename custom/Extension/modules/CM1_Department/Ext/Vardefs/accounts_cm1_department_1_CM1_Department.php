<?php
// created: 2016-07-12 01:07:07
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1"] = array (
  'name' => 'accounts_cm1_department_1',
  'type' => 'link',
  'relationship' => 'accounts_cm1_department_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_cm1_department_1accounts_ida',
);
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1_name"] = array (
  'name' => 'accounts_cm1_department_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_cm1_department_1accounts_ida',
  'link' => 'accounts_cm1_department_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1accounts_ida"] = array (
  'name' => 'accounts_cm1_department_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_cm1_department_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_CM1_DEPARTMENT_TITLE',
);
