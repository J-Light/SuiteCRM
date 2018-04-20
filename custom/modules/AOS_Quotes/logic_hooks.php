<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(
    1,
    'updateOpportunityAmount',
    'custom/modules/AOS_Quotes/AOSQuoteOpportunityHook.php',
    'AOSQuoteOpportunityHook',
    'updateOpportunityAmount');

$hook_array['after_delete'] = Array();
$hook_array['after_delete'][] = Array(
    2,
    'updateOpportunityAmount',
    'custom/modules/AOS_Quotes/AOSQuoteOpportunityHook.php',
    'AOSQuoteOpportunityHook',
    'updateOpportunityAmount');