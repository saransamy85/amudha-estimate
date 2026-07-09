@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold">
                    <i class="bi bi-building"></i>
                    Active Project Sites
                </h3>

                <small class="text-muted">
                    Yet to Start & Progress Projects
                </small>
            </div>

        </div>

        <div class="row">

            @forelse($sites as $site)
                @php

                    $dispatchCount = $site->materialDispatches->count();

                    $transportCharge = $site->materialDispatches->sum('transport_charge');

                    $lastDispatch = $site->materialDispatches->sortByDesc('dispatch_date')->first();

                    if ($site->status == 'Yet to Start') {
                        $progress = 10;

                        $color = 'bg-secondary';
                    } else {
                        $progress = 60;

                        $color = 'bg-warning';
                    }

                @endphp

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow border-0 rounded-4 site-card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <h5 class="fw-bold mb-1">

                                        <i class="bi bi-building text-primary"></i>

                                        {{ $site->client_name }}

                                    </h5>

                                    <small class="text-muted">

                                        <i class="bi bi-geo-alt-fill text-danger"></i>

                                        {{ $site->Location }}

                                    </small>

                                </div>

                                <div>

                                    @if ($site->status == 'Yet to Start')
                                        <span class="badge bg-secondary">

                                            Yet to Start

                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">

                                            Progress

                                        </span>
                                    @endif

                                </div>

                            </div>

                            <hr>

                            <div class="row text-center">

                                <div class="col-4">

                                    <div class="border rounded p-2">

                                        <small class="text-muted d-block">

                                            Dispatch

                                        </small>

                                        <h5 class="text-primary mb-0">

                                            {{ $dispatchCount }}

                                        </h5>

                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="border rounded p-2">

                                        <small class="text-muted d-block">

                                            Transport

                                        </small>

                                        <h6 class="text-success mb-0">

                                            ₹ {{ number_format($transportCharge) }}

                                        </h6>

                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="border rounded p-2">

                                        <small class="text-muted d-block">

                                            Last

                                        </small>

                                        <small>

                                            @if ($lastDispatch)
                                                {{ date('d M', strtotime($lastDispatch->dispatch_date)) }}
                                            @else
                                                -
                                            @endif

                                        </small>

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-1">

                                <small>

                                    Project Progress

                                </small>

                                <small>

                                    {{ $progress }}%

                                </small>

                            </div>

                            <div class="progress rounded-pill" style="height:12px;">

                                <div class="progress-bar {{ $color }}" style="width:{{ $progress }}%">

                                </div>

                            </div>

                            <div class="mt-4 d-grid">

                                <a href="{{ route('receptionmaterialitems') }}" class="btn btn-primary rounded-pill">

                                    <i class="bi bi-truck"></i>

                                    Material Dispatch

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-info">

                        No Active Sites Found.

                    </div>

                </div>
            @endforelse

        </div>

    </div>




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
                <th>Action</th>
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
@endsection

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
