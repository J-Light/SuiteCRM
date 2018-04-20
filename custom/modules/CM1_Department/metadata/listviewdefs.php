<?php
$module_name = 'CM1_Department';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'EMAIL' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_EMAIL',
    'width' => '10%',
    'default' => true,
  ),
  'PHONE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PHONE',
    'width' => '10%',
    'default' => true,
  ),
  'WEBPAGE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_WEBPAGE',
    'width' => '10%',
    'default' => true,
  ),
  'ACCOUNTS_CM1_DEPARTMENT_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_CM1_DEPARTMENT_1ACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
);
?>
