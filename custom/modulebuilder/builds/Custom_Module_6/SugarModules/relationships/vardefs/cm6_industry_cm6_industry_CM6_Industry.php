<?php
// created: 2017-09-04 12:32:56
$dictionary["CM6_Industry"]["fields"]["cm6_industry_cm6_industry"] = array (
  'name' => 'cm6_industry_cm6_industry',
  'type' => 'link',
  'relationship' => 'cm6_industry_cm6_industry',
  'source' => 'non-db',
  'module' => 'CM6_Industry',
  'bean_name' => 'CM6_Industry',
  'vname' => 'LBL_CM6_INDUSTRY_CM6_INDUSTRY_FROM_CM6_INDUSTRY_L_TITLE',
  'id_name' => 'cm6_industry_cm6_industrycm6_industry_ida',
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
