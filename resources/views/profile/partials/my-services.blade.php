<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">My Services</h2>
        <a href="{{ route('provider.services.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Service
        </a>
    </div>
    
    @if(isset($services) && $services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="relative h-48">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/service-placeholder.jpg') }}" 
                            alt="{{ $service->title }}" class="w-full h-full object-cover">
                        
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $service->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:bg-opacity-50 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:bg-opacity-50 dark:text-gray-200' }}">
                                {{ ucfirst($service->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-1">{{ $service->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $service->category->name }}</p>
                        
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-lg font-bold text-primary">{{ $service->formatted_price }}</div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($service->average_rating, 1) }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">({{ $service->ratings()->count() }})</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ $service->description }}</p>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('provider.services.edit', $service->id) }}" class="px-3 py-1.5 bg-primary text-white rounded hover:bg-opacity-90 text-sm flex-1 text-center">
                                Edit
                            </a>
                            
                            <form action="{{ route('provider.services.toggle-status', $service->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-full px-3 py-1.5 border border-primary text-primary rounded hover:bg-primary-50 text-sm">
                                    {{ $service->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
            <i class="fas fa-tools text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Services Yet</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't created any services yet. Start offering your skills by adding a new service.</p>
            <a href="{{ route('provider.services.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                <i class="fas fa-plus mr-2"></i> Add New Service
            </a>
        </div>
    @endif
</div>