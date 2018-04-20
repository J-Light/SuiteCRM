<?php
$viewdefs ['Notes'] = 
array (
  'DetailView' => 
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_NOTE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_note_information' => 
      array (
        0 => 
        array (
          0 => 'contact_name',
          1 => 
          array (
            'name' => 'parent_name',
            'customLabel' => '{sugar_translate label=\'LBL_MODULE_NAME\' module=$fields.parent_type.value}',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'filename',
          ),
          1 => 
          array (
            'name' => 'due_date_c',
            'label' => 'LBL_DUE_DATE',
          ),
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
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
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_NOTE_STATUS',
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
  ),
);
?>
