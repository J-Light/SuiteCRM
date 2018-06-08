<?php 
 //WARNING: The contents of this file are auto-generated


/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['account_id'] = array(
    'name' => 'account_id',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

// created: 2017-09-04 12:38:38
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm7_accountindustry_1',
  'source' => 'non-db',
  'module' => 'CM6_Industry',
  'bean_name' => 'CM6_Industry',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
  'id_name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
);
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1_name"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM6_INDUSTRY_TITLE',
  'save' => true,
  'id_name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
  'link' => 'cm6_industry_cm7_accountindustry_1',
  'table' => 'cm6_industry',
  'module' => 'CM6_Industry',
  'rname' => 'name',
);
$dictionary["CM7_AccountIndustry"]["fields"]["cm6_industry_cm7_accountindustry_1cm6_industry_ida"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1cm6_industry_ida',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm7_accountindustry_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
);


// created: 2017-09-04 12:38:00
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1"] = array (
  'name' => 'accounts_cm7_accountindustry_1',
  'type' => 'link',
  'relationship' => 'accounts_cm7_accountindustry_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_cm7_accountindustry_1accounts_ida',
);
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1_name"] = array (
  'name' => 'accounts_cm7_accountindustry_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_cm7_accountindustry_1accounts_ida',
  'link' => 'accounts_cm7_accountindustry_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["CM7_AccountIndustry"]["fields"]["accounts_cm7_accountindustry_1accounts_ida"] = array (
  'name' => 'accounts_cm7_accountindustry_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_cm7_accountindustry_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
);


/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['sic'] = array(
    'name' => 'sic',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['parent_id'] = array(
    'name' => 'parent_id',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['parent_name'] = array(
    'name' => 'parent_name',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['industry_id'] = array(
    'name' => 'industry_id',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM7_AccountIndustry']['fields']['segment'] = array(
    'name' => 'segment',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);
?>