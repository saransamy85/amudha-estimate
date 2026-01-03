@extends('layouts.adminbase')

@section('title','Dashboard')

@section('content')
<div class="row md-4 g-3">
    <div class="col-md-4">
        <h4>Active users</h4>
        <ul>
            @foreach($onl as $online)
            <li>{{$online->name}}</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row mt-4 g-3">
    <div class="col-md-4">
        <div class="card p-3">
            <h4 class="text-uppercase">estimates</h4>
            {{$escount}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4 class="text-uppercase">Leads</h4>
            {{$lc}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4 class="text-uppercase">Customers</h4>
            {{$cuscount}}
        </div>
    </div>
</div>
<br>

<div class="container-fluid">
    <div class="row mt-4 g-3">
        <div class="col-md-4">
            <div class="card md-4 p-3">
                <form method="POST" action="{{route('addlead')}}">
                    @csrf

                    <!-- Source -->
                    <div class="mb-3">
                        <label>Source</label>
                        <select name="source" class="form-control">
                            <option value="Website">Website</option>
                            <option value="Google Ads">Showroom-Walk-in</option>
                            <option value="Phone Call">Phone Call</option>
                            <option value="WhatsApp">Email or WhatsApp</option>
                            <option value="Reference">Reference</option>
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="Name" class="form-control" required>
                    </div>

                    <!-- Mobile -->
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="Mobile" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <!-- Product -->
                    <div class="mb-3">
                        <label>Product</label>
                        <input type="text" name="Product" class="form-control" required>
                    </div>

                    <!-- Total Area -->
                    <div class="mb-3">
                        <label>Total Area</label>
                        <input type="text" name="Total_Area" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="Description" class="form-control"></textarea>
                    </div>

                    <!-- Site Location -->
                    <div class="mb-3">
                        <label>Site Location</label>
                        <input type="text" name="Site_location" class="form-control" required>
                    </div>

                    <!-- Source -->
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="Status" class="form-control">
                            <option value="Details shared">Details shared</option>
                            <option value="Follow up">Follow up</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Quote Shared">Quote Shared</option>
                            <option value="RNR">RNR</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Save Lead</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card md-4 p-3">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Source</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Product</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lds as $leds)
                        <tr>
                            <td>{{$leds->created_at->format('d M Y')}}</td>
                            <td>{{$leds->source}}</td>
                            <td>{{$leds->Name}}</td>
                            <td>{{$leds->Mobile}}</td>
                            <td>{{$leds->Product}}</td>
                            <td>{{$leds->Total_Area}}Sq.ft</td>
                            <td>{{$leds->Site_location}}</td>
                            <td>{{$leds->Status}}</td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                    Feedback
                                </button>
                                <div class="modal fade" id="feedbackModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form method="POST" action="{{route('addfeedback')}}">
                                                @csrf

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Feedback</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="lead_id" value="{{ $leds->id }}">

                                                    <div class="mb-3">
                                                        <label>Feedback</label>
                                                        <textarea name="feedback" class="form-control"
                                                            required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="status">
                                                            <option value="Details shared">Details
                                                                shared</option>
                                                            <option value="Follow up">Follow up</option>
                                                            <option value="Confirmed">Confirmed</option>
                                                            <option value="Quote Shared">Quote Shared</option>
                                                            <option value="RNR">RNR</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">
                                                        Save Feedback
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="container mt-4">
        <h4 class="mb-4">Lead Timeline</h4>
        @foreach($lds as $lead)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Lead Name: {{ $lead->id }} — {{ $lead->Name }}
            </div>

            <div class="card-body">
                <p class="mb-1"><b>Mobile:</b> {{ $lead->Mobile }}</p>
                <p class="mb-1"><b>Product:</b> {{ $lead->Product }}</p>
                <p class="mb-1"><b>Site:</b> {{ $lead->Site_location }}</p>
                <p class="mb-3"><b>Status:</b> {{ $lead->Status }}</p>

                <div class="timeline">

                    <!-- Lead Created -->
                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <div class="timeline-card">
                            <strong>Lead Created</strong><br>
                            <span class="timeline-date">
                                {{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Feedbacks -->
                    @foreach($lead->feedbacks as $fb)
                    <div class="timeline-item">
                        <span class="timeline-dot bg-success"></span>
                        <div class="timeline-card">
                            <strong>Feedback</strong><br>
                            <span class="timeline-date">
                                {{ $fb->created_at->format('d M Y h:i A') }}
                            </span>
                            <p class="mb-0 mt-1">{{ $fb->feedback }}</p>
                        </div>
                    </div>
                    @endforeach

                    @if($lead->feedbacks->isEmpty())
                    <p class="text-muted ms-2">No feedback available</p>
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection