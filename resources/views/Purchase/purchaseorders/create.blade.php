@extends('layouts.purchasebase')

@section('title', 'Create Purchase Order')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>

                <i class="bi bi-cart4"></i>

                Create Purchase Order

            </h4>

        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('purchase.store') }}">

                @csrf
                <div class="row">

                    <div class="col-md-3">

                        <label>

                            Company

                        </label>

                        <select name="company" id="company" class="form-select">
                            <option value="">Select Company</option>
                            <option value="Amudha Decors">Amudha Decors</option>
                            <option value="Arasuvel Roofings">Arasuvel Roofings</option>
                        </select>

                    </div>

                    <div class="col-md-3">

                        <label>

                            Vendor

                        </label>

                        <select class="form-select" name="vendor_id" required>

                            <option value="">

                                Select Vendor

                            </option>

                            @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">

                                {{ $vendor->company_name }}

                            </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-3">

                        <label>

                            Project Site

                        </label>

                        <select class="form-select" name="site_id">

                            <option>

                                Select Site

                            </option>

                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}">

                                {{ $site->client_name }}

                            </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <label>
                            PO Date
                        </label>

                        <input type="date" class="form-control" name="po_date" value="{{ date('Y-m-d') }}">

                    </div>

                    <div id="po_no_div" class="col-md-3" style="display:none;">
                        <label>PO Number</label>
                        <input type="text" name="po_no" class="form-control">
                    </div>

                </div>
                <br>

                <div class="row">

                    <div class="col-md-4">

                        <label>

                            Purchase Template

                        </label>

                        <select id="template" class="form-select" name="po_template">

                            <option value="anchor">

                                Anchor Bolt

                            </option>

                            <option value="steelplate">

                                Steel Plate

                            </option>

                            <option value="fabrication">

                                Fabrication

                            </option>

                            <option value="sandwichpanel">

                                Sandwich Panel

                            </option>

                            <option value="gutter">UPVC Gutter</option>

                            <option value="polycarbonate">Polycarbonate Sheet</option>
                            <option value="metalsheet">Metal Sheet</option>

                        </select>

                    </div>

                </div>
                <hr>

                <div id="itemTable">

                    @include('Purchase.purchaseorders.templates.anchor')

                </div>
                <hr>

                <div class="row">

                    <div class="col-md-3">

                        <label>

                            Subtotal

                        </label>

                        <input readonly class="form-control" id="subtotal" name="subtotal">

                    </div>

                    <div class="col-md-3">

                        <label>

                            GST %

                        </label>

                        <input type="number" class="form-control" id="gst_percent" name="gst_percent" value="18">

                    </div>

                    <div class="col-md-3">

                        <label>

                            GST Amount

                        </label>

                        <input readonly class="form-control" id="gst_amount" name="gst_amount">

                    </div>

                    <div class="col-md-3">

                        <label>

                            Grand Total

                        </label>

                        <input readonly class="form-control" id="grand_total" name="grand_total">

                    </div>

                </div>

                <br>

                <label>

                    Remarks

                </label>

                <textarea rows="3" class="form-control" name="remarks"></textarea>

                <br>

                <div class="text-end">

                    <button class="btn btn-success btn-lg">

                        <i class="bi bi-check-circle"></i>

                        Save Purchase Order

                    </button>

                </div>
            </form>

        </div>

    </div>

</div>

@push('scripts')
<script>
    function bindAnchorEvents() {

        // Add Row
        $(document).off('click', '#addRow').on('click', '#addRow', function() {

            let row = $('#tbody tr:first').clone();

            row.find('input').val('');

            $('#tbody').append(row);

        });

        // Remove Row
        $(document).off('click', '.removeRow').on('click', '.removeRow', function() {

            if ($('#tbody tr').length > 1) {

                $(this).closest('tr').remove();

                calculateTotal();

            }

        });

        // Calculate
        $(document).off('keyup change', '.qty,.rate,#gst_percent')
            .on('keyup change', '.qty,.rate,#gst_percent', function() {

                calculateTotal();

            });

        calculateTotal();

    }

    function calculateTotal() {

        if ($('#tbody').length === 0) {
            return; // anchor table not loaded — don't touch totals
        }

        let subtotal = 0;

        $('#tbody tr').each(function() {

            let qty = parseFloat($(this).find('.qty').val()) || 0;
            let rate = parseFloat($(this).find('.rate').val()) || 0;
            let amount = qty * rate;

            $(this).find('.amount').val(amount.toFixed(2));
            subtotal += amount;

        });

        $('#subtotal').val(subtotal.toFixed(2));

        let gst = parseFloat($('[name="gst_percent"]').val()) || 0;
        let gstAmount = subtotal * gst / 100;

        $('#gst_amount').val(gstAmount.toFixed(2));
        $('#grand_total').val((subtotal + gstAmount).toFixed(2));

    }

    $(document).ready(function() {

        bindAnchorEvents();

        $('#template').change(function() {

            let template = $(this).val();

            $('#itemTable').load("{{ url('purchase/template') }}/" + template, function() {


                $.getScript('/js/' + template + '.js');
                bindAnchorEvents();

            });

        });

    });


    $(document).ready(function() {

        $('#company').on('change', function() {

            if ($(this).val() == 'Arasuvel Roofings') {

                $('#po_no_div').removeClass('d-none').show();

            } else {

                $('#po_no_div').hide();

            }

        });

        $('#company').trigger('change');

    });

</script>
@endpush
<script>

</script>
@endsection
