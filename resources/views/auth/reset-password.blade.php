@extends('layouts.auth')

@section('title', 'Reset Password')
@section('meta_description', 'Create a new password for your HaisenServ account.')
@section('meta_keywords', 'reset password, new password, account security, HaisenServ')

@section('content')
    <div class="text-center mb-8 staggered-item">
        <div class="w-20 h-20 mx-auto mb-4 text-buttonPrimary animate-float">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-textHeading">Reset password</h2>
        <p class="mt-2 text-textParagraph">
            Create a new password for your account
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
    
    <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">
        
        <div class="space-y-4">
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
                        <input type="email" class="input-field pl-10" value="{{ $request->email }}" disabled readonly>
                    </div>
                </div>
            </div>
            
            <div class="staggered-item">
                <div class="relative group">
                    <label for="password" class="block text-sm font-medium text-textParagraph mb-1 transition-colors duration-300">
                        New password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-secondary transition-colors duration-300 group-hover:text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                              class="input-field pl-10"
                              placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-secondary hover:text-primary transition-colors duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div id="password-strength" class="mt-1 h-1 w-0 bg-primary/50 rounded-full transition-all duration-500"></div>
                </div>
            </div>
            
            <div class="staggered-item">
                <div class="relative group">
                    <label for="password_confirmation" class="block text-sm font-medium text-textParagraph mb-1 transition-colors duration-300">
                        Confirm new password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-secondary transition-colors duration-300 group-hover:text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                              class="input-field pl-10"
                              placeholder="••••••••">
                        <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-secondary hover:text-primary transition-colors duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div id="password-match" class="mt-1 h-0 transition-all duration-300"></div>
                </div>
            </div>
        </div>

        <div class="mt-6 staggered-item">
            <button type="submit" class="btn-primary w-full group">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-primary-dark group-hover:text-primary-dark/80 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                Reset Password
            </button>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="mt-2 text-textParagraph hover:text-text-heading transition-colors duration-300">
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
        // Password visibility toggles
        const setupPasswordToggle = (toggleId, inputId) => {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            
            if (toggle && input) {
                toggle.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    // Toggle the eye icon
                    this.innerHTML = type === 'password' 
                        ? `<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                           </svg>`
                        : `<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                           </svg>`;
                });
            }
        };
        
        setupPasswordToggle('togglePassword', 'password');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');
        
        // Password strength meter
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('password-strength');
        const confirmInput = document.getElementById('password_confirmation');
        const passwordMatch = document.getElementById('password-match');
        
        if (passwordInput && strengthMeter) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length > 0) {
                    // Length check
                    if (password.length >= 8) strength += 1;
                    
                    // Lowercase letters check
                    if (/[a-z]/.test(password)) strength += 1;
                    
                    // Uppercase letters check
                    if (/[A-Z]/.test(password)) strength += 1;
                    
                    // Numbers check
                    if (/[0-9]/.test(password)) strength += 1;
                    
                    // Special characters check
                    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
                    
                    // Set strength meter color and width
                    switch(strength) {
                        case 1:
                            strengthMeter.className = 'mt-1 h-1 w-1/5 bg-accent/70 rounded-full transition-all duration-500';
                            break;
                        case 2:
                            strengthMeter.className = 'mt-1 h-1 w-2/5 bg-accent/80 rounded-full transition-all duration-500';
                            break;
                        case 3:
                            strengthMeter.className = 'mt-1 h-1 w-3/5 bg-primary/80 rounded-full transition-all duration-500';
                            break;
                        case 4:
                            strengthMeter.className = 'mt-1 h-1 w-4/5 bg-primary/90 rounded-full transition-all duration-500';
                            break;
                        case 5:
                            strengthMeter.className = 'mt-1 h-1 w-full bg-accent rounded-full transition-all duration-500';
                            break;
                        default:
                            strengthMeter.className = 'mt-1 h-1 w-0 bg-primary/50 rounded-full transition-all duration-500';
                    }
                } else {
                    strengthMeter.className = 'mt-1 h-1 w-0 bg-primary/50 rounded-full transition-all duration-500';
                }
            });
        }
        
        // Password match indicator
        if (passwordInput && confirmInput && passwordMatch) {
            const checkPasswordMatch = () => {
                if (confirmInput.value && passwordInput.value) {
                    if (confirmInput.value === passwordInput.value) {
                        confirmInput.classList.add('border-accent');
                        confirmInput.classList.remove('border-secondary/30');
                        passwordMatch.className = 'mt-1 h-1 bg-accent w-full rounded-full transition-all duration-500';
                        passwordMatch.innerHTML = '';
                    } else {
                        confirmInput.classList.remove('border-accent');
                        confirmInput.classList.add('border-secondary/30');
                        passwordMatch.className = 'mt-1 text-xs text-accent transition-all duration-500';
                        passwordMatch.innerHTML = 'Passwords do not match';
                    }
                } else {
                    confirmInput.classList.remove('border-accent');
                    confirmInput.classList.add('border-secondary/30');
                    passwordMatch.className = 'mt-1 h-0 transition-all duration-300';
                    passwordMatch.innerHTML = '';
                }
            };
            
            confirmInput.addEventListener('input', checkPasswordMatch);
            passwordInput.addEventListener('input', checkPasswordMatch);
        }
    });
</script>
@endsection