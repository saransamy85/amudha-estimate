@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Edit Estimate</h4>

    <form action="{{ route('estimates.update', $estimate->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- CUSTOMER DETAILS --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6>Customer Details</h6>

                <input type="text" name="customer_name" class="form-control mb-2"
                       value="{{ $estimate->customer_name }}" required>

                <input type="text" name="address_line1" class="form-control mb-2"
                       value="{{ explode(',', $estimate->customer_address)[0] ?? '' }}" required>

                <input type="text" name="address_line2" class="form-control mb-2"
                       value="{{ explode(',', $estimate->customer_address)[1] ?? '' }}">

                <input type="text" name="mobile" class="form-control"
                       value="{{ $estimate->mobile }}" required>
            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6>Description</h6>
                <textarea name="description" class="form-control" rows="4" required>{{ $estimate->description }}</textarea>
            </div>
        </div>

        {{-- ITEMS --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6>Estimate Items</h6>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Area</th>
                            <th>Rate</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody id="items">
                        @foreach($estimate->items as $item)
                        <tr>
                            <td><input name="location[]" class="form-control" value="{{ $item->location }}"></td>
                            <td><input name="area[]" class="form-control" value="{{ $item->area }}"></td>
                            <td><input name="rate[]" class="form-control" value="{{ $item->rate }}"></td>
                            <td><input name="value[]" class="form-control" value="{{ $item->value }}"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" class="btn btn-secondary btn-sm" onclick="addRow()">+ Add Row</button>
            </div>
        </div>

        {{-- TOTALS --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6>Charges</h6>

                <input type="number" name="gst_percent" class="form-control mb-2"
                       value="{{ $estimate->gst_percent }}">

                <input type="number" name="transportation" class="form-control"
                       value="{{ $estimate->transportation }}">
            </div>
        </div>

        <button class="btn btn-primary">Update Estimate</button>
        <a href="{{ route('estimates.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
function addRow(){
    document.getElementById('items').insertAdjacentHTML('beforeend', `
        <tr>
            <td><input name="location[]" class="form-control"></td>
            <td><input name="area[]" class="form-control"></td>
            <td><input name="rate[]" class="form-control"></td>
            <td><input name="value[]" class="form-control"></td>
        </tr>
    `);
}
</script>
@endsection
