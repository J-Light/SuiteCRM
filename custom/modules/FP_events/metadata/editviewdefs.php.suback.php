<?php
$module_name = 'FP_events';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
        'LBL_PANEL_OVERVIEW' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMAIL_INVITE' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'LBL_PANEL_OVERVIEW' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'fp_event_locations_fp_events_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'date_end',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'budget',
            'label' => 'LBL_BUDGET',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'status_c',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 'description',
        ),
      ),
      'LBL_EMAIL_INVITE' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'invite_templates',
            'studio' => 'visible',
            'label' => 'LBL_INVITE_TEMPLATES',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'accept_redirect',
            'label' => 'LBL_ACCEPT_REDIRECT',
          ),
          1 => 
          array (
            'name' => 'decline_redirect',
            'label' => 'LBL_DECLINE_REDIRECT',
          ),
        ),
      ),
    ),
  ),
);
?>
