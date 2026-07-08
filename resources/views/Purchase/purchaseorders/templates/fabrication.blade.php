<div class="table-responsive">

    <table class="table table-bordered align-middle" id="fabricationTable">

        <thead class="table-dark">

            <tr>

                <th width="22%">Material</th>

                <th width="15%">Size</th>

                <th width="12%">Thickness</th>

                <th width="12%">Qty</th>

                <th width="10%">Unit</th>

                <th width="12%">Rate</th>

                <th width="12%">Amount</th>

                <th width="5%">

                    <button type="button" class="btn btn-success btn-sm" id="addFabricationRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody id="fabricationBody">

            <tr>

                <td>

                    <input type="text" class="form-control" name="material[]">

                </td>

                <td>

                    <input type="text" class="form-control" name="size[]" placeholder="300x300">

                </td>

                <td>

                    <input type="text" class="form-control" name="thickness[]" placeholder="12 mm">

                </td>

                <td>

                    <input type="number" class="form-control qty" name="qty[]" min="0" step="0.01">

                </td>

                <td>

                    <select class="form-select" name="unit[]">

                        <option value="Nos">Nos</option>

                        <option value="Kg">Kg</option>

                        <option value="Sq.ft">Sq.ft</option>

                        <option value="Rft">Rft</option>

                        <option value="Mtr">Mtr</option>

                    </select>

                </td>

                <td>

                    <input type="number" class="form-control rate" name="rate[]" min="0" step="0.01">

                </td>

                <td>

                    <input type="number" class="form-control amount" name="amount[]" readonly>

                </td>

                <td>

                    <button type="button" class="btn btn-danger btn-sm removeFabricationRow">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>
