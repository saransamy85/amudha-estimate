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
            <form action="{{ route('estimates.store') }}" method="POST">
                @csrf

                <h4>Customer Details</h4>

                <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required>

                <input type="text" name="address_line1" class="form-control mt-2" placeholder="Address Line 1" required>

                <input type="text" name="address_line2" class="form-control mt-2" placeholder="Address Line 2">

                <input type="text" name="mobile" class="form-control mt-2" placeholder="Mobile No" required>

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

                <input type="number" name="gst_percent" value="18" class="form-control w-25" placeholder="GST %">


                <hr>

                <button type="submit" class="btn btn-primary">Generate Estimate</button>
            </form>

            <script>
            function addRow() {
                let row = `
    <tr>
      <td><input name="location[]" class="form-control"></td>
      <td><input name="area[]" class="form-control"></td>
      <td><input name="rate[]" class="form-control rate"></td>
      <td><input name="value[]" class="form-control value"></td>
    </tr>`;
                document.getElementById('items').insertAdjacentHTML('beforeend', row);
            }
            </script>
            <script>
            function calculateRow(row) {
                let area = parseFloat(row.querySelector('.area').value) || 0;
                let rate = parseFloat(row.querySelector('.rate').value) || 0;
                let value = area * rate;
                row.querySelector('.value').value = value.toFixed(2);
                calculateGrandTotal();
            }

            function calculateGrandTotal() {
                let total = 0;
                document.querySelectorAll('.value').forEach(input => {
                    total += parseFloat(input.value) || 0;
                });
            }

            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('area') || e.target.classList.contains('rate')) {
                    calculateRow(e.target.closest('tr'));
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
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>
        </div>
    </div>
</body>

</html>