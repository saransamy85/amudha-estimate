@extends('layouts.app')

@section('content')


  

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Estimate List</h4>
        <a href="{{ route('estimates.create') }}" class="btn btn-primary">
            + Create Estimate
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
@endsection
