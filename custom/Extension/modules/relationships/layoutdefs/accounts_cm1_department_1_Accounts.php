<?php
 // created: 2016-07-12 01:07:07
$layout_defs["Accounts"]["subpanel_setup"]['accounts_cm1_department_1'] = array (
  'order' => 100,
  'module' => 'CM1_Department',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNTS_CM1_DEPARTMENT_1_FROM_CM1_DEPARTMENT_TITLE',
  'get_subpanel_data' => 'accounts_cm1_department_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
