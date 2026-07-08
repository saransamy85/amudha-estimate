@extends('layouts.adminbase')

@section('title', 'Dashboard')

@section('content')
    <div class="row mt-4 g-3">

        <div class="row">
            <div class="col-lg-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
                    + New Customer
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card p-3">
                <div class="table-responsive">
                    <table id="clientTable" class="table table-bordered table-hover align-middle nowrap" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Mobile</th>
                                <th>Location</th>
                                <th>Area</th>
                                <th>Product</th>
                                <th>Total Value</th>
                                <th>Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cli as $cl)
                                <tr>
                                    <td>{{ $cl->client_name }}</td>
                                    <td>{{ $cl->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $cl->Mobile }}</td>
                                    <td>{{ $cl->Location }}</td>
                                    <td>{{ $cl->Area }} Sq.ft</td>
                                    <td>{{ $cl->Product }}</td>
                                    <td>₹ {{ $cl->Total_values }}</td>
                                    <td>
                                        @switch($cl->status)
                                            @case('Yet to Start')
                                                <span class="badge bg-secondary">Yet to Start</span>
                                            @break

                                            @case('Progress')
                                                <span class="badge bg-warning text-dark">Progress</span>
                                            @break

                                            @case('Completed')
                                                <span class="badge bg-success">Completed</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>

                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#statusModal{{ $cl->id }}">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--customer add model-->
    <div class="modal fade" id="customerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="Post" action="{{ route('addcustomers') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customer name">Customer Name</label>
                            <input type="text" class="form-control" name="cusname" required>
                        </div>
                        <div class="mb-3">
                            <label for="Mobile">Mobile</label>
                            <input type="tel" class="form-control" name="cusmob" required>
                        </div>
                        <div class="mb-3">
                            <label for="Location">Location</label>
                            <input type="text" class="form-control" name="cuslocation" required>
                        </div>
                        <div class="mb-3">
                            <label for="Area">Total Area</label>
                            <input type="text" class="form-control" name="cusarea" required>
                        </div>
                        <div class="mb-3">
                            <label for="product">Product</label>
                            <input type="text" class="form-control" name="cusproduct" required>
                        </div>
                        <div class="mb-3">
                            <label for="values">Values</label>
                            <input type="text" class="form-control" name="cusvalue" required>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--End customer add model-->

    @foreach ($cli as $cl)
        <div class="modal fade" id="statusModal{{ $cl->id }}" tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="{{ route('customerstatusupdate', $cl->id) }}" method="POST">

                        @csrf

                        @method('PUT')

                        <div class="modal-header bg-primary text-white">

                            <h5 class="modal-title">

                                Update Project Status

                            </h5>

                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                        </div>

                        <div class="modal-body">

                            <div class="mb-3">

                                <label class="form-label">

                                    Customer

                                </label>

                                <input type="text" class="form-control" value="{{ $cl->client_name }}" readonly>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Status

                                </label>

                                <select class="form-select" name="status">

                                    <option value="Yet to Start" {{ $cl->status == 'Yet to Start' ? 'selected' : '' }}>

                                        Yet to Start

                                    </option>

                                    <option value="Progress" {{ $cl->status == 'Progress' ? 'selected' : '' }}>

                                        Progress

                                    </option>

                                    <option value="Completed" {{ $cl->status == 'Completed' ? 'selected' : '' }}>

                                        Completed

                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button class="btn btn-success">

                                Update Status

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    @endforeach



@endsection
