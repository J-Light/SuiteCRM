<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2017-06-21 15:29:34
$dictionary['CM5_MYOB_Card']['fields']['currency_id']['inline_edit']=1;

 

 // created: 2017-06-21 15:29:34
$dictionary['CM5_MYOB_Card']['fields']['currency_c']['inline_edit']='1';
$dictionary['CM5_MYOB_Card']['fields']['currency_c']['labelValue']='Currency';

 

// created: 2017-01-27 17:03:49
$dictionary["CM5_MYOB_Card"]["fields"]["cm5_myob_card_accounts"] = array (
  'name' => 'cm5_myob_card_accounts',
  'type' => 'link',
  'relationship' => 'cm5_myob_card_accounts',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'id_name' => 'cm5_myob_card_accountsaccounts_ida',
);
$dictionary["CM5_MYOB_Card"]["fields"]["cm5_myob_card_accounts_name"] = array (
  'name' => 'cm5_myob_card_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'cm5_myob_card_accountsaccounts_ida',
  'link' => 'cm5_myob_card_accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["CM5_MYOB_Card"]["fields"]["cm5_myob_card_accountsaccounts_ida"] = array (
  'name' => 'cm5_myob_card_accountsaccounts_ida',
  'type' => 'link',
  'relationship' => 'cm5_myob_card_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_CM5_MYOB_CARD_TITLE',
);

?>