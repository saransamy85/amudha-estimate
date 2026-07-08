@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-8">

                                <h3 class="text-primary">

                                    {{ $customer->client_name }}

                                </h3>

                                <p>

                                    <i class="bi bi-geo-alt-fill text-danger"></i>

                                    {{ $customer->Location }}

                                </p>

                                <p>

                                    <i class="bi bi-telephone-fill"></i>

                                    {{ $customer->Mobile }}

                                </p>

                            </div>

                            <div class="col-md-4 text-end">

                                <a href="{{ url()->previous() }}" class="btn btn-primary">

                                    Back

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-4">

                <div class="card bg-primary text-white shadow">

                    <div class="card-body text-center">

                        <h2>

                            {{ $dispatchCount }}

                        </h2>

                        Total Dispatches

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card bg-success text-white shadow">

                    <div class="card-body text-center">

                        <h2>

                            {{ $materialCount }}

                        </h2>

                        Materials Sent

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card bg-danger text-white shadow">

                    <div class="card-body text-center">

                        <h2>

                            ₹{{ number_format($transportTotal, 2) }}

                        </h2>

                        Transport Charges

                    </div>

                </div>

            </div>

        </div>

        <br>

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    Dispatch Timeline

                </h5>

            </div>

            <div class="card-body">

                <div class="timeline">

                    @foreach ($dispatches as $dispatch)
                        <div class="card mb-4 border-start border-primary border-4">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-9">

                                        <h5 class="text-primary">

                                            🚚 Dispatch

                                            {{ date('d-m-Y', strtotime($dispatch->dispatch_date)) }}

                                        </h5>

                                    </div>

                                    <div class="col-md-3 text-end">

                                        <span class="badge bg-success">

                                            ₹{{ number_format($dispatch->transport_charge, 2) }}

                                        </span>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-3">

                                        <b>Person</b>

                                        <br>

                                        {{ $dispatch->person_name ?: '-' }}

                                    </div>

                                    <div class="col-md-3">

                                        <b>Vehicle</b>

                                        <br>

                                        {{ $dispatch->vehicle_no ?: '-' }}

                                    </div>

                                    <div class="col-md-3">

                                        <b>Transport</b>

                                        <br>

                                        {{ $dispatch->transport_type }}

                                    </div>

                                    <div class="col-md-3">

                                        <b>From → To</b>

                                        <br>

                                        {{ $dispatch->from_location }}

                                        →

                                        {{ $dispatch->to_location }}

                                    </div>

                                </div>

                                <hr>

                                <table class="table table-bordered">

                                    <thead class="table-light">

                                        <tr>

                                            <th>Item</th>

                                            <th>Qty</th>

                                            <th>Unit</th>

                                            <th>Description</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($dispatch->items as $item)
                                            <tr>

                                                <td>

                                                    {{ $item->item }}

                                                </td>

                                                <td>

                                                    {{ $item->quantity }}

                                                </td>

                                                <td>

                                                    {{ $item->unit }}

                                                </td>

                                                <td>

                                                    {{ $item->description }}

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>
@endsection
