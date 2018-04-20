<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(
    1,
    'updatePurchase',
    'custom/modules/CM4_Purchases/PurchasesHook.php',
    'PurchasesHook',
    'updatePurchase');	$hook_array['after_retrieve'] = Array();$hook_array['after_retrieve'][] = Array(    2,    'Change invoice name to invoice number',    'custom/modules/CM4_Purchases/PurchasesHook.php',    'PurchasesHook',    'afterRetrieve');	$hook_array['process_record'] = Array();$hook_array['process_record'][] = Array(    2,    'Change invoice name to invoice number',    'custom/modules/CM4_Purchases/PurchasesHook.php',    'PurchasesHook',    'processRecord');