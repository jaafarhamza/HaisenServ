<header class="fixed w-full z-50 backdrop-blur-md" role="banner">
    <!-- Animated gradient border -->
    <div
        class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-primary to-transparent opacity-50">
    </div>

    <!-- Glass background -->
    <div class="absolute inset-0 bg-dark/50 backdrop-blur-md dark:bg-dark/80"></div>

    <div class="container mx-auto px-4 relative">
        <div class="flex items-center justify-between h-20">

            <!-- Enhanced Logo -->
            <a href="{{ route('homepage') }}" class="group relative flex items-center space-x-3"
                aria-label="HaisenServ Home">

                <!-- Logo Text -->
                <div class="flex flex-col">
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        HaisenServ
                    </span>
                    <span class="text-xs text-gray-400">Solutions Digitales Premium</span>
                </div>
            </a>
            <!-- Dark mode toggle button (Mobile) -->
            <button id="dark-mode-toggle-mobile"
                class="md:hidden flex items-center justify-center w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 transition-colors duration-300"
                aria-label="Toggle dark mode">
                <!-- Sun icon (shown in dark mode) -->
                <svg id="sun-icon-mobile" class="w-5 h-5 text-yellow-400 hidden dark:block" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <!-- Moon icon (shown in light mode) -->
                <svg id="moon-icon-mobile" class="w-5 h-5 text-primary block dark:hidden" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                    </path>
                </svg>
            </button>

            <!-- Desktop Search Bar (shown on md and larger screens) -->
            <div class="hidden md:flex flex-1 max-w-3xl mx-4">
                <div class="flex items-center space-x-1">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search services..."
                            class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-l-lg appearance-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-white transition-all duration-300">
                    </div>
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" list="mobile-location-options" placeholder="Location"
                            class="w-full pl-10 pr-3 py-2.5 bg-white/5 border border-white/10 appearance-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-white transition-all duration-300">
                        <datalist id="mobile-location-options">
                            <option value="New York">
                            <option value="London">
                            <option value="Paris">
                            <option value="Tokyo">
                            <option value="Dubai">
                        </datalist>
                    </div>
                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-4 py-2.5 rounded-r-lg transition-colors duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- User Menu / Sign In and Dark Mode Toggle (Desktop) -->
            <div class="flex items-center space-x-4">
                <!-- Dark mode toggle button (Desktop) -->
                <button id="dark-mode-toggle-desktop"
                    class="hidden md:flex items-center justify-center w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 transition-colors duration-300"
                    aria-label="Toggle dark mode">
                    <!-- Sun icon (shown in dark mode) -->
                    <svg id="sun-icon-desktop" class="w-5 h-5 text-yellow-400 hidden dark:block" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <!-- Moon icon (shown in light mode) -->
                    <svg id="moon-icon-desktop" class="w-5 h-5 text-primary block dark:hidden" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>

                @auth
                    <div class="relative">
                        <button type="button" onclick="toggleUserMenu()"
                            class="flex items-center space-x-3 rounded-full py-2 px-2 hover:bg-white/5 focus:outline-none transition duration-300">
                            <div class="relative">
                                <div
                                    class="h-10 w-10 rounded-full bg-gradient-to-br from-secondary to-accent p-0.5 animate-pulse-slow">
                                    <img class="h-full w-full rounded-full object-cover bg-white"
                                        src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                                </div>
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-green-400 rounded-full border-2 border-dark">
                                </div>
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">
                                    @if (Auth::user()->roles->isNotEmpty())
                                        {{ Auth::user()->roles->first()->name }}
                                    @else
                                        User
                                    @endif
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-menu"
                            class="hidden absolute right-0 mt-2 w-64 bg-dark/90 backdrop-blur-lg rounded-xl overflow-hidden z-10 border border-white/10 animate-scale-in shadow-xl">
                            <div class="p-4 border-b border-white/10">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <div
                                            class="h-12 w-12 rounded-full bg-gradient-to-br from-secondary to-accent p-0.5">
                                            <img class="h-full w-full rounded-full object-cover bg-white"
                                                src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                                        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="max-h-[60vh] overflow-y-auto">
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center px-4 py-3 hover:bg-white/5 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-3"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg> Dashboard
                                    </a>
                                @endif
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center px-4 py-3 hover:bg-white/5 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg> Profile
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-3 hover:bg-white/5 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> Settings
                                </a>
                                <div class="border-t border-white/10"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center px-4 py-3 text-red-400 hover:bg-red-500/10 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                            Sign in
                        </a>
                        <!-- Contact Button with enhanced styling -->
                        <a href="{{ route('register') }}" class="relative group">
                            <div
                                class="absolute -inset-0.5 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 group-hover:opacity-100 transition duration-200">
                            </div>
                            <button
                                class="relative px-6 py-2 rounded-full bg-dark text-white font-medium group-hover:-translate-y-0.5 transition-transform">
                                Sign up
                            </button>
                        </a>
                    </div>
                @endauth

                <!-- Mobile menu hamburger button -->
                <button type="button"
                    class="md:hidden relative w-10 h-10 rounded-lg hover:bg-white/5 transition-colors flex items-center justify-center group"
                    onclick="toggleMobileMenu()" aria-label="Toggle menu">
                    <div class="w-6 h-6 flex flex-col justify-center space-y-1.5 transition-all">
                        <span id="hamburger-top"
                            class="w-full h-0.5 bg-gray-300 rounded-full transform transition-all origin-right"></span>
                        <span id="hamburger-middle"
                            class="w-full h-0.5 bg-gray-300 rounded-full transform transition-all"></span>
                        <span id="hamburger-bottom"
                            class="w-full h-0.5 bg-gray-300 rounded-full transform transition-all origin-right"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Search Bar (permanently visible on mobile) -->
    <div class="md:hidden p-3 bg-dark/80 backdrop-blur-md border-t border-white/10">
        <div class="flex items-center space-x-1">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search services..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-l-lg appearance-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-white transition-all duration-300">
            </div>
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <input type="text" list="mobile-location-options" placeholder="Location"
                    class="w-full pl-10 pr-3 py-2.5 bg-white/5 border border-white/10 appearance-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-white transition-all duration-300">
                <datalist id="mobile-location-options">
                    <option value="New York">
                    <option value="London">
                    <option value="Paris">
                    <option value="Tokyo">
                    <option value="Dubai">
                </datalist>
            </div>
            <button
                class="bg-primary hover:bg-primary/90 text-white px-4 py-2.5 rounded-r-lg transition-colors duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu (hidden by default) --}}
    <div id="mobile-menu"
        class="hidden md:hidden bg-dark/95 backdrop-blur-xl border-t border-white/10 animate-scale-in max-h-[70vh] overflow-y-auto">
        <div class="p-4 space-y-1">
            @auth
                <div class="flex items-center space-x-3 mb-4 py-3 border-b border-white/10">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-secondary to-accent p-0.5">
                            <img class="h-full w-full rounded-full object-cover bg-white"
                                src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-green-400 rounded-full border-2 border-dark">
                        </div>
                    </div>
                    <div>
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <a href="{{ route('homepage') }}"
                    class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-white/5 text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7m-7-7v14" />
                    </svg>
                    <span>Home</span>
                </a>
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-white/5 text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                @endif
                <a href="{{ route('profile.index') }}"
                    class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-white/5 text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>My Profile</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-white/5 text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
                <div class="pt-2 border-t border-white/10 mt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-500/10 text-red-400 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="p-4 border-t border-white/10 flex flex-col space-y-3">
                <a href="{{ route('login') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}"
                    class="flex items-center justify-center space-x-2 px-4 py-3 rounded-lg bg-gradient-to-r from-primary to-secondary text-white hover:shadow-lg hover:shadow-primary/25 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Create Account</span>
                </a>
            </div>
        @endauth
    </div>

    </div>
