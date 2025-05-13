@extends('provider.layouts.app')

@section('title', 'Manage Availability')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Manage Availability</h1>
        <a href="{{ route('provider.availabilities.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
            <i class="fas fa-plus mr-2"></i> Add Availability
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

    <!-- Quick Navigation -->
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <div class="flex items-center justify-between flex-wrap">
                <div class="flex items-center mb-3 sm:mb-0">
                    <span class="text-gray-700 dark:text-gray-300 font-medium mr-4">View:</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('provider.availabilities.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('provider.availabilities.index') && !request()->has('view') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                            List View
                        </a>
                        <a href="{{ route('provider.availabilities.calendar') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('provider.availabilities.calendar') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                            Calendar View
                        </a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('provider.bookings.index') }}" class="text-primary hover:text-primary-light">
                        <i class="fas fa-calendar-check mr-1"></i> View Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Filter -->
    @if(count($services) > 1)
        <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <form action="{{ route('provider.availabilities.index') }}" method="GET" class="flex flex-wrap items-center">
                    <span class="text-gray-700 dark:text-gray-300 font-medium mr-4 mb-2 sm:mb-0">Filter by Service:</span>
                    <select name="service_id" class="px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 mr-2">
                        <option value="">All Services</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                        Apply Filter
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Availabilities List -->
    @if($availabilities->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-4xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Availability Set</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't added any availability times yet.</p>
                <a href="{{ route('provider.availabilities.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                    Add Availability
                </a>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Day of Week
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Start Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                End Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($availabilities as $availability)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                            <i class="fas fa-concierge-bell text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $availability->service->title }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $availability->service->formatted_price }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $availability->day_of_week_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $availability->formatted_start_time }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $availability->formatted_end_time }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($availability->is_available)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                            Available
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                            Unavailable
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('provider.availabilities.edit', $availability->id) }}" class="text-primary hover:text-primary-light">
                                            Edit
                                        </a>
                                        <form action="{{ route('provider.availabilities.destroy', $availability->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this availability?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $availabilities->links() }}
            </div>
        </div>
    @endif

    <!-- Availability Tips -->
    <div class="mt-8 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 p-4 rounded-lg">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Tips for Managing Availability</h2>
        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-2">
            <li>Set up recurring availability for days and times you're normally available</li>
            <li>Clients can only book appointments during your available time slots</li>
            <li>You'll receive notifications when new bookings are made</li>
            <li>You can block out time periods when you're unavailable by marking them as 'Unavailable'</li>
            <li>Use the calendar view to get a visual overview of your availability</li>
        </ul>
    </div>
</div>
@endsection