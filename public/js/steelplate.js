$(document).ready(function () {

    bindSteelEvents();

});

function bindSteelEvents() {

    // Remove previous bindings
    $(document).off('click', '#addSteelRow');
    $(document).off('click', '.removeSteelRow');
    $(document).off('keyup change', '.weight,.rate,.cutting,#gst_percent');

    // -----------------------------
    // Add Row
    // -----------------------------

    $(document).on('click', '#addSteelRow', function () {

        let row = $('#steelBody tr:first').clone(false);

        row.find('input').each(function () {

            if ($(this).hasClass('cutting')) {

                $(this).val(0);

            }
            else if ($(this).hasClass('amount')) {

                $(this).val('0.00');

            }
            else {

                $(this).val('');

            }

        });

        $('#steelBody').append(row);

    });

    // -----------------------------
    // Remove Row
    // -----------------------------

    $(document).on('click', '.removeSteelRow', function () {

        if ($('#steelBody tr').length > 1) {

            $(this).closest('tr').remove();

            calculateSteel();

        }

    });

    // -----------------------------
    // Calculate
    // -----------------------------

    $(document).on('keyup change', '.weight,.rate,.cutting,#gst_percent', function () {

        calculateSteel();

    });

    calculateSteel();

}


// =====================================
// CALCULATE
// =====================================

function calculateSteel() {

    let subtotal = 0;

    $('#steelBody tr').each(function () {

        let weight = parseFloat($(this).find('.weight').val()) || 0;

        let rate = parseFloat($(this).find('.rate').val()) || 0;

        let cutting = parseFloat($(this).find('.cutting').val()) || 0;

        let amount = (weight * rate) + cutting;

        $(this).find('.amount').val(amount.toFixed(2));

        subtotal += amount;

    });

    $('#subtotal').val(subtotal.toFixed(2));

    let gst = parseFloat($('#gst_percent').val()) || 0;

    let gstAmount = subtotal * gst / 100;

    $('#gst_amount').val(gstAmount.toFixed(2));

    $('#grand_total').val((subtotal + gstAmount).toFixed(2));

}