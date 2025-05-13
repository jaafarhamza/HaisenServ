<section class="relative overflow-hidden pt-10">
    <!-- Background decoration elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
        <!-- Animated dots grid -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute left-0 top-0 h-full w-full" id="dots-grid"></div>
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header with animated underline -->
        <div class="flex flex-col items-center text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 relative">
                <span class="relative z-10">Explore Our <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Services</span></span>
                <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-primary to-secondary rounded-full"></span>
            </h2>
            <p class="text-gray-400 text-lg">Discover all the services available through our platform and find the perfect match for your specific needs.</p>
        </div>

        <!-- Creative Masonry Grid Layout -->
        <div class="category-grid grid grid-cols-1 md:grid-cols-6 gap-6 mb-10">
            @if(isset($featuredCategories) && $featuredCategories->count() > 0)
                @foreach($featuredCategories as $index => $category)
                    @php
                        // Define grid classes based on index
                        $gridClasses = match($index) {
                            0 => 'md:col-span-3 md:row-span-2',
                            1 => 'md:col-span-3',
                            default => 'md:col-span-2'
                        };
                        
                        // Define color themes based on index
                        $colorTheme = match($index % 4) {
                            0 => 'primary',
                            1 => 'secondary',
                            2 => 'accent',
                            3 => 'support'
                        };
                        
                        // Get service count for this category
                        $serviceCount = App\Models\Service::where('category_id', $category->id)
                            ->where('status', 'active')
                            ->count();
                            
                        // Default placeholder images if icon_url is empty
                        $backgroundImages = [
                            'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1531973576160-7125cd663d86?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1587527901949-ab0341697c1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1560439514-4e9645039924?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                        ];
                        $backgroundImage = $category->icon_url ?? $backgroundImages[$index % count($backgroundImages)];
                    @endphp
                    
                    <div class="{{ $gridClasses }} group category-card">
                        <div class="h-full relative overflow-hidden rounded-2xl transition-all duration-500 transform group-hover:scale-[0.98]">
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-dark/50 to-dark/90 z-10"></div>
                            
                            <!-- Background Image -->
                            <img src="{{ $backgroundImage }}" 
                                 class="absolute w-full h-full object-cover transition-all duration-700 group-hover:scale-110" alt="{{ $category->name }}">
                            
                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 z-20">
                                <span class="inline-block px-4 py-1 rounded-full bg-{{ $colorTheme }}/20 backdrop-blur-sm text-{{ $colorTheme }} text-sm font-medium mb-3">{{ $serviceCount }} Services</span>
                                <h3 class="text-2xl md:text-3xl font-bold text-white mb-2 transition-transform duration-300 group-hover:translate-x-2">{{ $category->name }}</h3>
                                @if($index === 0 || $index === 1 || $index === 5)
                                    <p class="text-gray-300 mb-4 max-w-md transition-transform duration-300 group-hover:translate-x-2">{{ \Illuminate\Support\Str::limit($category->description, 100) }}</p>
                                @endif
                                
                                @if($index === 0 && isset($category->subcategories) && $category->subcategories->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($category->subcategories->take(3) as $subcategory)
                                            <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">{{ $subcategory->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Shine effect -->
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-20 z-10 transition-opacity duration-700 bg-gradient-to-tr from-white via-white to-transparent bg-[length:200%_200%] bg-[position:0%_0%] group-hover:bg-[position:100%_100%]"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback for when no categories are available -->
                <div class="md:col-span-6 p-8 text-center">
                    <h3 class="text-2xl font-bold text-white">No categories available</h3>
                    <p class="text-gray-400 mt-2">Check back soon for new service categories!</p>
                </div>
            @endif
        </div>
    </div>
</section>

<style>
.category-grid {
    min-height: 600px;
}

.category-card {
    min-height: 250px;
}

@media (min-width: 768px) {
    .category-card:nth-child(1) {
        height: 500px;
    }
    .category-card:nth-child(2) {
        height: 250px;
    }
    .category-card:nth-child(3),
    .category-card:nth-child(4),
    .category-card:nth-child(5) {
        height: 250px;
    }
    .category-card:nth-child(6) {
        height: 250px;
    }
}

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

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Create animated dots grid
    createDotsGrid();
    
    // Add scroll reveal animation to category cards
    animateCategoryCards();
    
    // Optional: Randomize card sizes on each page load for more dynamic layout
    randomizeCardSizes();
    
    function createDotsGrid() {
        const dotsGrid = document.getElementById('dots-grid');
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
        const cards = document.querySelectorAll('.category-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Staggered animation with delay based on index
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    
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
    
    function randomizeCardSizes() {
        // This function would randomize card sizes on each page load
        // We're keeping it minimal for this implementation
        // But you could add logic to randomly assign col-span and row-span classes
        const cards = document.querySelectorAll('.category-card');
        
        // Example: Randomly swap heights between some cards
        if (window.innerWidth >= 768) { // Only on desktop
            const randomIndex1 = Math.floor(Math.random() * (cards.length - 1)) + 1;
            const randomIndex2 = Math.floor(Math.random() * (cards.length - 1)) + 1;
            
            if (randomIndex1 !== randomIndex2) {
                const height1 = window.getComputedStyle(cards[randomIndex1]).height;
                const height2 = window.getComputedStyle(cards[randomIndex2]).height;
                
                cards[randomIndex1].style.height = height2;
                cards[randomIndex2].style.height = height1;
            }
        }
    }
});
</script>