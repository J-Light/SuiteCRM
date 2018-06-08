<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2016-07-13 08:49:02
$dictionary['CM1_Department']['fields']['dept_po_country_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_po_country_c']['labelValue']='Dept PO Country';

 

 // created: 2016-07-13 08:48:15
$dictionary['CM1_Department']['fields']['dept_po_pcode_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_po_pcode_c']['labelValue']='Dept PO Postcode';

 

 // created: 2016-07-13 08:41:27
$dictionary['CM1_Department']['fields']['dept_address_country_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_address_country_c']['labelValue']='Dept Address Country';

 

 // created: 2016-07-13 08:47:12
$dictionary['CM1_Department']['fields']['dept_po_state_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_po_state_c']['labelValue']='Dept PO State';

 

 // created: 2016-07-13 08:39:15
$dictionary['CM1_Department']['fields']['dept_address_city_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_address_city_c']['labelValue']='Dept Address City';

 

 // created: 2016-07-13 08:40:42
$dictionary['CM1_Department']['fields']['dept_address_pcode_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_address_pcode_c']['labelValue']='Dept Address Postcode';

 

 // created: 2016-07-13 08:42:32
$dictionary['CM1_Department']['fields']['dept_po_street_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_po_street_c']['labelValue']='Dept PO Street';

 

 // created: 2016-07-13 08:39:57
$dictionary['CM1_Department']['fields']['dept_address_state_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_address_state_c']['labelValue']='Dept Address State';

 

 // created: 2016-07-13 08:38:30
$dictionary['CM1_Department']['fields']['dept_address_street_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_address_street_c']['labelValue']='Dept Address Street';

 

 // created: 2016-07-13 08:43:22
$dictionary['CM1_Department']['fields']['dept_po_city_c']['inline_edit']='1';
$dictionary['CM1_Department']['fields']['dept_po_city_c']['labelValue']='Dept PO City';

 

// created: 2016-07-12 01:07:07
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1"] = array (
  'name' => 'accounts_cm1_department_1',
  'type' => 'link',
  'relationship' => 'accounts_cm1_department_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_cm1_department_1accounts_ida',
);
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1_name"] = array (
  'name' => 'accounts_cm1_department_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_cm1_department_1accounts_ida',
  'link' => 'accounts_cm1_department_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["CM1_Department"]["fields"]["accounts_cm1_department_1accounts_ida"] = array (
  'name' => 'accounts_cm1_department_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_cm1_department_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_CM1_DEPARTMENT_TITLE',
);


// created: 2016-07-12 02:03:34
$dictionary["CM1_Department"]["fields"]["cm1_department_contacts_1"] = array (
  'name' => 'cm1_department_contacts_1',
  'type' => 'link',
  'relationship' => 'cm1_department_contacts_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'side' => 'right',
  'vname' => 'LBL_CM1_DEPARTMENT_CONTACTS_1_FROM_CONTACTS_TITLE',
);

?>