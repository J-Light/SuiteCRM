<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2017-02-03 15:07:24
$dictionary["CM4_Purchases"]["fields"]["cm4_purchases_aos_products_quotes_1"] = array (
  'name' => 'cm4_purchases_aos_products_quotes_1',
  'type' => 'link',
  'relationship' => 'cm4_purchases_aos_products_quotes_1',
  'source' => 'non-db',
  'module' => 'AOS_Products_Quotes',
  'bean_name' => 'AOS_Products_Quotes',
  'side' => 'right',
  'vname' => 'LBL_CM4_PURCHASES_AOS_PRODUCTS_QUOTES_1_FROM_AOS_PRODUCTS_QUOTES_TITLE',
);


// This is use to filter all the line items per purchase order
$dictionary['CM4_Purchases']['fields']['kr_cm4_hidden_id'] = array(
    'name' => 'kr_cm4_hidden_id',
    'vname' => 'LBL_KR_PO_HIDDEN_ID',
    'type' => 'kreporter',
    'source' => 'non-db',
    'kreporttype' => 'text',
    'eval' => array(
        'presentation' => array(
            'eval' => '
                SELECT EXISTS(
                    SELECT aos_products_quotes.id
                    FROM cm4_purchases cp
                    INNER JOIN aos_invoices ai 
                        ON ai.id = cp.aos_invoices_id_c
                    LEFT JOIN accounts a
                        ON a.id = ai.billing_account_id
                    INNER JOIN aos_products_quotes
                        ON aos_products_quotes.parent_id = ai.id
                        AND aos_products_quotes.parent_type = \'AOS_Invoices\'
                    INNER JOIN aos_products_quotes_cstm apqc
                        ON apqc.id_c = aos_products_quotes.id
                    INNER JOIN aos_products ap
                        ON ap.id = aos_products_quotes.product_id
                    INNER JOIN aos_product_categories apc
                        ON apc.id = ap.aos_product_category_id
                    INNER JOIN aos_product_categories apc2
                        ON apc2.id = apc.parent_category_id
                        AND apc2.is_parent = 1
                        AND apc2.id = cp.aos_product_categories_id_c
                    WHERE cp.id = {t}.id
                )
            ',
        ),
        'selection' => array(
            'equals' => 'exists(select * from aos_products_quotes where id = \'{p1}\')',
        ),
    ),
);

 // created: 2017-02-26 14:39:06
$dictionary['CM4_Purchases']['fields']['tax_code_c']['inline_edit']='1';
$dictionary['CM4_Purchases']['fields']['tax_code_c']['labelValue']='Tax Code';

 
?>