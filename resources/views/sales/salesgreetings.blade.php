<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Sales-Greetings')</title>
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

                <a href="{{route('leaddash')}}">
                    <i class="bi bi-file-earmark-text"></i> Leads
                </a>
                <a href="{{route('customers')}}" >
                    <i class="bi bi-people"></i> Customers
                </a>
                  <a href="{{route('salesgreetings')}}" class="active">
                    <i class="bi bi-people"></i> Greetings
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
                    <div class="row mt-4 g-2">
                        <div class="col-lg-6">
                            <div class="card p-3">
                                <form method="POST" action="{{ route('greetings') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress">Email</label>
                                        <input type="email" name="email" required class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="attachments">File</label>
                                        <input type="file" name="attachments[]" multiple accept="image/jpeg,image/png"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-success">Send Greeting</button>
                                </form>
                                <br>
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif
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