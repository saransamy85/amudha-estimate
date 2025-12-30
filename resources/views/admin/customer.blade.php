@extends('layouts.adminbase')

@section('title','Dashboard')

@section('content')
<div class="row mt-4 g-3">
    <div class="col-lg-6">
        <div class="card md-4 p-3">
            <form method="Post" action="{{route('addcustomers')}}">
                @csrf
                <div class="mb-3">
                    <label for="customer name" >Customer Name</label>
                    <input type="text" class="form-control" name="cusname" required>
                </div>
                <div class="mb-3">
                    <label for="Mobile" >Mobile</label>
                    <input type="tel" class="form-control" name="cusmob" required>
                </div>
                <div class="mb-3">
                    <label for="Location" >Location</label>
                    <input type="text" class="form-control" name="cuslocation" required>
                </div>
                <div class="mb-3">
                    <label for="Area" >Total Area</label>
                    <input type="text" class="form-control" name="cusarea" required>
                </div>
                <div class="mb-3">
                    <label for="product" >Product</label>
                    <input type="text" class="form-control" name="cusproduct" required>
                </div>
                <div class="mb-3">
                    <label for="values" >Values</label>
                    <input type="text" class="form-control" name="cusvalue" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Create">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th>Location</th>
                        <th>Area</th>
                        <th>Product</th>
                        <th>Values</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cli as $cl)
                    <tr>
                        <td>
                            {{$cl->client_name}}
                        </td>
                        <td>
                            {{$cl->Mobile}}
                        </td>
                        <td>
                            {{$cl->Location}}
                        </td>
                        <td>
                            {{$cl->Area}} Sq.ft
                        </td>
                        <td>
                            {{$cl->Product}}
                        </td>
                        <td>
                            {{$cl->Total_values}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

