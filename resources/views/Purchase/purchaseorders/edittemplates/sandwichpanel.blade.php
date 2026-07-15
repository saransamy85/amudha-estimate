<div class="table-responsive">

    <table class="table table-bordered" id="panelTable">

        <thead class="table-dark">

            <tr>

                <th>Material</th>

                <th>Width</th>

                <th>Thickness</th>

                <th>Color</th>

                <th>Nos</th>

                <th>Qty</th>

                <th>Unit</th>

                <th>Rate</th>

                <th>Amount</th>

                <th>

                    <button type="button" class="btn btn-success btn-sm" id="addPanelRow">

                        <i class="bi bi-plus-lg"></i>

                    </button>

                </th>

            </tr>

        </thead>

        <tbody id="panelBody">

            @foreach ($po->items as $item)
                <tr>

                    <td>

                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                        <input type="text" name="material[]" class="form-control" value="{{ $item->material }}">

                    </td>

                    <td>

                        <input type="text" name="width[]" class="form-control" value="{{ $item->width }}">

                    </td>

                    <td>

                        <input type="text" name="thickness[]" class="form-control" value="{{ $item->thickness }}">

                    </td>

                    <td>

                        <input type="text" name="color[]" class="form-control" value="{{ $item->color }}">

                    </td>

                    <td>

                        <input type="number" name="nos[]" class="form-control nos" value="{{ $item->nos }}">

                    </td>

                    <td>

                        <input type="number" name="qty[]" class="form-control qty" value="{{ $item->qty }}">

                    </td>

                    <td>

                        <select name="unit[]" class="form-select">

                            <option {{ $item->unit == 'Rft' ? 'selected' : '' }}>Rft</option>

                            <option {{ $item->unit == 'Sq.ft' ? 'selected' : '' }}>Sq.ft</option>

                            <option {{ $item->unit == 'Nos' ? 'selected' : '' }}>Nos</option>

                            <option {{ $item->unit == 'Mtr' ? 'selected' : '' }}>Mtr</option>

                        </select>

                    </td>

                    <td>

                        <input type="number" name="rate[]" class="form-control rate" value="{{ $item->rate }}">

                    </td>

                    <td>

                        <input type="number" name="amount[]" class="form-control amount" value="{{ $item->amount }}"
                            readonly>

                    </td>

                    <td>

                        <button type="button" class="btn btn-danger btn-sm removePanelRow">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</div>

@push('scripts')
    <script src="{{ asset('js/sandwichpanel.js') }}"></script>
@endpush
