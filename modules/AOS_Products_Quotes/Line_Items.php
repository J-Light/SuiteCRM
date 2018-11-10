<?php
/**
 * Advanced OpenSales, Advanced, robust set of sales modules.
 * @package Advanced OpenSales for SugarCRM
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
 * @author SalesAgility <info@salesagility.com>
 */

function display_lines($focus, $field, $value, $view)
{
    global $sugar_config, $locale, $app_list_strings, $mod_strings;

    $enable_groups = (int)$sugar_config['aos']['lineItems']['enableGroups'];
   $total_tax = (int)$sugar_config['aos']['lineItems']['totalTax'];

    $html = '';

    if($view == 'EditView'){
	
	$licdaterenewal = array(
            '1' => 1,	//1 Month Lease
            '10' => 10,	//10 Month Lease
            '11' => 11,	//11 Month Lease
            '12' => 12,	//12 Month Lease
            '2'	=> 2, //2 Month Lease
            '3'	=> 3, //3 Month Lease
            '4'	=> 4, //4 Month Lease
            '5'	=> 5, //5 Month Lease
            '6'	=> 6, //6 Month Lease
            '7'	=> 7, //7 Month Lease
            '8'	=> 8, //8 Month Lease
            '9'	=> 9, //9 Month Lease
            '25' => 12,	//Admin & Services (Misc)
            '99' => 12,	//Budget
            '40' => 12,	//Consulting
            '90' => 12,	//Costs
            '100' => 12,	//LEAP COS
            '-15' => 12,	//Licence Transfer
            '14' => 12,	//No Maint (Optional Maint)
            '13' => 12,	//Paid Up License
            '20' => 12,	//Stock
            '30' => 12,	//Training
            '0' => 12,	//Trial License
            '101' => 1,	//Upgrade To 1 Month Lease
            '110' => 10,	//Upgrade To 10 Month Lease
            '111' => 11,	//Upgrade To 11 Month Lease
            '112' => 12,	//Upgrade To 12 Month Lease
            '102' => 2, 	//Upgrade To 2 Month Lease
            '103' => 3, 	//Upgrade To 3 Month Lease
            '104' => 4, 	//Upgrade To 4 Month Lease
            '105' => 5,	    //Upgrade To 5 Month Lease
            '106' => 6,  	//Upgrade To 6 Month Lease
            '107' => 7, 	//Upgrade To 7 Month Lease
            '108' => 8, 	//Upgrade To 8 Month Lease
            '109' => 9, 	//Upgrade To 9 Month Lease
            '113' => 12,	//Upgrade To Paid Up License
            '-1' => 1,  	//Upgraded 1 Month Lease
            '-10' => 10,	//Upgraded 10 Month Lease
            '-11' => 11,	//Upgraded 11 Month Lease
            '-12' => 12,	//Upgraded 12 Month Lease
            '-2' => 2,	//Upgraded 2 Month Lease
            '-3' => 3,	//Upgraded 3 Month Lease
            '-4' => 4,	//Upgraded 4 Month Lease
            '-5' => 5,	//Upgraded 5 Month Lease
            '-6' => 6,	//Upgraded 6 Month Lease
            '-7' => 7,	//Upgraded 7 Month Lease
            '-8' => 8,	//Upgraded 8 Month Lease
            '-9' => 9,	//Upgraded 9 Month Lease
            '-13' => 12,	//Upgraded Paid Up License
            '15' => 12,	//WAN Access Fee from Australia
            '16' => 12,	//WAN Access Fee to Australia
            '-99' => 12	//Z DELETE
        );
        $json_lictypedate = str_replace('"', "'", json_encode($licdaterenewal));

        $html .= '<script src="modules/AOS_Products_Quotes/line_items.js"></script>';
        if(file_exists('custom/modules/AOS_Products_Quotes/line_items.js')){
			$html .= '<script src="custom/modules/AOS_Products_Quotes/moment.js"></script>';
            $html .= '<script src="custom/modules/AOS_Products_Quotes/line_items.js"></script>';
        }
        $html .= '<script language="javascript">var sig_digits = '.$locale->getPrecision().';';
        $html .= 'var module_sugar_grp1 = "'.$focus->module_dir.'";';
        $html .= 'var enable_groups = '.$enable_groups.';';
        $html .= 'var total_tax = '.$total_tax.';';
        $html .= '</script>';

        $html .= "<table border='0' cellspacing='4' id='lineItems'></table>";

        if ($enable_groups) {
            $html .= "<div style='padding-top: 10px; padding-bottom:10px;'>";
            $html .= "<input type=\"button\" tabindex=\"116\" class=\"button\" value=\"".$mod_strings['LBL_ADD_GROUP']."\" id=\"addGroup\" onclick=\"insertGroup(0)\" />";
            $html .= "</div>";
        }
		
		$licensetype_options = "";
        foreach($app_list_strings['license_type_list'] as $key => $val) {
            $licensetype_options .= "\n<OPTION value='$key'>$val</OPTION>";
        }

        $lineitem_status_options = "";
        foreach($app_list_strings['lineitem_status_list'] as $key => $val) {
            $lineitem_status_options .= "\n<OPTION value='$key'>$val</OPTION>";
        }
		
		$html .= '<input type="hidden" name="vathidden" id="vathidden" value="'.get_select_options_with_id($app_list_strings['vat_list'], '').'">
				  <input type="hidden" name="taxhidden" id="taxhidden" value="'.get_select_options_with_id($app_list_strings['myob_tax'], '').'">
				  <input type="hidden" name="lictypehidden" id="lictypehidden" value="'.$licensetype_options.'">
				  <input type="hidden" name="statushidden" id="statushidden" value="'.$lineitem_status_options.'">
				  <input type="hidden" name="discounthidden" id="discounthidden" value="'.get_select_options_with_id($app_list_strings['discount_list'], '').'">
				  <input type="hidden" name="_module" id="_module" value="'.$focus->module_dir.'" >
				  <input type="hidden" name="_invoice" id="_invoice" value="'.$focus->id.'" >';
		$html .= '<input type="hidden" name="lictypedatehidden" id="lictypedatehidden" value="'.$json_lictypedate.'">';
		
        if($focus->id != '') {
            require_once('modules/AOS_Products_Quotes/AOS_Products_Quotes.php');
            require_once('modules/AOS_Line_Item_Groups/AOS_Line_Item_Groups.php');
			
			$db = DBManagerFactory::getInstance();
			$cost_currency_strings = $GLOBALS['app_list_strings']['cost_currency_list'];
			
			$query = "SELECT *
                FROM aos_product_categories
                WHERE name = 'ANSYS Inc'";
            $result = $db->query($query);

            $ansys_id = null;
            while($row = $result->fetch_assoc()) {
                $ansys_id = $row['id'];
            }

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

            $sql = "SELECT pg.id, pg.product_list_price, pg.group_id FROM aos_products_quotes pg LEFT JOIN aos_line_item_groups lig ON pg.group_id = lig.id WHERE pg.parent_type = '" . $focus->object_name . "' AND pg.parent_id = '" . $focus->id . "' AND pg.deleted = 0 ORDER BY lig.number ASC, pg.number ASC";

            $result = $focus->db->query($sql);
            $html .= "<script>
                if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}
                </script>";

            while ($row = $focus->db->fetchByAssoc($result)) {
                $line_item = new AOS_Products_Quotes();
                $line_item->retrieve($row['id'], false);
				
				$product_id = $line_item->product_id;
				
                $line_item = json_encode($line_item->toArray());
				$line_item = json_decode($line_item);
				
				$custom_sql = "SELECT * FROM aos_products ap LEFT JOIN aos_products_cstm apc ON apc.id_c = ap.id WHERE ap.id = '" . $product_id. "'";
				$productResult = $db->query($custom_sql);

				while($productRow = $GLOBALS['db']->fetchByAssoc($productResult) )
				{
                    $is_ansys = 0;
                    if(isset($ansys_group[$productRow['aos_product_category_id']])) {
                        $is_ansys = 1;
                    }

					$_cost_currency = isset($cost_currency_strings[$productRow['cost_currency_c']]) ? $cost_currency_strings[$productRow['cost_currency_c']] : '';
					$_cost = $productRow['cost_currency_c'].$productRow['cost_2_c'];
					//Use $row['id'] to grab the id fields value

					$line_item->current_active_lineitem_c = $line_item->current_active_lineitem_c;
					$line_item->hidden_orig_price = $line_item->product_list_price;
					$line_item->hidden_fix_price = $line_item->product_list_price;
					$line_item->hidden_list_price = $line_item->product_list_price;
					$line_item->hidden_list_currency = $line_item->currency_id;
					$line_item->hidden_orig_prod_price = $productRow['price'];
					$line_item->is_ansys = $is_ansys;
					$line_item->cost_2_c = $_cost;
					$line_item->cost_currency_c = $_cost_currency;
					$line_item->cost_currency_c_hidden = $productRow['cost_currency_c'];
					$line_item->supplier_margin_c = $line_item->supplier_margin_c;
				}
				
				#$line_item->hidden_fix_price = $row['product_list_price'];
				$line_item = json_encode($line_item);

                $group_item = 'null';
                if ($row['group_id'] != null) {
                    $group_item = new AOS_Line_Item_Groups();
                    $group_item->retrieve($row['group_id']);
                    $group_item = json_encode($group_item->toArray());
                }
                $html .= "<script>
                        insertLineItems(" . $line_item . "," . $group_item . ");
                    </script>";
            }
        }
        if (!$enable_groups) {
            $html .= '<script>insertGroup();</script>';
        }
    } elseif ($view == 'DetailView') {
        $params = array('currency_id' => $focus->currency_id);

        $sql = "SELECT pg.id, pg.group_id FROM aos_products_quotes pg LEFT JOIN aos_line_item_groups lig ON pg.group_id = lig.id WHERE pg.parent_type = '".$focus->object_name."' AND pg.parent_id = '".$focus->id."' AND pg.deleted = 0 ORDER BY lig.number ASC, pg.number ASC";

        $result = $focus->db->query($sql);
        $sep = get_number_seperators();

        $html .= "<table border='0' width='100%' cellpadding='0' cellspacing='0'>";

        $i = 0;
        $productCount = 0;
        $serviceCount = 0;
        $group_id = '';
        $groupStart = '';
        $groupEnd = '';
        $product = '';
        $service = '';

        $supplierTotal = 0.0;

        while ($row = $focus->db->fetchByAssoc($result)) {

            $line_item = new AOS_Products_Quotes();
            $line_item->retrieve($row['id'], false);

            if ($enable_groups && ($group_id != $row['group_id'] || $i == 0)) {
                if($i != 0 ) {
                    $groupEnd .= "<tr>";
                    $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>Supplier Total:&nbsp;&nbsp;</td>";
                    $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($supplierTotal, $cost_params)."</td>";
                    $groupEnd .= "</tr>";
                    $supplierTotal = 0.0;
                }
                $html .= $groupStart.$product.$service.$groupEnd;
                if ($i != 0) {
                    $html .= "<tr><td colspan='9' nowrap='nowrap'><br></td></tr>";
                }
                $groupStart = '';
                $groupEnd = '';
                $product = '';
                $service = '';
                $i = $i + 1;
                $productCount = 0;
                $serviceCount = 0;
                $group_id = $row['group_id'];

                $group_item = new AOS_Line_Item_Groups();
                $group_item->retrieve($row['group_id']);

                $groupStart .= "<tr>";
                $groupStart .= "<td class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>&nbsp;</td>";
                $groupStart .= "<td class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>".$mod_strings['LBL_GROUP_NAME'].":</td>";
                $groupStart .= "<td class='tabDetailViewDL' colspan='8' style='text-align: left;padding:2px;'>".$group_item->name."</td>";
                $groupStart .= "</tr>";

                $groupEnd = "<tr><td colspan='10' nowrap='nowrap'><br></td></tr>";
                $groupEnd .= "<tr>";
                $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_TOTAL_AMT'].":&nbsp;&nbsp;</td>";
                $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($group_item->total_amt, $params)."</td>";
                $groupEnd .= "</tr>";
                $groupEnd .= "<tr style='display:none'>";
                $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_DISCOUNT_AMOUNT'].":&nbsp;&nbsp;</td>";
                $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($group_item->discount_amount, $params)."</td>";
                $groupEnd .= "</tr>";
                $groupEnd .= "<tr>";
                $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_SUBTOTAL_AMOUNT'].":&nbsp;&nbsp;</td>";
                $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($group_item->subtotal_amount, $params)."</td>";
                $groupEnd .= "</tr>";
                $groupEnd .= "<tr>";
                $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_TAX_AMOUNT'].":&nbsp;&nbsp;</td>";
                $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($group_item->tax_amount, $params)."</td>";
                $groupEnd .= "</tr>";
                $groupEnd .= "<tr>";
                $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_GRAND_TOTAL'].":&nbsp;&nbsp;</td>";
                $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($group_item->total_amount, $params)."</td>";
                $groupEnd .= "</tr>";
            }
            if ($line_item->product_id != '0' && $line_item->product_id != null) {
                if ($productCount == 0) {
                    $product .= "<tr>";
                    $product .= "<td width='5%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>&nbsp;</td>";
                    $product .= "<td width='10%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>".$mod_strings['LBL_PRODUCT_QUANITY']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>".$mod_strings['LBL_PRODUCT_NAME']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_LIST_PRICE']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>&nbsp;</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_DISCOUNT_AMT']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_UNIT_PRICE']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_VAT']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_VAT_AMT']."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_TOTAL_PRICE']."</td>";
                    $product .= "</tr>";
                    $product .= "<tr>";
                    $product .= "<td width='5%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>&nbsp;</td>";
                    $product .= "<td width='10%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>".($focus->module_dir == 'AOS_Invoices' ? 'Account Number' : '')."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>".($focus->module_dir == 'AOS_Invoices' ? 'Job Number' : '')."</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Cost</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Supplier Margin</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Cost Discount</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Quoted Cost</td>";
                    if($focus->module_dir == 'AOS_Quotes') {
                        $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Margin</td>";
                    }
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>Start Date</td>";
                    $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>End Date</td>";
                    if($focus->module_dir == 'AOS_Invoices') {
                        $product .= "<td width='12%' class='tabDetailViewDL' style='text-align: right;padding:2px;' scope='row'>&nbsp;</td>";
                    }
                    $product .= "</tr>";
                }

                $product .= "<tr>";
                $product_note = wordwrap($line_item->description,40,"<br />\n");
                $product .= "<td class='tabDetailViewDF' style='text-align: left; padding:2px;'>".number_format($line_item->number, 0)."</td>";
                $product .= "<td class='tabDetailViewDF' style='padding:2px;'>".number_format($line_item->product_qty, 0)."</td>";

                $product .= "<td class='tabDetailViewDF' style='padding:2px;'><a href='index.php?module=AOS_Products&action=DetailView&record=".$line_item->product_id."' class='tabDetailViewDFLink'>".$line_item->name."</a><br />".$product_note."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_list_price,$params)."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>&nbsp;</td>";

                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".get_discount_string($line_item->discount, $line_item->product_discount, $params, $locale, $sep)."</td>";

                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_unit_price, $params)."</td>";
                if ($locale->getPrecision()) {
                    $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".rtrim(rtrim(format_number($line_item->vat), '0'), $sep[1])."%</td>";
                } else {
                    $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".format_number($line_item->vat)."%</td>";
                }
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->vat_amt, $params)."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_total_price, $params)."</td>";
                $product .= "</tr>";

                $cost_params = array('currency_id' => $line_item->cost_currency_c);

                $product .= "<tr style='border-bottom:1px solid #cbdae6;'>";
                $product .= "<td class='tabDetailViewDF'>&nbsp;</td>";
                $product .= "<td class='tabDetailViewDF'>$line_item->account_number_sales_c</td>";
                $product .= "<td class='tabDetailViewDF'>$line_item->job_number_text_c</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->cost_c,$cost_params )."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".number_format($line_item->supplier_margin_c ? $line_item->supplier_margin_c : 0, 2)."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".number_format($line_item->cost_discount_c ? $line_item->cost_discount_c : 0, 2)."%</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->supplier_amount_c,$cost_params )."</td>";

                $supplierTotal = $supplierTotal + $line_item->supplier_amount_c;
                if($focus->module_dir == 'AOS_Quotes') {
                    $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>". ($line_item->margin_c != '' ? number_format($line_item->margin_c, 2) : '0') ."%</td>";
                }
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".$line_item->start_date_c."</td>";
                $product .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".$line_item->end_date_c."</td>";
                if($focus->module_dir == 'AOS_Invoices') {
                    $product .= "<td class='tabDetailViewDF'>&nbsp;</td>";
                }
                $product .= "</tr>";
            } else {
                if ($serviceCount == 0) {
                    $service .= "<tr>";
                    $service .= "<td width='5%' class='tabDetailViewDL' style='text-align: left;padding:2px;' scope='row'>&nbsp;</td>";
                    $service .= "<td width='46%' class='dataLabel' style='text-align: left;padding:2px;' colspan='2' scope='row'>".$mod_strings['LBL_SERVICE_NAME']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_SERVICE_LIST_PRICE']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_SERVICE_DISCOUNT']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_SERVICE_PRICE']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_VAT']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_VAT_AMT']."</td>";
                    $service .= "<td width='12%' class='dataLabel' style='text-align: right;padding:2px;' scope='row'>".$mod_strings['LBL_TOTAL_PRICE']."</td>";
                    $service .= "</tr>";
                }

                $service .= "<tr>";
                $service .= "<td class='tabDetailViewDF' style='text-align: left; padding:2px;'>".++$serviceCount."</td>";
                $service .= "<td class='tabDetailViewDF' style='padding:2px;' colspan='2'>".$line_item->name."</td>";
                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_list_price, $params)."</td>";

                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".get_discount_string($line_item->discount, $line_item->product_discount, $params, $locale, $sep)."</td>";


                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_unit_price, $params)."</td>";
                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".rtrim(rtrim(format_number($line_item->vat), '0'), $sep[1])."%</td>";
                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->vat_amt, $params)."</td>";
                $service .= "<td class='tabDetailViewDF' style='text-align: right; padding:2px;'>".currency_format_number($line_item->product_total_price, $params)."</td>";
                $service .= "</tr>";
            }

        }
        if($enable_groups) {
            $groupEnd .= "<tr>";
            $groupEnd .= "<td class='tabDetailViewDL' colspan='9' style='text-align: right;padding:2px;' scope='row'>Supplier Total:&nbsp;&nbsp;</td>";
            $groupEnd .= "<td class='tabDetailViewDL' style='text-align: right;padding:2px;'>".currency_format_number($supplierTotal, $cost_params)."</td>";
            $groupEnd .= "</tr>";
            $supplierTotal = 0.0;
        }
        $html .= $groupStart.$product.$service.$groupEnd;
        $html .= "</table>";
    }
    return $html;
}

