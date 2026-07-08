@extends('layouts.purchasebase')

@section('title', 'Vendor Master')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">

            <h3>Vendor Master</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vendorModal">

                <i class="bi bi-plus-circle"></i>

                Add Vendor

            </button>

        </div>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert">

                </button>

            </div>
        @endif

        <div class="card shadow">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="vendorTable" class="table table-bordered table-hover">

                        <thead class="table-dark">

                            <tr>

                                <th>#</th>

                                <th>Company</th>

                                <th>Contact</th>

                                <th>Mobile</th>

                                <th>GST</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($vendors as $vendor)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $vendor->company_name }}</td>

                                    <td>{{ $vendor->contact_person }}</td>

                                    <td>{{ $vendor->mobile }}</td>

                                    <td>{{ $vendor->gst_no }}</td>

                                    <td>

                                        @if ($vendor->status == 'Active')
                                            <span class="badge bg-success">

                                                Active

                                            </span>
                                        @else
                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editVendor{{ $vendor->id }}">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <a href="{{ route('vendor.delete', $vendor->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete Vendor?')">

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    </td>

                                </tr>
                                <div class="modal fade" id="editVendor{{ $vendor->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <form method="POST" action="{{ route('vendor.update', $vendor->id) }}">
                                                @csrf

                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">
                                                        Edit Vendor
                                                    </h5>

                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Company Name</label>

                                                            <input type="text" name="company_name" class="form-control"
                                                                value="{{ $vendor->company_name }}" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Contact Person</label>

                                                            <input type="text" name="contact_person" class="form-control"
                                                                value="{{ $vendor->contact_person }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Mobile</label>

                                                            <input type="text" name="mobile" class="form-control"
                                                                value="{{ $vendor->mobile }}" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Email</label>

                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $vendor->email }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>GST No</label>

                                                            <input type="text" name="gst_no" class="form-control"
                                                                value="{{ $vendor->gst_no }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Status</label>

                                                            <select name="status" class="form-select">

                                                                <option value="Active"
                                                                    {{ $vendor->status == 'Active' ? 'selected' : '' }}>
                                                                    Active
                                                                </option>

                                                                <option value="Inactive"
                                                                    {{ $vendor->status == 'Inactive' ? 'selected' : '' }}>
                                                                    Inactive
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label>Address</label>

                                                            <textarea name="address" class="form-control" rows="3">{{ $vendor->address }}</textarea>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label>City</label>

                                                            <input type="text" name="city" class="form-control"
                                                                value="{{ $vendor->city }}">
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label>State</label>

                                                            <input type="text" name="state" class="form-control"
                                                                value="{{ $vendor->state }}">
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label>Pincode</label>

                                                            <input type="text" name="pincode" class="form-control"
                                                                value="{{ $vendor->pincode }}">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-check-circle"></i>
                                                        Update Vendor
                                                    </button>

                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection

<!-- Vendor Modal -->

<div class="modal fade" id="vendorModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form method="POST" action="{{ route('vendor.store') }}">

                @csrf

                <div class="modal-header bg-primary text-white">

                    <h5>

                        Add Vendor

                    </h5>

                    <button class="btn-close btn-close-white" data-bs-dismiss="modal">

                    </button>

                </div>



                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>

                                Company Name

                            </label>

                            <input type="text" class="form-control" name="company_name" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Contact Person

                            </label>

                            <input type="text" class="form-control" name="contact_person">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Mobile

                            </label>

                            <input type="text" class="form-control" name="mobile" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Email

                            </label>

                            <input type="email" class="form-control" name="email">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                GST No

                            </label>

                            <input type="text" class="form-control" name="gst_no">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Status

                            </label>

                            <select class="form-select" name="status">

                                <option value="Active">

                                    Active

                                </option>

                                <option value="Inactive">

                                    Inactive

                                </option>

                            </select>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label>

                                Address

                            </label>

                            <textarea class="form-control" rows="3" name="address"></textarea>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>

                                City

                            </label>

                            <input type="text" class="form-control" name="city">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>

                                State

                            </label>

                            <input type="text" class="form-control" name="state">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>

                                Pincode

                            </label>

                            <input type="text" class="form-control" name="pincode">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        Save Vendor

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(function() {

        $('#vendorTable').DataTable({

            responsive: true,

            pageLength: 10

        });

    });
</script>
