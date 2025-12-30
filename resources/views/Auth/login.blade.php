<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amudha Decors | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>

<div class="card login-card p-4">
    <div class="text-center mb-4">
        <!-- Logo optional -->
        <img src="{{ asset('images/Logo-removebg-preview.png') }}" width="80">

        <h3 class="brand">Amudha Decors</h3>
        <p class="text-muted">Estimate Management System</p>
    </div>

    <form method="POST" action="{{route('logins')}}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-danger w-100">
            Login
        </button>
    </form>
    <br>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="text-center mt-3 text-muted">
        © {{ date('Y') }} Amudha Decors
    </div>
</div>

</body>
</html>
