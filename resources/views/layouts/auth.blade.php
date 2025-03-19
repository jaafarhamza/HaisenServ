<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'HaisenServ - The platform revolutionizing connections between clients and service providers')">
    <meta name="keywords" content="@yield('meta_keywords', 'authentication, login, register, service platform, HaisenServ')">
    <meta name="author" content="HaisenServ">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#16161a">

    <title>@yield('title', 'Authentication') | HaisenServ</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        // Happy Hues Color Palette (Dark Theme #10)
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
                }
            }
        }
    </script>

    <style>
        /* Base Styles - Prevent Scrolling */
        html,
        body {
            /* color: #94a1b2; */
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(130deg, #16161a, #242629, #1e1e24, #16161a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            z-index: -2;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        /* Animated Particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            pointer-events: none;
            background: radial-gradient(circle, #7f5af0 0%, transparent 70%);
            z-index: -1;
        }

        /* Animation Keyframes */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Form Elements */
        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            color: #fffffe;
            background-color: #16161a;
            border: 1px solid rgba(114, 117, 126, 0.3);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #7f5af0;
            box-shadow: 0 0 0 3px rgba(127, 90, 240, 0.2);
        }

        .input-field::placeholder {
            color: rgba(148, 161, 178, 0.6);
        }

        /* Button Styles */
        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 100%;
            padding: 0.75rem 1.5rem;
            background-color: #7f5af0;
            color: #fffffe;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(127, 90, 240, 0.2), 0 2px 4px -1px rgba(127, 90, 240, 0.1);
        }

        .btn-primary:hover {
            background-color: #6b4bd6;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px -1px rgba(127, 90, 240, 0.25), 0 2px 4px -1px rgba(127, 90, 240, 0.15);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 100%;
            padding: 0.75rem 1.5rem;
            background-color: transparent;
            border: 1px solid rgba(114, 117, 126, 0.3);
            color: #fffffe;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: rgba(114, 117, 126, 0.1);
            border-color: rgba(114, 117, 126, 0.5);
        }

        /* Card Styling */
        .auth-card {
            background-color: #242629;
            border-radius: 1rem;
            box-shadow: 0 10px 35px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            border: 1px solid rgba(114, 117, 126, 0.1);
            overflow: hidden;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.4), 0 10px 15px -6px rgba(0, 0, 0, 0.3);
            border-color: rgba(114, 117, 126, 0.2);
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .slide-up {
            animation: slideUp 1s ease-out forwards;
        }

        .float {
            animation: float 5s ease-in-out infinite;
        }

        .pulse {
            animation: pulse 4s ease-in-out infinite;
        }

        .delayed {
            opacity: 0;
            animation-fill-mode: forwards;
            animation-delay: 0.3s;
        }

        /* Staggered Animation */
        .staggered {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .staggered:nth-child(1) {
            animation-delay: 0.2s;
        }

        .staggered:nth-child(2) {
            animation-delay: 0.4s;
        }

        .staggered:nth-child(3) {
            animation-delay: 0.6s;
        }

        .staggered:nth-child(4) {
            animation-delay: 0.8s;
        }

        /* Loading Animation */
        .loading-dots span {
            display: inline-block;
            width: 0.5rem;
            height: 0.5rem;
            margin: 0 0.25rem;
            background-color: #fffffe;
            border-radius: 50%;
            animation: loadingDots 1.4s infinite ease-in-out both;
        }

        .loading-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes loadingDots {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1.0);
            }
        }

        /* Logo & Tagline Styling */
        .brand-container {
            text-align: center;
        }

        .logo-text {
            font-weight: 700;
            letter-spacing: -0.025em;
            font-size: 2rem;
            line-height: 2.5rem;
        }

        .logo-gradient {
            background: linear-gradient(to right, #7f5af0, #2cb67d);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tagline-container {
            position: relative;
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background-color: rgba(22, 22, 26, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 5rem;
            border: 1px solid rgba(127, 90, 240, 0.2);
            display: inline-flex;
            max-width: 90%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .tagline-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            border-color: rgba(127, 90, 240, 0.4);
        }

        .tagline {
            font-size: 0.75rem;
            line-height: 1.1rem;
            text-align: center;
            color: #fffffe;
            opacity: 0.9;
        }

        .highlight-accent {
            color: #2cb67d;
            font-weight: 500;
        }

        /* Layout - Flex Container to Use Full Screen */
        .auth-layout {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100vh;
            max-height: 100vh;
        }

        /* Main Scrollable Content Area */
        .main-container {
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            max-width: 100vw;
        }

        .brand-section {
            margin-bottom: 1.5rem;
        }

        .content-section {
            max-width: 24rem;
            width: 100%;
            padding: 0 1rem;
        }

        .footer-section {
            padding: 1rem;
            text-align: center;
        }

        /* Scrollable Card Content for forms that might be too tall */
        .card-content {
            max-height: 60vh;
            overflow-y: auto;
            -ms-overflow-style: none;
            /* Hide scrollbar for IE and Edge */
            scrollbar-width: none;
            /* Hide scrollbar for Firefox */
            padding: 1.5rem;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .card-content::-webkit-scrollbar {
            display: none;
        }

        /* Special element styles */
        .shape-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
            pointer-events: none;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            right: -100px;
            top: 10%;
            border-radius: 72% 28% 70% 30% / 41% 73% 27% 59%;
            background: linear-gradient(45deg, #7f5af0, #2cb67d);
            animation: morphing 15s linear infinite alternate;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            left: -50px;
            bottom: 15%;
            border-radius: 32% 68% 54% 46% / 26% 67% 33% 74%;
            background: linear-gradient(-45deg, #7f5af0, #2cb67d);
            animation: morphing 12s linear infinite alternate-reverse;
        }

        @keyframes morphing {
            0% {
                border-radius: 72% 28% 70% 30% / 41% 73% 27% 59%;
            }

            25% {
                border-radius: 41% 59% 27% 73% / 61% 40% 60% 39%;
            }

            50% {
                border-radius: 38% 62% 63% 37% / 42% 26% 74% 58%;
            }

            75% {
                border-radius: 67% 33% 52% 48% / 23% 68% 32% 77%;
            }

            100% {
                border-radius: 32% 68% 54% 46% / 26% 67% 33% 74%;
            }
        }

        /* Input field icon position */
        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #72757e;
            transition: color 0.3s ease;
        }

        .input-container:hover .input-icon {
            color: #7f5af0;
        }
    </style>

    @yield('additional_styles')
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Decorative shapes -->
    <div class="shape-decoration shape-1"></div>
    <div class="shape-decoration shape-2"></div>

    <!-- Main Layout Container -->
    <div class="auth-layout">
        <!-- Main Content Container -->
        <div class="main-container">
            <!-- Brand Section -->
            <div class="brand-section">
                <div class="brand-container">
                    <h1 class="logo-text">
                        <span class="logo-gradient">Haisen</span>
                        <span class="text-textHeading">Serv</span>
                    </h1>

                    <div class="tagline-container float">
                        <p class="tagline">
                            The platform <span class="highlight-accent">revolutionizing</span> connections between
                            clients and service providers, with a touch of <span class="highlight-accent">fun</span> and
                            engagement!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="content-section max-w-lg max-h-screen">
                <div class="auth-card fade-in delayed">
                    <div class="card-content">
                        @yield('content')
                    </div>
                </div>

                <div class="mt-4 text-center text-xs text-textParagraph">
                    @yield('footer_links')
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer-section">
            <p class="text-xs text-textParagraph opacity-50">&copy; {{ date('Y') }} HaisenServ. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create animated particles
            createParticles();

            // Add loading animation to buttons
            setupButtonLoadingState();

            // Setup input field animations
            setupInputAnimations();

            // Apply staggered animations
            setupStaggeredAnimations();

            // Create particle effect
            function createParticles() {
                const particleCount = window.innerWidth < 768 ? 4 : 6;

                for (let i = 0; i < particleCount; i++) {
                    const size = Math.random() * 150 + 50;
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.top = `${Math.random() * 100}%`;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.opacity = (Math.random() * 0.06 + 0.02).toString();
                    particle.style.animation = `float ${Math.random() * 8 + 8}s ease-in-out infinite`;
                    particle.style.animationDelay = `${Math.random() * 5}s`;
                    document.body.appendChild(particle);
                }
            }

            // Input field animations
            function setupInputAnimations() {
                const inputs = document.querySelectorAll('.input-field');
                inputs.forEach(input => {
                    // Find the parent container and icon
                    const container = input.closest('.input-container');
                    const icon = container ? container.querySelector('.input-icon') : null;
                    const label = input.previousElementSibling;

                    input.addEventListener('focus', function() {
                        if (container) {
                            container.style.transform = 'scale(1.02)';
                            container.style.transition = 'transform 0.3s ease';
                        }

                        if (icon) {
                            icon.style.color = '#7f5af0';
                        }

                        if (label && label.tagName === 'LABEL') {
                            label.style.color = '#7f5af0';
                        }
                    });

                    input.addEventListener('blur', function() {
                        if (container) {
                            container.style.transform = 'scale(1)';
                        }

                        if (icon && !this.value) {
                            icon.style.color = '';
                        }

                        if (label && label.tagName === 'LABEL' && !this.value) {
                            label.style.color = '';
                        }
                    });

                    // Initial check for pre-filled values
                    if (input.value && icon) {
                        icon.style.color = '#7f5af0';
                    }
                });
            }

            // Brand animation
            const taglineContainer = document.querySelector('.tagline-container');
            if (taglineContainer) {
                taglineContainer.addEventListener('mouseover', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });

                taglineContainer.addEventListener('mouseout', function() {
                    this.style.transform = '';
                });
            }

            // Staggered animations
            function setupStaggeredAnimations() {
                const staggeredItems = document.querySelectorAll('.staggered');
                staggeredItems.forEach((item, index) => {
                    item.style.animationDelay = `${0.2 + (index * 0.1)}s`;
                });
            }
        });
    </script>

    @yield('additional_scripts')
</body>

</html>
