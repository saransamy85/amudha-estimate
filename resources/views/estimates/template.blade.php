<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<meta charset="utf-8">
<title>Estimate</title>

<style>
body{
    font-family: DejaVu Sans;
    font-size: 14px;
}
.header{
    text-align: center;
    line-height: 1.6;
}
.header h2{
    margin: 0;
    color: maroon;
}
table{
    width: 100%;
    border-collapse: collapse;
}
th,td{
    border:1px solid #000;
    padding:6px;
}
.no-border td{
    border: none;
}
.text-right{ text-align: right; }
.text-center{ text-align: center; }
.red{ color:red; }
.mt-10{ margin-top:10px; }
.mt-20{ margin-top:20px; }
</style>
</head>

<body>
<a href="{{route('salesdashboard')}}"><button class="btn btn-primary">Home</button></a>
<!-- HEADER -->
<table class="no-border">
<tr>
<td width="100%">
    <img src="{{ asset('images/Header-5-1-1.jpg') }}" width="100%" height="100%">
</td>

</tr>
</table>

<hr>

<h3 class="text-center">ESTIMATE</h3>

<!-- TO DETAILS -->
<table class="no-border table table-responsive ">
<tr>
<td width="60%">
<b>TO:</b><br>
{{ $estimate->customer_name }}<br>
{{ $estimate->customer_address }}<br>
Mobile: {{ $estimate->mobile }}
</td>
<td width="40%">
<b>EST NO:</b> {{ $estimate->estimate_no }}<br>
<b>DATE:</b> {{ \Carbon\Carbon::parse($estimate->estimate_date)->format('d/m/Y') }}<br>
<!-- <b>GSTIN:</b> 33AANPS2720G1ZS -->
</td>
</tr>
</table>

<!-- DESCRIPTION -->
<p class="mt-10">
{!! nl2br(e($estimate->description)) !!}
</p>

<!-- ITEMS -->
<table class="mt-10 table">
<thead class="thead-dark">
<tr class="text-center">
<th>Location</th>
<th>Area</th>
<th>Rate </th>
<th>Value (Rs)</th>
</tr>
</thead>

@foreach($estimate->items as $item)
<tr class="text-center">
<td>{{ $item->location }}</td>
<td>{{ rtrim(rtrim(number_format($item->area, 2), '0'), '.') }} Sq.ft</td>
<!-- <td>{{ $item->area }} Sq.ft</td> -->
<td class="text-right">{{ number_format($item->rate,2) }} /- (Per Sq.ft)</td>
<td class="text-right">{{ number_format($item->value,2) }}</td>
</tr>
@endforeach

<tr>
<td colspan="3" class="text-right">GST {{ (int) $estimate->gst_percent }}%</td>
<td class="text-right">{{ number_format($estimate->gst_amount,2) }}</td>
</tr>

<tr>
<td colspan="3" class="text-right"><b>Total</b></td>
<td class="text-right"><b>{{ number_format($estimate->net_total,2) }}</b></td>
</tr>
</table>

<!-- NOTES -->
<ul class="mt-10">
<li><b>Total Value:</b> Rs. {{ number_format($estimate->net_total,2) }}/-</li>
<li>
    <b>Rupees In Words:</b> {{ $amountWords }}
</li>
<li class="red">FINISHED AREA WILL BE TAKEN FOR FINAL MEASUREMENT.</li>
<li class="red">TRANSPORTATION CHARGE WILL BE EXTRA.</li>
<li><b>NOTE:</b> CIVIL WORK & SCAFFOLDING HAS TO BE PROVIDED</li>
</ul>

<!-- PAYMENT TERMS -->
<b>PAYMENT TERMS</b>
<ul>
<li>50% ADVANCE</li>
<li>40% ON PROGRESS</li>
<li>10% ON COMPLETION</li>
</ul>

<br>

<table class="no-border mt-20">
<tr>
<td>
FOR AMUDHA DECORS<br>
<h5>{{$estimate->estimatedby}}</h5>
<b>AUTHORISED SIGNATORY</b>
</td>
<td class="text-right">
CUSTOMER<br>
SEAL & SIGNATURE
</td>
</tr>
</table>
<br>
<table class="no-border mt-20">
    <tr>
        <td><b>RTGS DETAILS</b></td>
    </tr>
    <tr>
        <td>NAME: AMUDHA DECORS</td>
    </tr>
    <tr>
        <td>A/C NO: 610 930 7000 1293</td>
    </tr>
    <tr>
        <td>BANK: CANARA BANK</td>
    </tr>
    <tr>
        <td>BRANCH: PORUR</td>
    </tr>    
        <tr>
            <td>IFSC CODE: CNRB0002950</td>
        </tr>
</table>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
