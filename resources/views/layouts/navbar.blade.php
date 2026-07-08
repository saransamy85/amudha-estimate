<nav class="topbar">
    <h5 class="mb-0">@yield('title')</h5>

    <!-- <div class="topbar-right">
        <i class="bi bi-bell"></i>
        {{session('username')}}
    </div> -->


    <div class="topbar-right d-flex align-items-center">

    <i class="bi bi-bell me-3"></i>

    <div class="dropdown">
        <a href="#"
           class="text-dark text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown"
           aria-expanded="false">

            {{ session('username') }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-person"></i> Profile
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item text-danger"
                   href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>

</div>
</nav>
