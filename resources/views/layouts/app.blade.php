<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HaisenServ') }} - @yield('title', 'Home')</title>

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
                        'scale-in': 'scale-in 0.2s ease-out',
                        'scale-out': 'scale-out 0.2s ease-in',
                        'rotate-180': 'rotate-180 0.2s ease-out',
                        floating: 'floating 3s ease-in-out infinite',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'bounce-slow': 'bounce 3s infinite'
                    },
                    keyframes: {
                        flow: {
                            '0%, 100%': {
                                backgroundPosition: '0% 50%'
                            },
                            '50%': {
                                backgroundPosition: '100% 50%'
                            }
                        },
                        shine: {
                            '0%': {
                                transform: 'translateX(-100%) rotate(45deg)'
                            },
                            '100%': {
                                transform: 'translateX(100%) rotate(45deg)'
                            }
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        },
                        'scale-in': {
                            '0%': {
                                transform: 'scale(0.95)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            }
                        },
                        'scale-out': {
                            '0%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            },
                            '100%': {
                                transform: 'scale(0.95)',
                                opacity: '0'
                            }
                        },
                        'rotate-180': {
                            '0%': {
                                transform: 'rotate(0deg)'
                            },
                            '100%': {
                                transform: 'rotate(180deg)'
                            }
                        },
                        floating: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(100px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        display: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <!-- Font imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    
    <!-- Preload dark mode -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gradient-to-br dark:from-dark dark:via-dark/90 dark:to-dark dark:text-gray-100 font-sans transition-colors duration-300">
    <!-- App Header -->
    <div class="h-20"></div> 
    @include('components.header')
    
    <main class="flex-grow pt-10">
        @yield('content')
    </main>
    
    @include('components.footer')

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>