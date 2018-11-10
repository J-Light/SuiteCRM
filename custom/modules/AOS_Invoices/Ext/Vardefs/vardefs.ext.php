<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2016-09-14 06:03:24
$dictionary['AOS_Invoices']['fields']['billing_account']['required']=true;
$dictionary['AOS_Invoices']['fields']['billing_account']['inline_edit']=true;
$dictionary['AOS_Invoices']['fields']['billing_account']['merge_filter']='disabled';
$dictionary['AOS_Invoices']['fields']['billing_account']['populate_list']= array('id', 'name', 'myob_card_name_dd_c');
$dictionary['AOS_Invoices']['fields']['billing_account']['field_list']= array('account_id_c', 'account_name', 'myob_card_name_link_c');

 

 // created: 2017-01-30 09:16:24
$dictionary['AOS_Invoices']['fields']['cm5_myob_card_id_c']['inline_edit']=1;

 

 // created: 2016-04-06 08:13:55
$dictionary['AOS_Invoices']['fields']['myob_sale_date_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_date_c']['labelValue']='MYOB Sale Date';

 

 // created: 2016-05-04 08:09:26
$dictionary['AOS_Invoices']['fields']['myob_card_name_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_card_name_c']['labelValue']='MYOB Card Name';

 

 // created: 2016-04-07 06:08:41
$dictionary['AOS_Invoices']['fields']['purchase_order_date_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['purchase_order_date_c']['labelValue']='Purchase Order Date';

 

 // created: 2017-01-30 09:16:24
$dictionary['AOS_Invoices']['fields']['myob_card_lookup_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_card_lookup_c']['labelValue']='MYOB Card';

 

 // created: 2016-03-29 07:13:40
$dictionary['AOS_Invoices']['fields']['purchase_order_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['purchase_order_c']['labelValue']='Purchase Order';

 

 // created: 2016-05-04 08:06:48
$dictionary['AOS_Invoices']['fields']['tax_code_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['tax_code_c']['labelValue']='Tax Code';

 

 // created: 2017-11-08 11:26:47
$dictionary['AOS_Invoices']['fields']['myob_sale_paid_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_paid_c']['labelValue']='MYOB Sale Paid';

 

 // created: 2016-04-06 08:18:02
$dictionary['AOS_Invoices']['fields']['myob_sale_date_paid_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_date_paid_c']['labelValue']='MYOB Sale Date Paid';

 

 // created: 2018-04-19 13:48:37
$dictionary['AOS_Invoices']['fields']['customer_purchase_order_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['customer_purchase_order_c']['labelValue']='Customer Purchase Order';

 

 // created: 2016-11-01 10:36:10
$dictionary['AOS_Invoices']['fields']['myob_card_name_link_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_card_name_link_c']['labelValue']='MYOB Card Name Link';

 

 // created: 2016-08-05 14:07:29
$dictionary['AOS_Invoices']['fields']['company_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['company_c']['labelValue']='Company';

 

 // created: 2017-11-08 11:22:10
$dictionary['AOS_Invoices']['fields']['myob_sale_total_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_total_c']['labelValue']='MYOB Sale Total';

 

// created: 2018-08-07 15:41:32
$dictionary["AOS_Invoices"]["fields"]["aos_invoices_documents_1"] = array (
  'name' => 'aos_invoices_documents_1',
  'type' => 'link',
  'relationship' => 'aos_invoices_documents_1',
  'source' => 'non-db',
  'module' => 'Documents',
  'bean_name' => 'Document',
  'side' => 'right',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);


 // created: 2016-04-06 08:12:26
$dictionary['AOS_Invoices']['fields']['myob_sale_id_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_id_c']['labelValue']='MYOB Sale ID';

 

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


 // created: 2016-04-06 08:16:09
$dictionary['AOS_Invoices']['fields']['myob_sale_outstanding_c']['inline_edit']='1';
$dictionary['AOS_Invoices']['fields']['myob_sale_outstanding_c']['labelValue']='MYOB Sale Outstanding';

 
?>