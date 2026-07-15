<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="text-primary">Amudha</span> <span class="text-warning"> Decors</span> &nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>


    <nav class="sidebar-menu">

        <a href="{{ route('dashboard1') }}" class="active">
            <i class="bi bi-grid-1x2-fill display-6"></i>
            <span class="menu-text">Dashboard</span>
            <span class="badge text-bg-danger">{{ $escount }}</span>
        </a>

        <a href="{{ route('adminlead') }}">
            <i class="bi bi-person-lines-fill display-6"></i>
            <span class="menu-text">Leads</span>
            <span class="badge text-bg-danger">{{ $lc }}</span>
        </a>

        <a href="{{ route('adminreport') }}">
            <i class="bi bi-bar-chart-line-fill display-6"></i>
            <span class="menu-text">Reports</span>
        </a>

        <a href="{{ route('admincustomer') }}">
            <i class="bi bi-people-fill display-6"></i>
            <span class="menu-text">Customers</span>
            <span class="badge text-bg-danger">{{ $cuscount }}</span>
        </a>

        <a href="{{ route('admin.po_orders') }}">
            <i class="bi bi-truck display-6"></i>
            <span class="menu-text">Purchase Orders</span>
        </a>

        <a href="#">
            <i class="bi bi-sliders  display-6"></i>
            <span class="menu-text">Settings</span>
        </a>

        <a href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right display-6"></i>
            <span class="menu-text">Logout</span>
        </a>

    </nav>

    <div class="active-users px-3 pb-3">
        <hr>

        <h6 class="text-muted">
            <i class="bi bi-circle-fill text-success"></i>
            Active Users
            <span class="badge bg-success">
                {{ count($onlineUsers) }}
            </span>
        </h6>

        @forelse($onlineUsers as $user)
            <div class="d-flex align-items-center mb-2">
                <span class="bg-success rounded-circle me-2" style="width:8px;height:8px;">
                </span>

                <small>{{ $user->name }}</small>
            </div>
        @empty
            <small class="text-muted">No active users</small>
        @endforelse
    </div>
</aside>
