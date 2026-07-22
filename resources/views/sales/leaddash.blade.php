<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sales-Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


</head>

<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                Amudha Decors
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('salesdashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="#" class="active">
                    <i class="bi bi-file-earmark-text"></i> Leads <span class="badge text-bg-danger">{{ $lc }}</span>
                </a>
                <a href="{{ route('salescustomer') }}">
                    <i class="bi bi-people"></i> Customers <span class="badge text-bg-danger">{{ $cuscount }}</span>
                </a>
                <a href="{{ route('salesgreetings') }}">
                    <i class="bi bi-people"></i> Greetings
                </a>

                <a href="{{ route('logout') }}">
                    <i class="bi bi-gear"></i> Log Out
                </a>
            </nav>
        </aside>


        <!-- MAIN CONTENT -->
        <div class="main-content">

            <!-- TOP NAVBAR -->
            <nav class="topbar">
                <h5 class="mb-0">@yield('title')</h5>

                <div class="topbar-right">
                    <i class="bi bi-bell"></i>
                    {{ session('username') }}
                </div>
            </nav>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mt-4">

                        @php
                        $statusData = [
                        'Cancelled' => ['icon' => 'bi-x-circle', 'color' => 'danger'],
                        'Confirmed' => ['icon' => 'bi-check-circle', 'color' => 'success'],
                        'Details shared' => ['icon' => 'bi-file-earmark-text', 'color' => 'primary'],
                        'Follow up' => ['icon' => 'bi-clock-history', 'color' => 'secondary'],
                        'Quote Shared' => ['icon' => 'bi-chat-quote', 'color' => 'warning'],
                        'RNR' => ['icon' => 'bi-arrow-repeat', 'color' => 'info'],
                        'Site Visit' => ['icon' => 'bi-geo-alt', 'color' => 'success'],
                        ];

                        $sourceData = [
                        'Old Database' => ['icon' => 'bi-database', 'color' => '#3b82f6'],
                        'Phone Call' => ['icon' => 'bi-telephone', 'color' => '#84cc16'],
                        'Reference' => ['icon' => 'bi-people', 'color' => '#9333ea'],
                        'Showroom-walk-in' => ['icon' => 'bi-shop', 'color' => '#f97316'],
                        'Website' => ['icon' => 'bi-globe', 'color' => '#2563eb'],
                        'WhatsApp' => ['icon' => 'bi-whatsapp', 'color' => '#22c55e'],
                        ];
                        @endphp

                        <!-- Lead Status -->
                        <div class="col-lg-6 mb-4">

                            <div class="dashboard-section">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="section-icon">
                                            <i class="bi bi-graph-up"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h3 class="mb-0">Lead Status</h3>
                                            <small class="text-muted">
                                                Overview of leads by current status
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @foreach ($leadSC as $status => $count)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="modern-card">
                                            <div class="icon-box text-{{ $statusData[$status]['color'] ?? 'primary' }}">

                                                <i class="bi {{ $statusData[$status]['icon'] ?? 'bi-circle' }}"></i>

                                            </div>
                                            <div class="flex-grow-1">

                                                <h6 class="text-muted mb-2">
                                                    {{ $status }}
                                                </h6>

                                                <h2 class="fw-bold mb-3">
                                                    {{ $count }}
                                                </h2>

                                                <div class="status-line bg-{{ $statusData[$status]['color'] ?? 'primary' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Lead Source -->
                        <div class="col-lg-6 mb-4">
                            <div class="dashboard-section">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="section-icon bg-light-primary">
                                        <i class="bi bi-diagram-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h3 class="mb-0">Lead Source</h3>
                                        <small class="text-muted">
                                            Overview of leads by source
                                        </small>
                                    </div>
                                </div>
                                <div class="row g-3">

                                    @foreach ($lsc as $source => $count)
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                                        <div class="source-card">

                                            <div class="source-icon" style="color:{{ $sourceData[$source]['color'] ?? '#2563eb' }}">

                                                <i class="bi {{ $sourceData[$source]['icon'] ?? 'bi-folder' }}"></i>

                                            </div>

                                            <h6 class="mt-3">
                                                {{ $source }}
                                            </h6>

                                            <h2 class="fw-bold">
                                                {{ $count }}
                                            </h2>

                                            <div class="source-line" style="background:{{ $sourceData[$source]['color'] ?? '#2563eb' }}">
                                            </div>

                                        </div>

                                    </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>
                    <br>
                    @include('admin.partials.reference',['referenceLeads' => $referenceLeads])
                    <div class="row mt-4 g-3">
                        <div class="row g-2">
                            <div class="col-4">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddLeadModal">
                                    + AddLead
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card md-4 p-3">
                                <div class="table table-responsive">
                                    <div class="mb-3">
                                        <form method="GET" action="">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <input type="text" name="search" class="form-control" placeholder="Search Name or Mobile" value="{{ request('search') }}">
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        Search
                                                    </button>
                                                </div>

                                                @if (request('search'))
                                                <div class="col-md-2">
                                                    <a href="{{ route('leaddash') }}" class="btn btn-danger">
                                                        Clear
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-dark text-center">
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
                                            @foreach ($lds as $leds)
                                            <tr class="@if (strtolower($leds->Status) == 'cancelled') table-danger
                                                    @elseif (strtolower($leds->Status) == 'confirmed') table-success @endif">
                                                <td>{{ $leds->created_at->format('d M Y') }}</td>
                                                <td>{{ $leds->source }}</td>
                                                <td>{{ $leds->Name }}</td>
                                                <td>{{ $leds->Mobile }}</td>
                                                <td>{{ $leds->Product }}</td>
                                                <td>{{ $leds->Total_Area }}Sq.ft</td>
                                                <td>{{ $leds->Site_location }}</td>
                                                <td>{{ $leds->Status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal" data-lead-id="{{ $leds->id }}" data-status="{{ $leds->Status }}">
                                                            Feedback
                                                        </button>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#timelineModal{{ $leds->id }}" data-lead-id="{{ $leds->id }}">
                                                            Timeline
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="feedbackModal" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <form method="POST" action="{{ route('addfeedback') }}">
                                                                    @csrf

                                                                    <input type="hidden" name="lead_id" id="lead_id">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add Feedback</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label>Feedback</label>
                                                                            <textarea name="feedback" class="form-control" required></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Status</label>
                                                                            <select class="form-select" name="status" id="status" required>
                                                                                <option value="" selected disabled>-- Select Status --</option>
                                                                                <option value="Details shared">Details shared</option>
                                                                                <option value="Follow up">Follow up</option>
                                                                                <option value="Confirmed">Confirmed</option>
                                                                                <option value="Quote Shared">Quote Shared</option>
                                                                                <option value="RNR">RNR</option>
                                                                                <option value="Cancelled">Cancelled</option>
                                                                                <option value="Site Visit">Schedule For Site Visit</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">Save
                                                                            Feedback</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                            Cancel
                                                                        </button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>


                                            <!--Feedback Timeline model-->
                                            <div class="modal fade" id="timelineModal{{ $leds->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Timeline</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <input type="hidden" name="lead_id" value="{{ $leds->id }}">

                                                            <div class="card mb-4">
                                                                <div class="card-header bg-primary text-white">
                                                                    Lead Name: {{ $leds->id }} :
                                                                    {{ $leds->Name }}
                                                                </div>

                                                                <div class="card-body">
                                                                    <div class="timeline">

                                                                        <!-- Lead Created -->
                                                                        <div class="timeline-item">
                                                                            <span class="timeline-dot"></span>
                                                                            <div class="timeline-card">
                                                                                <strong>Lead Created</strong><br>
                                                                                <span class="timeline-date">
                                                                                    {{ $leds->created_at->format('d M Y h:i A') }}
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Initial Enquiry -->
                                                                        @if (!empty($leds->Description))
                                                                        <div class="timeline-item">
                                                                            <span class="timeline-dot bg-info"></span>
                                                                            <div class="timeline-card">
                                                                                <strong>Initial
                                                                                    Enquiry</strong><br>
                                                                                <span class="timeline-date">
                                                                                    {{ $leds->created_at->format('d M Y h:i A') }}
                                                                                </span>

                                                                                <p class="mb-0 mt-1">
                                                                                    {{ $leds->Description }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        @endif

                                                                        <!-- Feedback History -->
                                                                        @forelse($leds->feedbacks as $fb)
                                                                        <div class="timeline-item">
                                                                            <span class="timeline-dot bg-success"></span>
                                                                            <div class="timeline-card">
                                                                                <strong>Feedback</strong><br>
                                                                                <span class="timeline-date">
                                                                                    {{ $fb->created_at->format('d M Y h:i A') }}
                                                                                </span>

                                                                                <p class="mb-0 mt-1">
                                                                                    {{ $fb->feedback }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        @empty
                                                                        <div class="timeline-item">
                                                                            <div class="timeline-card">
                                                                                <p class="text-muted mb-0">
                                                                                    No feedback available yet.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        @endforelse

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end Timeline model-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <!--AddLead Model-->
    <div class="modal fade" id="AddLeadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('addlead') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Source -->
                        <div class="mb-3">
                            <label>Source</label>
                            <select name="source" class="form-control" required>
                                <option value="" selected disabled>Choose Source</option>
                                <option value="Website">Website</option>
                                <option value="Showroom-Walk-in">Showroom-Walk-in</option>
                                <option value="Phone Call">Phone Call</option>
                                <option value="WhatsApp">Email or WhatsApp</option>
                                <option value="Reference">Reference</option>
                                <option value="Old Database">Old Database</option>
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
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="Details shared">Details shared</option>
                                <!--<option value="Follow up">Follow up</option>-->
                                <!--<option value="Confirmed">Confirmed</option>-->
                                <!--<option value="Quote Shared">Quote Shared</option>-->
                                <!--<option value="RNR">RNR</option>-->
                                <!--<option value="Cancelled">Cancelled</option>-->
                                <!--<option value="Site Visit">Schedule For Site Visit</option>-->
                            </select>
                            <label class="text-danger">* Need to change the status click feedback button</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Save Lead
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--End addlead model-->
    <script>
        document.getElementById('feedbackModal')
            .addEventListener('show.bs.modal', function(event) {

                let button = event.relatedTarget;
                let leadId = button.getAttribute('data-lead-id');

                document.getElementById('lead_id').value = leadId;
            });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
