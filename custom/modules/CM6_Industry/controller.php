<?php
/**
 * Date: 11/06/13
 * Written by: Andrew Mclaughlan
 * Company: SalesAgility
 */

class CM6_IndustryController extends SugarController
{
    public function action_add_to_accounts(){

        $ids = $_POST['subpanel_id'];
        $return_id = $_POST['return_id'];
        $type = $_POST['pop_up_type'];

        if(!is_array($ids)){
            $ids = array($ids);
        }

        // Accounts
        if($type == 'accounts'){
            foreach($ids as $account){
                $accountindustry_m = new CM7_AccountIndustry();
                $accountindustry_m->name = '-';
                $accountindustry_m->save();

                $accountindustry_m->load_relationship('accounts_cm7_accountindustry_1');
                $accountindustry_m->accounts_cm7_accountindustry_1->add($account);
                $accountindustry_m->save();

                $accountindustry_m->load_relationship('cm6_industry_cm7_accountindustry_1');
                $accountindustry_m->cm6_industry_cm7_accountindustry_1->add($return_id);
                $accountindustry_m->save();
            }
        }

        die();
    }
}