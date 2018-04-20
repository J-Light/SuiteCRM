<?php
// created: 2018-03-12 13:15:50
$viewdefs['Cases']['DetailView'] = array (
  'templateMeta' => 
  array (
    'form' => 
    array (
      'buttons' => 
      array (
        0 => 'EDIT',
        1 => 'DUPLICATE',
        2 => 'DELETE',
        3 => 'FIND_DUPLICATES',
      ),
    ),
    'maxColumns' => '2',
    'widths' => 
    array (
      0 => 
      array (
        'label' => '10',
        'field' => '30',
      ),
      1 => 
      array (
        'label' => '10',
        'field' => '30',
      ),
    ),
    'useTabs' => true,
    'tabDefs' => 
    array (
      'LBL_CASE_INFORMATION' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_AOP_CASE_UPDATES' => 
      array (
        'newTab' => false,
        'panelDefault' => 'expanded',
      ),
    ),
  ),
  'panels' => 
  array (
    'lbl_case_information' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'case_number',
          'label' => 'LBL_CASE_NUMBER',
        ),
        1 => 'priority',
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'state',
          'comment' => 'The state of the case (i.e. open/closed)',
          'label' => 'LBL_STATE',
        ),
        1 => 'status',
      ),
      2 => 
      array (
        0 => 'resolution',
        1 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
        ),
      ),
      3 => 
      array (
        0 => 'account_name',
        1 => 
        array (
          'name' => 'aos_product_categories_cases_1_name',
        ),
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'name',
          'label' => 'LBL_SUBJECT',
        ),
        1 => 'description',
      ),
      5 => 
      array (
        0 => 
        array (
          'name' => 'date_fixed_c',
          'label' => 'LBL_DATE_FIXED',
        ),
        1 => 
        array (
          'name' => 'date_reponse_c',
          'label' => 'LBL_DATE_REPONSE',
        ),
      ),
      6 => 
      array (
        0 => 
        array (
          'name' => 'date_error_reported_c',
          'label' => 'LBL_DATE_ERROR_REPORTED',
        ),
        1 => 
        array (
          'name' => 'support_hours_c',
          'label' => 'LBL_SUPPORT_HOURS',
        ),
      ),
      7 => 
      array (
        0 => 
        array (
          'name' => 'support_number_c',
          'label' => 'LBL_SUPPORT_NUMBER',
        ),
        1 => '',
      ),
    ),
    'LBL_AOP_CASE_UPDATES' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'aop_case_updates_threaded',
          'studio' => 'visible',
          'label' => 'LBL_AOP_CASE_UPDATES_THREADED',
        ),
      ),
    ),
  ),
);