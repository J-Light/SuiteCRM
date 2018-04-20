<?php
$currency_list = $app_list_strings['vat_list'];

$dictionary['AOS_Products_Quotes']['fields']['kr_amount'] = array(
    'name' => 'kr_amount',
    'vname' => 'LBL_KR_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'CONCAT(CHAR(36), FORMAT({t}.product_total_price, 2))'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_amount_inc_tax'] = array(
    'name' => 'kr_amount_inc_tax',
    'vname' => 'LBL_KR_AMOUNT_INC_TAX',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'CONCAT(CHAR(36), FORMAT({t}.product_total_price + IF({t}.vat_amt IS NULL OR {t}.vat_amt = \'\', 0, {t}.vat_amt), 2))'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_purchase_amount'] = array(
    'name' => 'kr_purchase_amount',
    'vname' => 'LBL_KR_PURCHASE_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'CONCAT(IF({tc}.cost_currency_symbol_c = \'AUD\' OR {tc}.cost_currency_symbol_c IS NULL, \'\', {tc}.cost_currency_symbol_c), CHAR(36),FORMAT({tc}.supplier_amount_c, 2))'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_purchase_amount_inc_tax'] = array(
    'name' => 'kr_purchase_amount_inc_tax',
    'vname' => 'LBL_KR_PURCHASE_AMOUNT_INC_TAX',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT CONCAT(IF(apqc.cost_currency_symbol_c = \'AUD\' OR apqc.cost_currency_symbol_c IS NULL, \'\', apqc.cost_currency_symbol_c), CHAR(36), FORMAT(apqc.supplier_amount_c + CASE aqc.tax_code_c WHEN 11 THEN 0 ELSE (apqc.supplier_amount_c * 0.10) END, 2))
                FROM aos_products_quotes apq
                JOIN aos_products_quotes_cstm apqc ON apq.id = apqc.id_c
                JOIN aos_quotes_aos_invoices_c aqaic ON aqaic.aos_quotes6b83nvoices_idb = apq.parent_id
                JOIN aos_quotes aq ON aq.id = aqaic.aos_quotes77d9_quotes_ida
                JOIN aos_quotes_cstm aqc ON aq.id = aqc.id_c
                WHERE apq.deleted = 0
                AND aqaic.deleted = 0
                AND aq.deleted = 0
                AND apq.id = {t}.id'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_tax_amount'] = array(
    'name' => 'kr_tax_amount',
    'vname' => 'LBL_KR_TAX_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'CONCAT(CHAR(36), FORMAT(IF({t}.vat_amt IS NULL OR {t}.vat_amt = \'\', 0, {t}.vat_amt), 2))'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_purchase_tax_amount'] = array(
    'name' => 'kr_purchase_tax_amount',
    'vname' => 'LBL_KR_PURCHASE_TAX_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'CONCAT(IF({tc}.cost_currency_symbol_c = \'AUD\' OR {tc}.cost_currency_symbol_c IS NULL, \'\', {tc}.cost_currency_symbol_c), CHAR(36), FORMAT(IF({t}.vat_amt IS NULL OR {t}.vat_amt = \'\', 0, {t}.vat_amt), 2))'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_currency'] = array(
    'name' => 'kr_currency',
    'vname' => 'LBL_KR_CURRENCY',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT case {t}.currency_id when -99 then \'AUD\' else (select symbol from currencies where id =  {t}.currency_id) end as amount FROM currencies LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_exchanger_rate'] = array(
    'name' => 'kr_exchanger_rate',
    'vname' => 'LBL_KR_EXCHANGE_RATE',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT case {t}.currency_id when -99 then \'1\' else (select conversion_rate from currencies where id =  {t}.currency_id) end as amount FROM currencies LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_exchanger_rate_2'] = array(
    'name' => 'kr_exchanger_rate_2',
    'vname' => 'LBL_KR_EXCHANGE_RATE',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT case {tc}.hdn_already_in_myob_c when 1 then \'\' else (SELECT case (SELECT aos_products_cstm.cost_currency_c FROM aos_products_cstm WHERE id_c = {t}.product_id LIMIT 1) when \'AUD\' then \'1\' else (select conversion_rate from currencies where symbol = (SELECT aos_products_cstm.cost_currency_c FROM aos_products_cstm WHERE id_c = {t}.product_id LIMIT 1)) end as amount FROM currencies LIMIT 1) end'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_description'] = array(
    'name' => 'kr_description',
    'vname' => 'LBL_KR_DESCRIPTION',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'concat(FLOOR({t}.product_qty),\' x \',{t}.name)'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_parent_category'] = array(
    'name' => 'ky_parent_category',
    'vname' => 'LBL_KR_PARENT_CATEGORY',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT apc_parent.name
        FROM aos_products ap
        INNER JOIN aos_product_categories apc
            ON apc.id = ap.aos_product_category_id
        INNER JOIN aos_product_categories apc_parent
            ON apc.parent_category_id = apc_parent.id
        WHERE ap.id = {t}.product_id'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_po_account'] = array(
    'name' => 'ky_po_account',
    'vname' => 'LBL_KR_PO_ACCOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT tdv.value 
        FROM aos_quotes aq 
        INNER JOIN aos_quotes_aos_invoices_c aqaic 
            ON aqaic.aos_quotes77d9_quotes_ida = aq.id 
        INNER JOIN aos_products_quotes apq 
            ON apq.parent_id = aq.id 
        INNER JOIN aos_products_quotes_cstm apqc 
            ON apqc.id_c = apq.id 
        INNER JOIN tmp_dropdown_values tdv 
            ON tdv.id = apqc.account_number_c 
            AND tdv.type = \'account\' 
        WHERE aqaic.aos_quotes6b83nvoices_idb = {t}.parent_id 
        ORDER BY apqc.account_number_c DESC LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_po_amount'] = array(
    'name' => 'ky_po_amount',
    'vname' => 'LBL_KR_PO_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT concat(
            CASE apc.cost_currency_c
                WHEN \'AUD\' THEN ""
                ELSE apc.cost_currency_c
             END, CHAR(36),ROUND(apqc.supplier_amount_c, 2)) 
        FROM aos_products_cstm apc 
        LEFT JOIN aos_products_quotes apq 
            ON apq.product_id = apc.id_c 
        LEFT JOIN aos_products_quotes_cstm apqc 
            ON apqc.id_c = apq.id 
        WHERE apq.id = {t}.id'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_po_job'] = array(
    'name' => 'ky_po_job',
    'vname' => 'LBL_KR_PO_JOB',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT tdv.value 
        FROM aos_quotes aq 
        INNER JOIN aos_quotes_aos_invoices_c aqaic 
            ON aqaic.aos_quotes77d9_quotes_ida = aq.id 
        INNER JOIN aos_products_quotes apq 
            ON apq.parent_id = aq.id 
        INNER JOIN aos_products_quotes_cstm apqc 
            ON apqc.id_c = apq.id 
        INNER JOIN tmp_dropdown_values tdv 
            ON tdv.id = apqc.job_number_c 
            AND tdv.type = \'job\' 
        WHERE aqaic.aos_quotes6b83nvoices_idb = {t}.parent_id 
        ORDER BY apqc.job_number_c DESC LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_po_exchange_rate'] = array(
    'name' => 'ky_po_exchange_rate',
    'vname' => 'LBL_KR_PO_EXCHANGE_RATE',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT 
        case {t}.currency_id 
        when -99 then \'1\' 
        else (select conversion_rate from currencies where csv_original_id =  {t}.currency_id) 
        end as amount 
        FROM currencies LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['ky_po_lineitem_description'] = array(
    'name' => 'ky_po_lineitem_description',
    'vname' => 'LBL_KR_PO_LINEITEM_DESCRIPTION',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => '
                SELECT concat(FLOOR(apq.product_qty), \' x \', apq.name, \' - \', tdv.value, \' \', 
                    CASE apqc.start_date_c
                        WHEN "0000-00-00" THEN "---"
                        WHEN NULL THEN "---"
                        ELSE DATE_FORMAT(apqc.start_date_c, \'%e-%b-%y\')
                    END,
                    \' to \',
                    CASE apqc.end_date_c
                        WHEN "0000-00-00" THEN "---"
                        WHEN NULL THEN "---"
                        ELSE DATE_FORMAT(apqc.end_date_c, \'%e-%b-%y\')
                    END)
                FROM aos_products_quotes apq
                LEFT JOIN aos_products_quotes_cstm apqc 
                    ON apqc.id_c = apq.id 
                INNER JOIN tmp_dropdown_values tdv 
                    ON tdv.id = apqc.license_type_c 
                    AND tdv.type = \'lictype\' 
                WHERE apq.id = {t}.id
                LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_forecast_weighted_amount'] = array(
    'name' => 'kr_forecast_weighted_amount',
    'vname' => 'LBL_KR_FORECAST_WEIGHTED_AMOUNT',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT ROUND((CASE WHEN apqc.supplier_amount_c IS NULL THEN 0 ELSE apqc.supplier_amount_c END) * CASE WHEN ai.status IS NULL THEN 0 ELSE (CASE ai.status WHEN \'Paid\' THEN 1 ELSE 0.9 END) END, 2)
                FROM aos_products_quotes apq
                JOIN aos_products_quotes_cstm apqc ON apqc.id_c = apq.id
                LEFT JOIN aos_quotes_aos_invoices_c aqaic ON aqaic.aos_quotes77d9_quotes_ida = apq.parent_id
                LEFT JOIN aos_invoices ai ON ai.id = aqaic.aos_quotes6b83nvoices_idb
                WHERE apq.deleted = 0
                AND apq.id = {t}.id
                LIMIT 1'
);
$dictionary['AOS_Products_Quotes']['fields']['kr_forecast_sales_stage'] = array(
    'name' => 'kr_forecast_sales_stage',
    'vname' => 'LBL_KR_FORECAST_SALES_STAGE',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => 'SELECT 
                    REPLACE(
                        CASE aqc.quote_type_c 
                            WHEN 1 THEN (SELECT opportunities.sales_stage FROM opportunities WHERE id = aq.opportunity_id)
                            WHEN 2 THEN (SELECT cm3_renewals_cstm.status_c FROM cm3_renewals_cstm WHERE id_c = aqc.cm3_renewals_id_c)
                            ELSE \'\'
                        END,
                        \'_\', \' \'
                    )
                FROM aos_quotes aq
                LEFT JOIN aos_quotes_cstm aqc ON aqc.id_c = aq.id
                JOIN aos_products_quotes apq ON apq.parent_id = aq.id
                WHERE apq.id = {t}.id'
);
?>