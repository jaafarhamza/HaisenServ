@extends('layouts.app')

@section('title', 'My Reviews')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Reviews</h1>
            <a href="{{ route('client.bookings.index') }}" class="text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Back to Bookings
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

        @if($ratings->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-4xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Reviews Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't left any reviews for services yet.</p>
                    <a href="{{ route('client.bookings.index') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                        View Your Bookings
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-6">
                @foreach($ratings as $rating)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-start">
                                <div class="sm:w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 sm:mb-0 flex-shrink-0">
                                    <i class="fas fa-concierge-bell text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <div class="sm:ml-6 flex-grow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{ $rating->service->title }}
                                        </h3>
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                                        Reviewed on {{ $rating->rating_date->format('M d, Y') }}
                                    </p>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                        <p class="text-gray-600 dark:text-gray-300">{{ $rating->comment }}</p>
                                    </div>
                                    
                                    @if($rating->replies && $rating->replies->count() > 0)
                                        <div class="ml-6 pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                                            @foreach($rating->replies as $reply)
                                                <div class="mb-3">
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        <span class="font-medium text-primary">{{ $reply->user->name }}</span> replied on {{ $reply->rating_date->format('M d, Y') }}:
                                                    </p>
                                                    <p class="text-gray-600 dark:text-gray-300">{{ $reply->comment }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="flex justify-end space-x-3 mt-4">
                                        <a href="{{ route('client.ratings.edit', $rating->id) }}" class="text-primary hover:text-primary-light transition-colors">
                                            Edit Review
                                        </a>
                                        <form action="{{ route('client.ratings.destroy', $rating->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this review?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="mt-4">
                    {{ $ratings->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection