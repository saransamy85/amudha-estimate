<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="text-primary">Amudha</span> <span class="text-warning"> Decors</span> &nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>


    <nav class="sidebar-menu">

        <a href="{{ route('receptiondashboard') }}" class="active">
            <i class="bi bi-grid-1x2-fill display-6"></i>
            <span class="menu-text">Dashboard</span>
            <span class="badge text-bg-danger"></span>
        </a>

        <a href="{{ route('materialreturn.history') }}">
            <i class="bi bi-box-arrow-in-left display-6 text-success"></i>
            <span class="menu-text">Materials-In</span>
            <span class="badge text-bg-danger"></span>
        </a>

        <a href="{{ route('receptionmaterialitems') }}">
            <i class="bi bi-box-arrow-right display-6 text-danger"></i>
            <span class="menu-text">Materials-Out</span>
        </a>

        <a href="{{ route('materialreturn') }}">
            <i class="bi bi-people-fill display-6"></i>
            <span class="menu-text">Returns</span>
            <span class="badge text-bg-danger"></span>
        </a>

        <a href="{{ route('receptionsites') }}">
            <i class="bi bi-sliders display-6"></i>
            <span class="menu-text">sites</span>
        </a>
        <a href="#">
            <i class="bi bi-tools display-6 text-secondary"></i>
            <span class="menu-text">Machines</span>
        </a>
        <a href="{{ route('reception.reports') }}">
            <i class="bi bi-tools display-6 text-secondary"></i>
            <span class="menu-text">Reports</span>
        </a>

        <a href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right display-6"></i>
            <span class="menu-text">Logout</span>
        </a>

    </nav>


</aside>
