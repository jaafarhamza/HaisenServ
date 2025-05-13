@extends('provider.layouts.app')

@section('title', 'My Services')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Services</h1>
        <a href="{{ route('provider.services.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
            <i class="fas fa-plus mr-2"></i> Add New Service
        </a>
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

    <!-- Services List -->
    @if($services->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-concierge-bell text-4xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Services Yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't added any services yet.</p>
                <a href="{{ route('provider.services.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                    Add Your First Service
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $service->title }}</h2>
                            <div>
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-gray-500',
                                        'pending' => 'bg-yellow-500',
                                        'active' => 'bg-green-500',
                                        'inactive' => 'bg-red-500',
                                        'rejected' => 'bg-red-700',
                                    ];
                                    $statusColor = $statusColors[$service->status] ?? 'bg-gray-500';
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full text-white {{ $statusColor }}">
                                    {{ ucfirst($service->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                            {{ $service->description }}
                        </p>
                        
                        <div class="flex justify-between items-center mb-4">
                            <div class="text-lg font-bold text-primary">
                                {{ $service->formatted_price }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Category: {{ $service->category->name }}
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-1">
                                    <a href="{{ route('provider.services.edit', $service->id) }}" class="text-primary hover:text-primary-light">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <a href="{{ route('provider.availabilities.index', ['service_id' => $service->id]) }}" class="text-secondary hover:text-secondary-light">
                                        <i class="fas fa-calendar-alt"></i> Availability
                                    </a>
                                </div>
                                
                                @if($service->status !== 'draft' && $service->status !== 'rejected')
                                    <div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            @if($service->status === 'pending')
                                                Awaiting approval
                                            @elseif($service->status === 'active')
                                                <i class="fas fa-check-circle text-green-500 mr-1"></i> Live
                                            @elseif($service->status === 'inactive')
                                                Paused
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($service->status === 'active')
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 border-t border-gray-200 dark:border-gray-600">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    {{ number_format($service->rating_average, 1) }} ({{ $service->ratings_count ?? 0 }} reviews)
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-calendar-check text-blue-500 mr-1"></i>
                                    {{ $service->bookings_count ?? 0 }} bookings
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    @endif

    <!-- Services Tips -->
    <div class="mt-8 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 p-4 rounded-lg">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Tips for Managing Services</h2>
        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-2">
            <li>Add detailed descriptions and clear pricing to attract more clients</li>
            <li>Keep your service status up to date (active/inactive) to control when you're available</li>
            <li>Set up availability for each service to enable booking</li>
            <li>Respond promptly to reviews to build a good reputation</li>
            <li>Update your services regularly to reflect any changes in your offerings</li>
        </ul>
    </div>
</div>
@endsection