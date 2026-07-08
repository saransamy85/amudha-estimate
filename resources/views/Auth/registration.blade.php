<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Amudha CRM | Create Account</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Auth CSS -->

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body>

    <div class="auth-wrapper">

        <div class="container-fluid">

            <div class="row min-vh-100">

                <!-- LEFT SIDE -->

                <div class="col-lg-6 d-none d-lg-flex illustration-section">

                    <div class="illustration-content">

                        <img src="{{ asset('images/Logo-removebg-preview.png') }}" class="logo mb-4">

                        <span class="badge bg-primary mb-3">

                            AMUDHA CRM

                        </span>

                        <h1>

                            Build Better.
                            <br>
                            Manage Smarter.

                        </h1>

                        <p>

                            A complete CRM solution for
                            Leads,
                            Estimates,
                            Customers,
                            Material Dispatch,
                            Material Return,
                            Purchase Orders
                            and Reports.

                        </p>

                        <div class="feature-list">

                            <div class="feature-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Lead Management

                            </div>

                            <div class="feature-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Estimate Generation

                            </div>

                            <div class="feature-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Material Dispatch

                            </div>

                            <div class="feature-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Inventory Tracking

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE -->

                <div class="col-lg-6 auth-panel">

                    <div class="auth-card">

                        <div class="text-center mb-4">

                            <h2>

                                Create Account

                            </h2>

                            <p class="text-muted">

                                Register a new CRM user

                            </p>

                        </div>

                        <form method="POST" action="{{ route('reg1') }}">

                            @csrf

                            <!-- NAME -->

                            <div class="mb-3">

                                <label>

                                    Full Name

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-person"></i>

                                    </span>

                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Full Name" required>

                                </div>

                                @error('name')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <!-- EMAIL -->

                            <div class="mb-3">

                                <label>

                                    Email Address

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-envelope"></i>

                                    </span>

                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter Email">

                                </div>

                                @error('email')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <!-- PASSWORD -->

                            <div class="mb-3">

                                <label>

                                    Password

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-lock"></i>

                                    </span>

                                    <input id="password" type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter Password">

                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">

                                        <i class="bi bi-eye"></i>

                                    </button>

                                </div>

                                @error('password')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <!-- CONFIRM PASSWORD -->

                            <div class="mb-3">

                                <label>

                                    Confirm Password

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-shield-lock"></i>

                                    </span>

                                    <input id="confirmPassword" type="password" name="password_confirmation"
                                        class="form-control" placeholder="Confirm Password">

                                </div>

                            </div>

                            <!-- ROLE -->

                            <div class="mb-4">

                                <label class="mb-3">

                                    Select Role

                                </label>

                                <div class="row g-3">

                                    <div class="col-4">

                                        <input type="radio" class="btn-check" name="Role" id="sales"
                                            value="Sales" checked>

                                        <label class="role-card" for="sales">

                                            <i class="bi bi-briefcase"></i>

                                            <span>

                                                Sales

                                            </span>

                                        </label>

                                    </div>

                                    <div class="col-4">

                                        <input type="radio" class="btn-check" name="Role" id="reception"
                                            value="Receptionist">

                                        <label class="role-card" for="reception">

                                            <i class="bi bi-headset"></i>

                                            <span>

                                                Reception

                                            </span>

                                        </label>

                                    </div>

                                    <div class="col-4">

                                        <input type="radio" class="btn-check" name="Role" id="purchase"
                                            value="Purchase">

                                        <label class="role-card" for="purchase">

                                            <i class="bi bi-cart3"></i>

                                            <span>

                                                Purchase

                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                            <!-- BUTTON -->

                            <button class="btn btn-primary btn-register w-100">

                                <i class="bi bi-person-plus-fill"></i>

                                Create Account

                            </button>

                        </form>

                        <div class="text-center mt-4">

                            Already have an account?

                            <a href="{{ route('login') }}">

                                Login

                            </a>

                        </div>

                        <div class="copyright">

                            © {{ date('Y') }} Amudha Decors

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="{{ asset('js/auth.js') }}"></script>

</body>

</html>
