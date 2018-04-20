<?php
/**
 * Created by PhpStorm.
 * User: SVE14133CVW
 * Date: 9/20/2016
 * Time: 4:50 PM
 */

class AOS_InvoicesController extends SugarController {

    function action_get_myob_card_name() {
        global $app_list_strings;

        $id = $_REQUEST['id'];

        $query = "SELECT * FROM accounts_cstm WHERE accounts_cstm.id_c = '{$id}'";
        $result = $this->bean->db->query($query, true);
        $row = $this->bean->db->fetchByAssoc($result);

        $myob_card_name_id = $row['myob_card_name_dd_c'];
        $myob_card_name = isset($app_list_strings['myob_card_name_list'][$myob_card_name_id]) ? $app_list_strings['myob_card_name_list'][$myob_card_name_id] : '';
        echo $myob_card_name;

        exit;
    }

}