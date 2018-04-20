<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(
    2,
    'updateRenewals',
    'custom/modules/CM3_Renewals/CM3RenewalsHook.php',
    'CM3RenewalsHook',
    'updateRenewals');

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(
    1,
    'updateRenewalsBefore',
    'custom/modules/CM3_Renewals/CM3RenewalsHook.php',
    'CM3RenewalsHook',
    'updateRenewalsBefore');