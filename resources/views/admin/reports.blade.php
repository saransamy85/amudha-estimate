@extends('layouts.adminbase')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="p-3">
        <a href="{{ route('dailyreport') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Download Daily Report
        </a>
    </div>
    <div class="p-3">
        <a href="{{ route('weeklyreport') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Download Weekly Report
        </a>
    </div>
    <div class="p-3">
        <a href="{{ route('monthlyreport') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Monthly Report
        </a>
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
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Lead Status Chart
                </div>
                <div class="card-body">
                    <canvas id="leadChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
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
        let delayed = false;

        const labels = {
            !!json_encode($leadSC - > keys()) !!
        };
        const values = {
            !!json_encode($leadSC - > values()) !!
        };

        new Chart(document.getElementById('leadChart'), {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [{

                    label: 'Lead Count',

                    data: values,

                    backgroundColor: [
                        '#0d6efd'
                        , '#ffc107'
                        , '#198754'
                        , '#dc3545'
                        , '#6f42c1'
                        , '#20c997'
                        , '#fd7e14'
                        , '#0dcaf0'
                    ],

                    borderRadius: 12,

                    borderSkipped: false,

                    maxBarThickness: 55

                }]

            },

            plugins: [ChartDataLabels],

            options: {

                responsive: true,

                maintainAspectRatio: false,

                animation: {

                    onComplete: () => {

                        delayed = true;

                    },

                    delay: (context) => {

                        let delay = 0;

                        if (
                            context.type === 'data' &&
                            context.mode === 'default' &&
                            !delayed
                        ) {

                            delay = context.dataIndex * 300;

                        }

                        return delay;

                    },

                    duration: 1800,

                    easing: 'easeOutBounce'

                },

                plugins: {

                    legend: {

                        display: false

                    },

                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                return ' Leads : ' + context.raw;

                            }

                        }

                    },

                    datalabels: {

                        anchor: 'end',

                        align: 'top',

                        color: '#000',

                        font: {

                            size: 13,

                            weight: 'bold'

                        },

                        formatter: function(value) {

                            return value;

                        }

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0,

                            stepSize: 1

                        },

                        title: {

                            display: true,

                            text: 'Number of Leads',

                            font: {

                                size: 14,

                                weight: 'bold'

                            }

                        },

                        grid: {

                            color: '#e9ecef'

                        }

                    },

                    x: {

                        title: {

                            display: true,

                            text: 'Lead Status',

                            font: {

                                size: 14,

                                weight: 'bold'

                            }

                        },

                        grid: {

                            display: false

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

        const total1 = values.reduce((a, b) => a + b, 0);

        new Chart(document.getElementById('Source'), {
            type: 'doughnut'
            , data: {
                labels: labels1
                , datasets: [{
                    data: values1
                    , backgroundColor: [
                        '#0d6efd'
                        , '#ffc107'
                        , '#198754'
                        , '#dc3545'
                    ]
                    , hoverOffset: 15 // 🔥 slice zoom on hover
                }]
            }
            , plugins: [ChartDataLabels]
            , options: {
                responsive: true
                , animation: {
                    animateRotate: true
                    , animateScale: true
                    , duration: 1800
                    , easing: 'easeOutBounce'
                }
                , plugins: {
                    datalabels: {
                        color: '#fff'
                        , font: {
                            weight: 'bold'
                            , size: 13
                        }
                        , formatter: (value1) => {
                            let percent = ((value1 / total1) * 100).toFixed(1);
                            return `${value1} (${percent}%)`;
                        }
                    }
                    , legend: {
                        position: 'bottom'
                    }
                }
            }
        });

    </script>



    @endsection
