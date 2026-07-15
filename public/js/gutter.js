$(function () {

    $(document).on('click', '#addGutterRow', function () {

        let row = $('#gutterBody tr:first').clone();

        row.find('input').val('');

        row.find('.amount').val('0.00');

        $('#gutterBody').append(row);

    });

    $(document).on('click', '.removeGutterRow', function () {

        if ($('#gutterBody tr').length > 1) {

            $(this).closest('tr').remove();

            calculateGutter();

        }

    });

    $(document).on('keyup change', '.nos,.rate', function () {

        let tr = $(this).closest('tr');

        let nos = parseFloat(tr.find('.nos').val()) || 0;

        let rate = parseFloat(tr.find('.rate').val()) || 0;

        let amount = nos * rate;

        tr.find('.amount').val(amount.toFixed(2));

        calculateGutter();

    });

    $(document).on('keyup change', '#gst_percent', function () {

        calculateGutter();

    });

    function calculateGutter() {

        let subtotal = 0;

        $('#gutterBody .amount').each(function () {

            subtotal += parseFloat($(this).val()) || 0;

        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gst = parseFloat($('#gst_percent').val()) || 0;

        let gstAmount = subtotal * gst / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));

        $('#grand_total').val((subtotal + gstAmount).toFixed(2));

    }

    calculateGutter();

});