<div class="table-responsive">
    <table class="table table-bordered align-middle" id="polycarbonateTable">
        <thead class="table-primary text-center">
            <tr>
                <th width="5%">S.No</th>
                <th width="25%">Particular</th>
                <th width="10%">Length (m)</th>
                <th width="10%">Width (m)</th>
                <th width="8%">Nos</th>
                <th width="12%">Area (Sqm)</th>
                <th width="10%">Rate</th>
                <th width="12%">Amount</th>
                <th width="8%">Action</th>
            </tr>
        </thead>

        <tbody id="polycarbonateBody">

            <tr>

                <td class="text-center serial">1</td>

                <td>
                    <input type="text" name="material[]" class="form-control" placeholder="Particular">
                </td>

                <td>
                    <input type="number" step="0.001" min="0" name="length[]" class="form-control length">
                </td>

                <td>
                    <input type="number" step="0.001" min="0" name="width[]" class="form-control width">
                </td>

                <td>
                    <input type="number" min="1" value="1" name="nos[]" class="form-control nos">
                </td>

                <td>
                    <input type="number" step="0.001" name="area[]" class="form-control area" readonly>
                </td>

                <td>
                    <input type="number" step="0.01" min="0" name="rate[]" class="form-control rate">
                </td>

                <td>
                    <input type="number" step="0.01" name="amount[]" class="form-control amount" readonly>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm addPolyRow">
                        <i class="bi bi-plus"></i>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm removePolyRow">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>

            </tr>

        </tbody>

        <tfoot>



        </tfoot>

    </table>
</div>
