<?php

class CM3RenewalsHook {

    public function updateRenewalsBefore(&$bean, $event, $arguments) {
        global $db;

        $renewal = new CM3_Renewals();
        $renewal->retrieve($bean->id);

        if($renewal->name == "") {
            $query = "
                SELECT opportunities.*
                FROM cm3_renewals
                INNER JOIN aos_quotes_cstm ON aos_quotes_cstm.cm3_renewals_id_c = cm3_renewals.id
                INNER JOIN aos_quotes ON aos_quotes.id = aos_quotes_cstm.id_c
                INNER JOIN opportunities ON opportunities.id = aos_quotes.opportunity_id
                WHERE cm3_renewals.id = '{$renewal->id}'
            ";

            $result = $db->query($query);

            while($row = $db->fetchByAssoc($result)) {
                $opp_id = $row['id'];
                $opp_name = $row['name'];
                $opp_date_entered = $row['date_entered'];

                $timestamp = strtotime($opp_date_entered);

                $default_opp_name = date('YmdHi', $timestamp);

                if(strpos($opp_name, 'Renewal') === false) {
                    $new_name = $bean->name.' - '.$default_opp_name;
                } else {
                    $new_name = 'Renewal - '. $bean->name.' - '.$default_opp_name;
                }

                $opportunity = new Opportunity();
                $opportunity->retrieve($opp_id);

                $auto_generated_name = $opportunity->fetched_row['auto_generated_name'];

                if($auto_generated_name != NULL && $auto_generated_name != "") {
                    $db->query("
                        UPDATE opportunities
                        SET name = '{$new_name}'
                        WHERE id = '{$opp_id}'; 
                    ");
                }
            }
        }
    }

    public function updateRenewals(&$bean, $event, $arguments) {
        /*global $db;

        $renewal_id = $bean->id;
        $agreement_number = $bean->name;

        $query = "
            SELECT opportunities.*
            FROM cm3_renewals
            INNER JOIN aos_quotes_cstm ON aos_quotes_cstm.hdn_agreement_number_c = cm3_renewals.id
            INNER JOIN aos_quotes ON aos_quotes.id = aos_quotes_cstm.id_c
            INNER JOIN opportunities ON opportunities.id = aos_quotes.opportunity_id
            WHERE cm3_renewals.id = '{$renewal_id}'
        ";
        $result = $db->query($query);

        while($row = $db->fetchByAssoc($result)) {
            $opp_id = $row['id'];
            $opp_name = $row['name'];
            $opp_date_entered = $row['date_entered'];

            $timestamp = strtotime($opp_date_entered);

            $default_opp_name = date('YmdHi', $timestamp);

            if(strpos($opp_name, 'Renewal') === false) {
                $new_name = $agreement_number.' - '.$default_opp_name;
            } else {
                $new_name = 'Renewal - '. $agreement_number.' - '.$default_opp_name;
            }

            $opportunity = new Opportunity();
            $opportunity->retrieve($opp_id);

            if($opportunity->auto_generated_name != NULL && $opportunity->auto_generated_name != "") {
                $db->query("
                    UPDATE opportunities
                    SET name = '{$new_name}'
                    WHERE id = '{$opp_id}'; 
                ");
            }
        }*/
    }

}