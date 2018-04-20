<?php

$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateNoteButton'),
        array('widget_class' => 'SubPanelTopArchiveEmailButton'),
        array('widget_class' => 'SubPanelTopSummaryButton'),
    ),
    'where' => '',
    'list_fields' => array(
        'object_image' => array(
            'vname' => 'LBL_OBJECT_IMAGE',
            'widget_class' => 'SubPanelIcon',
            'width' => '2%',
            'image2' => 'attachment',
            'image2_url_field' => array(
                'id_field' => 'id',
                'filename_field' => 'filename',
            ),
        ),
        'name' => array(
            'vname' => 'LBL_NOTES_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '40%',
        ),
        'assigned_user_name' => array (
            'name' => 'assigned_user_name',
            'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'target_record_key' => 'assigned_user_id',
            'target_module' => 'Employees',
            'width' => '15%',
        ),
        /*'description' => array(
            'vname' => 'LBL_DESCRIPTION',
            'width' => '80%',
        ),*/
        'flag_due_date_c'=>array(
            'vname' => 'LBL_NOTES_FLAG_DUE_DATE',
            'width' => '9%',
        ),
        'action_completed_c'=>array(
            'vname' => 'LBL_NOTES_ACTION_COMPLETED',
            'width' => '9%',
        ),
        'priority_c'=>array(
            'vname' => 'LBL_PRIORITY',
            'width' => '5%',
        ),
        'due_date_c'=>array(
            'vname' => 'LBL_DUE_DATE',
            'width' => '5%',
        ),
        'date_entered' => array(
            'vname' => 'LBL_DATE_ENTERED',
            'width' => '5%',
        ),
        'edit_button' => array(
            'vname' => 'LBL_EDIT_BUTTON',
            'widget_class' => 'SubPanelEditButton',
            'module' => 'Notes',
            'width' => '5%',
        ),
        'remove_button' => array(
            'vname' => 'LBL_REMOVE',
            'widget_class' => 'SubPanelRemoveButton',
            'width' => '2%',
        ),
        'file_url' => array(
            'usage' => 'query_only'
        ),
        'filename' => array(
            'usage' => 'query_only'
        ),
    ),
);