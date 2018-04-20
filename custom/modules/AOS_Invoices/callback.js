function popupAccountCallback(data) {
    var account_id = data.name_to_value_array.billing_account_id;

    set_return(data);

    if(account_id) {
        $.ajax({
            type: 'get',
            async: false,
            url: 'index.php?module=AOS_Invoices&action=get_myob_card_name&id=' + account_id,
            error: function(req, status) {
                return false;
            },
            success: function(ret) {
                console.log('RETURN:');
                $('#myob_card_name_c').val(ret);
            }

        })
    }
}