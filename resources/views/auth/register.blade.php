@extends('layouts.auth')

@section('title', 'Register')
@section('meta_description', 'Create a new HaisenServ account to access our professional services platform.')
@section('meta_keywords', 'register, sign up, create account, new user, HaisenServ')

@section('content')
    <div class="text-center mb-5 staggered">
        <div class="w-14 h-14 mx-auto mb-3 text-buttonPrimary float">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-textHeading">Create account</h2>
        <p class="mt-1 text-textParagraph text-xs">
            Join HaisenServ and discover our platform
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
    
    <form class="" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="">
            <div class="staggered">
                <div class="input-container group relative">
                    <label for="name" class="block text-xs font-medium text-textParagraph mb-1 transition-colors duration-300">
                        Full name
                    </label>
                    <div class="relative">
                        <svg class="input-icon h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                              class="input-field text-sm py-2"
                              placeholder="John Doe">
                    </div>
                </div>
            </div>
            
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
                              placeholder="you@example.com">
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
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                              class="input-field text-sm py-2"
                              placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-secondary hover:text-highlight transition-colors duration-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div id="password-strength" class="mt-1 h-0.5 w-0 bg-primary/50 rounded-full transition-all duration-500"></div>
                </div>
            </div>
            
            <div class="staggered">
                <div class="input-container group relative">
                    <label for="password_confirmation" class="block text-xs font-medium text-textParagraph mb-1 transition-colors duration-300">
                        Confirm password
                    </label>
                    <div class="relative">
                        <svg class="input-icon h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                              class="input-field text-sm py-2"
                              placeholder="••••••••">
                        <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-secondary hover:text-highlight transition-colors duration-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div id="password-match" class="mt-1 h-0 transition-all duration-300"></div>
                </div>
            </div>
        </div>

        <div class="flex items-start mt-4 staggered">
            <div class="flex items-center h-5 pt-0.5">
                <input id="terms" name="terms" type="checkbox" required
                      class="h-3 w-3 rounded border-secondary text-buttonPrimary focus:ring-highlight transition-colors duration-300">
            </div>
            <div class="ml-2 text-xs">
                <label for="terms" class="text-textParagraph">
                    I agree to the <a href="#" class="text-highlight hover:text-buttonPrimary transition-colors duration-300">Terms</a> and <a href="#" class="text-highlight hover:text-buttonPrimary transition-colors duration-300">Privacy Policy</a>
                </label>
            </div>
        </div>

        <div class="mt-5 staggered">
            <button type="submit" class="btn-primary text-sm py-2">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-buttonText opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Create account
            </button>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="mt-3 text-textParagraph hover:text-textHeading transition-colors duration-300 text-xs">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-highlight hover:text-buttonPrimary transition-colors duration-300">
            Sign in
        </a>
    </p>
@endsection

