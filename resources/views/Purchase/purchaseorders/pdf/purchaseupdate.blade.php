@php

if($po->company == 'Arasuvel Roofings'){

$companyName = 'ARASUVEL ROOFINGS';

$address = 'No. 108/1 MOUNT P.H.ROAD, TRUNK ROAD, PORUR,CHENNAI - 600 116.';

$website = 'www.arasuvelroofings.com';

$email = 'arasuvelroofings@gmail.com';

$phone = '+91 98410 11186 / 98417 29591';

$gst = '33AJAPJ6193N1ZX';

$billingAddress = '<< Billing Address>>';

    $bank = 'Indian Bank';

    $account = 'XXXXXXXXXXXX';

    $ifsc = 'IDIB000XXXX';

    $upi = 'arasuvel@upi';

    }else{

    $companyName = 'AMUDHA DECORS';

    $address = 'Reg off: No.72, 40 Feet Road, 1st Floor, Lakshmi Nagar, Porur, Chennai - 600116';

    $unit = 'Unit at: No.2/27, Krishnan Industrial Estate, Mettukuppam, Vanagaram, Chennai - 95';

    $website = 'www.amudhadecors.com';

    $email = 'admin@amudhadecors.com';

    $phone = '98419 11186 / 98410 11186';

    $gst = '33AANPS2720G1ZS';

    $billingAddress = 'No.72, 40 Feet Road, Lakshmi Nagar, Porur, Chennai - 600116';

    $logo = public_path('images/logo.png');

    $bank = 'Canara Bank';

    $account = 'XXXXXXXXXXXX';

    $ifsc = 'CNRB000XXXX';

    $upi = 'amudhadecors@upi';

    }

    @endphp
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="UTF-8">

        <title>Purchase Order</title>

        <style>
            * {
                margin: 0;
                padding: 0;
            }



            body {

                margin: 15mm;
                padding: 0;
                font-family: "Times New Roman", serif;
                font-size: 14px;
            }

            table {

                width: 100%;

                border-collapse: collapse;

            }

            .border {

                border: 2px solid #222;

            }

            .border td,
            .border th {

                border: 1px solid #222;

            }

            .header {

                text-align: center;

                line-height: 22px;

            }

            .company {

                font-size: 22px;

                font-weight: bold;

                color: #d40000;

            }

            .address {

                font-size: 14px;

                color: #6b2a2a;

            }

            .unit {

                font-size: 14px;

                font-weight: bold;

                color: #8b2b2b;

            }

            .phone {

                color: blue;

                font-size: 15px;

            }

            .title {

                text-align: center;

                font-size: 16px;

                color: #6b2a2a;

            }

            .left {

                width: 65%;

                vertical-align: top;

                padding: 5px;

            }

            .right {

                width: 35%;

                vertical-align: top;

                padding: 5px;

            }

            .site {

                color: red;

                font-size: 18px;

                margin-top: 20px;

            }

            .centerText {

                text-align: center;

                padding: 25px 0;

                font-size: 18px;

            }

            .bold {

                font-weight: bold;

            }

        </style>

    </head>

    <body>

        <table class="border">

            <!-- HEADER -->

            <tr>

                <td colspan="2">

                    <div class="header">

                        <div class="company">

                            {{ $companyName }}

                        </div>

                        <div class="address">

                            {{ $address }}

                        </div>

                        @if(!empty($unit))

                        <div class="unit">

                            {{ $unit }}

                        </div>

                        @endif

                        <div class="unit">

                            {{$website}}
                            /

                            {{$email}}

                        </div>

                        <div class="phone">

                            {{ $phone }}

                        </div>

                    </div>

                </td>

            </tr>

            <!-- TITLE -->

            <tr>

                <td colspan="2" class="title">

                    PURCHASE ORDER

                </td>

            </tr>

            <!-- Vendor & PO -->

            <tr>

                <td class="left">

                    To

                    <br>

                    <strong>

                        M/s.

                        {{ $po->vendor->company_name }}

                    </strong>

                    <br>

                    {{ $po->vendor->address }}

                    <br>

                    {{ $po->vendor->city }}

                </td>

                <td class="right">

                    P.O.No:{{ $po->po_no }}

                    Date:{{ date('d.m.Y', strtotime($po->po_date)) }}

                </td>

            </tr>

            <!-- SITE -->

            <tr>

                <td colspan="2">

                    <div class="site">

                        SITE AT :

                        {{ $po->customer->Location }}

                    </div>

                    <br>

                    Dear Sir,

                </td>

            </tr>

            <!-- MESSAGE -->

            <tr>

                <td colspan="2">

                    <div class="centerText">

                        We are pleased to place an order for the following products.

                    </div>

                </td>

            </tr>

            <!-- MATERIAL TABLE STARTS IN PART 2 -->
            <!-- MATERIAL TABLE -->

            @if ($po->po_template == 'anchor')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr style="font-weight:bold;text-align:center;">

                                <th width="32%">MATERIAL</th>

                                <th width="12%">DIA</th>

                                <th width="12%">LENGTH</th>

                                <th width="15%">NOS</th>

                                <th width="15%">RATE/PER NOS</th>

                                <th width="14%">AMOUNT</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                            <tr style="text-align:center;">

                                <td>

                                    {{ $item->material }}

                                </td>

                                <td>

                                    {{ $item->dia }}

                                </td>

                                <td>

                                    {{ $item->length }}

                                </td>

                                <td>

                                    {{ $item->nos }}

                                </td>

                                <td>

                                    {{ number_format((float) $item->rate, 2) }}

                                </td>

                                <td>

                                    {{ number_format((float) $item->amount, 2) }}

                                </td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif


            @if ($po->po_template == 'steelplate')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr align="center">

                                <th>S.NO</th>

                                <th>Material</th>

                                <th>Size</th>

                                <th>Thickness</th>

                                <th>Approx Weight</th>

                                <th>Rate/KG</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                            <tr align="center">

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->material }}</td>

                                <td>{{ $item->size }}</td>

                                <td>{{ $item->thickness }}</td>

                                <td>{{ $item->approx_weight }}</td>

                                <td>{{ number_format((float) $item->rate, 2) }}</td>

                                <td>{{ number_format((float) $item->amount, 2) }}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif


            @if ($po->po_template == 'fabrication')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr align="center">

                                <th>Material</th>

                                <th>Size</th>

                                <th>Thickness</th>

                                <th>Qty</th>

                                <th>Rate</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                            <tr align="center">

                                <td>{{ $item->material }}</td>

                                <td>{{ $item->size }}</td>

                                <td>{{ $item->thickness }}</td>

                                <td>{{ $item->qty }}</td>

                                <td>{{ number_format((float) $item->rate, 2) }}</td>

                                <td>{{ number_format((float) $item->amount, 2) }}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif


            @if ($po->po_template == 'sandwichpanel')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr align="center">

                                <th>Material</th>

                                <th>Width</th>

                                <th>Thickness</th>

                                <th>Colour</th>

                                <th>Qty</th>

                                <th>Rate</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                            <tr align="center">

                                <td>{{ $item->material }}</td>

                                <td>{{ $item->width }}</td>

                                <td>{{ $item->thickness }}</td>

                                <td>{{ $item->color }}</td>

                                <td>{{ $item->qty }}</td>

                                <td>{{ number_format((float) $item->rate, 2) }}</td>

                                <td>{{ number_format((float) $item->amount, 2) }}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif

            @if ($po->po_template == 'gutter')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr align="center">

                                <th>Particular</th>

                                <th>nos</th>

                                <th>Rate/no</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                            <tr align="center">

                                <td>{{ $item->material }}</td>

                                <td>{{ $item->nos }}</td>

                                <td>{{ $item->rate }}</td>


                                <td>{{ number_format((float) $item->amount, 2) }}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif
            @if ($po->po_template == 'polycarbonate')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border">

                        <thead>

                            <tr align="center">

                                <th>S.No</th>

                                <th>Particular</th>

                                <th>Length (m)</th>

                                <th>Width (m)</th>

                                <th>Nos</th>

                                <th>Area (Sqm)</th>

                                <th>Rate</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $key => $item)

                            <tr align="center">

                                <td>{{ $key + 1 }}</td>

                                <td align="left">{{ $item->material }}</td>

                                <td>{{ number_format((float)$item->length,3) }}</td>

                                <td>{{ number_format((float)$item->width,3) }}</td>

                                <td>{{ $item->nos }}</td>

                                <td>{{ number_format((float)$item->area,3) }}</td>

                                <td>{{ number_format((float)$item->rate,2) }}</td>

                                <td>{{ number_format((float)$item->amount,2) }}</td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif
            @if ($po->po_template == 'metalsheet')

            <tr>

                <td colspan="2" style="padding:0;">

                    <table class="border" width="100%">

                        <thead>

                            <tr align="center">

                                <th width="5%">S.No</th>
                                <th width="28%">Material</th>
                                <th width="8%">Width(M)</th>
                                <th width="8%">Length(M)</th>
                                <th width="8%">Nos</th>
                                <th width="10%">SQ.M</th>
                                <th width="13%">Rate(SQ.M)</th>
                                <th width="15%">Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $key => $item)

                            <tr align="center">

                                <td>{{ $key + 1 }}</td>

                                <td align="left">
                                    {{ $item->material }}
                                </td>

                                <td>
                                    {{ number_format((float)$item->width, 2) }}
                                </td>

                                <td>
                                    {{ number_format((float)$item->length, 2) }}
                                </td>

                                <td>
                                    {{ $item->nos }}
                                </td>

                                <td>
                                    {{ number_format((float)$item->area, 2) }}
                                </td>

                                <td>
                                    {{ number_format((float)$item->rate, 2) }}
                                </td>

                                <td>
                                    {{ number_format((float)$item->amount, 2) }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

            @endif


            <!-- TOTALS -->

            <tr>

                <td width="65%" style="height:130px;">

                    &nbsp;

                </td>

                <td width="35%" style="padding:0;">

                    <table class="border">

                        <tr>

                            <td align="center">

                                <b>TOTAL</b>

                            </td>

                            <td align="right">

                                <b>

                                    {{ number_format((float) $po->subtotal, 2) }}

                                </b>

                            </td>

                        </tr>

                        <tr>

                            <td align="center" style="color:red;">

                                <b>

                                    GST {{ $po->gst_percent }}%

                                </b>

                            </td>

                            <td align="right" style="color:red;">

                                <b>

                                    {{ number_format((float) $po->gst_amount, 2) }}

                                </b>

                            </td>

                        </tr>

                        <tr>

                            <td align="center" style="font-size:20px;color:red;">

                                <b>

                                    G.TOTAL

                                </b>

                            </td>

                            <td align="right" style="font-size:20px;color:red;">

                                <b>

                                    {{ number_format((float) $po->grand_total, 2) }}

                                </b>

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>
            <!-- BILLING ADDRESS & SIGNATURE -->

            <tr>

                <td style="padding:15px; vertical-align:top;">

                    <div style="color:red;font-size:18px;font-weight:bold;">

                        BILLING ADDRESS

                    </div>

                    <br>

                    <div style="font-size:16px; line-height:26px;">

                        <strong>{{ $po->company }}</strong>
                        <br>

                        {{$address}}

                        <br>
                        <strong>

                            GSTIN: {{$gst}}

                        </strong>

                    </div>

                </td>

                <td style="padding:15px; vertical-align:bottom;">

                    <div style="text-align:center;">

                        <strong>

                            Authorised Signatory.

                        </strong>

                        <br><br>

                        <span style="color:red;font-size:18px;">

                            {{ strtoupper($po->created_by) }}

                        </span>

                    </div>

                </td>

            </tr>


        </table>

    </body>

    </html>
