<section class="relative py-20 overflow-hidden">
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
            <h2 class="text-3xl font-bold mb-4">More Service <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Categories</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Browse through our comprehensive range of service categories, each offering specialized solutions to meet your specific requirements.</p>
        </div>

        <!-- Category Pills Row -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button class="category-pill px-6 py-2 rounded-full bg-primary/20 backdrop-blur-sm border border-primary/30 text-white font-medium transition-all hover:bg-primary/30 hover:scale-105 active">All Categories</button>
            <button class="category-pill px-6 py-2 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 text-white font-medium transition-all hover:bg-white/10 hover:scale-105">Popular</button>
            <button class="category-pill px-6 py-2 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 text-white font-medium transition-all hover:bg-white/10 hover:scale-105">New</button>
            <button class="category-pill px-6 py-2 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 text-white font-medium transition-all hover:bg-white/10 hover:scale-105">Indoor</button>
            <button class="category-pill px-6 py-2 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 text-white font-medium transition-all hover:bg-white/10 hover:scale-105">Outdoor</button>
        </div>

        <!-- Category Cards Grid (3 columns on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Category 1 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-primary/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Professional Services">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-primary/20 backdrop-blur-sm text-primary text-xs">42 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Professional Services</h3>
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Consultancy, accounting, legal advice, and professional business services.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Consulting</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Legal</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Financial</span>
                    </div>
                </div>
            </div>

            <!-- Category 2 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-secondary/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Creative & Design">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-secondary/20 backdrop-blur-sm text-secondary text-xs">38 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Creative & Design</h3>
                        <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Graphic design, UI/UX design, branding, and creative services for businesses and individuals.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Graphics</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">UI/UX</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Branding</span>
                    </div>
                </div>
            </div>

            <!-- Category 3 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-accent/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Marketing">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-accent/20 backdrop-blur-sm text-accent text-xs">53 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Marketing</h3>
                        <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Digital marketing, SEO, social media management, content creation and advertising services.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">SEO</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Social Media</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Content</span>
                    </div>
                </div>
            </div>

            <!-- Category 4 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-support/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1590402494610-2c378a9114c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Automotive">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-support/20 backdrop-blur-sm text-support text-xs">28 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Automotive</h3>
                        <div class="w-10 h-10 rounded-full bg-support/10 flex items-center justify-center text-support group-hover:bg-support group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Car repair, maintenance, detailing, inspections and automotive support services.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Repair</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Maintenance</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Detailing</span>
                    </div>
                </div>
            </div>

            <!-- Category 5 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-primary/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1533745848184-3db07256e163?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Photography">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-primary/20 backdrop-blur-sm text-primary text-xs">35 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Photography</h3>
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Portrait photography, event coverage, product photography and photography services.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Portrait</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Events</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Product</span>
                    </div>
                </div>
            </div>

            <!-- Category 6 -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 group hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:shadow-secondary/10">
                <div class="h-40 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Fitness">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-secondary/20 backdrop-blur-sm text-secondary text-xs">33 Services</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-white">Fitness</h3>
                        <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Personal training, fitness coaching, nutrition plans and health consulting services.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Training</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Nutrition</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs">Coaching</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Button -->
        <div class="flex justify-center pt-12">
            <a href="#" class="group relative">
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
    
    // Category pill selection
    const categoryPills = document.querySelectorAll('.category-pill');
    categoryPills.forEach(pill => {
        pill.addEventListener('click', function() {
            // Remove active class from all pills
            categoryPills.forEach(p => p.classList.remove('active', 'bg-primary/20', 'border-primary/30'));
            categoryPills.forEach(p => p.classList.add('bg-white/5', 'border-white/10'));
            
            // Add active class to clicked pill
            this.classList.add('active', 'bg-primary/20', 'border-primary/30');
            this.classList.remove('bg-white/5', 'border-white/10');
            
            // Here you would normally filter the categories
            // For demo purposes, just simulate a loading state
            cards.forEach(card => {
                card.style.opacity = '0.5';
                card.style.transform = 'scale(0.98)';
            });
            
            setTimeout(() => {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, index * 50);
                });
            }, 300);
        });
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

.category-pill.active {
    position: relative;
    overflow: hidden;
}

.category-pill.active::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(99, 102, 241, 0), rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0));
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% {
        background-position: 100% 0;
    }
    100% {
        background-position: -100% 0;
    }
}
</style>