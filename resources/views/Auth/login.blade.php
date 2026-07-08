<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Amudha CRM | Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

    <div class="login-wrapper">

        <div class="container-fluid h-100">

            <div class="row h-100">

                <!-- LEFT PANEL -->

                <div class="col-lg-4 login-panel">

                    <div class="login-box">

                        <!-- Logo -->

                        <div class="text-center mb-4">

                            <img src="{{ asset('images/Logo-removebg-preview.png') }}" class="company-logo">

                            <h2 class="company-name">

                                AMUDHA DECORS

                            </h2>

                            <p class="company-subtitle">

                                CRM & Estimate Management System

                            </p>

                        </div>

                        <!-- Heading -->



                        <!-- Login Form -->

                        <form method="POST" action="{{ route('logins') }}">

                            @csrf

                            <!-- Email -->

                            <div class="form-group mb-3">

                                <label>

                                    Email Address

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-envelope-fill"></i>

                                    </span>

                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter Email" required>

                                </div>

                                @error('email')
                                    <div class="text-danger small mt-1">

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>

                            <!-- Password -->

                            <div class="form-group mb-3">

                                <label>

                                    Password

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-lock-fill"></i>

                                    </span>

                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Enter Password" required>

                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">

                                        <i class="bi bi-eye"></i>

                                    </button>

                                </div>

                            </div>

                            <!-- Remember -->

                            <div class="d-flex justify-content-between mb-4">

                                <div>

                                    <input class="form-check-input" type="checkbox">

                                    Remember Me

                                </div>

                                <a href="#">

                                    Forgot Password?

                                </a>

                            </div>

                            <!-- Button -->

                            <button type="submit" class="btn btn-login">

                                <i class="bi bi-box-arrow-in-right"></i>

                                Login

                            </button>

                        </form>

                        <!-- Alert -->

                        @if (session('error'))
                            <div class="alert alert-danger mt-4">

                                {{ session('error') }}

                            </div>
                        @endif

                        <!-- Footer -->

                        <div class="footer-text">

                            © {{ date('Y') }}

                            Amudha Decors

                            <br>

                            All Rights Reserved.

                        </div>

                    </div>

                </div>

                <!-- RIGHT PANEL -->

                <div class="col-lg-8 info-panel">

                    <div class="overlay">

                        <div class="hero-content">

                            <span class="badge bg-danger mb-3">

                                AMUDHA CRM

                            </span>

                            <h1>

                                BUILD ON STEEL

                            </h1>

                            <h3>

                                Driven By Quality

                            </h3>

                            <p>

                                Smart CRM Solution for Roofing,
                                PEB Structures, ACP,
                                Toughened Glass,
                                Material Dispatch,
                                Purchase &
                                Project Management.

                            </p>

                        </div>

                        <!-- Floating Cards -->

                        <div class="floating-card card-one">

                            <i class="bi bi-graph-up-arrow"></i>

                            <h5>

                                Lead Management

                            </h5>

                        </div>

                        <div class="floating-card card-two">

                            <i class="bi bi-truck"></i>

                            <h5>

                                Material Dispatch

                            </h5>

                        </div>

                        <div class="floating-card card-three">

                            <i class="bi bi-box-seam"></i>

                            <h5>

                                Inventory Tracking

                            </h5>

                        </div>

                        <div class="floating-card card-four">

                            <i class="bi bi-building"></i>

                            <h5>

                                Project Monitoring

                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Custom JS -->

    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
