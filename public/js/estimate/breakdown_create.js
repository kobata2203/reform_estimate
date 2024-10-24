$(function(){
    $('.amount_output').change(function() {
        let loop_count = $(this).data('count');
        let quantity = parseInt($('#quantity_' + loop_count).val());
        let unit_price = parseInt($('#unit_price_' + loop_count).val());

        if(Number.isInteger(quantity) && Number.isInteger(unit_price)) {
            let amount = quantity * unit_price;
            $('#amount_' + loop_count).val(amount);
        } else {
            return false;
        }
    });
});
