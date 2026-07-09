@extends('layouts.receptionbase')

@section('title', 'Reception Reports')

@section('content')

    <div class="container-fluid">

        <div class="row g-3">

            <div class="col-md-3">

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h6>Total Dispatch</h6>

                        <h2 class="text-primary">

                            {{ $dispatchCount }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h6>Today's Dispatch</h6>

                        <h2 class="text-success">

                            {{ $todayDispatch }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h6>Material Returns</h6>

                        <h2 class="text-danger">

                            {{ $returnCount }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h6> Transport Charges</h6>

                        <h2 class="text-danger">

                            ₹ {{ number_format($transportCharge, 2) }}

                        </h2>

                    </div>

                </div>

            </div>



        </div>

        <br>



        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                Recent Dispatches

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" id="dispatchTable">

                        <thead class="table-dark">

                            <tr>

                                <th>Dispatch No</th>

                                <th>Date</th>

                                <th>Customer</th>

                                <th>Site</th>

                                <th>Transport</th>

                                <th>Charge</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($recentDispatch as $dispatch)
                                <tr>

                                    <td>

                                        {{ $dispatch->id }}

                                    </td>

                                    <td>

                                        {{ date('d-m-Y', strtotime($dispatch->dispatch_date)) }}

                                    </td>

                                    <td>

                                        {{ $dispatch->customer->client_name }}

                                    </td>

                                    <td>

                                        {{ $dispatch->customer->Location }}

                                    </td>

                                    <td>

                                        {{ $dispatch->transport_type }}

                                    </td>

                                    <td>

                                        ₹ {{ number_format($dispatch->transport_charge, 2) }}

                                    </td>

                                    <td>

                                        <span class="badge bg-success">

                                            {{ $dispatch->status }}

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(function() {

            $('#dispatchTable').DataTable({

                pageLength: 10,

                responsive: true

            });

        });
    </script>
@endpush
