<?php 
 //WARNING: The contents of this file are auto-generated


/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 8/5/2016
 * Time: 7:49 PM
 */

$dictionary['CM6_Industry']['fields']['sic_type'] = array(
    'name' => 'sic_type',
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

$dictionary['CM6_Industry']['fields']['parent_id'] = array(
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

$dictionary['CM6_Industry']['fields']['parent_name'] = array(
    'name' => 'parent_name',
    'type' => 'text',
	'source' => 'non-db',
    'link' => true,
);

// created: 2017-09-04 12:38:38
$dictionary["CM6_Industry"]["fields"]["cm6_industry_cm7_accountindustry_1"] = array (
  'name' => 'cm6_industry_cm7_accountindustry_1',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm7_accountindustry_1',
  'source' => 'non-db',
  'module' => 'CM7_AccountIndustry',
  'bean_name' => 'CM7_AccountIndustry',
  'side' => 'right',
  'vname' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
);


// created: 2017-09-04 12:32:56
$dictionary["CM6_Industry"]["fields"]["cm6_industry_cm6_industry"]=array (
  'name' => 'cm6_industry_cm6_industry',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm6_industry',
  'source' => 'non-db',
  'module' => 'CM6_Industry',
  'bean_name' => 'CM6_Industry',
  'vname' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
  'id_name' => 'cm6_industry_cm6_industrycm6_industry_ida',
  'side' => 'left',
);
$dictionary["CM6_Industry"]["fields"]["cm6_industry_cm6_industry_name"] = array (
  'name' => 'cm6_industry_cm6_industry_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
  'save' => true,
  'id_name' => 'cm6_industry_cm6_industrycm6_industry_ida',
  'link' => 'cm6_industry_cm6_industry',
  'table' => 'cm6_industry',
  'module' => 'CM6_Industry',
  'rname' => 'name',
);
$dictionary["CM6_Industry"]["fields"]["cm6_industry_cm6_industrycm6_industry_ida"] = array (
  'name' => 'cm6_industry_cm6_industrycm6_industry_ida',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm6_industry',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_R_TITLE',
);

?>