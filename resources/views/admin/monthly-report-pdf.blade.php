<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Business Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h2,
        h3,
        h4 {
            margin: 5px 0;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .summary td {
            border: 1px solid #000;
            padding: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 7px;
        }

        .table th {
            background: #efefef;
        }

        .section-title {
            background: #0d6efd;
            color: white;
            padding: 6px;
            margin-top: 18px;
            font-size: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 11px;
            color: #666;
        }
    </style>

</head>

<body>

    <div class="text-center">

        <h2>AMUDHA DECORS</h2>

        <h3>Business Report</h3>

        <p>

            {{ $from->format('d-m-Y') }}

            to

            {{ $to->format('d-m-Y') }}

        </p>

    </div>

    <table class="summary">

        <tr>

            <td><b>Total Leads</b></td>

            <td>{{ $totalLeads }}</td>

            <td><b>Total Estimates</b></td>

            <td>{{ $totalEstimates }}</td>

        </tr>

        <tr>

            <td><b>Customers Added</b></td>

            <td>{{ $totalCustomers }}</td>

            <td><b>Confirmed Orders</b></td>

            <td>{{ $confirmedCount }}</td>

        </tr>

    </table>

    <div class="section-title">

        Lead Source Report

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Source</th>

                <th>Total Leads</th>

            </tr>

        </thead>

        <tbody>

            @forelse($leadSources as $row)
                <tr>

                    <td>{{ $row->source }}</td>

                    <td>{{ $row->total }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" align="center">

                        No Records

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="section-title">

        Product Wise Leads

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Product</th>

                <th>Total Leads</th>

            </tr>

        </thead>

        <tbody>

            @forelse($productReport as $row)
                <tr>

                    <td>{{ $row->Product }}</td>

                    <td>{{ $row->total }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" align="center">

                        No Records

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="section-title">

        Lead Status Report

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Status</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @forelse($statusReport as $row)
                <tr>

                    <td>{{ $row->Status }}</td>

                    <td>{{ $row->total }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" align="center">

                        No Records

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="section-title">

        Confirmed Orders

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Date</th>

                <th>Customer</th>

                <th>Mobile</th>

                <th>Product</th>

                <th>Location</th>

            </tr>

        </thead>

        <tbody>

            @forelse($confirmedOrders as $row)
                <tr>

                    <td>

                        {{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}

                    </td>

                    <td>

                        {{ $row->Name }}

                    </td>

                    <td>

                        {{ $row->Mobile }}

                    </td>

                    <td>

                        {{ $row->Product }}

                    </td>

                    <td>

                        {{ $row->Site_location }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" align="center">

                        No Confirmed Orders

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="footer">

        Report Generated on

        {{ now()->format('d-m-Y h:i A') }}

    </div>

</body>

</html>
