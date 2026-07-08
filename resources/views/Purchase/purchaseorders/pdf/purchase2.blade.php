<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Purchase Order</title>

    <style>
        @page {
            margin: 15mm 12mm 15mm 12mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            font-family: "Times New Roman", serif;

            font-size: 14px;

            color: #000;
            margin: 15mm;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        /* Main Layout */

        .main-table {

            width: 100%;

        }

        .main-table td {

            border: none;

            vertical-align: top;

        }

        /* Only Material Table */

        .item-table {

            width: 100%;

            border-collapse: collapse;

        }

        .item-table th {

            border: 1px solid #000;

            padding: 6px;

            font-size: 14px;

            text-align: center;

        }

        .item-table td {

            border: 1px solid #000;

            padding: 5px;

        }

        /* Totals */

        .total-table {

            width: 100%;

            border-collapse: collapse;

        }

        .total-table td {

            border: 1px solid #000;

            padding: 5px;

        }

        .header {

            text-align: center;

            line-height: 22px;

        }

        .company {

            font-size: 22px;

            font-weight: bold;

            color: #c40000;

        }

        .address {

            font-size: 13px;

        }

        .unit {

            font-size: 13px;

            font-weight: bold;

        }

        .phone {

            color: #0048ff;

            font-size: 14px;

        }

        .title {

            text-align: center;

            font-size: 18px;

            font-weight: bold;

            color: #8b0000;

            padding: 12px 0;

        }

        .vendor {

            width: 65%;

            padding-top: 15px;

        }

        .poinfo {

            width: 35%;

            padding-top: 15px;

        }

        .site {

            color: red;

            font-weight: bold;

            font-size: 16px;

            padding-top: 18px;

        }

        .message {

            text-align: center;

            padding: 20px 0;

            font-size: 16px;

        }
    </style>

</head>

<body>

    <table class="main-table">

        <!-- COMPANY HEADER -->

        <tr>

            <td colspan="2">

                <div class="header">

                    <div class="company">

                        AMUDHA DECORS

                    </div>

                    <div class="address">

                        Reg Off : No.72, 40 Feet Road, 1st Floor,

                        Lakshmi Nagar, Porur, Chennai - 600116

                    </div>

                    <div class="unit">

                        Unit : No.2/27, Krishnan Industrial Estate,

                        Mettukuppam, Vanagaram,

                        Chennai - 600095

                    </div>

                    <div class="unit">

                        Website :

                        www.amudhadecors.com

                        &nbsp;&nbsp;&nbsp;

                        E-Mail :

                        admin@amudhadecors.com

                    </div>

                    <div class="phone">

                        Phone :

                        98419 11186

                        &nbsp;&nbsp;&nbsp;

                        Mobile :

                        98410 11186

                    </div>

                </div>

            </td>

        </tr>
        <hr style="width: 100%;height: 2px;background-color: red;">

        <!-- TITLE -->

        <tr>

            <td colspan="2">

                <div class="title">

                    PURCHASE ORDER

                </div>

            </td>

        </tr>

        <!-- VENDOR -->

        <tr>

            <td class="vendor">

                <strong>

                    To,

                </strong>

                <br><br>

                <strong>

                    M/s.

                    {{ $po->vendor->company_name }}

                </strong>

                <br>

                {{ $po->vendor->address }}

                <br>

                {{ $po->vendor->city }}

            </td>

            <td class="poinfo">

                <table style="width:100%;">

                    <tr>

                        <td width="40%">

                            <strong>

                                P.O.No

                            </strong>

                        </td>

                        <td>

                            :

                            {{ $po->po_no }}

                        </td>

                    </tr>

                    <tr>

                        <td>

                            <strong>

                                Date

                            </strong>

                        </td>

                        <td>

                            :

                            {{ date('d-m-Y', strtotime($po->po_date)) }}

                        </td>

                    </tr>

                </table>

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

                <div class="message">

                    We are pleased to place an order for the following products.

                </div>

            </td>

        </tr>

        <!-- MATERIAL TABLE STARTS IN PART 2 -->
        <!-- ========================= -->
        <!-- MATERIAL TABLE - ANCHOR -->
        <!-- ========================= -->

        @if ($po->po_template == 'anchor')

            <tr>

                <td colspan="2" style="padding-top:10px;">

                    <table class="item-table">

                        <thead>

                            <tr>

                                <th width="35%">Material Description</th>

                                <th width="10%">Dia</th>

                                <th width="12%">Length</th>

                                <th width="10%">Nos</th>

                                <th width="15%">Rate / Nos</th>

                                <th width="18%">Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                                <tr>

                                    <td>{{ $item->material }}</td>

                                    <td align="center">{{ $item->dia }}</td>

                                    <td align="center">{{ $item->length }}</td>

                                    <td align="center">{{ $item->nos }}</td>

                                    <td align="right">{{ number_format((float) $item->rate, 2) }}</td>

                                    <td align="right">{{ number_format((float) $item->amount, 2) }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

        @endif


        <!-- ========================= -->
        <!-- MATERIAL TABLE - STEEL -->
        <!-- ========================= -->

        @if ($po->po_template == 'steelplate')

            <tr>

                <td colspan="2" style="padding-top:10px;">

                    <table class="item-table">

                        <thead>

                            <tr>

                                <th>S.No</th>

                                <th>Description</th>

                                <th>Size</th>

                                <th>Thickness</th>

                                <th>Approx Weight</th>

                                <th>Rate/Kg</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                                <tr>

                                    <td align="center">{{ $loop->iteration }}</td>

                                    <td>{{ $item->material }}</td>

                                    <td align="center">{{ $item->size }}</td>

                                    <td align="center">{{ $item->thickness }}</td>

                                    <td align="right">{{ $item->approx_weight }}</td>

                                    <td align="right">{{ number_format((float) $item->rate, 2) }}</td>

                                    <td align="right">{{ number_format((float) $item->amount, 2) }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

        @endif


        <!-- ========================= -->
        <!-- FABRICATION -->
        <!-- ========================= --> 

        @if ($po->po_template == 'fabrication')

            <tr>

                <td colspan="2" style="padding-top:10px;">

                    <table class="item-table">

                        <thead>

                            <tr>

                                <th>Description</th>

                                <th>Size</th>

                                <th>Thickness</th>

                                <th>Qty</th>

                                <th>Rate</th>

                                <th>Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($po->items as $item)
                                <tr>

                                    <td>{{ $item->material }}</td>

                                    <td align="center">{{ $item->size }}</td>

                                    <td align="center">{{ $item->thickness }}</td>

                                    <td align="center">{{ $item->qty }}</td>

                                    <td align="right">{{ number_format((float) $item->rate, 2) }}</td>

                                    <td align="right">{{ number_format((float) $item->amount, 2) }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

        @endif


        <!-- ========================= -->
        <!-- SANDWICH PANEL -->
        <!-- ========================= -->

        @if ($po->po_template == 'sandwichpanel')

            <tr>

                <td colspan="2" style="padding-top:10px;">

                    <table class="item-table">

                        <thead>

                            <tr>

                                <th>Description</th>

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
                                <tr>

                                    <td>{{ $item->material }}</td>

                                    <td align="center">{{ $item->width }}</td>

                                    <td align="center">{{ $item->thickness }}</td>

                                    <td align="center">{{ $item->color }}</td>

                                    <td align="center">{{ $item->qty }}</td>

                                    <td align="right">{{ number_format((float) $item->rate, 2) }}</td>

                                    <td align="right">{{ number_format((float) $item->amount, 2) }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </td>

            </tr>

        @endif


        <!-- ========================= -->
        <!-- SPACE AFTER MATERIAL TABLE -->
        <!-- ========================= -->

        <tr>

            <td colspan="2" style="height:18px;"></td>

        </tr>

        <!-- TOTALS STARTS IN PART 3 -->
        <!-- ========================= -->
        <!-- TOTAL SECTION -->
        <!-- ========================= -->

        <tr>

            <td width="65%" style="vertical-align:top;">

                <div style="padding-top:20px;">

                    <span style="color:#c00000;font-size:16px;font-weight:bold;">

                        BILLING ADDRESS

                    </span>

                    <br><br>

                    <strong>

                        {{ strtoupper($po->company) }}

                    </strong>

                    <br>

                    No.72, 40 Feet Road,

                    <br>

                    Lakshmi Nagar,

                    <br>

                    Porur,

                    <br>

                    Chennai - 600116.

                    <br>

                    GSTIN : 33AANPS2720G1ZS

                </div>

            </td>

            <td width="35%" valign="top">

                <table class="total-table">

                    <tr>

                        <td width="55%">

                            <strong>TOTAL</strong>

                        </td>

                        <td align="right">

                            {{ number_format((float) $po->subtotal, 2) }}

                        </td>

                    </tr>

                    <tr>

                        <td>

                            <strong>GST {{ $po->gst_percent }}%</strong>

                        </td>

                        <td align="right">

                            {{ number_format((float) $po->gst_amount, 2) }}

                        </td>

                    </tr>

                    <tr>

                        <td style="font-size:16px;">

                            <strong>G.TOTAL</strong>

                        </td>

                        <td align="right" style="font-size:16px;">

                            <strong>

                                {{ number_format((float) $po->grand_total, 2) }}

                            </strong>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>


        <!-- ========================= -->
        <!-- SIGNATURE -->
        <!-- ========================= -->

        <tr>

            <td style="padding-top:40px;">

                <strong>

                    Prepared By

                </strong>

                <br><br>

                {{ strtoupper($po->created_by) }}

            </td>

            <td align="center" style="padding-top:40px;">

                <strong>

                    For {{ strtoupper($po->company) }}

                </strong>

                <br><br><br>

                <strong>

                    Authorised Signatory

                </strong>

            </td>

        </tr>




    </table>

</body>

</html>
