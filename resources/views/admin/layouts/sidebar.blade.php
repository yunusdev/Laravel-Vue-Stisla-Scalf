<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('admin.home')}}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        @php
            $current_url = url()->current();
            $base_url = env('APP_URL')
        @endphp
        <ul class="sidebar-menu">
            <li class="{{$base_url . '/admin/home' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('admin.home')}}"><i class="fas fa-home"></i> <span>Home</span></a></li>

            <li class="menu-header">Dashboard</li>
            <li class="{{$base_url . '/admin/admins' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('admins.index')}}"><i class="fas fa-users"></i> <span>Admins</span></a></li>
            <li class="{{$base_url . '/admin/admins/create' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('admins.create')}}"><i class="fas fa-user-plus"></i> <span>Add Admin</span></a></li>

            <li class="menu-header">Starter</li>
            <li class="{{$base_url . '/admin/users' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('users.index')}}"><i class="fas fa-user"></i> <span>Users</span></a></li>

            <li class="menu-header">AUTHORIZING</li>
            <li class="{{$base_url . '/admin/role' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('role.index')}}"><i class="fas fa-pencil-ruler"></i> <span>Roles</span></a></li>
            <li class="{{$base_url . '/admin/permission' === $current_url ? 'active' : ''}}"><a class="nav-link" href="{{route('permission.index')}}"><i class="fas fa-pencil-ruler"></i> <span>Permissions</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
