<?php
// created: 2016-08-12 08:02:33
$dictionary["AOS_Invoices"]["fields"]["cm3_renewals_aos_invoices_1"] = array (
  'name' => 'cm3_renewals_aos_invoices_1',
  'type' => 'link',
  'relationship' => 'cm3_renewals_aos_invoices_1',
  'source' => 'non-db',
  'module' => 'CM3_Renewals',
  'bean_name' => 'CM3_Renewals',
  'vname' => 'LBL_CM3_RENEWALS_AOS_INVOICES_1_FROM_CM3_RENEWALS_TITLE',
  'id_name' => 'cm3_renewals_aos_invoices_1cm3_renewals_ida',
);
$dictionary["AOS_Invoices"]["fields"]["cm3_renewals_aos_invoices_1_name"] = array (
  'name' => 'cm3_renewals_aos_invoices_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CM3_RENEWALS_AOS_INVOICES_1_FROM_CM3_RENEWALS_TITLE',
  'save' => true,
  'id_name' => 'cm3_renewals_aos_invoices_1cm3_renewals_ida',
  'link' => 'cm3_renewals_aos_invoices_1',
  'table' => 'cm3_renewals',
  'module' => 'CM3_Renewals',
  'rname' => 'name',
);
$dictionary["AOS_Invoices"]["fields"]["cm3_renewals_aos_invoices_1cm3_renewals_ida"] = array (
  'name' => 'cm3_renewals_aos_invoices_1cm3_renewals_ida',
  'type' => 'link',
  'relationship' => 'cm3_renewals_aos_invoices_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CM3_RENEWALS_AOS_INVOICES_1_FROM_AOS_INVOICES_TITLE',
);
