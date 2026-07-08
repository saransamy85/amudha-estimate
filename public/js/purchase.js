$(document).ready(function () {

    bindPurchaseEvents();

    // Load Template
    $('#template').change(function () {

        let template = $(this).val();

        $("#itemTable").load("/purchase/template/" + template, function () {

            bindPurchaseEvents();

        });

    });

});


function bindPurchaseEvents() {

    // Remove duplicate bindings
    $(document).off('click', '#addRow');
    $(document).off('click', '.removeRow');
    $(document).off('keyup change', '.qty,.nos,.rate,#gst_percent');

    // -------------------------
    // Add Row
    // -------------------------

    $(document).on('click', '#addRow', function () {

        let row = $('#tbody tr:first').clone();

        row.find('input').each(function () {

            if ($(this).hasClass('amount')) {

                $(this).val('0.00');

            } else {

                $(this).val('');

            }

        });

        $('#tbody').append(row);

    });

    // -------------------------
    // Remove Row
    // -------------------------

    $(document).on('click', '.removeRow', function () {

        if ($('#tbody tr').length > 1) {

            $(this).closest('tr').remove();

            calculateTotals();

        }

    });

    // -------------------------
    // Calculate
    // -------------------------

    $(document).on('keyup change', '.qty,.nos,.rate,#gst_percent', function () {

        calculateTotals();

    });

    calculateTotals();

}


// ======================================
// CALCULATE TOTAL
// ======================================

function calculateTotals() {

    let subtotal = 0;

    $('#tbody tr').each(function () {

        let qty = 0;

        if ($(this).find('.qty').length) {

            qty = parseFloat($(this).find('.qty').val()) || 0;

        }

        if ($(this).find('.nos').length) {

            qty = parseFloat($(this).find('.nos').val()) || 0;

        }

        let rate = parseFloat($(this).find('.rate').val()) || 0;

        let amount = qty * rate;

        $(this).find('.amount').val(amount.toFixed(2));

        subtotal += amount;

    });

    $('#subtotal').val(subtotal.toFixed(2));

    let gst = parseFloat($('#gst_percent').val()) || 0;

    let gstAmount = subtotal * gst / 100;

    $('#gst_amount').val(gstAmount.toFixed(2));

    $('#grand_total').val((subtotal + gstAmount).toFixed(2));

}