<?php

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