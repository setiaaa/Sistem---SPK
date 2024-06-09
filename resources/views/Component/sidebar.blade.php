<script src="/js/app.js"></script>
<link rel="stylesheet" href="/css/style.css">

<ul class="navbar-nav sidebar primary accordion shadow" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="image mt-5">
            <img src="img/logo_percetakan_bandung.svg" width="85%" alt="">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider mt-5">

    <!-- Nav Item - Dashboard -->
        <li class="nav-item rounded d-flex align-items-center {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('dashboard') ? 'background-pure' : '' }}" href="dashboard">
                {!! file_get_contents('icons/chart-2.svg') !!}
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item rounded ms-2 {{ Request::is('*order') ? 'active' : '' }}">
            <a class="nav-link" href="dashboard-order">
                {!! file_get_contents('icons/list.svg') !!}
                <span>Order</span></a>
        </li>
        <li class="nav-item rounded ms-2 {{ Request::is('*mesin') ? 'active' : '' }}">
            <a class="nav-link" href="dashboard-mesin">
                {!! file_get_contents('icons/printer.svg') !!}
                <span>Mesin</span></a>
        </li>
        <li class="nav-item rounded ms-2 {{ Request::is('*user') ? 'active' : '' }}">
            @if(auth()->user()->role == "superadmin")
            <a class="nav-link" href="dashboard-user">
                {!! file_get_contents('icons/profile-2-user.svg') !!}
                <span>User</span></a>
            @endif
        </li>
</ul>