@extends('layouts.auth')

@section('title', 'Login')
@section('meta_description', 'Securely access your HaisenServ account and connect with service providers.')
@section('meta_keywords', 'login, sign in, account access, HaisenServ, service providers')

@section('content')
    <div class="text-center mb-6 staggered">
        <div class="w-14 h-14 mx-auto mb-3 text-buttonPrimary float">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-textHeading">Welcome back</h2>
        <p class="mt-1 text-textParagraph text-xs">
            Sign in to access your account
        </p>
    </div>
    
    @if ($errors->any())
        <div class="bg-bgPrimary border-l-4 border-tertiary text-tertiary p-3 mb-4 rounded-md fade-in" role="alert">
            <div class="flex items-start">
                <svg class="h-4 w-4 mr-2 text-tertiary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-xs">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    @if (session('status'))
        <div class="bg-bgPrimary border-l-4 border-tertiary text-tertiary p-3 mb-4 rounded-md fade-in" role="alert">
            <div class="flex items-start">
                <svg class="h-4 w-4 mr-2 text-tertiary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xs">{{ session('status') }}</p>
            </div>
        </div>
    @endif
    
    <form class="space-y-4" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="space-y-3">
            <div class="staggered">
                <div class="input-container group relative">
                    <label for="email" class="block text-xs font-medium text-textParagraph mb-1 transition-colors duration-300">
                        Email address
                    </label>
                    <div class="relative">
                        <svg class="input-icon h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                              class="input-field text-sm py-2"
                              placeholder="HaisenServ@example.com">
                    </div>
                </div>
            </div>
            
            <div class="staggered">
                <div class="input-container group relative">
                    <label for="password" class="block text-xs font-medium text-textParagraph mb-1 transition-colors duration-300">
                        Password
                    </label>
                    <div class="relative">
                        <svg class="input-icon h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                              class="input-field text-sm py-2"
                              placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-secondary hover:text-highlight transition-colors duration-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4 staggered">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox"
                      class="h-3 w-3 rounded border-secondary text-buttonPrimary focus:ring-highlight transition-colors duration-300">
                <label for="remember" class="ml-2 block text-xs text-textParagraph">
                    Remember me
                </label>
            </div>

            <a href="{{ route('password.request') }}" class="text-xs font-medium text-highlight hover:text-buttonPrimary transition-colors duration-300">
                Forgot password?
            </a>
        </div>

        <div class="mt-5 staggered">
            <button type="submit" class="btn-primary text-sm py-2">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-buttonText opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </span>
                Sign in
            </button>
        </div>
        
        <div class="relative flex items-center justify-center mt-4 staggered">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-secondary/20"></div>
            </div>
            <div class="relative px-3 bg-bgSecondary text-textParagraph text-xs uppercase tracking-wider">
                or
            </div>
        </div>
        
        <div class="mt-4 staggered">
            <a href="{{ route('login.google') }}" class="btn-secondary text-sm py-2">
                <div class="flex items-center justify-center">
                    <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                        <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                            <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/>
                            <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/>
                            <path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/>
                            <path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/>
                        </g>
                    </svg>
                    Sign in with Google
                </div>
            </a>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="mt-3 text-textParagraph hover:text-textHeading transition-colors duration-300 text-xs">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-medium text-highlight hover:text-buttonPrimary transition-colors duration-300">
            Create account
        </a>
    </p>
@endsection

@section('additional_scripts')
<script>
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.innerHTML = type === 'password' 
                    ? `<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                       </svg>`
                    : `<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                       </svg>`;
            });
        }
    });
</script>
@endsection