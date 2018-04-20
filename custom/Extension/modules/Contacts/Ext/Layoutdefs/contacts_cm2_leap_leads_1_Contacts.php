<?php
 // created: 2016-07-14 04:32:37
$layout_defs["Contacts"]["subpanel_setup"]['contacts_cm2_leap_leads_1'] = array (
  'order' => 100,
  'module' => 'CM2_Leap_Leads',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_CM2_LEAP_LEADS_1_FROM_CM2_LEAP_LEADS_TITLE',
  'get_subpanel_data' => 'contacts_cm2_leap_leads_1',
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
