<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>
        Estimate create
    </title>
</head>

<body>

    <div class="p-3">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                </div>
            @endif
            <form action="{{ route('estimates.store') }}" method="POST">
                @csrf

                <h4>Customer Details</h4>

                <input type="checkbox" name="re_estimate" value="1"><label for="Re-estimate">Re-estimate</label>
                <br>

                <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required>

                <input type="text" name="address_line1" class="form-control mt-2" placeholder="Address Line 1"
                    required>

                <input type="text" name="address_line2" class="form-control mt-2" placeholder="Address Line 2">

                <input type="text" name="mobile" class="form-control mt-2" placeholder="Mobile No" required
                    onpaste="return false;" id="mobile">

                <hr>

                <h4>Description</h4>
                <textarea name="description" class="form-control" rows="4" required>
                        Supply and fixing of HI TENSILE CSC BRAND TENSILE 750GSM...
                </textarea>

                <hr>

                <h4>Estimate Items</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Area</th>
                            <th>Rate </th>
                            <th>Value (Rs)</th>
                        </tr>
                    </thead>

                    <tbody id="items">
                        <tr>
                            <td><input name="location[]" class="form-control" required></td>
                            <td><input name="area[]" class="form-control" required></td>
                            <td><input name="rate[]" class="form-control rate" required></td>
                            <td><input name="value[]" class="form-control value" readonly></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" onclick="addRow()" class="btn btn-sm btn-secondary">+ Add Row</button>

                <hr>

                <h4>Calculation</h4>

                <div class="row">

                    <div class="col-md-3">
                        <label>GST %</label>
                        <input type="number" name="gst_percent" value="18" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Transportation Charges</label>
                        <input type="number" name="transport_charges" id="transport_charges" value="0"
                            class="form-control">
                    </div>

                </div>
                <div class="alert alert-info mt-3">
                    <h6>Subtotal : ₹ <span id="subtotal">0.00</span></h6>
                    <h6>GST Amount : ₹ <span id="gstamount">0.00</span></h6>
                    <h5>Grand Total : ₹ <span id="grandtotal">0.00</span></h5>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Generate Estimate</button>
            </form>

            <script>
                function calculateRow(row) {

                    let area = parseFloat(row.querySelector('.area').value) || 0;
                    let rate = parseFloat(row.querySelector('.rate').value) || 0;

                    let value = area * rate;

                    row.querySelector('.value').value = value.toFixed(2);

                    calculateGrandTotal();
                }

                function calculateGrandTotal() {

                    let subtotal = 0;

                    document.querySelectorAll('.value').forEach(input => {
                        subtotal += parseFloat(input.value) || 0;
                    });

                    let gstPercent =
                        parseFloat(document.querySelector('[name="gst_percent"]').value) || 0;

                    let transportCharges =
                        parseFloat(document.getElementById('transport_charges').value) || 0;

                    let taxableAmount = subtotal + transportCharges;

                    let gstAmount =
                        taxableAmount * gstPercent / 100;

                    let grandTotal =
                        taxableAmount + gstAmount;

                    document.getElementById('subtotal').innerText =
                        subtotal.toFixed(2);

                    document.getElementById('gstamount').innerText =
                        gstAmount.toFixed(2);

                    document.getElementById('grandtotal').innerText =
                        grandTotal.toFixed(2);
                }

                document.addEventListener('input', function(e) {

                    if (
                        e.target.classList.contains('area') ||
                        e.target.classList.contains('rate')
                    ) {
                        calculateRow(e.target.closest('tr'));
                    }

                    if (
                        e.target.name == 'gst_percent' ||
                        e.target.id == 'transport_charges'
                    ) {
                        calculateGrandTotal();
                    }

                });

                function addRow() {

                    document.getElementById('items').insertAdjacentHTML('beforeend', `
        <tr>
            <td><input name="location[]" class="form-control"></td>
            <td><input name="area[]" class="form-control area"></td>
            <td><input name="rate[]" class="form-control rate"></td>
            <td><input name="value[]" class="form-control value" readonly></td>
        </tr>
    `);
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>
        </div>
    </div>
</body>

</html>
