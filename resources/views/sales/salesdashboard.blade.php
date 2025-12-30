<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Sales-Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">


</head>

<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                Amudha Decors
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('salesdashboard') }}" class="active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="{{route('leaddash')}}">
                    <i class="bi bi-file-earmark-text"></i> Leads
                </a>
                <a href="{{route('salescustomer')}}">
                    <i class="bi bi-people"></i> Customers
                </a>

                <a href="{{route('logout')}}">
                    <i class="bi bi-gear"></i> Log Out
                </a>
            </nav>
        </aside>


        <!-- MAIN CONTENT -->
        <div class="main-content">

            <!-- TOP NAVBAR -->
            <nav class="topbar">
                <h5 class="mb-0">@yield('title')</h5>

                <div class="topbar-right">
                    <i class="bi bi-bell"></i>
                    {{session('username')}}
                </div>
            </nav>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid">
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

                                <!-- <form action="{{ route('estimates.destroy', $estimate->id) }}"
                                      method="POST"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this estimate?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td> -->
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
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>