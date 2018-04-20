<?php
$module_name = 'CM7_AccountIndustry';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'accounts_cm7_accountindustry_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
        'id' => 'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1ACCOUNTS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'accounts_cm7_accountindustry_1_name',
      ),
      'cm6_industry_cm7_accountindustry_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
        'id' => 'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1CM6_INDUSTRY_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'cm6_industry_cm7_accountindustry_1_name',
      ),
      'sic_type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SIC_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'sic_type',
      ),
    ),
    'advanced_search' => 
    array (
      'accounts_cm7_accountindustry_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'ACCOUNTS_CM7_ACCOUNTINDUSTRY_1ACCOUNTS_IDA',
        'name' => 'accounts_cm7_accountindustry_1_name',
      ),
      'cm6_industry_cm7_accountindustry_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1CM6_INDUSTRY_IDA',
        'name' => 'cm6_industry_cm7_accountindustry_1_name',
      ),
      'sic_type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SIC_TYPE',
        'width' => '10%',
        'default' => true,
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
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
