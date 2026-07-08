<aside class="sidebar">
    <div class="sidebar-brand">
        Amudha Decors &nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>


    <nav class="sidebar-menu">
        <a href="{{ route('purchase.index') }}" class="active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('poview') }}">
            <i class="bi bi-file-earmark-text"></i> PO
        </a><span class="badge text-bg-secondary">4</span>

        <a href="{{ route('adminreport') }}">
            <i class="bi bi-box-seam"></i> Reports
        </a>

        <a href="{{ route('admincustomer') }}">
            <i class="bi bi-people"></i> Customers
        </a>

        <a href="#">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="{{ route('logout') }}">
            <i class="bi bi-gear"></i> Log Out
        </a>
    </nav>
</aside>
