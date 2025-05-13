<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">My Ratings & Reviews</h2>
    
    @if(isset($ratings) && $ratings->count() > 0)
        <div class="space-y-6">
            @foreach($ratings as $rating)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <img src="{{ $rating->service->image ? asset('storage/' . $rating->service->image) : asset('images/service-placeholder.jpg') }}" 
                                alt="{{ $rating->service->title }}" 
                                class="w-16 h-16 object-cover rounded-lg mr-4">
                            <div>
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ $rating->service->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    By {{ $rating->service->user->name }} • {{ $rating->rating_date->format('M j, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating->score)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded p-3 mb-3">
                        <p class="text-gray-700 dark:text-gray-300">{{ $rating->comment }}</p>
                    </div>
                    
                    @if($rating->reply)
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded p-3 ml-4 border-l-2 border-blue-300 dark:border-blue-700">
                            <div class="flex items-center mb-1">
                                <img src="{{ $rating->service->user->avatar ? asset('storage/' . $rating->service->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($rating->service->user->name) . '&background=random' }}" 
                                    alt="{{ $rating->service->user->name }}" 
                                    class="w-6 h-6 rounded-full mr-2">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $rating->service->user->name }} <span class="text-gray-500 dark:text-gray-400 font-normal">replied</span></p>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $rating->reply }}</p>
                        </div>
                    @endif
                    
                    <div class="flex justify-end mt-3">
                        <a href="{{ route('client.ratings.edit', $rating->id) }}" class="text-primary hover:text-primary-light">
                            Edit Rating
                        </a>
                        <form action="{{ route('client.ratings.destroy', $rating->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                onclick="return confirm('Are you sure you want to delete this rating?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
            <i class="fas fa-star text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Ratings Yet</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't rated any services yet. After completing a service, you can leave a rating.</p>
        </div>
    @endif
</div>