<?php
$popupMeta = array (
    'moduleMain' => 'CM7_AccountIndustry',
    'varName' => 'CM7_AccountIndustry',
    'orderBy' => 'cm7_accountindustry.name',
    'whereClauses' => array (
  'accounts_cm7_accountindustry_1_name' => 'cm7_accountindustry.accounts_cm7_accountindustry_1_name',
  'cm6_industry_cm7_accountindustry_1_name' => 'cm7_accountindustry.cm6_industry_cm7_accountindustry_1_name',
  'sic_type' => 'cm7_accountindustry.sic_type',
  'assigned_user_id' => 'cm7_accountindustry.assigned_user_id',
),
    'searchInputs' => array (
  4 => 'accounts_cm7_accountindustry_1_name',
  5 => 'cm6_industry_cm7_accountindustry_1_name',
  6 => 'sic_type',
  7 => 'assigned_user_id',
),
    'searchdefs' => array (
  'accounts_cm7_accountindustry_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1ACCOUNTS_IDA',
    'width' => '10%',
    'name' => 'accounts_cm7_accountindustry_1_name',
  ),
  'cm6_industry_cm7_accountindustry_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
    'id' => 'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1CM6_INDUSTRY_IDA',
    'width' => '10%',
    'name' => 'cm6_industry_cm7_accountindustry_1_name',
  ),
  'sic_type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SIC_TYPE',
    'width' => '10%',
    'name' => 'sic_type',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'label' => 'LBL_ASSIGNED_TO',
    'type' => 'enum',
    'function' => 
    array (
      'name' => 'get_user_array',
      'params' => 
      array (
        0 => false,
      ),
    ),
    'width' => '10%',
  ),
),
);
