<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Estimate Management | Amudha Decors</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background-color:#f8f9fa;
        }
        .navbar-brand{
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('estimates.index') }}">
            AMUDHA DECORS   {{session('username')}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navBar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estimates.index') }}">
                        Estimates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estimates.create') }}">
                        Create Estimate
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- MAIN CONTENT --}}
<main class="py-4">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-dark text-light text-center py-2 mt-4">
    <small>
        © {{ date('Y') }} Amudha Decors | Estimate System
    </small>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
