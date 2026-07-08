@extends('layouts.purchasebase')

@section('title', 'Purchase Dashboard')

@section('content')

    <div class="container-fluid">

        <h3 class="mb-4">

            Purchase Dashboard

        </h3>

        <div class="row">

            <div class="col-md-3">

                <div class="modern-card bg-primary text-white">

                    <h6>Total Vendors</h6>

                    <h2>{{ $totalVendor }}</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="modern-card bg-success text-white">

                    <h6>Total PO</h6>

                    <h2>{{ $totalPO }}</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="modern-card bg-warning">

                    <h6>Pending PO</h6>

                    <h2>{{ $pendingPO }}</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="modern-card bg-info text-white">

                    <h6>Approved PO</h6>

                    <h2>{{ $approvedPO }}</h2>

                </div>

            </div>

        </div>

    </div>

@endsection
