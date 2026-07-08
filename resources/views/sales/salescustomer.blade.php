<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sales-Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


</head>

<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                Amudha Decors
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('salesdashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="{{ route('leaddash') }}">
                    <i class="bi bi-file-earmark-text"></i> Leads
                </a>
                <a href="{{ route('customers') }}" class="active">
                    <i class="bi bi-people"></i> Customers
                </a>
                <a href="{{ route('salesgreetings') }}">
                    <i class="bi bi-people"></i> Greetings
                </a>

                <a href="{{ route('logout') }}">
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
                    {{ session('username') }}
                </div>
            </nav>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid">
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
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Date</th>
                                            <th>Mobile</th>
                                            <th>Location</th>
                                            <th>Area</th>
                                            <th>Product</th>
                                            <th>Values</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cli as $cl)
                                            <tr>
                                                <td>
                                                    {{ $cl->client_name }}
                                                </td>
                                                <td>
                                                    {{ $cl->created_at->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    {{ $cl->Mobile }}
                                                </td>
                                                <td>
                                                    {{ $cl->Location }}
                                                </td>
                                                <td>
                                                    {{ $cl->Area }} Sq.ft
                                                </td>
                                                <td>
                                                    {{ $cl->Product }}
                                                </td>
                                                <td>
                                                    {{ $cl->Total_values }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    {{ $cli->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
