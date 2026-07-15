@extends('layouts.purchasebase')

@section('title', 'Edit Purchase Order')

@section('content')

    <div class="container-fluid">

        <form method="POST" action="{{ route('purchase.update', $po->id) }}">

            @csrf

            <div class="card shadow">

                <div class="card-header bg-warning">

                    <div class="d-flex justify-content-between">

                        <h4>

                            <i class="bi bi-pencil-square"></i>

                            Edit Purchase Order

                        </h4>

                        <a href="{{ route('purchase.index') }}" class="btn btn-dark">

                            Back

                        </a>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <label>Company</label>

                            <select name="company" class="form-select">

                                <option value="Amudha Decors" {{ $po->company == 'Amudha Decors' ? 'selected' : '' }}>

                                    Amudha Decors

                                </option>

                                <option value="Arasuvel Roofings"
                                    {{ $po->company == 'Arasuvel Roofings' ? 'selected' : '' }}>

                                    Arasuvel Roofings

                                </option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label>Vendor</label>

                            <select name="vendor_id" class="form-select">

                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ $vendor->id == $po->vendor_id ? 'selected' : '' }}>

                                        {{ $vendor->company_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label>Site</label>

                            <select name="site_id" class="form-select">

                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}" {{ $site->id == $po->site_id ? 'selected' : '' }}>

                                        {{ $site->client_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label>Date</label>

                            <input type="date" name="po_date" class="form-control" value="{{ $po->po_date }}">

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col-md-4">

                            <label>Template</label>

                            <input readonly class="form-control" value="{{ ucfirst($po->po_template) }}">

                            <input type="hidden" name="po_template" value="{{ $po->po_template }}">

                        </div>

                    </div>

                    <hr>

                    @if ($po->po_template == 'anchor')
                        @include('Purchase.purchaseorders.edittemplates.anchor')
                    @elseif($po->po_template == 'steelplate')
                        @include('Purchase.purchaseorders.edittemplates.steelplate')
                    @elseif($po->po_template == 'fabrication')
                        @include('Purchase.purchaseorders.edittemplates.fabrication')
                    @elseif($po->po_template == 'sandwichpanel')
                        @include('Purchase.purchaseorders.edittemplates.sandwichpanel')
                    @endif

                    <hr>

                    <div class="row">

                        <div class="col-md-3">

                            <label>Subtotal</label>

                            <input type="text" id="subtotal" name="subtotal" class="form-control"
                                value="{{ $po->subtotal }}" readonly>

                        </div>

                        <div class="col-md-3">

                            <label>GST %</label>

                            <input type="number" id="gst_percent" name="gst_percent" class="form-control"
                                value="{{ $po->gst_percent }}">

                        </div>

                        <div class="col-md-3">

                            <label>GST Amount</label>

                            <input type="text" id="gst_amount" name="gst_amount" class="form-control"
                                value="{{ $po->gst_amount }}" readonly>


                        </div>

                        <div class="col-md-3">

                            <label>Grand Total</label>

                            <input type="text" id="grand_total" name="grand_total" class="form-control"
                                value="{{ $po->grand_total }}" readonly>

                        </div>

                    </div>

                    <br>

                    <label>

                        Remarks

                    </label>

                    <textarea rows="3" name="remarks" class="form-control">{{ $po->remarks }}</textarea>

                    <br>

                    <div class="text-end">

                        <button class="btn btn-success btn-lg">

                            Update Purchase Order

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
