@extends('layouts.provider')

@section('title', 'Provider Dashboard')

@section('content')
<div class="container mx-auto px-4 py-10">
    <!-- Welcome Section -->
    <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-400">Here's an overview of your services and client interactions.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('provider.services.create') }}" class="bg-gradient-to-r from-primary to-secondary text-white font-medium py-2 px-4 rounded-lg hover:shadow-lg hover:shadow-primary/20 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Service
                </a>
                <button class="bg-white/10 text-white font-medium py-2 px-4 rounded-lg hover:bg-white/20 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Account Settings
                </button>
            </div>
        </div>
    </div>

    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1: Active Services -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 hover:transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Active Services</p>
                    <h3 class="text-2xl font-bold text-white">7</h3>
                </div>
            </div>
            <div class="w-full bg-white/10 rounded-full h-1.5 mb-1">
                <div class="bg-gradient-to-r from-primary to-secondary h-1.5 rounded-full" style="width: 70%"></div>
            </div>
            <p class="text-xs text-gray-400">3 pending approval</p>
        </div>

        <!-- Stat Card 2: Client Requests -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 hover:transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-secondary/20 flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">New Requests</p>
                    <h3 class="text-2xl font-bold text-white">12</h3>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">5 require action</span>
                <span class="text-xs text-secondary">+8 since last week</span>
            </div>
        </div>

        <!-- Stat Card 3: Completed Jobs -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 hover:transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-accent/20 flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Completed Jobs</p>
                    <h3 class="text-2xl font-bold text-white">42</h3>
                </div>
            </div>
            <div class="w-full bg-white/10 rounded-full h-1.5 mb-1">
                <div class="bg-gradient-to-r from-accent to-support h-1.5 rounded-full" style="width: 85%"></div>
            </div>
            <p class="text-xs text-gray-400">Last completed: April 28, 2025</p>
        </div>

        <!-- Stat Card 4: Earnings -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 hover:transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-support/20 flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-support" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Monthly Earnings</p>
                    <h3 class="text-2xl font-bold text-white">$3,854</h3>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">$1,250 pending</span>
                <span class="text-xs text-support">+12% this month</span>
            </div>
        </div>
    </div>

    <!-- Recent Client Requests and Active Services -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Client Requests -->
        <div class="lg:col-span-2 bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">Recent Client Requests</h2>
                <a href="#" class="text-primary text-sm hover:underline">View All</a>
            </div>
            
            <div class="space-y-4">
                <!-- Request 1 -->
                <div class="bg-white/5 rounded-lg p-4 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-medium text-white">Website Redesign Project</h3>
                        <span class="px-2 py-1 rounded-full bg-accent/20 text-accent text-xs">New Request</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-3">I need a modern, responsive website redesign for my restaurant business with online ordering capabilities.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" class="h-8 w-8 rounded-full mr-2" alt="Client">
                            <span class="text-sm text-gray-300">Michael Brown</span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 rounded-lg bg-primary/20 text-primary text-xs hover:bg-primary/30 transition-colors">
                                Accept
                            </button>
                            <button class="px-3 py-1 rounded-lg bg-white/10 text-gray-300 text-xs hover:bg-white/20 transition-colors">
                                Message
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Request 2 -->
                <div class="bg-white/5 rounded-lg p-4 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-medium text-white">Logo Design for Startup</h3>
                        <span class="px-2 py-1 rounded-full bg-primary/20 text-primary text-xs">In Discussion</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-3">Looking for a minimalist logo design for my tech startup focused on AI solutions for healthcare.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" class="h-8 w-8 rounded-full mr-2" alt="Client">
                            <span class="text-sm text-gray-300">Sarah Johnson</span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 rounded-lg bg-secondary/20 text-secondary text-xs hover:bg-secondary/30 transition-colors">
                                Continue
                            </button>
                            <button class="px-3 py-1 rounded-lg bg-white/10 text-gray-300 text-xs hover:bg-white/20 transition-colors">
                                Message
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Request 3 -->
                <div class="bg-white/5 rounded-lg p-4 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-medium text-white">Mobile App Development</h3>
                        <span class="px-2 py-1 rounded-full bg-support/20 text-support text-xs">Quote Sent</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-3">Fitness tracking app that integrates with wearable devices and provides personalized workout plans.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" class="h-8 w-8 rounded-full mr-2" alt="Client">
                            <span class="text-sm text-gray-300">Alex Rodriguez</span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 rounded-lg bg-white/10 text-gray-300 text-xs hover:bg-white/20 transition-colors">
                                View Quote
                            </button>
                            <button class="px-3 py-1 rounded-lg bg-white/10 text-gray-300 text-xs hover:bg-white/20 transition-colors">
                                Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Completeness Card -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">Profile Completeness</h2>
                <span class="text-xl font-bold text-primary">85%</span>
            </div>
            
            <!-- Progress bar -->
            <div class="w-full bg-white/10 rounded-full h-2 mb-6">
                <div class="bg-gradient-to-r from-primary to-secondary h-2 rounded-full" style="width: 85%"></div>
            </div>
            
            <!-- Checklist -->
            <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">Basic profile information</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">Portfolio items (3/5)</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">Skills & expertise</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">Payment information</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-400">Verification documents</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-400">Client testimonials (0/3)</span>
                </div>
            </div>
            
            <!-- Action button -->
            <button class="w-full py-2.5 rounded-lg bg-gradient-to-r from-primary to-secondary text-white font-medium hover:shadow-lg hover:shadow-primary/20 transition-all duration-300">
                Complete Your Profile
            </button>
        </div>
    </div>
    
    <!-- Your Services Section -->
    <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-white">Your Services</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1.5 rounded-lg bg-white/10 text-gray-300 text-sm hover:bg-white/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
                <a href="{{ route('provider.services.create') }}" class="px-3 py-1.5 rounded-lg bg-primary/20 text-primary text-sm hover:bg-primary/30 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New
                </a>
            </div>
        </div>
        
        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Service</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rating</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    <!-- Service Row 1 -->
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-primary/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Web Development & Design</div>
                                    <div class="text-xs text-gray-400">Custom websites with responsive design</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-primary/10 text-primary">Technology</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-xs text-gray-400">(27)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">$80 - $150</div>
                            <div class="text-xs text-gray-400">per hour</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-500">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <div class="flex space-x-2">
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-red-500/10 hover:bg-red-500/20 transition-colors text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Service Row 2 -->
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-secondary/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Logo & Brand Identity</div>
                                    <div class="text-xs text-gray-400">Professional logo design & branding</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-secondary/10 text-secondary">Design</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-xs text-gray-400">(15)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">$500 - $1,200</div>
                            <div class="text-xs text-gray-400">per project</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-500">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <div class="flex space-x-2">
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-red-500/10 hover:bg-red-500/20 transition-colors text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Service Row 3 -->
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-accent/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Content Writing</div>
                                    <div class="text-xs text-gray-400">SEO optimized blog posts & articles</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-accent/10 text-accent">Marketing</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-xs text-gray-400">(8)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">$0.15 - $0.25</div>
                            <div class="text-xs text-gray-400">per word</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-orange-500/20 text-orange-500">Pending Review</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <div class="flex space-x-2">
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-1.5 rounded-lg bg-red-500/10 hover:bg-red-500/20 transition-colors text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 flex items-center justify-between border-t border-white/10">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 text-sm font-medium rounded-md text-gray-300 bg-white/5 hover:bg-white/10">Previous</a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-white/10 text-sm font-medium rounded-md text-gray-300 bg-white/5 hover:bg-white/10">Next</a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-400">Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">10</span> results</p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-primary/20 text-sm font-medium text-primary">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">2</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">3</a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300">...</span>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">8</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">9</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">10</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-white/10 bg-white/5 text-sm font-medium text-gray-300 hover:bg-white/10">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart Section -->
    <div class="bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-white">Revenue Overview</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1.5 rounded-lg bg-primary/20 text-primary text-sm hover:bg-primary/30 transition-colors">Monthly</button>
                <button class="px-3 py-1.5 rounded-lg bg-white/10 text-gray-300 text-sm hover:bg-white/20 transition-colors">Quarterly</button>
                <button class="px-3 py-1.5 rounded-lg bg-white/10 text-gray-300 text-sm hover:bg-white/20 transition-colors">Yearly</button>
            </div>
        </div>
        
        <!-- Chart Area -->
        <div class="h-80 relative">
            <!-- Chart Placeholder -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-secondary/5 rounded-lg flex items-center justify-center">
                <div class="text-center px-6 py-8 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 max-w-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Revenue Chart</h3>
                    <p class="text-gray-400 mb-4">This chart would display your monthly revenue trends, allowing you to analyze performance over time.</p>
                    <button class="bg-gradient-to-r from-primary to-secondary text-white font-medium py-2 px-4 rounded-lg hover:shadow-lg hover:shadow-primary/20 transition-all duration-300">
                        Activate Revenue Tracking
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Chart Legend -->
        <div class="flex flex-wrap justify-center mt-6 gap-6">
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-primary mr-2"></div>
                <span class="text-sm text-gray-400">Completed Projects</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-secondary mr-2"></div>
                <span class="text-sm text-gray-400">Pending Payments</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-accent mr-2"></div>
                <span class="text-sm text-gray-400">Refunds</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-white/30 mr-2"></div>
                <span class="text-sm text-gray-400">Last Year</span>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Floating Button -->
<div class="fixed bottom-8 right-8 z-50">
    <button class="bg-gradient-to-r from-primary to-secondary text-white p-4 rounded-full shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 hover:-translate-y-1 transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </button>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat cards progress bars
        const progressBars = document.querySelectorAll('.bg-white\\/10.rounded-full.h-1\\.5 > div');
        
        progressBars.forEach(bar => {
            // Get the target width percentage
            const targetWidth = bar.style.width;
            
            // Start from 0
            bar.style.width = '0%';
            
            // Animate to target width
            setTimeout(() => {
                bar.style.transition = 'width 1.5s ease-in-out';
                bar.style.width = targetWidth;
            }, 300);
        });
        
        // Toggle filter visibility
        const filterButton = document.querySelector('button:contains("Filter")');
        if (filterButton) {
            // Example filter dropdown logic would go here
        }
        
        // Animate stats cards on scroll
        const statCards = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4.gap-6.mb-8 > div');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        statCards.forEach(card => {
            card.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-500');
            observer.observe(card);
        });
    });
</script>
@endpush