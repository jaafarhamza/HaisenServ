<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HaisenServ</title>
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
                    }
                }
            }
        }
    </script>
    @yield('head_scripts')
</head>

<body class="bg-bgPrimary text-textParagraph min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            @if (session('success'))
                <div class="bg-tertiary bg-opacity-20 border-l-4 border-tertiary text-textHeading p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-tertiary mr-3 text-xl"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 bg-opacity-20 border-l-4 border-red-500 text-textHeading p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    @vite('resources/js/app.js');
    @yield('scripts')
</body>

</html>