</header>

<script>
    // Function to toggle the mobile menu
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerTop = document.getElementById('hamburger-top');
        const hamburgerMiddle = document.getElementById('hamburger-middle');
        const hamburgerBottom = document.getElementById('hamburger-bottom');

        // Toggle the menu visibility
        mobileMenu.classList.toggle('hidden');

        // Toggle the hamburger icon animation
        if (mobileMenu.classList.contains('hidden')) {
            // Menu is closed, reset the icon
            hamburgerTop.classList.remove('rotate-45');
            hamburgerMiddle.classList.remove('opacity-0');
            hamburgerBottom.classList.remove('-rotate-45');
        } else {
            // Menu is open, animate the icon to an X
            hamburgerTop.classList.add('rotate-45');
            hamburgerMiddle.classList.add('opacity-0');
            hamburgerBottom.classList.add('-rotate-45');
        }
    }

    // Function to toggle user dropdown menu
    function toggleUserMenu() {
        const userMenu = document.getElementById('user-menu');
        userMenu.classList.toggle('hidden');
    }

    // Function to toggle nested dropdown in mobile menu
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const dropdownIcon = document.getElementById(id + '-icon');

        dropdown.classList.toggle('hidden');
        dropdownIcon.classList.toggle('rotate-180');
    }

    // Dark mode toggle functionality
    function setupDarkMode() {
        // Check for saved theme preference or prefer-color-scheme
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const savedTheme = localStorage.getItem('theme');

        // Apply the theme
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.documentElement.classList.add('dark');
        }

        // Set up toggle functionality
        const toggleButtons = [
            document.getElementById('dark-mode-toggle-desktop'),
            document.getElementById('dark-mode-toggle-mobile')
        ];

        toggleButtons.forEach(button => {
            if (button) {
                button.addEventListener('click', () => {
                    // Toggle dark class on html element
                    document.documentElement.classList.toggle('dark');

                    // Save preference
                    if (document.documentElement.classList.contains('dark')) {
                        localStorage.setItem('theme', 'dark');
                    } else {
                        localStorage.setItem('theme', 'light');
                    }
                });
            }
        });
    }

    // Run setup when DOM is loaded
    document.addEventListener('DOMContentLoaded', setupDarkMode);
</script>
