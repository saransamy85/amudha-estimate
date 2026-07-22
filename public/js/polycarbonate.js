$(document).ready(function () {

    function updateSerialNo() {
        $('#polycarbonateBody tr').each(function (index) {
            $(this).find('.serial').text(index + 1);
        });
    }

    function calculatePolycarbonate() {

        let subtotal = 0;

        $('#polycarbonateBody tr').each(function () {

            let length = parseFloat($(this).find('.length').val()) || 0;
            let width = parseFloat($(this).find('.width').val()) || 0;
            let nos = parseFloat($(this).find('.nos').val()) || 0;
            let rate = parseFloat($(this).find('.rate').val()) || 0;

            let area = length * width * nos;
            let amount = area * rate;

            $(this).find('.area').val(area.toFixed(3));
            $(this).find('.amount').val(amount.toFixed(2));

            subtotal += amount;
        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gstPercent = parseFloat($('#gst_percent').val()) || 0;

        let gstAmount = subtotal * gstPercent / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));

        $('#grand_total').val((subtotal + gstAmount).toFixed(2));
    }

    // Add Row
    $(document).off('click', '.addPolyRow').on('click', '.addPolyRow', function () {

        let row = $('#polycarbonateBody tr:first').clone();

        row.find('input').each(function () {

            if ($(this).hasClass('nos')) {
                $(this).val(1);
            } else {
                $(this).val('');
            }

        });

        row.find('.area').val('0.000');
        row.find('.amount').val('0.00');

        $('#polycarbonateBody').append(row);

        updateSerialNo();
    });

    // Remove Row
    $(document).off('click', '.removePolyRow').on('click', '.removePolyRow', function () {

        if ($('#polycarbonateBody tr').length > 1) {

            $(this).closest('tr').remove();

            updateSerialNo();

            calculatePolycarbonate();
        }

    });

    // Auto Calculation
    $(document).off('keyup change', '.length,.width,.nos,.rate,#gst')
        .on('keyup change', '.length,.width,.nos,.rate,#gst', function () {

            calculatePolycarbonate();

        });

    updateSerialNo();

    calculatePolycarbonate();

});