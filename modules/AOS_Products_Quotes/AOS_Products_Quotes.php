<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
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
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
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
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

require_once('modules/AOS_Products_Quotes/AOS_Products_Quotes_sugar.php');

class AOS_Products_Quotes extends AOS_Products_Quotes_sugar
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    public function AOS_Products_Quotes()
    {
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if (isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        } else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

    function save_lines($post_data, $parent, $groups = array(), $key = '')
    {
        global $db;
        
        $line_count = isset($post_data[$key . 'name']) ? count($post_data[$key . 'name']) : 0;
        $j = 0;
        for ($i = 0; $i < $line_count; ++$i) {
        
            if (isset($post_data[$key . 'deleted'][$i]) && $post_data[$key . 'deleted'][$i] == 1) {
                //$this->mark_deleted($post_data[$key . 'id'][$i]);
                $delete_query = "
                    UPDATE aos_products_quotes 
                    SET deleted = 1
                    WHERE aos_products_quotes.id = '".$post_data[$key . 'id'][$i]."' 
                    AND aos_products_quotes.deleted = 0
                ";
                $result = $db->query($delete_query);
            } else {
                if (!isset($post_data[$key . 'id'][$i])) {
                    LoggerManager::getLogger()->warn('Post date has no key id');
                    $postDataKeyIdI = null;
                } else {
                    $postDataKeyIdI = $post_data[$key . 'id'][$i];
                }

                $product_quote = BeanFactory::getBean('AOS_Products_Quotes', $postDataKeyIdI);
                if (!$product_quote) {
                    $product_quote = BeanFactory::newBean('AOS_Products_Quotes');
                }
                foreach ($this->field_defs as $field_def) {
                    $field_name = $field_def['name'];
                    if (isset($post_data[$key . $field_name][$i])) {
                        $product_quote->$field_name = $post_data[$key . $field_name][$i];
                    }
                }
                $product_quote->margin_c = $post_data['product_margin'][$i];
                $product_quote->supplier_margin_c = $post_data['product_supplier_margin_c'][$i];
                $product_quote->cost_c = $post_data['product_cost_2_c'][$i];

                if (isset($post_data[$key . 'group_number'][$i])) {
                    if (!isset($post_data[$key . 'group_number'][$i])) {
                        LoggerManager::getLogger()->warn('AOS Product Quotes error: Group number at post data key index is undefined in groups. Key and index was: ' . $key . ', ' . $i);
                        $groupIndex = null;
                    } else {
                        $groupIndex = $post_data[$key . 'group_number'][$i];
                    }
                    if (!isset($groups[$groupIndex])) {
                        LoggerManager::getLogger()->warn('AOS Product Quotes error: Group index was: ' . $groupIndex);
                        $product_quote->group_id = null;
                    } else {
                        $product_quote->group_id = $groups[$post_data[$key . 'group_number'][$i]];
                    }
                }
                if (trim($product_quote->product_id) != '' && trim($product_quote->name) != '' && trim($product_quote->product_unit_price) != '') {
                    $product_quote->number = $post_data['product_number'][$i];
                    $product_quote->assigned_user_id = $parent->assigned_user_id;
                    $product_quote->parent_id = $parent->id;

                    if (!isset($parent->currency_id)) {
                        LoggerManager::getLogger()->warn('Paren Currency ID is not defined for AOD Product Quotes / save lines.');
                        $parentCurrencyId = null;
                    } else {
                        $parentCurrencyId = $parent->currency_id;
                    }

                    $product_quote->currency_id = $parentCurrencyId;
                    $product_quote->parent_type = $parent->object_name;

                    $product_quote->save();

                    $_POST[$key . 'id'][$i] = $product_quote->id;
                }
            }
        }

        $relate_to = $post_data['relate_to'];
        $relate_id = $post_data['relate_id'];

        if($relate_to == 'AOS_Invoices') {
            // Tax Code - Sales
            $vat_sales_sql = "
                SELECT DISTINCT aos_products_quotes.*
                FROM aos_products_quotes 
                WHERE aos_products_quotes.parent_type = 'AOS_Invoices' 
                AND aos_products_quotes.parent_id = '{$relate_id}' 
                AND aos_products_quotes.deleted = 0
            ";
            $result = $db->query($vat_sales_sql);

            $tax_code_sales = "";
            while ($row = $db->fetchByAssoc($result)) {
                if($row['vat'] == '10.0') {
                    $tax_code_sales = "GST";
                } else {
                    $tax_code_sales = "FRE";
                }

                break;
            }

            $update_invoice = "UPDATE aos_invoices_cstm SET tax_code_c = '{$tax_code_sales}' WHERE id_c = '{$relate_id}'";
            $db->query($update_invoice);

            // Tax Code - Purchase
            $purchases = "SELECT cp.id as 'po_id', apq.vat, apc2.id as 'supplier_id', apc2.name, accounts_cstm.organisation_address_country_c
                        FROM cm4_purchases cp
                        INNER JOIN aos_products_quotes apq ON
                          apq.parent_id = cp.aos_invoices_id_c
                          AND apq.parent_type = 'AOS_Invoices'
                        INNER JOIN aos_products ap
                          ON ap.id = apq.product_id
                        INNER JOIN aos_product_categories apc
                          ON apc.id = ap.aos_product_category_id
                          AND ap.aos_product_category_id = apc.id
                        INNER JOIN aos_product_categories apc2
                          ON apc2.id = apc.parent_category_id
                          AND apc2.id = cp.aos_product_categories_id_c
                          AND apc2.is_parent = 1
                        INNER JOIN aos_product_categories_cstm apcc ON
                           apcc.id_c = apc2.id
                        LEFT JOIN accounts ON
                           accounts.id = apcc.account_id_c
                        LEFT JOIN accounts_cstm ON
                            accounts_cstm.id_c = accounts.id
                WHERE cp.aos_invoices_id_c = '{$relate_id}'";
            $result = $db->query($purchases);

            while ($row = $db->fetchByAssoc($result)) {
                $tax_code_purchase = "FRE";

                if($row['organisation_address_country_c'] == 'AUSTRALIA') {
                    $tax_code_purchase = "GST";
                } else {
                    $tax_code_purchase = "FRE";
                }

                $update_purchase = "UPDATE cm4_purchases_cstm SET tax_code_c = '{$tax_code_purchase}' WHERE id_c = '{$row['po_id']}'";
                $db->query($update_purchase);

                echo 'Purchase: ' . $tax_code_purchase;
                echo '<br/>';
                echo 'SQL: ' . $update_purchase;

            }
        }
    }

    public function save($check_notify = false)
    {
        require_once('modules/AOS_Products_Quotes/AOS_Utils.php');
        perform_aos_save($this);
        return parent::save($check_notify);
    }

    /**
     * @param $parent SugarBean
     */
    public function mark_lines_deleted($parent)
    {
        require_once('modules/Relationships/Relationship.php');
        $product_quotes = $parent->get_linked_beans('aos_products_quotes', $this->object_name);
        foreach ($product_quotes as $product_quote) {
            $product_quote->mark_deleted($product_quote->id);
        }
    }
}
