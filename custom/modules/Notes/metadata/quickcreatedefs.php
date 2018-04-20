<?php
// created: 2018-03-12 13:15:50
$viewdefs['Notes']['QuickCreate'] = array (
  'templateMeta' => 
  array (
    'form' => 
    array (
      'enctype' => 'multipart/form-data',
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
    'javascript' => '{sugar_getscript file="include/javascript/dashlets.js"}
<script>toggle_portal_flag(); function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
    'useTabs' => false,
    'tabDefs' => 
    array (
      'DEFAULT' => 
      array (
        'newTab' => false,
        'panelDefault' => 'expanded',
      ),
    ),
  ),
  'panels' => 
  array (
    'default' => 
    array (
      0 => 
      array (
        0 => 'contact_name',
        1 => 'parent_name',
      ),
      1 => 
      array (
        0 => 'filename',
        1 => 
        array (
          'name' => 'due_date_c',
          'label' => 'LBL_DUE_DATE',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
        ),
        1 => 
        array (
          'name' => 'actionee_c',
          'studio' => 'visible',
          'label' => 'LBL_ACTIONEE',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'name',
          'label' => 'LBL_SUBJECT',
          'displayParams' => 
          array (
            'size' => 50,
            'required' => true,
          ),
        ),
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'description',
          'label' => 'LBL_NOTE_STATUS',
          'displayParams' => 
          array (
            'rows' => 6,
            'cols' => 75,
          ),
        ),
      ),
      5 => 
      array (
        0 => 
        array (
          'name' => 'flag_due_date_c',
          'label' => 'LBL_FLAG_DUE_DATE',
        ),
        1 => 
        array (
          'name' => 'action_completed_c',
          'label' => 'LBL_ACTION_COMPLETED',
        ),
      ),
      6 => 
      array (
        0 => 
        array (
          'name' => 'priority_c',
          'studio' => 'visible',
          'label' => 'LBL_PRIORITY',
        ),
        1 => '',
      ),
    ),
  ),
);