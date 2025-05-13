<section class="relative py-20 overflow-hidden">
    <!-- Background design elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-dark/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-dark/40 to-transparent"></div>
        <div class="absolute right-0 top-1/4 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute left-0 bottom-1/4 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section header -->
        <div class="text-center mb-12 max-w-3xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-sm text-gray-200 mb-4">
                <span class="animate-pulse mr-2 h-2 w-2 rounded-full bg-primary"></span>
                <span>Global Service Network</span>
            </div>
            
            <h2 class="text-4xl font-bold mb-6">Service <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Coverage Areas</span></h2>
            
            <p class="text-gray-400 text-lg">Discover our extensive network of service providers available in your region. Our platform connects you with local professionals across the globe.</p>
        </div>

        <!-- Map and Stats Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Statistics Column -->
            <div class="lg:col-span-1 flex flex-col justify-center">
                <div class="space-y-8">
                    <!-- Region selector -->
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Explore Regions</h3>
                        <div class="space-y-2">
                            <button class="region-btn w-full flex items-center justify-between bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors active">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-white">North America</span>
                                </div>
                                <span class="text-primary">5,432 Providers</span>
                            </button>
                            
                            <button class="region-btn w-full flex items-center justify-between bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-secondary/20 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-white">Europe</span>
                                </div>
                                <span class="text-secondary">3,865 Providers</span>
                            </button>
                            
                            <button class="region-btn w-full flex items-center justify-between bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-accent/20 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-white">Asia</span>
                                </div>
                                <span class="text-accent">2,784 Providers</span>
                            </button>
                            
                            <button class="region-btn w-full flex items-center justify-between bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-support/20 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-support" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-white">Australia & Oceania</span>
                                </div>
                                <span class="text-support">1,246 Providers</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Coverage Statistics -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6">
                        <h3 class="text-xl font-semibold text-white mb-4">Coverage Highlights</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Cities Covered</span>
                                <span class="text-white font-medium">450+</span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-primary to-secondary h-1.5 rounded-full" style="width: 82%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Service Categories</span>
                                <span class="text-white font-medium">75+</span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-secondary to-accent h-1.5 rounded-full" style="width: 68%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Active Providers</span>
                                <span class="text-white font-medium">12,500+</span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-accent to-support h-1.5 rounded-full" style="width: 90%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Customer Coverage</span>
                                <span class="text-white font-medium">94%</span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-support to-primary h-1.5 rounded-full" style="width: 94%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Visualization Column -->
            <div class="lg:col-span-2">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 h-full relative overflow-hidden group">
                    <!-- Interactive Map Container -->
                    <div id="service-map" class="w-full h-[500px] rounded-lg overflow-hidden relative">
                        <!-- Map will be rendered here by JavaScript -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-r-2 border-primary mb-4"></div>
                                <p class="text-gray-400">Loading interactive map...</p>
                            </div>
                        </div>
                        
                        <!-- Service Provider Density Heatmap Legend -->
                        <div class="absolute bottom-4 left-4 bg-dark/80 backdrop-blur-md p-3 rounded-lg border border-white/10 opacity-0 transition-opacity duration-500" id="map-legend">
                            <h4 class="text-sm font-medium text-white mb-2">Provider Density</h4>
                            <div class="flex items-center space-x-2">
                                <div class="flex space-x-1">
                                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-orange-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-blue-500/80"></div>
                                </div>
                                <div class="flex justify-between w-full text-xs text-gray-400">
                                    <span>Low</span>
                                    <span>High</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Region Info Card (appears on hover) -->
                        <div class="absolute top-4 right-4 bg-dark/80 backdrop-blur-md p-4 rounded-lg border border-white/10 max-w-xs w-full opacity-0 transition-opacity duration-500" id="region-info">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="text-white font-medium">New York Metro Area</h4>
                                <div class="flex items-center bg-primary/20 px-2 py-1 rounded text-xs font-medium text-primary">
                                    <span class="mr-1">●</span> Active
                                </div>
                            </div>
                            
                            <div class="space-y-2 mb-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-400 text-sm">Service Providers:</span>
                                    <span class="text-white text-sm">1,245</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400 text-sm">Categories Available:</span>
                                    <span class="text-white text-sm">68</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400 text-sm">Response Time:</span>
                                    <span class="text-white text-sm">25 min avg</span>
                                </div>
                            </div>
                            
                            <div class="flex space-x-2 text-xs">
                                <span class="px-2 py-1 rounded-full bg-white/10 text-gray-300">Home Services</span>
                                <span class="px-2 py-1 rounded-full bg-white/10 text-gray-300">Tech</span>
                                <span class="px-2 py-1 rounded-full bg-white/10 text-gray-300">+66 more</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Find Providers In Your Area Button -->
                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-dark to-transparent flex justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button class="bg-gradient-to-r from-primary to-secondary text-white font-medium py-3 px-6 rounded-lg hover:shadow-lg hover:shadow-primary/20 transition-all duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Find Providers In Your Area
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- City Spotlight Section -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold mb-6">Featured <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Cities</span></h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- City Card 1 -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-primary/10">
                    <div class="relative h-32">
                        <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="New York">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <h4 class="text-white font-medium">New York</h4>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-300">1,245 Providers</span>
                                <span class="text-primary">●</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- City Card 2 -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-primary/10">
                    <div class="relative h-32">
                        <img src="https://images.unsplash.com/photo-1514565131-fce0801e5785?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Los Angeles">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <h4 class="text-white font-medium">Los Angeles</h4>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-300">986 Providers</span>
                                <span class="text-secondary">●</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- City Card 3 -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-primary/10">
                    <div class="relative h-32">
                        <img src="https://images.unsplash.com/photo-1526129318478-62ed807ebdf9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="London">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <h4 class="text-white font-medium">London</h4>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-300">854 Providers</span>
                                <span class="text-accent">●</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- City Card 4 -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-primary/10">
                    <div class="relative h-32">
                        <img src="https://images.unsplash.com/photo-1536098561742-ca998e48cbcc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Tokyo">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <h4 class="text-white font-medium">Tokyo</h4>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-300">765 Providers</span>
                                <span class="text-support">●</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Find Services Near You CTA -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 backdrop-blur-md rounded-2xl p-8 border border-white/10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Find Services Near You</h3>
                    <p class="text-gray-300 max-w-xl">Enter your location to discover available service providers in your area and get connected with local professionals instantly.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Enter your location" class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-white transition-all duration-300">
                    </div>
                    
                    <button class="bg-gradient-to-r from-primary to-secondary text-white font-medium py-3 px-6 rounded-lg hover:shadow-lg hover:shadow-primary/20 transition-all duration-300 whitespace-nowrap">
                        Find Services
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Leaflet Map CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map
    initMap();
    
    // Setup region selector buttons
    setupRegionButtons();
    
    // Animate progress bars
    animateProgressBars();
    
    function initMap() {
        // Check if the Leaflet library is loaded
        if (typeof L === 'undefined') {
            console.error('Leaflet library is not loaded');
            return;
        }
        
        // Default map center (North America)
        const map = L.map('service-map', {
            center: [39.8283, -98.5795], // Center of USA
            zoom: 3.5,
            zoomControl: false,
            attributionControl: false
        });
        
        // Add custom dark theme map tiles
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        
        // Add zoom control to the top-right corner
        L.control.zoom({
            position: 'topright'
        }).addTo(map);
        
        // Add hotspots for major cities in North America
        const hotspots = [
            { latlng: [40.7128, -74.0060], name: "New York", providers: 1245, intensity: 0.9 },
            { latlng: [34.0522, -118.2437], name: "Los Angeles", providers: 986, intensity: 0.85 },
            { latlng: [41.8781, -87.6298], name: "Chicago", providers: 765, intensity: 0.8 },
            { latlng: [29.7604, -95.3698], name: "Houston", providers: 654, intensity: 0.75 },
            { latlng: [43.6532, -79.3832], name: "Toronto", providers: 589, intensity: 0.7 },
            { latlng: [49.2827, -123.1207], name: "Vancouver", providers: 432, intensity: 0.6 },
            { latlng: [25.7617, -80.1918], name: "Miami", providers: 521, intensity: 0.65 },
            { latlng: [37.7749, -122.4194], name: "San Francisco", providers: 612, intensity: 0.75 },
            { latlng: [39.9526, -75.1652], name: "Philadelphia", providers: 487, intensity: 0.65 },
            { latlng: [45.5017, -73.5673], name: "Montreal", providers: 398, intensity: 0.55 },
            { latlng: [47.6062, -122.3321], name: "Seattle", providers: 537, intensity: 0.7 },
            { latlng: [33.4484, -112.0740], name: "Phoenix", providers: 423, intensity: 0.6 },
            { latlng: [39.7392, -104.9903], name: "Denver", providers: 376, intensity: 0.55 },
            { latlng: [19.4326, -99.1332], name: "Mexico City", providers: 442, intensity: 0.6 },
            { latlng: [33.7490, -84.3880], name: "Atlanta", providers: 465, intensity: 0.65 }
        ];
        
        // Create markers with different sizes based on intensity
        hotspots.forEach(spot => {
            // Create a pulsing circle marker for each hotspot
            const size = 15 + (spot.intensity * 25); // Size based on intensity
            
            // Create a circle with a pulsing animation
            const circle = L.circleMarker(spot.latlng, {
                radius: size / 2,
                fillColor: color,
                color: color,
                weight: 1,
                opacity: 0.8,
                fillOpacity: 0.6
            }).addTo(map);
            
            // Add a pulse effect
            const pulseCircle = L.circleMarker(spot.latlng, {
                radius: size / 2,
                fillColor: color,
                color: color,
                weight: 1,
                opacity: 0.4,
                fillOpacity: 0.2
            }).addTo(map);
            
            // Animate the pulse
            let pulseSize = size / 2;
            const pulseAnimation = setInterval(() => {
                pulseSize += 0.5;
                if (pulseSize > size) {
                    pulseSize = size / 2;
                    pulseCircle.setStyle({
                        opacity: 0.4,
                        fillOpacity: 0.2
                    });
                }
                pulseCircle.setRadius(pulseSize);
                pulseCircle.setStyle({
                    opacity: Math.max(0.1, 0.4 - (pulseSize / size) * 0.4),
                    fillOpacity: Math.max(0.05, 0.2 - (pulseSize / size) * 0.2)
                });
            }, 50);
            
            // Create popup with info
            const popupContent = `
                <div class="bg-dark text-white p-2 rounded">
                    <h3 class="font-medium">${spot.name}</h3>
                    <p class="text-sm text-gray-300">${spot.providers} Service Providers</p>
                </div>
            `;
            
            // Add a popup on hover
            circle.bindPopup(popupContent, {
                className: 'custom-popup',
                closeButton: false
            });
            
            // Show region info card on hover
            circle.on('mouseover', function(e) {
                circle.openPopup();
                
                // Update and show region info card
                const regionInfo = document.getElementById('region-info');
                if (regionInfo) {
                    regionInfo.querySelector('h4').textContent = spot.name;
                    regionInfo.querySelectorAll('.flex.justify-between span:last-child')[0].textContent = `${spot.providers}`;
                    regionInfo.style.opacity = '1';
                }
            });
            
            circle.on('mouseout', function(e) {
                circle.closePopup();
                
                // Hide region info card
                const regionInfo = document.getElementById('region-info');
                if (regionInfo) {
                    regionInfo.style.opacity = '0';
                }
            });
        });
        
        // Show the map legend after a short delay
        setTimeout(() => {
            const mapLegend = document.getElementById('map-legend');
            if (mapLegend) {
                mapLegend.style.opacity = '1';
            }
        }, 1000);
    }
    
    function setupRegionButtons() {
        const regionButtons = document.querySelectorAll('.region-btn');
        
        regionButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                regionButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.querySelector('.w-8.h-8').classList.remove('bg-primary/20', 'bg-secondary/20', 'bg-accent/20', 'bg-support/20');
                    btn.querySelector('.w-8.h-8').classList.add('bg-white/10');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get region name
                const regionName = this.querySelector('.font-medium').textContent;
                
                // Update map based on region
                updateMapRegion(regionName);
            });
        });
    }
    
    function updateMapRegion(region) {
        // Check if Leaflet is loaded
        if (typeof L === 'undefined' || !L.map) return;
        
        // Get map instance
        const map = L.map('service-map');
        
        // Set view based on selected region
        switch(region) {
            case 'North America':
                map.setView([39.8283, -98.5795], 3.5);
                break;
            case 'Europe':
                map.setView([54.5260, 15.2551], 4);
                break;
            case 'Asia':
                map.setView([34.0479, 100.6197], 3);
                break;
            case 'Australia & Oceania':
                map.setView([-25.2744, 133.7751], 4);
                break;
            default:
                map.setView([39.8283, -98.5795], 3.5);
        }
        
        // Show region has been changed with a flash effect
        const mapContainer = document.getElementById('service-map');
        
        if (mapContainer) {
            // Add flash effect
            const flashOverlay = document.createElement('div');
            flashOverlay.className = 'absolute inset-0 bg-white/10 z-50 pointer-events-none';
            flashOverlay.style.animation = 'flash-animation 0.5s';
            mapContainer.appendChild(flashOverlay);
            
            // Remove flash effect after animation
            setTimeout(() => {
                mapContainer.removeChild(flashOverlay);
            }, 500);
        }
    }
    
    function animateProgressBars() {
        const progressBars = document.querySelectorAll('.bg-white\\/10.rounded-full.h-1\\.5 > div');
        
        progressBars.forEach(bar => {
            // Get the target width percentage
            const targetWidth = bar.style.width;
            
            // Start from 0
            bar.style.width = '0%';
            
            // Animate to target width
            setTimeout(() => {
                bar.style.transition = 'width 1.5s ease-in-out';
                bar.style.width = targetWidth;
            }, 300);
        });
    }
});
</script>

<style>
/* Custom Popup Style */
.custom-popup .leaflet-popup-content-wrapper {
    background-color: rgba(17, 24, 39, 0.9);
    border-radius: 8px;
}

.custom-popup .leaflet-popup-tip {
    background-color: rgba(17, 24, 39, 0.9);
}

/* Flash Animation */
@keyframes flash-animation {
    0% { opacity: 0; }
    50% { opacity: 1; }
    100% { opacity: 0; }
}

/* Active button styles */
.region-btn.active {
    border-color: rgba(99, 102, 241, 0.5);
    background-color: rgba(99, 102, 241, 0.1);
}
</style>