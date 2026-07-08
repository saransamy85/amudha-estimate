<div class="card mt-3">
    <div class="card-header">
        <strong>Pipe Purchase Order</strong>
    </div>

    <div class="card-body">

        <button type="button" id="addPipeRow" class="btn btn-success btn-sm mb-2">
            + Add Row
        </button>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>S.NO</th>
                    <th>PARTICULAR</th>
                    <th>Size</th>
                    <th>Thick</th>
                    <th>NOS</th>
                    <th>Rate</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="pipeItems">

                <tr class="pipe-row">
                    <td class="sno text-center">1</td>

                    <td>
                        <input name="particular[]" class="form-control">
                    </td>

                    <td>
                        <input name="size[]" class="form-control" placeholder="122x61 / 114 od">
                    </td>

                    <td>
                        <input name="thick[]" class="form-control" placeholder="4.0mm">
                    </td>

                    <td>
                        <input name="nos[]" class="form-control">
                    </td>

                    <td>
                        <input name="rate[]" class="form-control" placeholder="₹ / Kg">
                    </td>

                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm removePipeRow">X</button>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>
<script>
    /* Add Pipe Row */
    document.getElementById('addPipeRow').addEventListener('click', function() {
        let tbody = document.getElementById('pipeItems');
        let firstRow = tbody.querySelector('.pipe-row');
        let newRow = firstRow.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => input.value = '');

        tbody.appendChild(newRow);
        updatePipeSerial();
    });

    /* Remove Pipe Row */
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removePipeRow')) {
            let rows = document.querySelectorAll('#pipeItems tr');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                updatePipeSerial();
            }
        }
    });

    /* Update S.NO */
    function updatePipeSerial() {
        document.querySelectorAll('#pipeItems .sno').forEach((td, i) => {
            td.innerText = i + 1;
        });
    }
</script>
