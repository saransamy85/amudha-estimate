
@extends('layouts.adminbase')

@section('title','Dashboard')

@section('content')

<div class="container">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Add Lead Activity</h4>
        </div>

        <div class="card-body">

            <form action="{{route('activitystore')}}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Lead</label>

                    <select name="lead_id" class="form-control" required>

                        <option value="">Select Lead</option>

                        @foreach($leads as $lead)

                            <option value="{{ $lead->id }}">
                                {{ $lead->id }} - {{ $lead->Name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Activity Type</label>

                    <select name="activity_type" class="form-control" required>

                        <option value="">Select Activity</option>

                        <option value="Lead Created">Lead Created</option>

                        <option value="Feedback Added">Feedback Added</option>

                        <option value="Site Visit">Site Visit</option>

                        <option value="Estimate Shared">Estimate Shared</option>

                        <option value="Confirmed">Confirmed</option>

                        <option value="Customer Created">Customer Created</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter activity details"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Activity
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
