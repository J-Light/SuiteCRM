<?php
$popupMeta = array (
    'moduleMain' => 'CM6_Industry',
    'varName' => 'CM6_Industry',
    'orderBy' => 'cm6_industry.name',
    'whereClauses' => array (
  'name' => 'cm6_industry.name',
  'sic' => 'cm6_industry.sic',
  'segment' => 'cm6_industry.segment',
  'cm6_industry_cm6_industry_name' => 'cm6_industry.cm6_industry_cm6_industry_name',
  'assigned_user_id' => 'cm6_industry.assigned_user_id',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'sic',
  5 => 'segment',
  6 => 'cm6_industry_cm6_industry_name',
  7 => 'assigned_user_id',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'sic' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SIC',
    'width' => '10%',
    'name' => 'sic',
  ),
  'segment' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SEGMENT',
    'width' => '10%',
    'name' => 'segment',
  ),
  'cm6_industry_cm6_industry_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
    'id' => 'CM6_INDUSTRY_CM6_INDUSTRYCM6_INDUSTRY_IDA',
    'width' => '10%',
    'name' => 'cm6_industry_cm6_industry_name',
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
