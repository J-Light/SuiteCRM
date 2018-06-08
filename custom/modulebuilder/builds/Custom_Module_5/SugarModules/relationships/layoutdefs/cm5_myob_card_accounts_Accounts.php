<?php
 // created: 2017-01-27 17:03:49
$layout_defs["Accounts"]["subpanel_setup"]['cm5_myob_card_accounts'] = array (
  'order' => 100,
  'module' => 'CM5_MYOB_Card',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CM5_MYOB_CARD_ACCOUNTS_FROM_CM5_MYOB_CARD_TITLE',
  'get_subpanel_data' => 'cm5_myob_card_accounts',
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
