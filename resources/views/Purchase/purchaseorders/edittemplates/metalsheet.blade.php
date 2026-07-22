<div class="table-responsive">

    <table class="table table-bordered" id="metalsheetTable">

        <thead class="table-dark">

            <tr>

                <th>S.No</th>
                <th>Material</th>
                <th>Width (M)</th>
                <th>Length (M)</th>
                <th>Nos</th>
                <th>SQ.M</th>
                <th>Rate / SQ.M</th>
                <th>Amount</th>

                <th>

                    <button type="button" class="btn btn-success btn-sm addMetalRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody id="metalsheetBody">

            @foreach($po->items as $item)

            <tr>

                <td class="serial">
                    {{ $loop->iteration }}
                </td>

                <td>

                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                    <input type="text" name="material[]" class="form-control material" value="{{ $item->material }}">

                </td>

                <td>

                    <input type="number" step="0.001" name="width[]" class="form-control width" value="{{ $item->width }}">

                </td>

                <td>

                    <input type="number" step="0.001" name="length[]" class="form-control length" value="{{ $item->length }}">

                </td>

                <td>

                    <input type="number" name="nos[]" class="form-control nos" value="{{ $item->nos }}">

                </td>

                <td>

                    <input type="number" step="0.01" name="area[]" class="form-control sqm" value="{{ $item->area }}" readonly>

                </td>

                <td>

                    <input type="number" step="0.01" name="rate[]" class="form-control rate" value="{{ $item->rate }}">

                </td>

                <td>

                    <input type="number" step="0.01" name="amount[]" class="form-control amount" value="{{ $item->amount }}" readonly>

                </td>

                <td>

                    <button type="button" class="btn btn-danger btn-sm removeMetalRow">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr>

                <td colspan="7" class="text-end fw-bold">
                    Sub Total
                </td>

                <td>

                    <input type="text" id="subtotal" name="subtotal" class="form-control" value="{{ $po->subtotal }}" readonly>

                </td>

                <td></td>

            </tr>

            <tr>

                <td colspan="7" class="text-end fw-bold">
                    GST %
                </td>

                <td>

                    <input type="number" id="gst" name="gst_percent" class="form-control" value="{{ $po->gst_percent }}">

                </td>

                <td></td>

            </tr>

            <tr>

                <td colspan="7" class="text-end fw-bold">
                    GST Amount
                </td>

                <td>

                    <input type="text" id="gst_amount" name="gst_amount" class="form-control" value="{{ $po->gst_amount }}" readonly>

                </td>

                <td></td>

            </tr>

            <tr>

                <td colspan="7" class="text-end fw-bold">
                    Grand Total
                </td>

                <td>

                    <input type="text" id="grand_total" name="grand_total" class="form-control fw-bold" value="{{ $po->grand_total }}" readonly>

                </td>

                <td></td>

            </tr>

        </tfoot>

    </table>

</div>

@push('scripts')
<script src="{{ asset('js/edit-metalsheet.js') }}"></script>
@endpush
