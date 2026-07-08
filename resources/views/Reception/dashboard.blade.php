@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">



        <div class="row g-4">

            <div class="col-lg-6">
                <div class="row g-4">

                    <div class="col-md-6 mb-6">
                        <div class="modern-card bg-primary text-white">
                            <div class="icon-box bg-white text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="text-white-50 mb-2">
                                    Total Customers
                                </h6>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalCustomers }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-6">
                        <div class="modern-card bg-secondary text-white">
                            <div class="icon-box bg-white text-secondary">
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="text-white-50 mb-2">
                                    Yet to Start
                                </h6>

                                <h2 class="fw-bold mb-0">
                                    {{ $yetToStart }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-6">
                        <div class="modern-card bg-warning text-white">
                            <div class="icon-box bg-white text-warning">
                                <i class="bi bi-tools"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">
                                    In Progress
                                </h6>

                                <h2 class="fw-bold mb-0">
                                    {{ $progress }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-6">
                        <div class="modern-card bg-success text-white">
                            <div class="icon-box bg-white text-success">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="text-white-50 mb-2">
                                    Completed
                                </h6>

                                <h2 class="fw-bold mb-0">
                                    {{ $completed }}
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-lg-4">

                        <a href="#" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-box-seam display-5 text-primary"></i>

                                    <h5 class="mt-3">
                                        Stock
                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-4">

                        <a href="#" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-box-arrow-in-down display-5 text-success"></i>

                                    <h5 class="mt-3">

                                        Material In

                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-4">

                        <a href="{{ route('receptionmaterialitems') }}" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-box-arrow-right display-5 text-danger"></i>

                                    <h5 class="mt-3">

                                        Material Out

                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-4">

                        <a href="#" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-truck display-5 text-warning"></i>

                                    <h5 class="mt-3">

                                        Dispatch

                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-4">

                        <a href="{{ route('receptionsites') }}" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-building display-5 text-info"></i>

                                    <h5 class="mt-3">

                                        Sites

                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-4">

                        <a href="#" class="text-decoration-none">

                            <div class="card shadow border-0">

                                <div class="card-body text-center">

                                    <i class="bi bi-tools display-5 text-secondary"></i>

                                    <h5 class="mt-3">

                                        Machines

                                    </h5>

                                </div>

                            </div>

                        </a>

                    </div>
                </div>
            </div>



        </div>

        <hr class="my-5">

        <div class="row">

            <div class="col-lg-12">

                <div class="card shadow">

                    <div class="card-header fw-bold">

                        Today Summary

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>
                                        <th>Site</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Timeline</th>
                                        <th>Materials</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($dispatches as $dispatch)
                                        <tr>

                                            <td width="20%">

                                                <strong class="text-primary">

                                                    {{ $dispatch->customer->client_name }}

                                                </strong>

                                                <br>

                                                <small class="text-muted">

                                                    <i class="bi bi-person-fill"></i>

                                                    Created By :

                                                    <strong>

                                                        {{ $dispatch->user_name }}

                                                    </strong>

                                                </small>

                                            </td>

                                            <td width="15%">

                                                <span class="badge bg-info">

                                                    {{ date('d-m-Y', strtotime($dispatch->dispatch_date)) }}

                                                </span>

                                            </td>

                                            <td width="20%">

                                                <i class="bi bi-geo-alt-fill text-danger"></i>

                                                {{ $dispatch->customer->Location }}

                                            </td>
                                            <td>
                                                <a href="{{ route('sitetimeline', $dispatch->customer_id) }}"
                                                    class="btn btn-info btn-sm">

                                                    <i class="bi bi-clock-history"></i>

                                                    Timeline

                                                </a>
                                            </td>

                                            <td>

                                                @foreach ($dispatch->items as $item)
                                                    <div class="border rounded p-2 mb-2 bg-light">

                                                        <div class="d-flex justify-content-between">

                                                            <strong>

                                                                {{ $item->item }}

                                                            </strong>

                                                            <span class="badge bg-success">

                                                                {{ $item->quantity }}

                                                                {{ $item->unit }}

                                                            </span>

                                                        </div>

                                                        @if ($item->description)
                                                            <small class="text-muted">

                                                                {{ $item->description }}

                                                            </small>
                                                        @endif

                                                    </div>
                                                @endforeach

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="4" class="text-center py-4">

                                                <i class="bi bi-inbox display-6 text-muted"></i>

                                                <br>

                                                No Dispatch Found

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    </div>
@endsection
