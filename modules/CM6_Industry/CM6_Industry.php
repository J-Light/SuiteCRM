<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
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
 */


class CM6_Industry extends Basic
{
    public $new_schema = true;
    public $module_dir = 'CM6_Industry';
    public $object_name = 'CM6_Industry';
    public $table_name = 'cm6_industry';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $sic;
    public $segment;
    public $sic_type;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }
	
	public function cm6_industry_cm7_accountindustry_1() {	
		$segments = $GLOBALS['app_list_strings']['industry_segment_list'];
		$sql_case = "";
		
		foreach($segments as $key => $val) {
			$sql_case .= " WHEN '" . $key . "' THEN '" . $val . "' ";
		}
		
		$query = "
			SELECT 
				cm7_accountindustry.id,
				ci.id as 'industry_id',
				a.id as 'account_id',
				a.name,
				ci.sic,
				CASE ci.segment {$sql_case} ELSE '' END as 'segment',
				CASE cm7_accountindustry.sic_type WHEN 1 THEN 'Primary' WHEN 2 THEN 'Other' ELSE '' END as 'sic_type',
				ci2.id as 'parent_id',
				ci2.name as 'parent_name'
			FROM cm7_accountindustry
														
			-- ACCOUNTS
			JOIN accounts_cm7_accountindustry_1_c acai
				ON cm7_accountindustry.id =  acai.accounts_cm7_accountindustry_1cm7_accountindustry_idb
			JOIN accounts a
				ON a.id = acai.accounts_cm7_accountindustry_1accounts_ida
				
			-- INDUSTRIES
			JOIN cm6_industry_cm7_accountindustry_1_c cicai 
				ON cm7_accountindustry.id = cicai.cm6_industry_cm7_accountindustry_1cm7_accountindustry_idb
			JOIN cm6_industry ci
				ON ci.id = cicai.cm6_industry_cm7_accountindustry_1cm6_industry_ida
				
			-- PARENT INDUSTRIES
			JOIN cm6_industry_cm6_industry_c cicic 
				ON ci.id = cicic.cm6_industry_cm6_industrycm6_industry_ida
			JOIN cm6_industry ci2
				ON ci2.id = cicic.cm6_industry_cm6_industrycm6_industry_idb			
				
			WHERE ci.id = '{$this->id}'
			AND cm7_accountindustry.deleted = 0
			AND a.deleted = 0
			AND ci.deleted = 0
			AND ci2.deleted = 0
			AND cicic.deleted = 0
			AND cicai.deleted = 0
			AND acai.deleted = 0
		";
		
		
		return $query;
	}
	
}