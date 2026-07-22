$(document).ready(function () {

    updateSerialNo();
    calculateMetalSheet();

    function updateSerialNo() {

        $('#metalsheetBody tr').each(function (index) {
            $(this).find('.serial').text(index + 1);
        });

    }

    function calculateMetalSheet() {

        let subtotal = 0;

        $('#metalsheetBody tr').each(function () {

            let width = parseFloat($(this).find('.width').val()) || 0;
            let length = parseFloat($(this).find('.length').val()) || 0;
            let nos = parseFloat($(this).find('.nos').val()) || 0;
            let rate = parseFloat($(this).find('.rate').val()) || 0;

            let sqm = width * length * nos;

            let amount = sqm * rate;

            $(this).find('.sqm').val(sqm.toFixed(2));

            $(this).find('.amount').val(amount.toFixed(2));

            subtotal += amount;

        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gst = parseFloat($('#gst_percent').val()) || 0;

        let gstAmount = subtotal * gst / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));

        $('#grand_total').val((subtotal + gstAmount).toFixed(2));

    }

    // Add Row
    $(document).off('click', '.addMetalRow').on('click', '.addMetalRow', function () {

        let row = $('#metalsheetBody tr:first').clone();

        row.find('input').each(function () {

            if ($(this).hasClass('nos')) {

                $(this).val(1);

            } else {

                $(this).val('');

            }

        });

        row.find('.sqm').val('0.00');
        row.find('.amount').val('0.00');

        $('#metalsheetBody').append(row);

        updateSerialNo();

    });

    // Remove Row
    $(document).off('click', '.removeMetalRow').on('click', '.removeMetalRow', function () {

        if ($('#metalsheetBody tr').length > 1) {

            $(this).closest('tr').remove();

            updateSerialNo();

            calculateMetalSheet();

        }

    });

    // Auto Calculation
    $(document).off('keyup change', '.width,.length,.nos,.rate,#gst')
        .on('keyup change', '.width,.length,.nos,.rate,#gst', function () {

            calculateMetalSheet();

        });

});