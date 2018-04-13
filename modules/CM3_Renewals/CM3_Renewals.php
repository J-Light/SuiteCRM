<?php
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

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/CM3_Renewals/CM3_Renewals_sugar.php');
class CM3_Renewals extends CM3_Renewals_sugar {
	
	function __construct(){
		parent::__construct();
	}

	public function getProductsServicesPurchasedQuery() {
		$query = "
			SELECT
				aos_products_quotes.*,
				aos_products_quotes_cstm.*,
				aos_quotes.id as `quote_id`,
				aos_invoices.number as `invoice_number`,
				aos_quotes.number as `quote_number`,
				aos_quotes.name as `quote_name`,
				aos_invoices.name as `parent_name`
			FROM
				aos_products_quotes
			JOIN aos_products_quotes_cstm
				ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
			JOIN aos_products
				ON aos_products.id = aos_products_quotes.product_id
				AND aos_products.deleted = 0
			JOIN aos_invoices 
				ON aos_invoices.id = aos_products_quotes.parent_id 
				AND aos_invoices.deleted = 0 
				AND aos_products_quotes.deleted = 0
			JOIN aos_quotes_aos_invoices_c 
				ON aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb = aos_invoices.id
			JOIN aos_quotes
				ON aos_quotes.id = aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida
			JOIN cm3_renewals_aos_invoices_1_c
				ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
				AND cm3_renewals_aos_invoices_1_c.deleted = 0
			WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$this->id}'
			AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
			AND (aos_products_quotes_cstm.status_c = '1' OR aos_products_quotes_cstm.status_c = '15' OR aos_products_quotes_cstm.status_c = '50')
			AND aos_products_quotes.parent_type = 'AOS_Invoices'
		";

		return $query;
	}

	public function getInactiveProductsServicesPurchasedQuery() {
		$query = "
			SELECT
				aos_products_quotes.*,
				aos_products_quotes_cstm.*,
				aos_quotes.id as `quote_id`,
				aos_invoices.number as `invoice_number`,
				aos_quotes.number as `quote_number`,
				aos_quotes.name as `quote_name`,
				aos_invoices.name as `parent_name`
			FROM
				aos_products_quotes
			JOIN aos_products_quotes_cstm
				ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
			JOIN aos_products
				ON aos_products.id = aos_products_quotes.product_id
				AND aos_products.deleted = 0
			JOIN aos_invoices 
				ON aos_invoices.id = aos_products_quotes.parent_id 
				AND aos_invoices.deleted = 0 
				AND aos_products_quotes.deleted = 0
			JOIN aos_quotes_aos_invoices_c 
				ON aos_quotes_aos_invoices_c.aos_quotes6b83nvoices_idb = aos_invoices.id
			JOIN aos_quotes
				ON aos_quotes.id = aos_quotes_aos_invoices_c.aos_quotes77d9_quotes_ida
			JOIN cm3_renewals_aos_invoices_1_c
				ON cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1aos_invoices_idb = aos_invoices.id
				AND cm3_renewals_aos_invoices_1_c.deleted = 0
			WHERE cm3_renewals_aos_invoices_1_c.cm3_renewals_aos_invoices_1cm3_renewals_ida = '{$this->id}'
			AND (aos_products.name LIKE '%- Lease' OR aos_products.name LIKE '%- Maintenance' OR aos_products.name LIKE '%- Subscription')
			AND aos_products_quotes_cstm.status_c != '1'
			AND aos_products_quotes_cstm.status_c != '15'
			AND aos_products_quotes_cstm.status_c != '50'
			AND aos_products_quotes.parent_type = 'AOS_Invoices'
		";

		return $query;
	}

	public function getQuotes() {
		$query = "			
			SELECT
				aos_quotes.*,
				accounts.name as 'account_name',
				CONCAT(users.first_name,' ',users.last_name) as 'assigned_user_name'
			FROM aos_quotes
			JOIN aos_quotes_cstm
				ON aos_quotes_cstm.id_c = aos_quotes.id
			LEFT JOIN accounts
				ON aos_quotes.billing_account_id = accounts.id
			LEFT JOIN users
				on users.id = aos_quotes.assigned_user_id
			WHERE aos_quotes_cstm.cm3_renewals_id_c = '{$this->id}'
		";

		return $query;
	}

	public function getOpportunities() {
		$query = "		
			SELECT opportunities.*
			FROM cm3_renewals
			INNER JOIN aos_quotes_cstm ON aos_quotes_cstm.cm3_renewals_id_c = cm3_renewals.id
			INNER JOIN aos_quotes ON aos_quotes.id = aos_quotes_cstm.id_c
			INNER JOIN opportunities ON opportunities.id = aos_quotes.opportunity_id
			WHERE cm3_renewals.id = '{$this->id}'
			AND cm3_renewals.deleted = 0
			AND opportunities.deleted = 0
			AND aos_quotes.deleted = 0
		";

		return $query;
	}
}
?>