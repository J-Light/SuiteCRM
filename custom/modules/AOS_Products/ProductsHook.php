<?php
    class ProductsHook
    {
        function leap_products_process_record($bean, $event, $arguments)
        {
			$rec = BeanFactory::getBean('AOS_Products', $bean->id);
			$new_cost = $rec->cost_currency_c . ($bean->cost_2_c ? number_format($bean->cost_2_c, 2, '.', ',') : '0.00');
			$bean->cost_2_c = $rec->cost_currency_c ? $new_cost : '';
        }
    }

?>