@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h4>

                    Material Return Details

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <b>Return No :</b>

                        {{ $return->return_no }}

                    </div>

                    <div class="col-md-6">

                        <b>Date :</b>

                        {{ date('d-m-Y', strtotime($return->return_date)) }}

                    </div>

                    <div class="col-md-6">

                        <b>Site :</b>

                        {{ $return->customer->client_name }}

                    </div>

                    <div class="col-md-6">

                        <b>Returned By :</b>

                        {{ $return->person_name }}

                    </div>

                </div>

                <hr>

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>

                            <th>Item</th>

                            <th>Description</th>

                            <th>Returned Qty</th>

                            <th>Unit</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($return->items as $item)
                            <tr>

                                <td>

                                    {{ $item->dispatchItem->item }}

                                </td>

                                <td>

                                    {{ $item->dispatchItem->description }}

                                </td>

                                <td>

                                    {{ $item->return_quantity }}

                                </td>

                                <td>

                                    {{ $item->dispatchItem->unit }}

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
