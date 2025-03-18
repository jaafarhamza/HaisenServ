@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('meta_description', 'Reset your HaisenServ account password securely.')
@section('meta_keywords', 'forgot password, reset password, account recovery, HaisenServ')

@section('content')
    <div class="text-center mb-8 staggered-item">
        <div class="w-20 h-20 mx-auto mb-4 text-buttonPrimary animate-float">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-textHeading">Forgot password?</h2>
        <p class="mt-2 text-textParagraph">
            Enter your email and we'll send you a password reset link
        </p>
    </div>
    
    @if ($errors->any())
        <div class="bg-bg-primary border-l-4 border-accent text-accent p-4 mb-6 rounded-md animate-fade-in" role="alert">
            <div class="flex">
                <svg class="h-5 w-5 mr-3 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    @if (session('status'))
        <div class="bg-bg-primary border-l-4 border-accent text-accent p-4 mb-6 rounded-md animate-fade-in" role="alert">
            <div class="flex">
                <svg class="h-5 w-5 mr-3 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm">{{ session('status') }}</p>
            </div>
        </div>
    @endif
    
    <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="staggered-item">
            <div class="relative group">
                <label for="email" class="block text-sm font-medium text-textParagraph mb-1 transition-colors duration-300">
                    Email address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-secondary transition-colors duration-300 group-hover:text-primary">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                          class="input-field pl-10"
                          placeholder="you@example.com">
                    <div id="email-valid-icon" class="hidden absolute inset-y-0 right-0 flex items-center pr-3 text-accent animate-fade-in">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 staggered-item">
            <button type="submit" class="btn-primary w-full group">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-primary-dark group-hover:text-primary-dark/80 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </span>
                Send Reset Link
            </button>
        </div>

        <div class="mt-6 text-center staggered-item">
            <p class="text-sm text-textParagraph animate-pulse-slow">
                Check your inbox for the reset link
            </p>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="mt-2 text-secondary-light hover:text-text-heading transition-colors duration-300">
        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-light transition-colors duration-300 inline-flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to login
        </a>
    </p>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple email validation animation
        const emailInput = document.getElementById('email');
        const emailValidIcon = document.getElementById('email-valid-icon');
        
        if (emailInput && emailValidIcon) {
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    emailValidIcon.classList.remove('hidden');
                    this.classList.add('border-accent');
                } else {
                    emailValidIcon.classList.add('hidden');
                    this.classList.remove('border-accent');
                }
            });
        }
    });
</script>
@endsection