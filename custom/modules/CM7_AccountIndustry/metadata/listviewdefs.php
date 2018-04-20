<?php
$module_name = 'CM7_AccountIndustry';
$listViewDefs [$module_name] = 
array (
  'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1ACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
    'id' => 'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1CM6_INDUSTRY_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'SIC_TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SIC_TYPE',
    'width' => '10%',
    'default' => true,
  ),
);
?>
