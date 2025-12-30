@extends('layouts.app')

@section('content')
<div class="container bg-white p-4">
    @include('estimates.template', [
        'estimate' => $estimate,
        'logo' => asset('logo.png')
    ])
</div>
@endsection
