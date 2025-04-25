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

    var selectWidth = $('#construction-name').outerWidth();
    $('#underline').css('width', selectWidth + 60);

    function adjustFontSize() {
        $('.adjust-font').each(function() {
            var $container = $(this);
            var text = $container.text().replace(/\s+/g, '\u0020').trim(); // Normalize spaces
            var containerWidth = $container.width();
            var minFontSize = 7;
            var maxFontSize = 12;
            var fontSize = maxFontSize;

            var $tempSpan = $('<span>').text(text).css({
                'font-size': fontSize + 'px',
                'white-space': 'nowrap',
                'visibility': 'hidden',
                'position': 'absolute'
            }).appendTo('body');

            while ($tempSpan.width() > containerWidth && fontSize > minFontSize) {
                fontSize--;
                $tempSpan.css('font-size', fontSize + 'px');
            }

            $tempSpan.remove();

            $container.css('font-size', fontSize + 'px');
        });
    }

    adjustFontSize();

    $(window).resize(function () {
        adjustFontSize();
    });


});
