<header class="bg-bgSecondary text-textHeading px-6 py-4 flex justify-between items-center shadow-md sticky top-0 z-5">
    <div class="flex items-center">
        <h1 class="text-2xl font-bold">@yield('header-title', 'Dashboard')</h1>
        @if (auth()->user()->roles->isNotEmpty())
            <span class="ml-4 px-3 py-1 rounded-full bg-tertiary text-white text-xs">
                {{ auth()->user()->roles->first()->name }}
            </span>
        @endif
    </div>

    <div class="flex items-center space-x-4">
        <!-- Search -->
        <div class="relative">
            <form action="@yield('search-route', route('admin.dashboard'))" method="GET">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="input-field w-64">
                <button type="submit" class="absolute right-3 top-3 text-secondary hover:text-highlight">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Notifications -->
        <div class="relative">
            <button class="text-textParagraph hover:text-textHeading" onclick="showModal('notifications-modal')">
                <i class="fas fa-bell"></i>
            </button>
            @if (isset($notificationsCount) && $notificationsCount > 0)
                <span
                    class="absolute -top-2 -right-2 h-5 w-5 rounded-full bg-red-500 flex items-center justify-center text-white text-xs">
                    {{ $notificationsCount }}
                </span>
            @endif
        </div>

        <!-- User Menu -->
        <div class="relative" x-data="{ open: false }">
            <div class="flex items-center space-x-3 cursor-pointer" @click="open = !open">
                <div class="avatar">
                    @if (auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                            class="h-10 w-10 rounded-full object-cover">
                    @else
                        <span>{{ substr(auth()->user()->name, 0, 2) }}</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-textHeading">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-secondary">
                        {{ auth()->user()->roles->isNotEmpty() ? auth()->user()->roles->first()->name : 'User' }}
                    </p>
                </div>
                <i class="fas fa-chevron-down text-xs"></i>
            </div>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-bgSecondary rounded-xl shadow-lg overflow-hidden z-10 border border-secondary"
                x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" style="display: none;">
                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm hover:bg-bgPrimary">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm hover:bg-bgPrimary">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <div class="border-t border-secondary"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="block px-4 py-2 text-sm hover:bg-bgPrimary text-red-500">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Alpine.js for dropdown -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
