<?php
// created: 2017-09-04 12:38:38
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm7_accountindustry_1',
  'source' => 'non-db',
  'module' => 'CM6_Industry',
  'bean_name' => 'CM6_Industry',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
  'id_name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
);
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1_name"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
  'save' => true,
  'id_name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
  'link' => 'cm6_industry_cm7_accountindustry_1',
  'table' => 'cm6_industry',
  'module' => 'CM6_Industry',
  'rname' => 'name',
);
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1cm6_industry_ida"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm7_accountindustry_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
);
