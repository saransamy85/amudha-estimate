 @extends('layouts.adminbase')
 @section('content')
     <div class="container-fluid">

         <div class="d-flex justify-content-between align-items-center mb-4">

             <h3>
                 Purchase Orders
             </h3>

             <a href="{{ route('purchase.create') }}" class="btn btn-primary">

                 <i class="bi bi-plus-circle"></i>

                 Create Purchase Order

             </a>

         </div>

         @if (session('success'))
             <div class="alert alert-success">

                 {{ session('success') }}

             </div>
         @endif

         <div class="card shadow">

             <div class="card-body">

                 <div class="table-responsive">

                     <table id="purchaseTable" class="table table-bordered table-hover">

                         <thead class="table-dark">

                             <tr>

                                 <th>PO No</th>

                                 <th>Company</th>

                                 <th>Vendor</th>

                                 <th>Site</th>

                                 <th>Type</th>

                                 <th>Date</th>

                                 <th>Total</th>

                                 <th>Status</th>

                                 <th>Action</th>

                             </tr>

                         </thead>

                         <tbody>

                             @foreach ($orders as $po)
                                 <tr>

                                     <td>

                                         {{ $po->po_no }}

                                     </td>

                                     <td>

                                         {{ $po->company }}

                                     </td>

                                     <td>

                                         {{ $po->vendor->company_name }}

                                     </td>

                                     <td>

                                         {{ $po->customer->client_name }}

                                     </td>
                                     <td>
                                         @php
                                             $templateLabels = [
                                                 'anchor' => 'Anchor Bolt',
                                                 'steelplate' => 'Steel Plate',
                                                 'fabrication' => 'Fabrication',
                                                 'sandwichpanel' => 'Sandwich Panel',
                                             ];
                                         @endphp
                                         <span class="badge bg-secondary">
                                             {{ $templateLabels[$po->po_template] ?? ucfirst($po->po_template) }}
                                         </span>
                                     </td>

                                     <td>

                                         {{ date('d-m-Y', strtotime($po->po_date)) }}

                                     </td>

                                     <td>

                                         ₹ {{ number_format($po->grand_total, 2) }}

                                     </td>

                                     <td>

                                         @if ($po->status == 'Pending')
                                             <span class="badge bg-warning">

                                                 Pending

                                             </span>
                                         @elseif($po->status == 'Approved')
                                             <span class="badge bg-success">

                                                 Approved

                                             </span>
                                         @else
                                             <span class="badge bg-danger">

                                                 Cancelled

                                             </span>
                                         @endif

                                     </td>

                                     <td>

                                         <a href="{{ route('purchase.view', $po->id) }}" class="btn btn-info btn-sm">

                                             <i class="bi bi-eye"></i>

                                         </a>

                                         <a href="{{ route('purchase.edit', $po->id) }}" class="btn btn-warning btn-sm">

                                             <i class="bi bi-pencil"></i>

                                         </a>
                                         <a href="{{ route('purchase.pdf', $po->id) }}" target="_blank"
                                             class="btn btn-danger btn-sm">

                                             <i class="bi bi-file-earmark-pdf"></i>

                                         </a>
                                         <form action="{{ route('purchase.delete', $po->id) }}" method="POST"
                                             style="display:inline;">

                                             @csrf
                                             @method('DELETE')

                                             <button class="btn btn-dark btn-sm"
                                                 onclick="return confirm('Delete this Purchase Order?')">

                                                 <i class="bi bi-trash"></i>

                                             </button>

                                         </form>

                                     </td>

                                 </tr>
                             @endforeach

                         </tbody>

                     </table>

                 </div>

             </div>

         </div>

     </div>
 @endsection

 @push('scripts')
     <script>
         $(document).ready(function() {

             $('#purchaseTable').DataTable({

                 responsive: true,

                 pageLength: 10

             });

         });
     </script>
 @endpush
