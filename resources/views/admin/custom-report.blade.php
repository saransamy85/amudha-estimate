@extends('layouts.adminbase')

@section('content')
    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4>Generate Business Report</h4>

            </div>

            <div class="card-body">

                <form action="{{ route('customreport.pdf') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-5">

                            <label>From Date</label>

                            <input type="date" name="from_date" class="form-control" required>

                        </div>

                        <div class="col-md-5">

                            <label>To Date</label>

                            <input type="date" name="to_date" class="form-control" required>

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button class="btn btn-danger w-100">

                                <i class="bi bi-file-earmark-pdf"></i>

                                Generate

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
