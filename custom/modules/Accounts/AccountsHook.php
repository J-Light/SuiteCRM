<?php

class AccountsHook {
	function updateAddress(&$bean, $event, $arguments) {
		global $db;
		
		$id = $bean->id;
	
		$query = "
			UPDATE accounts SET 
			billing_address_street = '{$bean->organisation_address_street_c}',
			billing_address_city = '{$bean->organisation_address_city_c}',
			billing_address_state = '{$bean->organisation_address_state_c}',
			billing_address_postalcode = '{$bean->organisation_address_pcode_c}',
			billing_address_country = '{$bean->organisation_address_country_c}'
			WHERE id = '{$id}'
		";
		
		$db->query($query);
	}
	
    function generate_crn(&$bean, $event, $arguments) {
		global $db;

		$id = $bean->id;
		$currenct_crn = $bean->crn_c;

		if($currenct_crn == '' || $currenct_crn == NULL) {
			$largest_crn = '';

			$query = "
                SELECT MAX(crn_c) as crn_c
                FROM accounts_cstm
            ";

			$result = $db->query($query);

			while($row = $db->fetchByAssoc($result)) {
				$largest_crn = $row['crn_c'];
			}

			// $largest_crn = 328955; // sample in excel

			if($largest_crn) {
				$account_number = substr($largest_crn, 0, -1);
				$new_account_number = $account_number + 1;
				$reverse_crn = strrev($new_account_number);

				#echo 'Largest CRN: ' . $largest_crn;
				#echo '<br/>';
				#echo 'Account: ' . $account_number;
				#echo '<br/>';
				#echo 'New Account Number: ' . $new_account_number;
				#echo '<br/>';
				#echo 'Reverse CRN: ' . $reverse_crn;
				#echo '<br/>';
				#echo '<br/>';

				$unweighted_sum = 0;

				for($ctr = 1; $ctr <= strlen($reverse_crn); $ctr++) {
					$mod = $ctr % 2;
					$num = substr($reverse_crn, $ctr - 1, 1);
					$weight = ($mod == 0) ? 1 : 2;

					$num_weight = $num * $weight;

					if($num_weight >= 10) {
						$_num_weight = 0;
						for($ctr2 = 1; $ctr2 <= strlen($num_weight); $ctr2++) {
							$_num_weight += substr($num_weight, $ctr2 - 1, 1);
						}

						$num_weight = $_num_weight;
					}

					#echo $num . ' * ' . $weight . ' = ' . $num_weight;
					#echo '<br/>';
					#echo '<br/>';

					$unweighted_sum += $num_weight;
				}

				$modulus_of_sum = $unweighted_sum % 10;

				#echo 'Unweighted Sum: ' . $unweighted_sum;
				#echo '<br/>';

				#echo 'Modulus of w/sum: ' . $modulus_of_sum;
				#echo '<br/>';

				$check_digit = 0;
				if($modulus_of_sum == 0) {
					$check_digit = 0;
				} else {
					$check_digit = 10 - $modulus_of_sum;
				}

				#echo '<br/>';
				#echo 'Check Digit: ' . $check_digit;
			}

			$crn = ($new_account_number * 10) + $check_digit;

			#echo '<br/>';
			#echo 'CRN: ' . $crn;

			$query = "
				UPDATE accounts_cstm
				SET crn_c = '{$crn}'
				WHERE id_c = '{$id}'
			";

			$db->query($query);

		}

	}

}
?>