//Bug #598
//The original approach to trimming the characters was rtrim(rtrim(format_number($line_item->product_qty), '0'),$sep[1])
//This however had the unwanted side-effect of turning 1000 (or 10 or 100) into 1 when the Currency Significant Digits
//field was 0.
//The approach below will strip off the fractional part if it is only zeroes (and in this case the decimal separator
//will also be stripped off) The custom decimal separator is passed in to the function from the locale settings
function stripDecimalPointsAndTrailingZeroes($inputString, $decimalSeparator)
{
    return preg_replace('/'.preg_quote($decimalSeparator).'[0]+$/', '', $inputString);
}

function get_discount_string($type, $amount, $params, $locale, $sep)
{
    if ($amount != '' && $amount != '0.00') {
        if ($type == 'Amount') {
            return currency_format_number($amount, $params)."</td>";
        } elseif ($locale->getPrecision()) {
            return rtrim(rtrim(format_number($amount), '0'), $sep[1])."%";
        }
        return format_number($amount)."%";
    }
    return "-";
}

function display_shipping_vat($focus, $field, $value, $view)
{
    if ($view == 'EditView') {
        global $app_list_strings;

        if ($value != '') {
            $value = format_number($value);
        }

        $html = "<input id='shipping_tax_amt' type='text' tabindex='0' title='' value='".$value."' maxlength='26,6' size='22' name='shipping_tax_amt' onblur='calculateTotal(\"lineItems\");'>";
        $html .= "<select name='shipping_tax' id='shipping_tax' onchange='calculateTotal(\"lineItems\");' >".get_select_options_with_id($app_list_strings['vat_list'], (isset($focus->shipping_tax) ? $focus->shipping_tax : ''))."</select>";

        return $html;
    }
    return format_number($value);
}
