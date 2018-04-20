<?php
$module_name = 'CM5_MYOB_Card';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'COMPANY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_COMPANY',
    'width' => '10%',
    'default' => true,
  ),
  'CM5_MYOB_CARD_ACCOUNTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id' => 'CM5_MYOB_CARD_ACCOUNTSACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
);
?>
