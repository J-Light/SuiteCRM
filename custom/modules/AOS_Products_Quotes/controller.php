<?php
/**
 * Products, Quotations & Invoices modules.
 * Extensions to SugarCRM
 * @package Advanced OpenSales for SugarCRM
 * @subpackage Products
 * @copyright SalesAgility Ltd http://www.salesagility.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author Salesagility Ltd <support@salesagility.com>
 */

require_once('include/MVC/Controller/SugarController.php');

class AOS_Products_QuotesController extends SugarController {

    function action_get_maintenance() {
        global $db;

        $_pid = $_REQUEST['id'];
        $_pname = $_REQUEST['name'];

        $query = "SELECT * FROM aos_products_cstm WHERE aos_products_cstm.id_c = '{$_pid}'";
        $result = $this->bean->db->query($query, true);
        $row = $this->bean->db->fetchByAssoc($result);

        $maint_id = $row['aos_products_id_c'];

        if($maint_id) {
            $query = "SELECT * FROM aos_products LEFT JOIN aos_products_cstm ON aos_products.id = aos_products_cstm.id_c WHERE aos_products.id = '{$maint_id}'";
            $result = $this->bean->db->query($query, true);
            $row = $this->bean->db->fetchByAssoc($result);

            echo json_encode($row);
        }

        /*if(strpos($_pname, ' - Paid Up') !== false) {
            $name = str_replace(' - Paid Up', '', $_pname);

            $name = $name . ' - Maintenance';

            $query = "SELECT * FROM aos_products WHERE name = '{$name}'";
            $result = $this->bean->db->query($query, true);
            $row = $this->bean->db->fetchByAssoc($result);

            $id = $row['id'];

            $query = "SELECT * FROM aos_products LEFT JOIN aos_products_cstm ON aos_products.id = aos_products_cstm.id_c WHERE aos_products.id = '{$id}'";
            $result = $this->bean->db->query($query, true);
            $row = $this->bean->db->fetchByAssoc($result);

            echo json_encode($row);
        }*/
        exit;
    }

    function action_getjobnum() {
        global $db;

        $invoice_id = $_REQUEST['id'];

        // GET STATE
        $state_sql = "
            SELECT LEFT(a.billing_address_state, 1) as 'state'
            FROM aos_invoices aq
            INNER JOIN accounts a ON
                aq.billing_account_id = a.id
            WHERE aq.id = '{$invoice_id}'
        ";
        $result = $this->bean->db->query($state_sql);
        $row = $this->bean->db->fetchByAssoc($result);
        $job_state = $row['state'] ? $row['state'] : '';

        echo $job_state;

        exit;
    }

    function action_checkisansys() {
        global $db;

        $_pid = $_REQUEST['id'];

        // GET ANSYS ID
        $query = "SELECT * FROM aos_products WHERE id= '{$_pid}'";
        $result = $db->query($query);

        $product_category_id = null;
        while($row = $result->fetch_assoc()) {
            $product_category_id = $row['aos_product_category_id'];
        }

        // GET ANSYS ID
        $query = "SELECT *
                FROM aos_product_categories
                WHERE name = 'ANSYS Inc'";
        $result = $db->query($query);

        $ansys_id = null;
        while($row = $result->fetch_assoc()) {
            $ansys_id = $row['id'];
        }

        // GET ANSYS - SUB CATEGORIES
        $ansys_group = array();
        if($ansys_id) {
            $query = "SELECT *
                    FROM aos_product_categories
                    WHERE parent_category_id = '{$ansys_id}'";
            $result = $db->query($query);

            while($row = $result->fetch_assoc()) {
                $ansys_group[$row['id']] = $row['name'];
            }
        }

        // CHECK IF PRODUCT IS ANSYS
        $is_ansys = 0;
        if(isset($ansys_group[$product_category_id])) {
            $is_ansys = 1;
        }

        echo $is_ansys;

        exit;
    }

    function action_update_lineitem_status() {
        global $db;

        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $record = $_REQUEST['record'];

        $db->query("UPDATE aos_products_quotes_cstm SET status_c = '{$status}' WHERE id_c = '{$id}'");

        $redirect_URL = 'index.php?module=CM3_Renewals&action=DetailView&record='.$record;
        header("Location: $redirect_URL");
    }

}

?>
