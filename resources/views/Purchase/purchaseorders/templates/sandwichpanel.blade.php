<div class="table-responsive">

    <table class="table table-bordered align-middle" id="panelTable">

        <thead class="table-dark">

            <tr>

                <th width="20%">Material</th>

                <th width="10%">Width</th>

                <th width="10%">Thickness</th>

                <th width="10%">Color</th>

                <th width="10%">Nos</th>

                <th width="12%">Qty (Rft / Sq.ft)</th>

                <th width="10%">Unit</th>

                <th width="10%">Rate</th>

                <th width="13%">Amount</th>

                <th width="5%">

                    <button type="button" class="btn btn-success btn-sm" id="addPanelRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>

                    <input type="text" name="material[]" class="form-control">

                </td>

                <td>

                    <input type="text" name="width[]" class="form-control" placeholder="1000 mm">

                </td>

                <td>

                    <input type="text" name="thickness[]" class="form-control" placeholder="50 mm">

                </td>

                <td>

                    <input type="text" name="color[]" class="form-control" placeholder="Blue">

                </td>

                <td>

                    <input type="number" name="nos[]" class="form-control nos" min="0">

                </td>

                <td>

                    <input type="number" name="qty[]" class="form-control qty" step="0.01">

                </td>

                <td>

                    <select name="unit[]" class="form-select">

                        <option value="Rft">Running Feet</option>

                        <option value="Sq.ft">Sq.ft</option>

                        <option value="Nos">Nos</option>

                        <option value="Mtr">Meter</option>

                    </select>

                </td>

                <td>

                    <input type="number" name="rate[]" class="form-control rate" step="0.01">

                </td>

                <td>

                    <input type="number" name="amount[]" class="form-control amount" readonly>

                </td>

                <td>

                    <button type="button" class="btn btn-danger btn-sm removePanelRow">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

<script>
    function bindPanelEvents() {

        $(document).off('click', '#addPanelRow').on('click', '#addPanelRow', function() {

            let row = $('#panelTable tbody tr:first').clone();

            row.find('input').val('');

            row.find('select').prop('selectedIndex', 0);

            $('#panelTable tbody').append(row);

        });

        $(document).off('click', '.removePanelRow').on('click', '.removePanelRow', function() {

            if ($('#panelTable tbody tr').length > 1) {

                $(this).closest('tr').remove();

                calculatePanelTotal();

            }

        });

        $(document).off('keyup change', '.qty,.rate').on('keyup change', '.qty,.rate', function() {

            let tr = $(this).closest('tr');

            let qty = parseFloat(tr.find('.qty').val()) || 0;

            let rate = parseFloat(tr.find('.rate').val()) || 0;

            let amount = qty * rate;

            tr.find('.amount').val(amount.toFixed(2));

            calculatePanelTotal();

        });

        $(document).off('keyup change', 'input[name="gst_percent"]').on('keyup change', 'input[name="gst_percent"]',
            function() {

                calculatePanelTotal();

            });

        calculatePanelTotal();

    }

    function calculatePanelTotal() {

        let subtotal = 0;

        $('#panelTable .amount').each(function() {

            subtotal += parseFloat($(this).val()) || 0;

        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gst = parseFloat($('input[name="gst_percent"]').val()) || 0;

        let gstAmount = subtotal * gst / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));

        $('#grand_total').val((subtotal + gstAmount).toFixed(2));

    }

    bindPanelEvents();
</script>
