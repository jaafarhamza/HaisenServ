@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Profile</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Profile Information</h2>
                        
                        <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="flex flex-col sm:flex-row mb-6">
                                <div class="sm:w-32 flex-shrink-0 mb-4 sm:mb-0">
                                    <div class="relative h-32 w-32 mx-auto sm:mx-0">
                                        @if(auth()->user()->avatar)
                                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="h-full w-full object-cover rounded-full border-4 border-gray-200 dark:border-gray-700">
                                        @else
                                            <div class="h-full w-full bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-4xl text-gray-400 dark:text-gray-500"></i>
                                            </div>
                                        @endif
                                        
                                        <label for="avatar" class="absolute bottom-0 right-0 h-8 w-8 bg-primary rounded-full flex items-center justify-center cursor-pointer shadow-md">
                                            <i class="fas fa-camera text-white"></i>
                                            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="sm:ml-6 flex-grow">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                            <input type="text" id="city" name="city" value="{{ old('city', auth()->user()->city) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                            @error('city')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">About Me</label>
                                        <textarea id="bio" name="bio" rows="3" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Tell us a bit about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                        @error('bio')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Password</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                                        <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Leave blank to keep current password">
                                        @error('current_password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                                        <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Leave blank to keep current password">
                                        @error('new_password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm New Password</label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Confirm your new password">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div>
                <!-- Stats Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Activity Summary</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-check text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Bookings</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $bookingsCount }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-accent bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-accent"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Reviews Given</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $ratingsCount }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-support bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-trophy text-support"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Loyalty Points</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ auth()->user()->gamification ? auth()->user()->gamification->points : 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h2>
                        
                        <div class="space-y-2">
                            <a href="{{ route('client.bookings.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="h-8 w-8 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">My Bookings</span>
                            </a>
                            
                            <a href="{{ route('client.ratings.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="h-8 w-8 rounded-full bg-accent bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-accent"></i>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">My Reviews</span>
                            </a>
                            
                            <a href="{{ route('messages.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="h-8 w-8 rounded-full bg-secondary bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-secondary"></i>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">Messages</span>
                            </a>
                            
                            <a href="{{ route('gamification.profile') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="h-8 w-8 rounded-full bg-support bg-opacity-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-trophy text-support"></i>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">Gamification Status</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview avatar image before upload
        const avatarInput = document.getElementById('avatar');
        
        if (avatarInput) {
            avatarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    const avatarContainer = this.parentElement.parentElement;
                    
                    reader.onload = function(e) {
                        let avatarImg = avatarContainer.querySelector('img');
                        if (!avatarImg) {
                            // Remove icon placeholder if it exists
                            const placeholder = avatarContainer.querySelector('div:not(.absolute)');
                            if (placeholder) {
                                avatarContainer.removeChild(placeholder);
                            }
                            
                            // Create new image element
                            avatarImg = document.createElement('img');
                            avatarImg.classList.add('h-full', 'w-full', 'object-cover', 'rounded-full', 'border-4', 'border-gray-200', 'dark:border-gray-700');
                            avatarImg.alt = 'Profile Avatar';
                            avatarContainer.insertBefore(avatarImg, avatarContainer.firstChild);
                        }
                        
                        avatarImg.src = e.target.result;
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endpush