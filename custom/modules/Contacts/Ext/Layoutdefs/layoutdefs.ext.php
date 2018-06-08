<?php 
 //WARNING: The contents of this file are auto-generated



$layout_defs['Contacts']['subpanel_setup']['project']['order'] = 1000;
$layout_defs['Contacts']['subpanel_setup']['bugs']['order'] = 1001;


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



// remove Notes from history panel
//unset($layout_defs['Contacts']['subpanel_setup']['history']['collection_list']['notes']);

// remove the "View Summary" button
/*$layout_defs['Contacts']['subpanel_setup']['history']['top_buttons'] = array(
    array('widget_class' => 'SubPanelTopArchiveEmailButton'),
);*/

// new sub panel pointing to the new list view fields
$layout_defs['Contacts']['subpanel_setup']['notes'] = array();
/*$layout_defs['Contacts']['subpanel_setup']['notes'] = array(
    'order' => 5,
    'module' => 'Notes',
    'override_subpanel_name' => 'ForNotes',
    'subpanel_name' => 'ForHistory',
    'sort_order' => 'desc',
    'sort_by' => 'date_created',
    'title_key' => 'LBL_NOTES_SUBPANEL_TITLE',
    'get_subpanel_data' => 'notes',
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopButtonQuickCreate'),
        array('widget_class' => 'SubPanelTopSummaryButton'),
    ),
);*/

//auto-generated file DO NOT EDIT
$layout_defs['Contacts']['subpanel_setup']['contacts_cm2_leap_leads_1']['override_subpanel_name'] = 'Contact_subpanel_contacts_cm2_leap_leads_1';


//auto-generated file DO NOT EDIT
$layout_defs['Contacts']['subpanel_setup']['fp_events_contacts']['override_subpanel_name'] = 'Contact_subpanel_fp_events_contacts';

?>