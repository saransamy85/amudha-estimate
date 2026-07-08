$(document).ready(function () {

    if ($('#fabricationTable').length) {

        bindFabricationEvents();

    }

});

function bindFabricationEvents() {

    // Remove previous bindings
    $(document).off('click', '#addFabricationRow');
    $(document).off('click', '.removeFabricationRow');
    $(document).off('keyup change', '.qty,.rate,#gst_percent');

    // -----------------------------
    // Add Row
    // -----------------------------

    $(document).on('click', '#addFabricationRow', function () {

        let row = $('#fabricationBody tr:first').clone(false);

        row.find('input').each(function () {

            if ($(this).hasClass('amount')) {

                $(this).val('0.00');

            } else {

                $(this).val('');

            }

        });

        $('#fabricationBody').append(row);

    });

    // -----------------------------
    // Remove Row
    // -----------------------------

    $(document).on('click', '.removeFabricationRow', function () {

        if ($('#fabricationBody tr').length > 1) {

            $(this).closest('tr').remove();

            calculateFabrication();

        }

    });

    // -----------------------------
    // Auto Calculate
    // -----------------------------

    $(document).on('keyup change', '.qty,.rate,#gst_percent', function () {

        calculateFabrication();

    });

    calculateFabrication();

}

// =======================================
// Calculate Total
// =======================================

function calculateFabrication() {

    let subtotal = 0;

    $('#fabricationBody tr').each(function () {

        let qty = parseFloat($(this).find('.qty').val()) || 0;

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