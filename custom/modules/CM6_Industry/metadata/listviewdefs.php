<?php
$module_name = 'CM6_Industry';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'SIC' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SIC',
    'width' => '10%',
    'default' => true,
  ),
  'SEGMENT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SEGMENT',
    'width' => '10%',
    'default' => true,
  ),
  'CM6_INDUSTRY_CM6_INDUSTRY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
    'id' => 'CM6_INDUSTRY_CM6_INDUSTRYCM6_INDUSTRY_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
?>
