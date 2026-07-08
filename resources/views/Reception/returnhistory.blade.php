@extends('layouts.receptionbase')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h4>

                    Material Return History

                </h4>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Return No</th>

                            <th>Site</th>

                            <th>Date</th>

                            <th>Returned By</th>

                            <th>Total Items</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($returns as $return)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $return->return_no }}</td>

                                <td>{{ $return->customer->client_name }}</td>

                                <td>{{ date('d-m-Y', strtotime($return->return_date)) }}</td>

                                <td>{{ $return->person_name }}</td>

                                <td>

                                    {{ $return->items->count() }}

                                </td>

                                <td>

                                    <a href="{{ route('materialreturn.view', $return->id) }}" class="btn btn-info btn-sm">

                                        <i class="bi bi-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center">

                                    No Returns Found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

                {{ $returns->links() }}

            </div>

        </div>

    </div>
@endsection
