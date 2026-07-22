@extends('layouts.adminbase')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-4">
            <a href="{{ route('dailyreport') }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Download Daily Report
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{ route('weeklyreport') }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Download Weekly Report
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{ route('monthlyreport') }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Monthly Report
            </a>
        </div>
    </div>
    <br>
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Today's Leads</h6>
                    <h2>{{ $todayLeads }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Today's Estimates</h6>
                    <h2>{{ $todayEstimates }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Feedback Updated</h6>
                    <h2>{{ $todayFeedbacks }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Customers Added</h6>
                    <h2>{{ $todayCustomers }}</h2>
                </div>
            </div>
        </div>

    </div>
    <br>


    <h4>Leads Reports</h4>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Month</th>
                <th>Total Leads</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyLeads as $row)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($row->month)->format('F') }}</td>
                <td>{{ $row->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row mt-4 g-3">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    Monthly Leads Trend
                </div>
                <div class="card-body">
                    <canvas id="monthlyLeadChart" height="110"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Lead Source Chart
                </div>
                <div class="card-body">
                    <canvas id="Source" height="120"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('monthlyLeadChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: @json($monthLabels),

                datasets: [{

                    label: 'Monthly Leads',

                    data: @json($monthValues),

                    borderColor: '#0d6efd',

                    backgroundColor: 'rgba(13,110,253,.15)',

                    fill: true,

                    tension: .35,

                    pointRadius: 6,

                    pointHoverRadius: 8,

                    pointBackgroundColor: '#fff',

                    pointBorderColor: '#0d6efd',

                    pointBorderWidth: 3,

                    pointHoverBackgroundColor: '#0d6efd',

                    pointHoverBorderColor: '#fff'

                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: false

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0

                        }

                    }

                }

            }

        });

    </script>
    <script>
        const labels1 = {
            !!json_encode($lsc - > keys()) !!
        };
        const values1 = {
            !!json_encode($lsc - > values()) !!
        };

        new Chart(document.getElementById('Source'), {

            type: 'bar',

            data: {
                labels: labels1
                , datasets: [{
                    label: 'Lead Sources'
                    , data: values1,

                    backgroundColor: [
                        '#0d6efd'
                        , '#198754'
                        , '#ffc107'
                        , '#dc3545'
                        , '#6f42c1'
                        , '#fd7e14'
                        , '#20c997'
                        , '#0dcaf0'
                    ],

                    borderColor: [
                        '#0d6efd'
                        , '#198754'
                        , '#ffc107'
                        , '#dc3545'
                        , '#6f42c1'
                        , '#fd7e14'
                        , '#20c997'
                        , '#0dcaf0'
                    ],

                    borderWidth: 1,

                    borderRadius: 8,

                    barThickness: 40
                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        enabled: true
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        title: {
                            display: true
                            , text: 'Number of Leads'
                        }

                    },

                    x: {

                        title: {
                            display: true
                            , text: 'Lead Sources'
                        }

                    }

                },

                animation: {

                    duration: 1500,

                    easing: 'easeOutBounce'

                }

            }

        });

    </script>

    @endsection
