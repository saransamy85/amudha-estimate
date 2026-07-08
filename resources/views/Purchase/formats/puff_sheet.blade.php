 <div class="row g-2">
     <div class="col-lg-12">

         <form method="POST" action="#">
             @csrf


             <div class="table table-resposive">
                 <table class="table  table-bordered">
                     <thead>
                         <tr>
                             <th>Description</th>
                             <th>Width (m)</th>
                             <th>Length (m)</th>
                             <th>Nos</th>
                             <th>SQM</th>
                             <th>Rate / Sqm</th>
                             <th>Amount</th>
                             <th>Action</th>
                         </tr>
                     </thead>

                     <tbody id="poItems">

                         <tr class="po-row">
                             <td>
                                 <input name="description[]" class="form-control">
                                 <input type="hidden" name="thickness[]">
                             </td>
                             <td><input name="width[]" class="form-control calc"></td>
                             <td><input name="length[]" class="form-control calc"></td>
                             <td><input name="nos[]" class="form-control calc"></td>
                             <td><input name="sqm[]" class="form-control sqm" readonly></td>
                             <td><input name="rate[]" class="form-control calc"></td>
                             <td><input name="amount[]" class="form-control amount" readonly></td>
                             <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-danger removeRow">X</button>
                                    <button type="button" id="addRow" class="btn btn-success mb-2">+</button>
                                </div>

                             </td>

                         </tr>

                     </tbody>

                     <tfoot>
                         <tr>
                             <th colspan="4" class="text-end">Total SQM</th>
                             <th><input id="totalSqm" class="form-control" readonly></th>
                             <th>Total</th>
                             <th><input id="subTotal" class="form-control" readonly></th>
                         </tr>
                         <tr>
                             <th colspan="6" class="text-end">GST 18%</th>
                             <th><input id="gstAmount" class="form-control" readonly></th>
                         </tr>
                         <tr>
                             <th colspan="6" class="text-end">Grand Total</th>
                             <th><input id="grandTotal" class="form-control" readonly></th>
                         </tr>
                     </tfoot>
                 </table>
             </div>
             <button class="btn btn-primary">Save PO</button>
         </form>

     </div>
 </div>

 <script>
     function calculateRow(row) {
         let width = parseFloat(row.querySelector('[name="width[]"]').value) || 0;
         let length = parseFloat(row.querySelector('[name="length[]"]').value) || 0;
         let nos = parseFloat(row.querySelector('[name="nos[]"]').value) || 0;
         let rate = parseFloat(row.querySelector('[name="rate[]"]').value) || 0;

         let sqm = width * length * nos;
         let amount = sqm * rate;

         row.querySelector('.sqm').value = sqm.toFixed(3);
         row.querySelector('.amount').value = amount.toFixed(2);
     }

     function calculateTotal() {
         let totalSqm = 0;
         let subTotal = 0;

         document.querySelectorAll('#poItems tr').forEach(row => {
             totalSqm += parseFloat(row.querySelector('.sqm').value || 0);
             subTotal += parseFloat(row.querySelector('.amount').value || 0);
         });

         let gst = subTotal * 0.18;

         document.getElementById('totalSqm').value = totalSqm.toFixed(3);
         document.getElementById('subTotal').value = subTotal.toFixed(2);
         document.getElementById('gstAmount').value = gst.toFixed(2);
         document.getElementById('grandTotal').value = (subTotal + gst).toFixed(2);
     }

     /* Auto calculate */
     document.addEventListener('input', function(e) {
         if (e.target.classList.contains('calc')) {
             let row = e.target.closest('tr');
             calculateRow(row);
             calculateTotal();
         }
     });

     /* Add Row */
     document.getElementById('addRow').addEventListener('click', function() {
         let tbody = document.getElementById('poItems');
         let firstRow = tbody.querySelector('.po-row');
         let newRow = firstRow.cloneNode(true);

         newRow.querySelectorAll('input').forEach(input => {
             if (input.type !== 'hidden' && !input.hasAttribute('readonly')) {
                 input.value = '';
             }
             if (input.classList.contains('sqm') || input.classList.contains('amount')) {
                 input.value = '';
             }
         });

         tbody.appendChild(newRow);
     });

     /* Remove Row */
     document.addEventListener('click', function(e) {
         if (e.target.classList.contains('removeRow')) {
             let rows = document.querySelectorAll('#poItems tr');
             if (rows.length > 1) {
                 e.target.closest('tr').remove();
                 calculateTotal();
             }
         }
     });
 </script>
