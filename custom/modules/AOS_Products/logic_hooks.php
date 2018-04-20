<?php

    $hook_version = 1;
    $hook_array = Array();
	
	$hook_array['process_record'] = Array();
    $hook_array['process_record'][] = Array(1, 'leap_products_process_record', 'custom/modules/AOS_Products/ProductsHook.php', 'ProductsHook', 'leap_products_process_record');

?>