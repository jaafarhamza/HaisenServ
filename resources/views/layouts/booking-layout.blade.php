<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HaisenServ') }} - @yield('title', 'Book Service')</title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class', // Enable dark mode variant with class 
            theme: {
                extend: {
                    colors: {
                        primary: '#6366F1',
                        secondary: '#8B5CF6',
                        accent: '#EC4899',
                        support: '#F59E0B',
                        dark: '#1F2937',
                        'primary-light': '#60A5FA',
                        'secondary-light': '#34D399',
                        'accent-light': '#A78BFA',
                        'support-light': '#FBBF24'
                    },
                    animation: {
                        flow: 'flow 15s ease infinite',
                        shine: 'shine 3s linear infinite',
                        float: 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <!-- Font imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @stack('styles')

    <!-- Preload dark mode -->
    <script>
        // On page load or when changing themes
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gradient-to-br dark:from-dark dark:via-dark/90 dark:to-dark dark:text-gray-100 font-sans transition-colors duration-300">
    <!-- Simple Header -->
    <header class="bg-white dark:bg-gray-800 shadow fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="font-bold text-xl text-primary">HaisenServ</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <a href="{{ route('services.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition">
                        <i class="fas fa-concierge-bell mr-1"></i> Services
                    </a>
                    @auth
                        <div class="relative group">
                            <button class="flex items-center text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Dashboard
                                    </a>
                                @elseif(Auth::user()->isProvider())
                                    <a href="{{ route('provider.profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Provider Dashboard
                                    </a>
                                @elseif(Auth::user()->isClient())
                                    <a href="{{ route('client.bookings.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        My Bookings
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg transition">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    
    <!-- Spacer for fixed header -->
    <div class="h-16"></div>

    <!-- Main Content -->
    <main class="flex-grow py-8">
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white dark:bg-gray-800 py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} HaisenServ. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
