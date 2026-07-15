<div class="table-responsive">

    <table class="table table-bordered" id="fabricationTable">

        <thead class="table-dark">

            <tr>

                <th>Material</th>

                <th>Description</th>

                <th>Qty</th>

                <th>Unit</th>

                <th>Rate</th>

                <th>Amount</th>

                <th>

                    <button type="button" class="btn btn-success btn-sm" id="addFabricationRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody id="fabricationBody">

            @foreach ($po->items as $item)
                <tr>

                    <td>

                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                        <input type="text" name="material[]" class="form-control" value="{{ $item->material }}">

                    </td>

                    <td>

                        <input type="text" name="description[]" class="form-control"
                            value="{{ $item->description }}">

                    </td>

                    <td>

                        <input type="number" name="qty[]" class="form-control qty" value="{{ $item->qty }}">

                    </td>

                    <td>

                        <input type="text" name="unit[]" class="form-control" value="{{ $item->unit }}">

                    </td>

                    <td>

                        <input type="number" name="rate[]" class="form-control rate" value="{{ $item->rate }}">

                    </td>

                    <td>

                        <input type="number" name="amount[]" class="form-control amount" value="{{ $item->amount }}"
                            readonly>

                    </td>

                    <td>

                        <button type="button" class="btn btn-danger btn-sm removeFabricationRow">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</div>

@push('scripts')
    <script src="{{ asset('js/fabrication.js') }}"></script>
@endpush
