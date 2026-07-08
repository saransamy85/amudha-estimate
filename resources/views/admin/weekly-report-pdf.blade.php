<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Weekly Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2,
        h3 {
            text-align: center;
            margin: 5px;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .summary th,
        .summary td {
            border: 1px solid #000;
            padding: 8px;
        }

        .summary th {
            background: #0d6efd;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11px;
        }

        table th {
            background: #efefef;
        }

        .section {
            margin-top: 25px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #777;
        }
    </style>

</head>

<body>

    <h2>AMUDHA DECORS CRM</h2>

    <h3>LAST 7 DAYS REPORT</h3>

    <p style="text-align:center;">
        {{ $from->format('d-m-Y') }}
        to
        {{ $to->format('d-m-Y') }}
    </p>


    <table class="summary">

        <tr>

            <th>Total Leads</th>

            <th>Total Customers</th>

            <th>Total Estimates</th>

            <th>Total Feedbacks</th>

            <th>Estimate Value</th>

        </tr>

        <tr>

            <td align="center">{{ $weeklyLeads }}</td>

            <td align="center">{{ $weeklyCustomers }}</td>

            <td align="center">{{ $weeklyEstimates }}</td>

            <td align="center">{{ $weeklyFeedbacks }}</td>

            <td align="right">
                ₹ {{ number_format($weeklyEstimateValue, 2) }}
            </td>

        </tr>

    </table>


    <div class="section">

        <h3>Lead Status Summary</h3>

        <table>

            <thead>

                <tr>

                    <th>Status</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($leadStatus as $status => $total)
                    <tr>

                        <td>{{ $status }}</td>

                        <td align="center">{{ $total }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="section">

        <h3>Lead Source Summary</h3>

        <table>

            <thead>

                <tr>

                    <th>Source</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($leadSource as $source => $total)
                    <tr>

                        <td>{{ $source }}</td>

                        <td align="center">{{ $total }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="section">

        <h3>Leads Created</h3>

        <table>

            <thead>

                <tr>

                    <th>#</th>

                    <th>Date</th>

                    <th>Name</th>

                    <th>Mobile</th>

                    <th>Product</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($weeklyLeadList as $lead)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ date('d-m-Y', strtotime($lead->created_at)) }}</td>

                        <td>{{ $lead->Name }}</td>

                        <td>{{ $lead->Mobile }}</td>

                        <td>{{ $lead->Product }}</td>

                        <td>{{ $lead->Status }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="section">

        <h3>Customers Added</h3>

        <table>

            <thead>

                <tr>

                    <th>#</th>

                    <th>Date</th>

                    <th>Customer</th>

                    <th>Location</th>

                    <th>Product</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($weeklyCustomerList as $customer)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ date('d-m-Y', strtotime($customer->created_at)) }}</td>

                        <td>{{ $customer->client_name }}</td>

                        <td>{{ $customer->Location }}</td>

                        <td>{{ $customer->Product }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="section">

        <h3>Estimates Created</h3>

        <table>

            <thead>

                <tr>

                    <th>#</th>

                    <th>Date</th>

                    <th>Estimate No</th>

                    <th>Customer</th>

                    <th>Amount</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($weeklyEstimateList as $estimate)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ date('d-m-Y', strtotime($estimate->created_at)) }}</td>

                        <td>{{ $estimate->estimate_no }}</td>

                        <td>{{ $estimate->customer_name }}</td>

                        <td align="right">
                            ₹ {{ number_format($estimate->net_total, 2) }}
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="section">

        <h3>Lead Feedback Timeline</h3>

        <table>

            <thead>

                <tr>

                    <th>#</th>

                    <th>Date</th>

                    <th>Lead</th>

                    <th>Feedback</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($weeklyFeedbackList as $feedback)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ date('d-m-Y', strtotime($feedback->created_at)) }}</td>

                        <td>{{ optional($feedback->lead)->Name }}</td>

                        <td>{{ $feedback->feedback }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    <div class="footer">

        Generated on :
        {{ now()->format('d-m-Y h:i A') }}

        <br>

        Generated by :
        {{ auth()->user()->name }}

        <br><br>

        Amudha Decors CRM

    </div>

</body>

</html>
