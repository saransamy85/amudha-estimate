<div class="table-responsive">

    <table class="table table-bordered align-middle" id="anchorTable">

        <thead class="table-dark">

            <tr>

                <th width="30%">Material</th>

                <th>Dia</th>

                <th>Length</th>

                <th>Nos</th>

                <th>Rate</th>

                <th>Amount</th>

                <th width="70">

                    <button type="button" class="btn btn-success btn-sm" id="addAnchorRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody>

            @foreach ($po->items as $item)
                <tr>

                    <td>

                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                        <input type="text" name="material[]" class="form-control" value="{{ $item->material }}">

                    </td>

                    <td>

                        <input type="text" name="dia[]" class="form-control" value="{{ $item->dia }}">

                    </td>

                    <td>

                        <input type="text" name="length[]" class="form-control" value="{{ $item->length }}">

                    </td>

                    <td>

                        <input type="number" name="nos[]" class="form-control nos" value="{{ $item->nos }}">

                    </td>

                    <td>

                        <input type="number" name="rate[]" class="form-control rate" value="{{ $item->rate }}"
                            step="0.01">

                    </td>

                    <td>

                        <input type="number" name="amount[]" class="form-control amount" value="{{ $item->amount }}"
                            readonly>

                    </td>

                    <td>

                        <button type="button" class="btn btn-danger btn-sm removeRow">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</div>

@push('scripts')
    <script>
        $(document).on('click', '#addAnchorRow', function() {

            let row = `
    <tr>

        <td>

            <input type="hidden" name="item_id[]" value="">

            <input type="text"
                   name="material[]"
                   class="form-control">

        </td>

        <td>

            <input type="text"
                   name="dia[]"
                   class="form-control">

        </td>

        <td>

            <input type="text"
                   name="length[]"
                   class="form-control">

        </td>

        <td>

            <input type="number"
                   name="nos[]"
                   class="form-control nos">

        </td>

        <td>

            <input type="number"
                   name="rate[]"
                   class="form-control rate"
                   step="0.01">

        </td>

        <td>

            <input type="number"
                   name="amount[]"
                   class="form-control amount"
                   readonly>

        </td>

        <td>

            <button type="button"
                class="btn btn-danger btn-sm removeRow">

                <i class="bi bi-trash"></i>

            </button>

        </td>

    </tr>`;

            $('#anchorTable tbody').append(row);

        });

        $(document).on('click', '.removeRow', function() {

            if ($('#anchorTable tbody tr').length > 1) {

                $(this).closest('tr').remove();

                calculateAnchor();

            }

        });

        $(document).on('keyup change', '.nos,.rate', function() {

            calculateAnchor();

        });

        function calculateAnchor() {

            let subtotal = 0;

            $('#anchorTable tbody tr').each(function() {

                let nos = parseFloat($(this).find('.nos').val()) || 0;

                let rate = parseFloat($(this).find('.rate').val()) || 0;

                let amount = nos * rate;

                $(this).find('.amount').val(amount.toFixed(2));

                subtotal += amount;

            });

            $('#subtotal').val(subtotal.toFixed(2));

            let gst = parseFloat($('input[name="gst_percent"]').val()) || 0;

            let gstAmount = subtotal * gst / 100;

            $('#gst_amount').val(gstAmount.toFixed(2));

            $('#grand_total').val((subtotal + gstAmount).toFixed(2));

        }

        calculateAnchor();
    </script>
@endpush
