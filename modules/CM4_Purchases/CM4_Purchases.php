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
require_once('modules/CM4_Purchases/CM4_Purchases_sugar.php');
class CM4_Purchases extends CM4_Purchases_sugar {
	
	function __construct(){
		parent::__construct();
	}

	public function getPurchaseLineItems() {
		/*
		CONCAT(aos_products_quotes_cstm.cost_currency_symbol_c, aos_products_quotes.product_qty * ROUND(CASE aos_products_quotes_cstm.cost_c WHEN NULL THEN 0 ELSE aos_products_quotes_cstm.cost_c END, 2)) as 'custom_total_cost_c'
		*/
		$query = "
			SELECT 
				aos_products_quotes.*,
				aos_products_quotes_cstm.*,
				a.name as 'account_name',
				apc2.name as 'supplier_name',
				CONCAT(aos_products_quotes_cstm.cost_currency_symbol_c, ROUND(CASE aos_products_quotes_cstm.supplier_amount_c WHEN NULL THEN 0 ELSE aos_products_quotes_cstm.supplier_amount_c END, 2)) as 'custom_cost_c'
			FROM cm4_purchases cp
			INNER JOIN aos_invoices ai 
				ON ai.id = cp.aos_invoices_id_c
			LEFT JOIN accounts a
				ON a.id = ai.billing_account_id
			INNER JOIN aos_products_quotes
				ON aos_products_quotes.parent_id = ai.id
				AND aos_products_quotes.parent_type = 'AOS_Invoices'
			INNER JOIN aos_products_quotes_cstm 
				ON aos_products_quotes_cstm.id_c = aos_products_quotes.id
			INNER JOIN aos_products ap
				ON ap.id = aos_products_quotes.product_id
			INNER JOIN aos_product_categories apc
				ON apc.id = ap.aos_product_category_id
			LEFT JOIN aos_product_categories apc2
				ON apc2.id = apc.parent_category_id
				AND apc2.is_parent = 1
				AND apc2.id = cp.aos_product_categories_id_c
			WHERE cp.id = '{$this->id}'
                AND aos_products_quotes.deleted = '0'
				-- AND apc2.id = '{$this->aos_product_categories_id_c}'
		";

		return $query;
	}

}
?>
