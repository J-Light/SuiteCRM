<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2016-03-17 23:21:08
$dictionary['Case']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2016-07-28 06:11:48
$dictionary['Case']['fields']['date_error_reported_c']['inline_edit']='1';
$dictionary['Case']['fields']['date_error_reported_c']['labelValue']='Date Error Reported';

 

// created: 2016-07-29 02:29:38
$dictionary["Case"]["fields"]["aos_product_categories_cases_1"] = array (
  'name' => 'aos_product_categories_cases_1',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cases_1',
  'source' => 'non-db',
  'module' => 'AOS_Product_Categories',
  'bean_name' => 'AOS_Product_Categories',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'id_name' => 'aos_product_categories_cases_1aos_product_categories_ida',
);
$dictionary["Case"]["fields"]["aos_product_categories_cases_1_name"] = array (
  'name' => 'aos_product_categories_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_AOS_PRODUCT_CATEGORIES_TITLE',
  'save' => true,
  'id_name' => 'aos_product_categories_cases_1aos_product_categories_ida',
  'link' => 'aos_product_categories_cases_1',
  'table' => 'aos_product_categories',
  'module' => 'AOS_Product_Categories',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["aos_product_categories_cases_1aos_product_categories_ida"] = array (
  'name' => 'aos_product_categories_cases_1aos_product_categories_ida',
  'type' => 'link',
  'relationship' => 'aos_product_categories_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_PRODUCT_CATEGORIES_CASES_1_FROM_CASES_TITLE',
);


 // created: 2016-03-17 23:21:06
$dictionary['Case']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2016-07-28 06:15:02
$dictionary['Case']['fields']['date_reponse_c']['inline_edit']='1';
$dictionary['Case']['fields']['date_reponse_c']['labelValue']='Date Reponse';

 

 // created: 2016-03-17 23:21:07
$dictionary['Case']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2016-03-17 23:21:04
$dictionary['Case']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 

 // created: 2016-07-28 06:17:53
$dictionary['Case']['fields']['date_fixed_c']['inline_edit']='1';
$dictionary['Case']['fields']['date_fixed_c']['labelValue']='Date Fixed';

 

// created: 2016-07-28 06:17:53
$dictionary['Case']['fields']['aos_product_categories_cases_1_name']['required']= true;
$dictionary['Case']['fields']['assigned_user_name']['required']= true;
 


 // created: 2016-07-28 06:23:21
$dictionary['Case']['fields']['support_hours_c']['inline_edit']='1';
$dictionary['Case']['fields']['support_hours_c']['labelValue']='Support Hours';

 

 // created: 2016-07-28 06:01:20
$dictionary['Case']['fields']['log_c']['inline_edit']='1';
$dictionary['Case']['fields']['log_c']['labelValue']='Log';

 

 // created: 2016-07-28 06:13:14
$dictionary['Case']['fields']['support_number_c']['inline_edit']='1';
$dictionary['Case']['fields']['support_number_c']['labelValue']='Support Number';

 

 // created: 2018-04-16 16:05:05
$dictionary['Case']['fields']['internal']['default']='1';
$dictionary['Case']['fields']['internal']['inline_edit']=true;
$dictionary['Case']['fields']['internal']['merge_filter']='disabled';

 
?>