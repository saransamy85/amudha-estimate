<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!---datatables--->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- ApexCharts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>

<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
        @include('layouts.sidebar2')

        <!-- MAIN CONTENT -->
        <div class="main-content">

            <!-- TOP NAVBAR -->
            @include('layouts.navbar')

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');

            // Save state
            if (document.body.classList.contains('sidebar-collapsed')) {
                localStorage.setItem('sidebar', 'collapsed');
            } else {
                localStorage.setItem('sidebar', 'expanded');
            }
        });

        // Restore state on load
        if (localStorage.getItem('sidebar') === 'collapsed') {
            document.body.classList.add('sidebar-collapsed');
        }


        $(document).ready(function() {

            $('#clientTable').DataTable({

                responsive: true,

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],

                order: [
                    [1, "desc"]
                ], // Sort by Date descending

                columnDefs: [{
                    targets: 6,
                    className: "text-end"
                }],

                language: {
                    search: "Search Customer:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ customers",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }

            });

        });
    </script>
    @stack('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('scripts')

</body>

</html>
