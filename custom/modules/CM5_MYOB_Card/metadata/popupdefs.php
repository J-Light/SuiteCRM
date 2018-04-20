<?php
$popupMeta = array (
    'moduleMain' => 'CM5_MYOB_Card',
    'varName' => 'CM5_MYOB_Card',
    'orderBy' => 'cm5_myob_card.name',
    'whereClauses' => array (
  'name' => 'cm5_myob_card.name',
  'cm5_myob_card_accounts_name' => 'cm5_myob_card.cm5_myob_card_accounts_name',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'cm5_myob_card_accounts_name',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'cm5_myob_card_accounts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id' => 'CM5_MYOB_CARD_ACCOUNTSACCOUNTS_IDA',
    'width' => '10%',
    'name' => 'cm5_myob_card_accounts_name',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
    'name' => 'name',
  ),
  'COMPANY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_COMPANY',
    'width' => '10%',
    'default' => true,
    'name' => 'company',
  ),
  'CM5_MYOB_CARD_ACCOUNTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id' => 'CM5_MYOB_CARD_ACCOUNTSACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'cm5_myob_card_accounts_name',
  ),
),
);
