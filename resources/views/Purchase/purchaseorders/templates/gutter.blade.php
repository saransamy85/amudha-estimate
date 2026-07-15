<div class="table-responsive">

    <table class="table table-bordered align-middle" id="gutterTable">

        <thead class="table-dark">

            <tr>

                <th width="25%">Particular</th>

                <th width="15%">Length</th>

                <th width="12%">Nos</th>

                <th width="18%">Rate / No</th>

                <th width="20%">Amount</th>

                <th width="10%">

                    <button type="button" class="btn btn-success btn-sm" id="addGutterRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody id="gutterBody">

            <tr>

                <td>

                    <input type="text" name="material[]" class="form-control" placeholder="Particular">

                </td>

                <td>

                    <input type="text" name="length[]" class="form-control" placeholder="3 Mtr">

                </td>

                <td>

                    <input type="number" name="nos[]" class="form-control nos">

                </td>

                <td>

                    <input type="number" name="rate[]" class="form-control rate" step="0.01">

                </td>

                <td>

                    <input type="number" name="amount[]" class="form-control amount" readonly>

                </td>

                <td>

                    <button type="button" class="btn btn-danger btn-sm removeGutterRow">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>
