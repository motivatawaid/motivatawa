<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="50" height="50" alt="icon">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="50" height="50" alt="icon">
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main Menu</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- sidebar admin --}}
        @can('admin')
        <li class="menu-header">Administrator</li>
        <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </a>
        </li>
        @endcan

        {{-- sidebar talent/penyelenggara --}}
        @can('talent')
        <li class="menu-header">Penyelenggara</li>
        <li class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('events.index') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Kelola Events</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('courses.index') }}">
                <i class="fas fa-graduation-cap"></i>
                <span>Kelola Courses</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('tickets.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tickets.index') }}">
                <i class="fas fa-ticket-alt"></i>
                <span>Kelola Tickets</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('registrations.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('registrations.index') }}">
                <i class="fas fa-user-graduate"></i>
                <span>Kelola Registrations</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('videos.index') }}">
                <i class="fas fa-video"></i>
                <span>Kelola Videos</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('purchases.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Kelola Purchases</span>
            </a>
        </li>
        @endcan

        {{-- sidebar user --}}
        @can('user')
        <li class="menu-header">Peserta</li>
        <li class="{{ request()->routeIs('user.events.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.events.index') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Events</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('user.courses.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.courses.index') }}">
                <i class="fas fa-graduation-cap"></i>
                <span>Courses</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('user.tickets.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.tickets.index') }}">
                <i class="fas fa-ticket-alt"></i>
                <span>Tickets</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('user.registrations.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.registrations.index') }}">
                <i class="fas fa-user-graduate"></i>
                <span>Registrations</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('user.videos.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.videos.index') }}">
                <i class="fas fa-video"></i>
                <span>Videos</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('user.purchases.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.purchases.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Purchases</span>
            </a>
        </li>
        @endcan
    </ul>
</aside>