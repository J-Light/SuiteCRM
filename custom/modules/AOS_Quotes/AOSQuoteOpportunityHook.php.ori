<?php

class AOSQuoteOpportunityHook {

    public function updateOpportunityAmount($bean, $event, $arguments) {
        global $db;

        $quote_id = $bean->id;
        $opportunity_id = $bean->opportunity_id;
        $total_amount = 0;
        $currency_id = $bean->currency_id;

        if($event == 'after_delete') {
            $query = "SELECT * FROM aos_quotes WHERE id = '" . $quote_id . "'";
            $result = $db->query($query);

            while($row = $db->fetchByAssoc($result)) {
                $opportunity_id = $row['opportunity_id'];
            }
        }

        $query = "SELECT * FROM aos_quotes WHERE opportunity_id = '" . $opportunity_id . "' and stage = 'Confirmed' and deleted = '0'";
        $result = $db->query($query);


        while($row = $db->fetchByAssoc($result)) {
            $total_amount += is_numeric($row['total_amount']) ? $row['total_amount'] : 0;
        }

        if($opportunity_id) {
            $query = "UPDATE opportunities SET 
                amount={$total_amount}, 
                amount_usdollar={$total_amount}, 
                currency_id='{$currency_id}'
                WHERE id='{$opportunity_id}'";

            $db->query($query);
        }
    }

}