<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<meta charset="utf-8">
<style>
body{
    font-family: DejaVu Sans;
    font-size: 12px;
}
.header{
    text-align: center;
    line-height: 1.5;
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
</style>
</head>

<body>

<!-- HEADER -->
<table class="no-border">
<tr>
<td width="100%">
<img src="{{public_path('images/Header-5-1-1.jpg') }}" width="100%">
</td>
</tr>
</table>
<hr>
<h6 class="text-center">ESTIMATE</h6>
<!-- TO DETAILS -->
<table class="no-border">
<tr>
<td width="60%">
<b>TO:</b><br>
{{ $estimate->customer_name }}<br>
{{ $estimate->customer_address }}<br>
MOBILE NO: {{ $estimate->mobile }}
</td>
<td width="40%">
<b>EST NO:</b> {{ $estimate->estimate_no }}<br>
<b>DATE:</b> {{ $estimate->estimate_date }}<br>
<b>GSTIN:</b> 33AANPS2720G1ZS
</td>
</tr>
</table>

<br>

<!-- DESCRIPTION -->
<p>
{!! nl2br(e($estimate->description)) !!}
</p>

<!-- ITEMS TABLE -->
<table>

<tr>
<th>Location</th>
<th>Area</th>
<th>Rate </th>
<th>Value (Rs)</th>
</tr>


@foreach($estimate->items as $item)
<tr class="text-center">
<td>{{ $item->location }}</td>
<td>{{ $item->area }}</td>
<td class="text-right">{{ number_format($item->rate,2) }}</td>
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

<br>

<!-- NOTES -->
<ul>
<li><b>Total Value:</b> Rs. {{ number_format($estimate->net_total,2) }}/-</li>
<li>(Rupees: {{ $amountWords }})</li>
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

<br><br>

<table class="no-border">
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

</body>
</html>
