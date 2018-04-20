<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/



$subpanel_layout = array(
	'top_buttons' => array(
//		array('widget_class' => 'SubPanelTopCreateButton'),
//		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Contacts'),
	),

//	'where' => '',

	'list_fields' => array(
		'name'=>array(
			'vname' => 'LBL_PURCHASE_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'target_record_key' => 'id',
			'target_module' => 'CM4_Purchases', // or 'target_module_key'=>'parent_type',
			'width' => '25%',
		),
		'date_sent'=>array(
			'vname' => 'LBL_PURCHASE_DATE_SENT',
		),
		'date_booked'=>array(
			'vname' => 'LBL_PURCHASE_DATE_BOOKED',
		),
		'supplier_invoice'=>array(
			'vname' => 'LBL_PURCHASE_SUPPLIER_INVOICE',
		),
		'myob_purchase_id'=>array(
			'vname' => 'LBL_PURCHASE_MYOB_PURCHASE_ID',
		),
		'purchase_date_paid'=>array(
			'vname' => 'LBL_PURCHASE_PURCHASE_DATE_PAID',
		),
		'license_process_step'=>array(
			'vname' => 'LBL_PURCHASE_LICENSE_PROCESS',
		),

//		'date_modified'=>array(
//			'vname' => 'LBL_DATE_MODIFIED',
//			//'width' => '45%',
//		),
//		'edit_button'=>array(
//			'widget_class' => 'SubPanelEditButton',
//			'module' => $module_name,
//			'width' => '4%',
//		),
//		'remove_button'=>array(
//			'widget_class' => 'SubPanelRemoveButton',
//			'module' => $module_name,
//			'width' => '5%',
//		),
	),
);
?>
