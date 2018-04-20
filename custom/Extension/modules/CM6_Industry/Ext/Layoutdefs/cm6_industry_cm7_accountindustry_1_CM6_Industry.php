<?php
 // created: 2017-09-04 12:38:38
 // /public_html/custom/Extension/modules/CM6_Industry/Ext/Layoutdefs
/*$layout_defs["CM6_Industry"]["subpanel_setup"]['cm6_industry_cm7_accountindustry_1'] = array (
  'order' => 100,
  'module' => 'CM7_AccountIndustry',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CM6_INDUSTRY_CM7_ACCOUNTINDUSTRY_1_FROM_CM7_ACCOUNTINDUSTRY_TITLE',
  'get_subpanel_data' => 'cm6_industry_cm7_accountindustry_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelAccountSelectButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);*/


$layout_defs['CM6_Industry']['subpanel_setup']['my_industries'] = array(
	'order' => 15,
	'module' => 'CM7_AccountIndustry',
	'subpanel_name' => 'ForIndustries',
	'get_subpanel_data' => 'function:cm6_industry_cm7_accountindustry_1',
	'title_key' => 'Accounts',
	'top_buttons' => array(
		array('widget_class' => 'SubPanelAccountSelectButton', 'mode' => 'multiselect'),
	),
);