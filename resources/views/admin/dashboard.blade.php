@extends('layouts.adminbase')

@section('title','Dashboard')

@section('content')

<div class="row mt-4 g-3">
    <div class="dashboard-section">
         <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="section-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0">Summary</h3>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    
                    <div class="modern-card">
                        <div class="icon-box text-primary">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-2">
                                   Estimate
                                </h6>
                                <h2 class="fw-bold mb-3">
                                    {{ $escount }}
                                </h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="modern-card">
                        <div class="icon-box text-success">
                                <i class="bi bi-bullseye"></i>
                            </div>
                        <div class="flex-grow-1">
                            <div class="text-muted mb-2">
                                <h6 class="text-muted mb-2">
                                   Lead
                                </h6>
                                <h2 class="fw-bold mb-3">
                                    {{ $lc }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="modern-card">
                        <div class="icon-box text-warning">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                             <h6 class="text-muted mb-2">
                                   Customer
                                </h6>
                                <h2 class="fw-bold mb-3">
                                    {{ $cuscount }}
                                </h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="modern-card">
                        <div class="icon-box text-warning">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                             <h6 class="text-muted mb-2">
                                   Today
                                </h6>
                                <h2 class="fw-bold mb-3">
                                    {{ $todayCount }}
                                </h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="modern-card">
                        <div class="icon-box text-warning">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                             <h6 class="text-muted mb-2">
                                   Month
                                </h6>
                                <h2 class="fw-bold mb-3">
                                    {{ $monthlyCount }}
                                </h2>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<br>
<div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Estimate List</h4>
        <a href="{{ route('estimates.create') }}" class="btn btn-primary">
            + Create Estimate
        </a>
</div>
<div class="row g-3">
   <div class="col-lg-12">
     {{-- Estimate Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Estimate No</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Location</th>
                        <th>Mobile</th>
                        <th>Total Amount</th>
                        <th width="220">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($estimates as $key => $estimate)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $estimate->estimate_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($estimate->estimate_date)->format('d-m-Y') }}</td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>{{ $estimate->customer_address }}</td>
                            <td>{{ $estimate->mobile }}</td>
                            <td class="text-end">
                                ₹ {{ number_format($estimate->net_total, 2) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('estimates.show', $estimate->id) }}"
                                   class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a href="{{ route('estimates.edit', $estimate->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="{{ route('estimates.pdf', $estimate->id) }}"
                                   class="btn btn-sm btn-success"
                                   target="_blank">
                                    PDF
                                </a>

                                <form action="{{ route('estimates.destroy', $estimate->id) }}"
                                      method="POST"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this estimate?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No estimates found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
   </div>
</div>
@endsection

