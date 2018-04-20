<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(
    1,
    'updateTaxCode',
    'custom/modules/AOS_Invoices/AOSInvoicesHook.php',
    'AOSInvoicesHook',
    'updateTaxCode');
$hook_array['after_save'][] = Array(
    2,
    'updateActiveLineItems',
    'custom/modules/AOS_Invoices/AOSInvoicesHook.php',
    'AOSInvoicesHook',
    'updateActiveLineItems');