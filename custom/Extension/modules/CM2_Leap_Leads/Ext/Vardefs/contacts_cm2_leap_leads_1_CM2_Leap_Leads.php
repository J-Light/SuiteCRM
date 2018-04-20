<?php
// created: 2016-07-14 04:32:37
$dictionary["CM2_Leap_Leads"]["fields"]["contacts_cm2_leap_leads_1"] = array (
  'name' => 'contacts_cm2_leap_leads_1',
  'type' => 'link',
  'relationship' => 'contacts_cm2_leap_leads_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_cm2_leap_leads_1contacts_ida',
);
$dictionary["CM2_Leap_Leads"]["fields"]["contacts_cm2_leap_leads_1_name"] = array (
  'name' => 'contacts_cm2_leap_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_cm2_leap_leads_1contacts_ida',
  'link' => 'contacts_cm2_leap_leads_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["CM2_Leap_Leads"]["fields"]["contacts_cm2_leap_leads_1contacts_ida"] = array (
  'name' => 'contacts_cm2_leap_leads_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_cm2_leap_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CM2_LEAP_LEADS_TITLE',
);
