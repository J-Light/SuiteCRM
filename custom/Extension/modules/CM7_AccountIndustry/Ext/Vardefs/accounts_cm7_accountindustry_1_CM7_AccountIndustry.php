<?php
// created: 2017-09-04 12:38:00
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1"] = array (
  'name' => 'accounts_cm7_accountindustry_1',
  'type' => 'link',
  'relationship' => 'accounts_cm7_accountindustry_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_cm7_accountindustry_1accounts_ida',
);
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1_name"] = array (
  'name' => 'accounts_cm7_accountindustry_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_cm7_accountindustry_1accounts_ida',
  'link' => 'accounts_cm7_accountindustry_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1accounts_ida"] = array (
  'name' => 'accounts_cm7_accountindustry_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_cm7_accountindustry_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
);
