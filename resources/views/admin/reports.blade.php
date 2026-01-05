@extends('layouts.adminbase')

@section('title','Dashboard')

@section('content')
<div class="container-fluid">
    <h4>Estimates Report</h4>
    <div class="row mt-4 g-3">
        <div class="col-lg-4 ">
            <div class="card p-3">
                Total No.of Estimates
                <div class="card-body">
                    {{$escount}}
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
        @foreach($monthlyLeads as $row)
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
                    <canvas id="leadChart" height="120"></canvas>
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
    const labels = {!! json_encode($leadSC->keys()) !!};
    const values = {!! json_encode($leadSC->values()) !!};

    const total = values.reduce((a, b) => a + b, 0);

    new Chart(document.getElementById('leadChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#0d6efd',
                    '#ffc107',
                    '#198754',
                    '#dc3545'
                ],
                hoverOffset: 15   // 🔥 slice zoom on hover
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            responsive: true,
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1800,
                easing: 'easeOutBounce'
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 13
                    },
                    formatter: (value) => {
                        let percent = ((value / total) * 100).toFixed(1);
                        return `${value} (${percent}%)`;
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<script>
    const labels1 = {!! json_encode($lsc->keys()) !!};
    const values1 = {!! json_encode($lsc->values()) !!};

    const total1 = values.reduce((a, b) => a + b, 0);

    new Chart(document.getElementById('Source'), {
        type: 'doughnut',
        data: {
            labels: labels1,
            datasets: [{
                data: values1,
                backgroundColor: [
                    '#0d6efd',
                    '#ffc107',
                    '#198754',
                    '#dc3545'
                ],
                hoverOffset: 15   // 🔥 slice zoom on hover
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            responsive: true,
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1800,
                easing: 'easeOutBounce'
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 13
                    },
                    formatter: (value1) => {
                        let percent = ((value1 / total1) * 100).toFixed(1);
                        return `${value1} (${percent}%)`;
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>



@endsection