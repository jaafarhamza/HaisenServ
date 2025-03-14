<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Dashboard')</title>
    
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="./../css/app.css" rel="stylesheet">
    
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-900 text-gray-100" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile sidebar toggle -->
        <div class="md:hidden fixed top-0 left-0 z-40 p-4">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-300 hover:text-white">
                <i x-show="sidebarOpen" class="fas fa-times text-xl"></i>
                <i x-show="!sidebarOpen" class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div x-cloak :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" 
             class="md:translate-x-0 fixed md:relative z-30 transition-transform duration-300 w-64 min-h-screen bg-gray-800 border-r border-gray-700 overflow-y-auto">
            <div class="p-5 border-b border-gray-700">
                <h1 class="text-xl font-bold text-white">Admin Panel</h1>
            </div>

            <nav class="p-4" x-data="{ 
                activeSection: '{{ request()->segment(2) ?? 'dashboard' }}',
                expanded: {
                    users: {{ request()->is('admin/users*') ? 'true' : 'false' }},
                    services: {{ request()->is('admin/services*') ? 'true' : 'false' }},
                    categories: {{ request()->is('admin/categories*') ? 'true' : 'false' }},
                    components: {{ request()->is('admin/components*') ? 'true' : 'false' }},
                    partials: {{ request()->is('admin/partials*') ? 'true' : 'false' }}
                }
            }">
                <ul>
                    <!-- Dashboard -->
                    <li class="mb-2">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center w-full p-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-chart-bar mr-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="mb-2">
                        <button @click="expanded.users = !expanded.users" 
                                class="flex items-center justify-between w-full p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>Users</span>
                            </div>
                            <i :class="expanded.users ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas"></i>
                        </button>
                        <ul x-show="expanded.users" x-collapse class="ml-6 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.users.index') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.users.index') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    User List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.show', ['user' => 1]) }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.users.show') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    User Details
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.edit', ['user' => 1]) }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.users.edit') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Edit User
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Services -->
                    <li class="mb-2">
                        <button @click="expanded.services = !expanded.services" 
                                class="flex items-center justify-between w-full p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                            <div class="flex items-center">
                                <i class="fas fa-briefcase mr-2"></i>
                                <span>Services</span>
                            </div>
                            <i :class="expanded.services ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas"></i>
                        </button>
                        <ul x-show="expanded.services" x-collapse class="ml-6 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.services.index') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.services.index') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Services List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.services.show', ['service' => 1]) }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.services.show') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Service Details
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.services.edit', ['service' => 1]) }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.services.edit') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Edit Service
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Categories -->
                    <li class="mb-2">
                        <button @click="expanded.categories = !expanded.categories" 
                                class="flex items-center justify-between w-full p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2"></i>
                                <span>Categories</span>
                            </div>
                            <i :class="expanded.categories ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas"></i>
                        </button>
                        <ul x-show="expanded.categories" x-collapse class="ml-6 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.categories.index') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.categories.index') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Categories List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.edit', ['category' => 1]) }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.categories.edit') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Edit Category
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Transactions -->
                    <li class="mb-2">
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="flex items-center w-full p-2 rounded-md {{ request()->routeIs('admin.transactions.index') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-dollar-sign mr-2"></i>
                            <span>Transactions</span>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="mb-2">
                        <a href="{{ route('admin.settings.index') }}" 
                           class="flex items-center w-full p-2 rounded-md {{ request()->routeIs('admin.settings.index') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-cog mr-2"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    <!-- Components -->
                    <li class="mb-2">
                        <button @click="expanded.components = !expanded.components" 
                                class="flex items-center justify-between w-full p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                <span>Components</span>
                            </div>
                            <i :class="expanded.components ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas"></i>
                        </button>
                        <ul x-show="expanded.components" x-collapse class="ml-6 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.components.verification-panel') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.components.verification-panel') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Verification Panel
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.components.user-status-manager') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.components.user-status-manager') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    User Status Manager
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Partials -->
                    <li class="mb-2">
                        <button @click="expanded.partials = !expanded.partials" 
                                class="flex items-center justify-between w-full p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                            <div class="flex items-center">
                                <i class="fas fa-chart-line mr-2"></i>
                                <span>Partials</span>
                            </div>
                            <i :class="expanded.partials ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas"></i>
                        </button>
                        <ul x-show="expanded.partials" x-collapse class="ml-6 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.partials.analytics') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.partials.analytics') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Analytics
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.partials.pending-services') }}" 
                                   class="block w-full p-2 rounded-md {{ request()->routeIs('admin.partials.pending-services') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                                    Pending Services
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 overflow-auto bg-gray-900">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-100 mb-6">@yield('header', 'Dashboard')</h1>
                <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Include Alpine.js -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>
    
    @stack('scripts')
</body>
</html>