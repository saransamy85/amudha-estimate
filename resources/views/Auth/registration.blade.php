<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amudha Decors | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>

<div class="card login-card p-4">
    <div class="text-center mb-4">
        <h3 class="brand">Amudha Decors</h3>
        <p class="text-muted">Create Account</p>
    </div>

    <form method="POST" action="{{route('reg1')}}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="Role" class="form-control">
                <option value="Sales">Sales</option>
                <option value="Purchase">Purchase</option>
                <option value="Receptionist">Receptionist</option>
            </select>
        </div>

        <button type="submit" class="btn btn-danger w-100">
            Register
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>

    <div class="text-center mt-2 text-muted">
        © {{ date('Y') }} Amudha Decors
    </div>
</div>

</body>
</html>
