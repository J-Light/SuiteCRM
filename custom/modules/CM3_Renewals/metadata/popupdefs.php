<?php
$popupMeta = array (
    'moduleMain' => 'CM3_Renewals',
    'varName' => 'CM3_Renewals',
    'orderBy' => 'cm3_renewals.name',
    'whereClauses' => array (
  'name' => 'cm3_renewals.name',
  'account_c' => 'cm3_renewals.account_c',
  'assigned_user_id' => 'cm3_renewals.assigned_user_id',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'account_c',
  5 => 'assigned_user_id',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'account_c' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'name' => 'account_c',
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
