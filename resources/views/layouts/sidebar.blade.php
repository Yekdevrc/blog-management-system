<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tachometer"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Blog Management System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{request()->is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{request()->is('blogs/*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('blogs.index')}}">
            <i class="fas fa-blog"></i>
            <span>Blogs</span></a>
    </li>

    <li class="nav-item {{request()->is('users/*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>

</ul>