<section class="relative py-20 overflow-hidden bg-gradient-to-b from-gray-50/50 to-gray-100/50 dark:from-dark dark:to-dark/80">
    <!-- Background design elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-dark/10 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-dark/10 to-transparent"></div>
        <svg class="absolute right-0 top-1/4 text-primary/5 w-72 h-72" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M42.9,-65.2C55.4,-58.9,65.3,-46.6,71.4,-32.5C77.5,-18.4,79.8,-2.5,76.7,12.6C73.6,27.7,65.1,42,53.4,53.3C41.8,64.6,27,72.9,10.5,76.2C-5.9,79.6,-24.1,78,-38.4,70.1C-52.7,62.2,-63.2,48,-67.4,32.8C-71.5,17.5,-69.3,1.2,-64.5,-13.2C-59.6,-27.5,-52.2,-39.8,-41.8,-47.4C-31.3,-54.9,-17.9,-57.6,-1.9,-54.9C14.2,-52.3,30.4,-71.5,42.9,-65.2Z" transform="translate(100 100)" />
        </svg>
        <svg class="absolute left-0 bottom-1/4 text-secondary/5 w-64 h-64" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M46.3,-68.5C59.9,-61.5,70.8,-47.8,76.1,-32.4C81.4,-17,81,-0.1,76.8,15.2C72.6,30.5,64.6,44.1,52.7,53.3C40.9,62.5,25.1,67.3,8.1,72.1C-8.9,77,-26.9,82,-39.4,75.8C-51.9,69.7,-58.9,52.5,-64.2,36.2C-69.5,19.9,-73,4.6,-71.9,-10.7C-70.8,-26,-65.1,-41.3,-54.4,-49.8C-43.7,-58.3,-28,-59.9,-14,-65.2C0,-70.5,12.3,-79.5,26.4,-78.1C40.5,-76.7,56.5,-64.9,46.3,-68.5Z" transform="translate(100 100)" />
        </svg>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Explore Our <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Services</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Browse through our highest-rated services from our top providers. Each service is rated by real customers.</p>
        </div>

        <!-- Services Cards Grid (3 columns on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @php
                // Calculate average rating for each service
                if(isset($services)) {
                    $services = $services->map(function($service) {
                        $avgRating = \App\Models\Rating::where('service_id', $service->id)
                            ->whereNull('reply_id') // Only original ratings, not replies
                            ->avg('score') ?? 0;
                        
                        $service->average_rating = round($avgRating, 1);
                        $service->rating_count = \App\Models\Rating::where('service_id', $service->id)
                            ->whereNull('reply_id')
                            ->count();
                            
                        return $service;
                    });
                    
                    // Sort by average rating (highest first)
                    $services = $services->sortByDesc('average_rating')->take(6);
                }
            @endphp
            
            @if(isset($services) && $services->count() > 0)
                @foreach($services as $index => $service)
                    @php
                        // Color themes based on index
                        $colorTheme = match($index % 4) {
                            0 => 'primary',
                            1 => 'secondary',
                            2 => 'accent',
                            3 => 'support'
                        };
                        
                        // Default placeholder images if none is provided
                        $images = [
                            'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1590402494610-2c378a9114c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1533745848184-3db07256e163?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                        ];
                        $image = isset($service->image_url) ? $service->image_url : $images[$index % count($images)];
                        
                        // Calculate rating stars
                        $fullStars = floor($service->average_rating);
                        $halfStar = $service->average_rating - $fullStars >= 0.5;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        
                        // Get provider information
                        $provider = $service->user;
                        $providerName = $provider ? $provider->name : 'Unknown Provider';
                        $providerAvatar = $provider && $provider->avatar ? $provider->avatar : 'https://ui-avatars.com/api/?name=' . urlencode($providerName) . '&background=random';
                    @endphp
                    
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-{{ $colorTheme }}/10 service-card">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ $image }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $service->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                            <div class="absolute top-0 right-0 px-3 py-1.5 bg-{{ $colorTheme }}/80 text-white text-sm font-semibold rounded-bl-lg">
                                {{ $service->category->name ?? 'General' }}
                            </div>
                            <div class="absolute bottom-4 left-4 flex gap-2">
                                <span class="px-3 py-1 rounded-full bg-{{ $colorTheme }}/20 backdrop-blur-sm text-{{ $colorTheme }} text-xs font-bold">{{ $service->city ?? 'Any Location' }}</span>
                                <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-bold">{{ number_format($service->price, 2) }} DH</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-white group-hover:text-{{ $colorTheme }} transition-colors">{{ $service->title }}</h3>
                            </div>
                            
                            <!-- Rating stars -->
                            <div class="flex items-center mb-3">
                                <div class="flex mr-2">
                                    @for($i = 0; $i < $fullStars; $i++)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                    
                                    @if($halfStar)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <defs>
                                                <linearGradient id="halfStarGradient{{ $index }}" x1="0%" y1="0%" x2="100%" y2="0%">
                                                    <stop offset="50%" stop-color="currentColor"></stop>
                                                    <stop offset="50%" stop-color="#4B5563"></stop>
                                                </linearGradient>
                                            </defs>
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" fill="url(#halfStarGradient{{ $index }})"></path>
                                        </svg>
                                    @endif
                                    
                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-400">{{ $service->average_rating }} ({{ $service->rating_count }} {{ Str::plural('review', $service->rating_count) }})</span>
                            </div>
                            
                            <p class="text-gray-400 mb-4">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="{{ $providerAvatar }}" class="w-8 h-8 rounded-full border border-white/20 mr-2" alt="{{ $providerName }}">
                                    <span class="text-sm text-gray-300">{{ $providerName }}</span>
                                </div>
                                <a href="{{ route('client.bookings.create', ['service_id' => $service->id]) }}" class="px-4 py-2 bg-{{ $colorTheme }}/20 hover:bg-{{ $colorTheme }}/40 transition-colors text-{{ $colorTheme }} text-sm font-medium rounded-full">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback for when no services are available -->
                <div class="col-span-3 p-8 text-center">
                    <h3 class="text-2xl font-bold text-white">No services available</h3>
                    <p class="text-gray-400 mt-2">Check back soon for new services!</p>
                </div>
            @endif
        </div>

        <!-- View All Button -->
        <div class="flex justify-center pt-4">
            <a href="{{ route('services.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 group-hover:opacity-100 transition duration-200"></div>
                <button class="relative px-8 py-3 bg-dark rounded-full flex items-center justify-center group-hover:-translate-y-1 transition-all duration-300">
                    <span class="text-white font-medium mr-2">View All Services</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate the cards when they come into view
    const cards = document.querySelectorAll('.service-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('animate-in');
                }, index * 100); // Staggered animation delay
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    cards.forEach(card => {
        card.classList.add('opacity-0', 'translate-y-8');
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
    
    // Add class for animation
    document.addEventListener('animationend', function(e) {
        if (e.target.classList.contains('animate-in')) {
            e.target.classList.remove('opacity-0', 'translate-y-8');
        }
    });
});
</script>

<style>
.animate-in {
    animation: fadeInUp 0.6s forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>