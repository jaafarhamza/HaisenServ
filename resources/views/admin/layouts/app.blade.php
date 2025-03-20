<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HaisenServ') }} - @yield('title', 'Admin Dashboard')</title>
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bgPrimary: '#16161a',
                        bgSecondary: '#242629',
                        textHeading: '#fffffe',
                        textParagraph: '#94a1b2',
                        buttonPrimary: '#7f5af0',
                        buttonText: '#fffffe',
                        highlight: '#7f5af0',
                        secondary: '#72757e',
                        tertiary: '#2cb67d',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .sidebar-icon {
                @apply relative flex items-center justify-center h-12 w-12 mt-2 mb-2 mx-auto shadow-lg 
                bg-bgSecondary text-textParagraph hover:bg-highlight hover:text-white
                rounded-3xl hover:rounded-xl transition-all duration-300 ease-linear;
            }
            .sidebar-tooltip {
                @apply absolute w-auto p-2 m-2 min-w-max left-14 rounded-md shadow-md
                text-white bg-bgSecondary text-xs font-bold transition-all duration-100 scale-0 origin-left;
            }
            .active-link {
                @apply bg-highlight text-white rounded-xl;
            }
            .card {
                @apply bg-bgSecondary rounded-xl shadow-lg overflow-hidden;
            }
            .btn-primary {
                @apply bg-buttonPrimary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200;
            }
            .btn-secondary {
                @apply bg-secondary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200;
            }
            .btn-success {
                @apply bg-tertiary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200;
            }
            .btn-danger {
                @apply bg-red-500 hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200;
            }
            .input-field {
                @apply bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading outline-none focus:border-highlight transition-all;
            }
            .table-header {
                @apply px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider;
            }
            .table-cell {
                @apply px-6 py-4 whitespace-nowrap text-sm text-textParagraph;
            }
            .avatar {
                @apply h-10 w-10 rounded-full bg-secondary text-textHeading flex items-center justify-center font-bold;
            }
            .badge {
                @apply px-2 py-1 text-xs rounded-full;
            }
            .badge-primary {
                @apply bg-highlight text-buttonText;
            }
            .badge-success {
                @apply bg-tertiary text-buttonText;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-bgPrimary text-textParagraph font-sans min-h-screen flex">
    <!-- Sidebar -->
    @include('admin.components.sidebar')
    
    <!-- Main Content -->
    <div class="flex-1 ml-16">
        <!-- Top Header -->
        @include('admin.components.header')
        
        <!-- Content Area -->
        <main class="p-6">
            @include('admin.components.alert')
            
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('admin.components.footer')
    </div>
    
    <!-- Modals -->
    @stack('modals')
    
    <!-- Scripts -->
    <script>
        // JavaScript for interactive elements
        document.querySelectorAll('.sidebar-icon').forEach(icon => {
            icon.addEventListener('mouseenter', () => {
                const tooltip = icon.querySelector('.sidebar-tooltip');
                if (tooltip) tooltip.classList.add('scale-100');
            });
            
            icon.addEventListener('mouseleave', () => {
                const tooltip = icon.querySelector('.sidebar-tooltip');
                if (tooltip) tooltip.classList.remove('scale-100');
            });
        });
        
        // Show/hide modals
        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Flash message timeout
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.classList.add('opacity-0');
                setTimeout(() => {
                    flashMessage.remove();
                }, 300);
            }
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>