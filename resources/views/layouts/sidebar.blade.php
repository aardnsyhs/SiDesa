<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-text mx-3">SiDesa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user() && Auth::user()->role->name === 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen Data
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ request()->is('resident*') ? 'active' : '' }}">
            <a class="nav-link" href="/resident">
                <i class="fas fa-fw fa-table"></i>
                <span>Penduduk</span></a>
        </li>
        <li class="nav-item {{ request()->is('account-request*') ? 'active' : '' }}">
            <a class="nav-link" href="/account-request">
                <i class="fas fa-fw fa-user"></i>
                <span>Permintaan Akun</span></a>
        </li>
        <li class="nav-item {{ request()->is('account-list*') ? 'active' : '' }}">
            <a class="nav-link" href="/account-list">
                <i class="fas fa-fw fa-user"></i>
                <span>Daftar Akun</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
