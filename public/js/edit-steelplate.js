$(document).ready(function () {

    // -----------------------------
    // Add New Row
    // -----------------------------
    $(document).on('click', '#addSteelRow', function () {

        let row = $('#steelBody tr:first').clone();

        // Clear values
        row.find('input').each(function () {

            if ($(this).attr('name') == 'item_id[]') {

                $(this).val('');

            } else if ($(this).hasClass('cutting')) {

                $(this).val(0);

            } else if ($(this).hasClass('amount')) {

                $(this).val('0.00');

            } else {

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

            calculateSteelTotal();

        }

    });

    // -----------------------------
    // Calculate Row
    // -----------------------------
    $(document).on('keyup change', '.weight,.rate,.cutting', function () {

        let tr = $(this).closest('tr');

        let weight = parseFloat(tr.find('.weight').val()) || 0;

        let rate = parseFloat(tr.find('.rate').val()) || 0;

        let cutting = parseFloat(tr.find('.cutting').val()) || 0;

        let amount = (weight * rate) + cutting;

        tr.find('.amount').val(amount.toFixed(2));

        calculateSteelTotal();

    });

    // -----------------------------
    // GST Changed
    // -----------------------------
    $(document).on('keyup change', '#gst_percent, input[name="gst_percent"]', function () {

        calculateSteelTotal();

    });

    // -----------------------------
    // Calculate Totals
    // -----------------------------
    function calculateSteelTotal() {

        let subtotal = 0;

        $('#steelBody tr').each(function () {

            let amount = parseFloat($(this).find('.amount').val()) || 0;

            subtotal += amount;

        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gst = parseFloat($('#gst_percent').val());

        if (isNaN(gst)) {

            gst = parseFloat($('input[name="gst_percent"]').val()) || 0;

        }

        let gstAmount = subtotal * gst / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));

        $('#grand_total').val((subtotal + gstAmount).toFixed(2));

    }

    // -----------------------------
    // Initial Calculation
    // -----------------------------
    calculateSteelTotal();

});