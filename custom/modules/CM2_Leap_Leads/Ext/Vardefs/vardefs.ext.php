<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2016-07-14 04:35:03
$dictionary["CM2_Leap_Leads"]["fields"]["aos_product_categories_cm2_leap_leads_1"] = array (
  'name' => 'aos_product_categories_cm2_leap_leads_1',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cm2_leap_leads_1',
  'source' => 'non-db',
  'module' => 'AOS_Product_Categories',
  'bean_name' => 'AOS_Product_Categories',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'id_name' => 'aos_producb617egories_ida',
);
$dictionary["CM2_Leap_Leads"]["fields"]["aos_product_categories_cm2_leap_leads_1_name"] = array (
  'name' => 'aos_product_categories_cm2_leap_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'save' => true,
  'id_name' => 'aos_producb617egories_ida',
  'link' => 'aos_product_categories_cm2_leap_leads_1',
  'table' => 'aos_product_categories',
  'module' => 'AOS_Product_Categories',
  'rname' => 'name',
);
$dictionary["CM2_Leap_Leads"]["fields"]["aos_producb617egories_ida"] = array (
  'name' => 'aos_producb617egories_ida',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cm2_leap_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CM2_LEAP_LEADS_1_FROM_CM2_LEAP_LEADS_TITLE',
);


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


 // created: 2016-07-14 04:37:32
$dictionary['CM2_Leap_Leads']['fields']['name']['required']=false;
$dictionary['CM2_Leap_Leads']['fields']['name']['inline_edit']=true;
$dictionary['CM2_Leap_Leads']['fields']['name']['duplicate_merge']='disabled';
$dictionary['CM2_Leap_Leads']['fields']['name']['duplicate_merge_dom_value']='0';
$dictionary['CM2_Leap_Leads']['fields']['name']['merge_filter']='disabled';
$dictionary['CM2_Leap_Leads']['fields']['name']['unified_search']=false;

 
?>