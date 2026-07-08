<table class="table table-bordered" id="poTable">

    <thead class="table-dark">

        <tr>

            <th>Material</th>

            <th>Dia</th>

            <th>Length</th>

            <th>Nos</th>

            <th>Rate</th>

            <th>Amount</th>

            <th></th>

        </tr>

    </thead>

    <tbody id="tbody">

        <tr>

            <td>

                <input type="text" name="material[]" class="form-control">

            </td>

            <td>

                <input type="text" name="dia[]" class="form-control">

            </td>

            <td>

                <input type="text" name="length[]" class="form-control">

            </td>

            <td>

                <input type="number" class="form-control qty" name="nos[]">

            </td>

            <td>

                <input type="number" class="form-control rate" name="rate[]">

            </td>

            <td>

                <input type="number" class="form-control amount" name="amount[]" readonly>

            </td>


            <td>

                <button type="button" class="btn btn-success addRow">

                    +

                </button>

            </td>

        </tr>

    </tbody>

</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('tbody');
        const GST_RATE = 0.18;

        function createRow() {
            const firstRow = tbody.querySelector('tr');
            const newRow = firstRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            addRemoveButtonIfMissing(newRow);
            return newRow;
        }

        function addRemoveButtonIfMissing(row) {
            if (!row.querySelector('.removeRow')) {
                const lastCell = row.querySelector('td:last-child');
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger removeRow ms-1';
                removeBtn.textContent = '−';
                lastCell.appendChild(removeBtn);
            }
        }

        function calculateAmount(row) {
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const rate = parseFloat(row.querySelector('.rate').value) || 0;
            row.querySelector('.amount').value = (qty * rate).toFixed(2);
        }

        function calculateGrandTotal() {
            let subtotal = 0;
            tbody.querySelectorAll('.amount').forEach(input => {
                subtotal += parseFloat(input.value) || 0;
            });

            const gst = subtotal * GST_RATE;
            const grandTotal = subtotal + gst;

            document.getElementById('subtotal').value = subtotal.toFixed(2);
            document.getElementById('gstAmount').value = gst.toFixed(2);
            document.getElementById('grandTotal').value = grandTotal.toFixed(2);
        }

        addRemoveButtonIfMissing(tbody.querySelector('tr'));

        tbody.addEventListener('click', function(e) {
            if (e.target.classList.contains('addRow')) {
                const row = e.target.closest('tr');
                const newRow = createRow();
                row.after(newRow);
                calculateGrandTotal();
            }

            if (e.target.classList.contains('removeRow')) {
                if (tbody.querySelectorAll('tr').length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    e.target.closest('tr').querySelectorAll('input').forEach(i => i.value = '');
                }
                calculateGrandTotal();
            }
        });

        tbody.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty') || e.target.classList.contains('rate')) {
                calculateAmount(e.target.closest('tr'));
                calculateGrandTotal();
            }
        });

        // Initial calc in case rows are pre-filled (e.g. edit form)
        calculateGrandTotal();
    });
</script>
