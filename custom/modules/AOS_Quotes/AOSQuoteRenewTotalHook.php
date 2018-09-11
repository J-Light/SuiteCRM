<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AOSQuoteRenewTotalHook
{
    function injectTotalRecal($event, $arguments)
    {
        $module = isset($_REQUEST['module']) ? $_REQUEST['module'] : null;
        if($module == 'AOS_Quotes')
        {
            $inject_recal = <<<EOQ
<script type="text/javascript" language="javascript">
    var url_string = window.location.href;
    var url = new URL(url_string);
    var newrenewal = url.searchParams.get("renewed");
    if(newrenewal == 'true') {
        calculateAllLines();
    }
</script>
EOQ;
            echo $inject_recal;
        }
        
        
    }
}

?>
