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
                <a href="{{ route('salesdashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="#">
                    <i class="bi bi-file-earmark-text"></i> Leads
                </a>
                <a href="{{route('customers')}}" class="active">
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
                   <div class="row mt-4 g-3">
    <div class="col-lg-6">
        <div class="card md-4 p-3">
            <form method="Post" action="{{route('addcustomers')}}">
                @csrf
                <div class="mb-3">
                    <label for="customer name" >Customer Name</label>
                    <input type="text" class="form-control" name="cusname" required>
                </div>
                <div class="mb-3">
                    <label for="Mobile" >Mobile</label>
                    <input type="tel" class="form-control" name="cusmob" required>
                </div>
                <div class="mb-3">
                    <label for="Location" >Location</label>
                    <input type="text" class="form-control" name="cuslocation" required>
                </div>
                <div class="mb-3">
                    <label for="Area" >Total Area</label>
                    <input type="text" class="form-control" name="cusarea" required>
                </div>
                <div class="mb-3">
                    <label for="product" >Product</label>
                    <input type="text" class="form-control" name="cusproduct" required>
                </div>
                <div class="mb-3">
                    <label for="values" >Values</label>
                    <input type="text" class="form-control" name="cusvalue" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Create">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th>Location</th>
                        <th>Area</th>
                        <th>Product</th>
                        <th>Values</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cli as $cl)
                    <tr>
                        <td>
                            {{$cl->client_name}}
                        </td>
                        <td>
                            {{$cl->Mobile}}
                        </td>
                        <td>
                            {{$cl->Location}}
                        </td>
                        <td>
                            {{$cl->Area}} Sq.ft
                        </td>
                        <td>
                            {{$cl->Product}}
                        </td>
                        <td>
                            {{$cl->Total_values}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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