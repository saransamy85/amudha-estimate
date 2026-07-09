@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('addmaterialitems') }}" method="POST">
            @csrf
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">
                        <i class="bi bi-truck"></i>
                        Material Dispatch
                    </h4>

                    <a href="{{ route('receptionmaterialitems') }}" class="btn btn-light btn-sm">

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>

                </div>

                <div class="card-body">

                    <div class="row">

                        <!-- Site -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                Site

                            </label>

                            <select class="form-select" name="customer_id" required>

                                <option value="">

                                    Select Site

                                </option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">

                                        {{ $customer->client_name }}

                                        -

                                        {{ $customer->Location }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Person -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                Person Name

                            </label>

                            <input type="text" name="person_name" class="form-control" placeholder="Optional">

                        </div>

                        <!-- From -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                From

                            </label>

                            <input type="text" name="from_location" class="form-control" placeholder="location" required>

                        </div>

                        <!-- To -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                To

                            </label>

                            <input type="text" name="to_location" class="form-control" placeholder="Site Location"
                                required>

                        </div>

                        <!-- Transport -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">

                                Transport Type

                            </label>

                            <select name="transport_type" class="form-select">

                                <option>Company Vehicle</option>

                                <option>Customer Vehicle</option>

                                <option>Transport</option>

                                <option>Courier</option>

                                <option>Pickup</option>

                                <option>Rapido</option>

                                <option>Abi Auto</option>

                                <option>Portar</option>

                            </select>

                        </div>

                        <!-- Vehicle -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">

                                Vehicle No

                            </label>

                            <input type="text" name="vehicle_no" class="form-control" placeholder="TN38AB1234">

                        </div>

                        <!-- Charge -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">

                                Transport Charge

                            </label>

                            <input type="number" step="0.01" value="0" name="transport_charge"
                                class="form-control">

                        </div>

                        <!-- Dispatch Date -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">

                                Dispatch Date

                            </label>

                            <input type="date" class="form-control" name="dispatch_date" value="{{ date('Y-m-d') }}">

                        </div>

                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">

                        Materials

                    </h5>

                    <!-- Dynamic Table will come in Part 4.2 -->

                    <table class="table table-bordered" id="materialTable">

                        <thead class="table-dark">

                            <tr>

                                <th width="30%">Item</th>

                                <th width="15%">Qty</th>

                                <th width="15%">Unit</th>

                                <th>Description</th>

                                <th width="80">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>

                                    <input type="text" name="item[]" class="form-control" placeholder="Material Name"
                                        required>

                                </td>

                                <td>

                                    <input type="number" name="quantity[]" class="form-control" step="0.01" required>

                                </td>

                                <td>

                                    <select name="unit[]" class="form-select">

                                        <option>Nos</option>

                                        <option>Kg</option>

                                        <option>Sq.ft</option>

                                        <option>Meter</option>

                                        <option>Box</option>

                                        <option>ltr</option>

                                    </select>

                                </td>

                                <td>

                                    <input type="text" name="description[]" class="form-control"
                                        placeholder="Description">

                                </td>

                                <td class="text-center">

                                    <button type="button" class="btn btn-success" id="addRow">

                                        +

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <hr>

                    <button class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Save Dispatch

                    </button>

                    <a href="#" class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </div>

        </form>

    </div>

@section('scripts')
    <script>
        $(document).ready(function() {

            $("#addRow").click(function() {

                var html = '';

                html += '<tr>';

                html += '<td><input type="text" name="item[]" class="form-control" required></td>';

                html +=
                    '<td><input type="number" step="0.01" name="quantity[]" class="form-control" required></td>';

                html += '<td>';

                html += '<select name="unit[]" class="form-select">';

                html += '<option>Nos</option>';

                html += '<option>Kg</option>';

                html += '<option>Sq.ft</option>';

                html += '<option>Meter</option>';

                html += '<option>Box</option>';

                html += '<option>Bundle</option>';

                html += '<option>ltr</option>';

                html += '</select>';

                html += '</td>';

                html += '<td><input type="text" name="description[]" class="form-control"></td>';

                html += '<td class="text-center">';

                html += '<button type="button" class="btn btn-danger removeRow">-</button>';

                html += '</td>';

                html += '</tr>';

                $("#materialTable tbody").append(html);

            });

            $(document).on("click", ".removeRow", function() {

                $(this).closest("tr").remove();

            });

        });
    </script>
@endsection
@endsection
