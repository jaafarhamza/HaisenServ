<section class="relative overflow-hidden pt-10 pb-16">
    <!-- Background decoration elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
        <!-- Animated dots grid -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute left-0 top-0 h-full w-full" id="dots-grid-explore"></div>
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header with animated underline -->
        <div class="flex flex-col items-center text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 relative">
                <span class="relative z-10">Explore Our <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Categories</span></span>
                <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-primary to-secondary rounded-full"></span>
            </h2>
            <p class="text-gray-400 text-lg">Discover all the service categories available through our platform, sorted by popularity and service availability.</p>
        </div>

        <!-- Category Cards Grid (3 columns on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @php
                // Sort categories by service count (most services first) and filter out zero service categories
                $sortedCategories = isset($categories) ? $categories->filter(function($category) {
                    $count = \App\Models\Service::where('category_id', $category->id)
                        ->where('status', 'active')
                        ->count();
                    return $count > 0;
                })->sortByDesc(function($category) {
                    return \App\Models\Service::where('category_id', $category->id)
                        ->where('status', 'active')
                        ->count();
                })->take(6) : collect([]);
            @endphp
            
            @if($sortedCategories->count() > 0)
                @foreach($sortedCategories as $index => $category)
                    @php
                        // Color themes based on index
                        $colorTheme = match($index % 4) {
                            0 => 'primary',
                            1 => 'secondary',
                            2 => 'accent',
                            3 => 'support'
                        };
                        
                        // Get service count for this category
                        $serviceCount = \App\Models\Service::where('category_id', $category->id)
                            ->where('status', 'active')
                            ->count();
                            
                        // Default placeholder images if none is provided
                        $images = [
                            'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1590402494610-2c378a9114c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1533745848184-3db07256e163?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80',
                        ];
                        $image = $category->icon_url ?? $images[$index % count($images)];
                    @endphp
                    
                    <a href="{{ route('categories.services', $category->id) }}" class="block group category-explore-card">
                        <div class="relative h-full bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-{{ $colorTheme }}/10">
                            <div class="absolute top-0 right-0 px-4 py-2 bg-{{ $colorTheme }}/20 backdrop-blur-sm text-{{ $colorTheme }} font-bold rounded-bl-xl z-20">
                                {{ $serviceCount }} Services
                            </div>
                            
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ $image }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $category->name }}">
                                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-dark/30 to-dark/90"></div>
                            </div>
                            
                            <div class="p-6 relative z-10">
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-{{ $colorTheme }} transition-colors">{{ $category->name }}</h3>
                                <p class="text-gray-400 mb-4">{{ \Illuminate\Support\Str::limit($category->description, 120) }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center text-{{ $colorTheme }} font-medium">
                                        <span class="mr-2">View Services</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                    
                                    <div class="flex -space-x-3">
                                        @for($i = 0; $i < min(3, $serviceCount); $i++)
                                            <div class="w-8 h-8 rounded-full bg-{{ $colorTheme }}/20 flex items-center justify-center text-white border-2 border-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        @endfor
                                        @if($serviceCount > 3)
                                            <div class="w-8 h-8 rounded-full bg-{{ $colorTheme }}/20 flex items-center justify-center text-white text-xs font-bold border-2 border-dark">
                                                +{{ $serviceCount - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Shine effect on hover -->
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none">
                                <div class="absolute inset-0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white to-transparent"></div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <!-- Fallback for when no categories are available -->
                <div class="col-span-3 p-8 text-center">
                    <h3 class="text-2xl font-bold text-white">No categories available</h3>
                    <p class="text-gray-400 mt-2">Check back soon for new service categories!</p>
                </div>
            @endif
        </div>

        <!-- View All Button -->
        <div class="flex justify-center">
            <a href="{{ route('categories.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 group-hover:opacity-100 transition duration-200"></div>
                <button class="relative px-8 py-3 bg-dark rounded-full flex items-center justify-center group-hover:-translate-y-1 transition-all duration-300">
                    <span class="text-white font-medium mr-2">View All Categories</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Create animated dots grid
    createDotsGrid();
    
    // Add scroll reveal animation to category cards
    animateCategoryCards();
    
    function createDotsGrid() {
        const dotsGrid = document.getElementById('dots-grid-explore');
        if (!dotsGrid) return;
        
        const gridSize = 20; // Number of dots in each row/column
        const containerWidth = dotsGrid.offsetWidth;
        const containerHeight = dotsGrid.offsetHeight;
        
        const dotSpacingX = containerWidth / gridSize;
        const dotSpacingY = containerHeight / gridSize;
        
        for (let y = 0; y < gridSize; y++) {
            for (let x = 0; x < gridSize; x++) {
                if ((x + y) % 3 !== 0) continue; // Skip some dots for sparser grid
                
                const dot = document.createElement('div');
                dot.className = 'absolute rounded-full bg-primary';
                dot.style.width = '3px';
                dot.style.height = '3px';
                dot.style.left = `${x * dotSpacingX}px`;
                dot.style.top = `${y * dotSpacingY}px`;
                dot.style.opacity = Math.random() * 0.5 + 0.1;
                
                // Random animation delay for each dot
                const animationDelay = Math.random() * 2;
                dot.style.animation = `pulse-dot 3s infinite ${animationDelay}s`;
                
                dotsGrid.appendChild(dot);
            }
        }
    }
    
    function animateCategoryCards() {
        const cards = document.querySelectorAll('.category-explore-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Staggered animation with delay based on index
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 150);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        cards.forEach((card, index) => {
            // Set initial state
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            
            observer.observe(card);
        });
    }
});
</script>

<style>
@keyframes pulse-dot {
    0% {
        transform: scale(0.8);
        opacity: 0.3;
    }
    50% {
        transform: scale(1);
        opacity: 0.6;
    }
    100% {
        transform: scale(0.8);
        opacity: 0.3;
    }
}
</style>