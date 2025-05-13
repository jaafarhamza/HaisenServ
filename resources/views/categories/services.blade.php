@extends('layouts.categories-layout')

@section('title', $category->name . ' Services')

@section('content')
<section class="relative py-16 overflow-hidden">
    <!-- Background design elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-dark/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-dark/30 to-transparent"></div>
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
            <h2 class="text-3xl font-bold mb-4"><span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">{{ $category->name }}</span> Services</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">{{ $category->description }}</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                        $image = $service->image_url ?? $images[$index % count($images)];
                        
                        // Get service provider
                        $provider = $service->user;
                        $providerName = $provider ? $provider->name : 'Unknown Provider';
                        $providerAvatar = $provider && $provider->avatar ? $provider->avatar : 'https://ui-avatars.com/api/?name=' . urlencode($providerName) . '&background=random';
                        
                        // Get service rating
                        $avgRating = $service->ratings()->avg('score') ?? 0;
                        $ratingCount = $service->ratings()->count();
                        $stars = floor($avgRating);
                        $hasHalfStar = ($avgRating - $stars) >= 0.5;
                    @endphp
                    
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-{{ $colorTheme }}/10">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ $image }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $service->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 flex gap-2">
                                <span class="px-3 py-1 rounded-full bg-{{ $colorTheme }}/20 backdrop-blur-sm text-{{ $colorTheme }} text-xs">{{ $service->price }} DH</span>
                                @if(isset($service->city))
                                    <span class="px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm text-white text-xs">{{ $service->city }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-white">{{ $service->name }}</h3>
                                <div class="flex items-center">
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $stars)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @elseif($i == $stars + 1 && $hasHalfStar)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" clip-path="inset(0 50% 0 0)"></path><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" fill="none" stroke="currentColor" stroke-width="1" clip-path="inset(0 0 0 50%)"></path></svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endif
                                        @endfor
                                        <span class="text-xs text-gray-400 ml-1">({{ $ratingCount }})</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-400 mb-4">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="{{ $providerAvatar }}" class="w-8 h-8 rounded-full border border-white/20 mr-2" alt="{{ $providerName }}">
                                    <span class="text-sm text-gray-300">{{ $providerName }}</span>
                                </div>
                                <a href="{{ route('client.bookings.create', ['service_id' => $service->id]) }}" class="text-{{ $colorTheme }} hover:underline text-sm font-medium">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback for when no services are available -->
                <div class="col-span-3 p-8 text-center">
                    <h3 class="text-2xl font-bold text-white">No services available in this category</h3>
                    <p class="text-gray-400 mt-2">Check back soon for new services or explore other categories!</p>
                </div>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-4 pt-12">
            <a href="{{ route('categories.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-secondary to-primary rounded-full blur opacity-70 group-hover:opacity-100 transition duration-200"></div>
                <button class="relative px-8 py-3 bg-dark rounded-full flex items-center justify-center group-hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5 transform rotate-180 group-hover:-translate-x-1 transition-transform mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    <span class="text-white font-medium">Back to Categories</span>
                </button>
            </a>
            
            <a href="{{ route('home') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 group-hover:opacity-100 transition duration-200"></div>
                <button class="relative px-8 py-3 bg-dark rounded-full flex items-center justify-center group-hover:-translate-y-1 transition-all duration-300">
                    <span class="text-white font-medium mr-2">Back to Home</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate the cards when they come into view
    const cards = document.querySelectorAll('.grid > div');
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
@endsection