$(document).ready(function() {
    var totalAmount = 0;
    $('.estimate-item-table tr').each(function() {
        var amountText = $(this).find('td:nth-child(6)').text();
        if (amountText) {
            var amount = parseFloat(amountText.replace(/[^\d.-]/g, ''));
            totalAmount += isNaN(amount) ? 0 : amount;
        }
    });

    var discount = parseFloat($('#special_discount').val()) || 0;

    function updateTotals() {
        var subtotal = totalAmount - discount;
        var tax = subtotal * 0.1;
        var grandTotal = subtotal + tax;

        $('.currency').eq(0).text('¥ ' + subtotal.toFixed(0));
        $('.currency').eq(1).text('¥ ' + tax.toFixed(0));
        $('.currency').eq(2).text('¥ ' + grandTotal.toFixed(0));
    }

    $('#special_discount').on('input', function() {
        discount = parseFloat($(this).val()) || 0;
        updateTotals();
    });

    updateTotals();
    
//内訳明細書のアンダーバー
    $(document).ready(function() {
        var selectWidth = $('#construction-name').outerWidth();
        $('#underline').css('width', selectWidth + 60);
    });
});
