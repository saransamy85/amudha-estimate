
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Report</title>

    <style>
        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th,td{
            border:1px solid #000;
            padding:8px;
        }

        h2,h3{
            margin-bottom:5px;
        }
    </style>
</head>
<body>

<h2>AMUDHA DECORS</h2>
<h3>Daily CRM Report</h3>

<p>Date: {{ now()->format('d-m-Y') }}</p>

<hr>

<table>
    <tr>
        <td>Today's Leads</td>
        <td>{{ $todayLeads }}</td>
    </tr>

    <tr>
        <td>Today's Estimates</td>
        <td>{{ $todayEstimates }}</td>
    </tr>

    <tr>
        <td>Today's Feedbacks</td>
        <td>{{ $todayFeedbacks }}</td>
    </tr>

    <tr>
        <td>Today's Customers</td>
        <td>{{ $todayCustomers }}</td>
    </tr>
</table>

<br>

<h3>Today's Lead List</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    @foreach($todayLeadList as $lead)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lead->Name }}</td>
            <td>{{ $lead->Mobile }}</td>
            <td>{{ $lead->Status }}</td>
        </tr>

    @endforeach

    </tbody>
</table>


<h3>Today's Feedback Updates</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Lead Name</th>
            <th>Mobile</th>
            <th>Feedback</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>

    @forelse($todayFeedbackList as $fb)

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $fb->lead->Name ?? '-' }}</td>

            <td>{{ $fb->lead->Mobile ?? '-' }}</td>

            <td>{{ $fb->feedback }}</td>

            <td>{{ $fb->created_at->format('d-m-Y h:i A') }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="5">No Feedback Added Today</td>
        </tr>

    @endforelse

    </tbody>
</table>


</body>
</html>

