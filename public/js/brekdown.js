$(document).ready(function() {
    // Calculate the total amount from the table dynamically
    var totalAmount = 0;
    $('.estimate-item-table tr').each(function() {
        var amountText = $(this).find('td:nth-child(6)').text(); // Amount is in the 6th column
        if (amountText) {
            var amount = parseFloat(amountText.replace(/[^\d.-]/g, '')); // Remove any non-numeric characters like ¥
            totalAmount += isNaN(amount) ? 0 : amount;
        }
    });

    // Set the initial discount value
    var discount = parseFloat($('#special_discount').val()) || 0;

    // Function to update the totals
    function updateTotals() {
        var subtotal = totalAmount - discount;
        var tax = subtotal * 0.1;
        var grandTotal = subtotal + tax;

        // Update the displayed values
        $('.currency').eq(0).text('¥ ' + subtotal.toFixed(0)); // Subtotal
        $('.currency').eq(1).text('¥ ' + tax.toFixed(0));       // Tax
        $('.currency').eq(2).text('¥ ' + grandTotal.toFixed(0)); // Grand Total
    }

    // Trigger the update whenever the discount input changes
    $('#special_discount').on('input', function() {
        discount = parseFloat($(this).val()) || 0;
        updateTotals();
    });

    // Initialize the totals on page load
    updateTotals();
});
