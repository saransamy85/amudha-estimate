<aside class="sidebar">
    <div class="sidebar-brand">
        Amudha Decors
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('dashboard1') }}" class="active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{route('adminlead')}}">
            <i class="bi bi-file-earmark-text"></i> Leads
        </a>

        <a href="#">
            <i class="bi bi-box-seam"></i> Inventory
        </a>

        <a href="{{route('admincustomer')}}">
            <i class="bi bi-people"></i> Customers
        </a>

        <a href="#">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="{{route('logout')}}">
            <i class="bi bi-gear"></i> Log Out
        </a>
    </nav>
</aside>
