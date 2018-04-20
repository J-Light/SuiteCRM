<?php

class PurchasesHook
{
    public function processRecord(&$bean, $event, $arguments)
    {
        global $db;
        $custom_query = "			SELECT *			FROM aos_invoices			WHERE id = '{$bean->aos_invoices_id_c}'		";
        $custom_result = $db->query($custom_query, true, "Error reading tasks entry: ");
        $custom_row = $db->fetchByAssoc($custom_result);
        if ($custom_row) {
            $bean->invoice = $custom_row['number'];
        }
    }

    public function afterRetrieve(&$bean, $event, $arguments)
    {
        global $db;
        $custom_query = "			SELECT *			FROM aos_invoices			WHERE id = '{$bean->aos_invoices_id_c}'		";
        $custom_result = $db->query($custom_query, true, "Error reading tasks entry: ");
        $custom_row = $db->fetchByAssoc($custom_result);
        if ($custom_row) {
            $bean->invoice = $custom_row['number'];
        }
    }

    public function updatePurchase(&$bean, $event, $arguments)
    {
        global $db;

        $user_m = new User();

        $id = $bean->id;
        $name = $bean->name;
        $po_number = $bean->po_number;
        $employee_id = $bean->assigned_user_id;

        // Get date (formatted to 0000)
        /*$purchase_date = $bean->purchase_date;
        $subtracted_date = "2000-01-01";
        $days = $this->dateDifference($purchase_date, $subtracted_date);
        $formatted_days = str_pad($days, 4, "0", STR_PAD_LEFT);*/

        // Get User Abbreviation
        /*$user = $user_m->retrieve($employee_id);
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $user_abbr = ucwords(substr($first_name, 0, 1) . substr($last_name, 0, 1));*/

        // Get Purchase Number
        //if($po_number == NULL) {
        /*$query = "
                SELECT *
                FROM cm4_purchases cp
                INNER JOIN aos_invoices ai
                    ON ai.id = cp.aos_invoices_id_c
                WHERE DATE(cp.date_entered) = UTC_DATE()
                AND cp.assigned_user_id = '{$employee_id}'
                AND cp.id != '{$id}'
                AND cp.deleted = '0'
            ";

        $result = $db->query($query);
        $count = $result->num_rows + 1;
        $po_number = str_pad($count, 2, "0", STR_PAD_LEFT);*/
        //}

        //setting the purchase order name
        //$purchase_order = $formatted_days . $user_abbr . $po_number;

        //update the purchase item
        /*$query = "
                UPDATE cm4_purchases
                SET 
                    name = '{$purchase_order}',
                    po_number = '{$po_number}'
                WHERE id = '{$id}'
            ";

        $result = $db->query($query);*/

        // UNCOMMENT BELOW
        if($name == NULL || empty($name)) {
            $query = "
                SELECT count(cp.id) as 'count'
                FROM cm4_purchases cp
            ";

            $result = $db->query($query);
            $row = $db->fetchByAssoc($result);
            $count = $row['count'] + 1;

            $query = "
                UPDATE cm4_purchases
                SET 
                    name = '{$count}'
                WHERE id = '{$id}'
            ";

            $result = $db->query($query);
        }
    }

    function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }

}