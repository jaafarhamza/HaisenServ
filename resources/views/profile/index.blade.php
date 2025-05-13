@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
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
        
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Profile Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden sticky top-24">
                    <div class="p-6 text-center border-b border-gray-200 dark:border-gray-700">
                        <div class="relative mx-auto mb-4 w-24 h-24">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary rounded-full animate-pulse-slow"></div>
                            <img src="{{ Auth::user()->avatar }}" alt="" class="h-full w-full object-cover rounded-full border-4 border-gray-200 dark:border-gray-700">
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            @if($user->roles->isNotEmpty())
                                {{ $user->roles->first()->name }}
                            @else
                                User
                            @endif
                        </p>
                    </div>
                    
                    <div class="p-4">
                        <nav class="space-y-1">
                            <a href="{{ route('profile.index', ['tab' => 'profile']) }}" 
                                class="flex items-center px-4 py-3 {{ $activeTab === 'profile' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                <i class="fas fa-user-circle w-5 h-5 mr-3"></i>
                                <span>Profile Information</span>
                            </a>
                            
                            <a href="{{ route('profile.index', ['tab' => 'security']) }}" 
                                class="flex items-center px-4 py-3 {{ $activeTab === 'security' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                <i class="fas fa-lock w-5 h-5 mr-3"></i>
                                <span>Security</span>
                            </a>
                            
                            <a href="{{ route('profile.index', ['tab' => 'my-bookings']) }}" 
                                class="flex items-center px-4 py-3 {{ $activeTab === 'my-bookings' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                <i class="fas fa-calendar-check w-5 h-5 mr-3"></i>
                                <span>My Bookings</span>
                            </a>
                            
                            @if($user->hasRole('client'))
                                <a href="{{ route('profile.index', ['tab' => 'ratings']) }}" 
                                    class="flex items-center px-4 py-3 {{ $activeTab === 'ratings' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                    <i class="fas fa-star w-5 h-5 mr-3"></i>
                                    <span>My Ratings</span>
                                </a>
                            @endif
                            
                            @if($user->hasRole('provider'))
                                <a href="{{ route('profile.index', ['tab' => 'my-services']) }}" 
                                    class="flex items-center px-4 py-3 {{ $activeTab === 'my-services' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                    <i class="fas fa-toolbox w-5 h-5 mr-3"></i>
                                    <span>My Services</span>
                                </a>
                                
                                <a href="{{ route('profile.index', ['tab' => 'service-bookings']) }}" 
                                    class="flex items-center px-4 py-3 {{ $activeTab === 'service-bookings' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                    <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                                    <span>Service Bookings</span>
                                </a>
                            @endif
                            
                            <a href="{{ route('profile.index', ['tab' => 'messages']) }}" 
                                class="flex items-center px-4 py-3 {{ $activeTab === 'messages' ? 'bg-primary text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} rounded-lg transition-all">
                                <i class="fas fa-envelope w-5 h-5 mr-3"></i>
                                <span>Messages</span>
                                @if(isset($unreadMessageCount) && $unreadMessageCount > 0)
                                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $unreadMessageCount }}
                                    </span>
                                @endif
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="w-full md:w-3/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <!-- Tab Content -->
                    @if($activeTab === 'profile')
                        @include('profile.partials.profile-info')
                    @elseif($activeTab === 'security')
                        @include('profile.partials.security')
                    @elseif($activeTab === 'my-bookings')
                        @include('profile.partials.my-bookings')
                    @elseif($activeTab === 'ratings' && $user->hasRole('client'))
                        @include('profile.partials.ratings')
                    @elseif($activeTab === 'my-services' && $user->hasRole('provider'))
                        @include('profile.partials.my-services')
                    @elseif($activeTab === 'service-bookings' && $user->hasRole('provider'))
                        @include('profile.partials.service-bookings')
                    @elseif($activeTab === 'messages')
                        @include('profile.partials.messages')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection