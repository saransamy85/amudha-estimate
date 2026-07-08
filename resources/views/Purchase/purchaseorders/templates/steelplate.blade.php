<div class="table-responsive">

    <table class="table table-bordered align-middle" id="steelTable">

        <thead class="table-dark">

            <tr>

                <th width="20%">Material</th>

                <th width="12%">Size</th>

                <th width="10%">Thickness</th>

                <th width="8%">Nos</th>

                <th width="12%">Approx Weight (Kg)</th>

                <th width="10%">Rate / Kg</th>

                <th width="10%">Cutting Charge</th>

                <th width="12%">Amount</th>

                <th width="6%">
                    <button type="button" class="btn btn-success btn-sm" id="addSteelRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>
                </th>

            </tr>

        </thead>

        <tbody id="steelBody">

            <tr>

                <td>

                    <input type="text" class="form-control" name="material[]">

                </td>

                <td>

                    <input type="text" class="form-control" name="size[]" placeholder="300x300">

                </td>

                <td>

                    <input type="text" class="form-control" name="thickness[]" placeholder="12mm">

                </td>

                <td>

                    <input type="number" class="form-control nos" name="nos[]" min="0" step="1">

                </td>

                <td>

                    <input type="number" class="form-control weight" name="approx_weight[]" min="0"
                        step="0.01">

                </td>

                <td>

                    <input type="number" class="form-control rate" name="rate[]" min="0" step="0.01">

                </td>

                <td>

                    <input type="number" class="form-control cutting" name="cutting_charge[]" value="0"
                        min="0" step="0.01">

                </td>

                <td>

                    <input type="number" class="form-control amount" name="amount[]" readonly>

                </td>

                <td>

                    <button type="button" class="btn btn-danger btn-sm removeSteelRow">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>


</div>
