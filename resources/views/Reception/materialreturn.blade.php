@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">

        <form method="POST" action="{{ route('materialreturn.store') }}">

            @csrf

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4>

                        <i class="bi bi-arrow-return-left"></i>

                        Material Return

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <label class="fw-bold">

                                Site

                            </label>

                            <select name="customer_id" id="customer_id" class="form-select" required>

                                <option value="">

                                    Select Site

                                </option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">

                                        {{ $customer->client_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="fw-bold">

                                Returned By

                            </label>

                            <input type="text" class="form-control" name="person_name" required>

                        </div>

                        <div class="col-md-4">

                            <label class="fw-bold">

                                Return Date

                            </label>

                            <input type="date" class="form-control" name="return_date" value="{{ date('Y-m-d') }}">

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col-md-4">

                            <label>

                                Vehicle No

                            </label>

                            <input type="text" class="form-control" name="vehicle_no">

                        </div>

                        <div class="col-md-4">

                            <label>

                                Transport Type

                            </label>

                            <select name="transport_type" class="form-select">

                                <option>

                                    Company Vehicle

                                </option>

                                <option>

                                    Customer Vehicle

                                </option>

                                <option>

                                    Transport

                                </option>

                                <option>

                                    Courier

                                </option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label>

                                Transport Charge

                            </label>

                            <input type="number" class="form-control" value="0" name="transport_charge">

                        </div>

                    </div>

                    <hr>

                    <div id="materialTable">

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button class="btn btn-success">

                        Save Return

                    </button>

                </div>

            </div>

        </form>

    </div>
@endsection
@push('scripts')
    <script>
        $('#customer_id').change(function() {

            let customer = $(this).val();

            if (customer == "") {

                $('#materialTable').html("");

                return;

            }

            $.get(

                "/material-return/items/" + customer,

                function(res) {

                    let html = "";

                    html += '<table class="table table-bordered">';

                    html += '<thead>';

                    html += '<tr class="table-dark">';

                    html += '<th>Item</th>';

                    html += '<th>Dispatch</th>';

                    html += '<th>Returned</th>';

                    html += '<th>Balance</th>';

                    html += '<th width="150">Return Qty</th>';

                    html += '</tr>';

                    html += '</thead>';

                    html += '<tbody>';

                    res.forEach(function(row, index) {

                        html += '<tr>';

                        html += '<td>';

                        html += row.item;

                        html += '<br>';

                        html += '<small>' + row.description + '</small>';

                        html += '</td>';

                        html += '<td>' + row.dispatch_qty + ' ' + row.unit + '</td>';

                        html += '<td>' + row.returned_qty + ' ' + row.unit + '</td>';

                        html += '<td>';

                        html += '<span class="badge bg-success">';

                        html += row.balance + ' ' + row.unit;

                        html += '</span>';

                        html += '</td>';

                        html += '<td>';

                        html += '<input type="hidden" name="dispatch_item_id[]" value="' + row
                            .dispatch_item_id + '">';

                        html += '<input type="number"';

                        html += ' min="0"';

                        html += ' max="' + row.balance + '"';

                        html += ' step="0.01"';

                        html += ' name="return_quantity[]"';

                        html += ' class="form-control">';

                        html += '</td>';

                        html += '</tr>';

                    });

                    html += '</tbody>';

                    html += '</table>';

                    $('#materialTable').html(html);

                }

            );

        });
    </script>
@endpush
