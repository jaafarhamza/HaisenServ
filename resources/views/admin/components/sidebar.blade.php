<div class="fixed inset-y-0 left-0 w-16 bg-bgSecondary border-r border-secondary flex flex-col items-center py-6 z-10">
    <div class="flex flex-col items-center space-y-4">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-icon text-xl mt-0 bg-buttonPrimary text-white mb-8">
            <i class="fas fa-bolt"></i>
        </a>

        <!-- Dashboard Icon -->
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-icon {{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}">
            <i class="fas fa-chart-pie"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Dashboard</span>
        </a>

        <!-- Roles Icon -->
        <a href="{{ route('admin.roles.index') }}"
            class="sidebar-icon {{ request()->routeIs('admin.roles.*') ? 'active-link' : '' }}">
            <i class="fas fa-user-shield"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Roles</span>
        </a>

        <!-- Permissions Icon -->
        <a href="{{ route('admin.permissions.index') }}"
            class="sidebar-icon {{ request()->routeIs('admin.permissions.*') ? 'active-link' : '' }}">
            <i class="fas fa-key"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Permissions</span>
        </a>

        <!-- Users Icon -->
        <a href="{{ route('admin.users.index') }}"
            class="sidebar-icon {{ request()->routeIs('admin.users.*') ? 'active-link' : '' }}">
            <i class="fas fa-users"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Users</span>
        </a>

        <!-- Category icon -->
        <a href="{{ route('admin.categories.index') }}"
            class="sidebar-icon {{ request()->routeIs('admin.categories.*') ? 'active-link' : '' }}">
            <i class="fas fa-folder"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Categories</span>
        </a>

        <!-- Services Icon -->
        <a href="#" class="sidebar-icon {{ request()->routeIs('admin.services.*') ? 'active-link' : '' }}">
            <i class="fas fa-concierge-bell"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Services</span>
        </a>

        <!-- Bookings Icon -->
        <a href="#" class="sidebar-icon {{ request()->routeIs('admin.bookings.*') ? 'active-link' : '' }}">
            <i class="fas fa-calendar-check"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Bookings</span>
        </a>

        <!-- Reports Icon -->
        <a href="#" class="sidebar-icon {{ request()->routeIs('admin.reports.*') ? 'active-link' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Reports</span>
        </a>
    </div>

    <!-- Bottom Section -->
    <div class="mt-auto">
        <a href="#" class="sidebar-icon {{ request()->routeIs('admin.settings') ? 'active-link' : '' }}">
            <i class="fas fa-cog"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Settings</span>
        </a>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="sidebar-icon text-red-500">
            <i class="fas fa-sign-out-alt"></i>
            <span class="sidebar-tooltip group-hover:scale-100">Logout</span>
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
