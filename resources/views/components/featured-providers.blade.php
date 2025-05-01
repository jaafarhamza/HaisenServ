<section class="relative py-10 overflow-hidden">
    <!-- Background effects -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-dark/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-48 bg-gradient-to-t from-dark/40 to-transparent"></div>
        <div class="absolute left-0 top-1/4 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute right-0 bottom-1/4 w-72 h-72 bg-secondary/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section header with animated underline -->
        <div
            class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-sm text-gray-200 mb-4">
            <span class="animate-pulse mr-2 h-2 w-2 rounded-full bg-primary"></span>
            <span>Trusted by thousands of clients</span>
        </div>
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 relative inline-block">
                Featured <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Service
                    Providers</span>
                <span
                    class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-primary/50 via-secondary/50 to-primary/50 rounded-full transform scale-x-0 transition-transform duration-700 group-hover:scale-x-100"
                    id="section-underline"></span>
            </h2>

            <p class="text-gray-400 text-lg">Meet our highest-rated professionals who consistently deliver exceptional
                service quality and customer satisfaction.</p>
        </div>

        <!-- Carousel controls -->
        <div class="flex justify-between items-center mb-10 flex-wrap">
            <div class="flex gap-2">
                <button
                    class="carousel-category px-4 py-2 rounded-lg bg-primary/20 backdrop-blur-sm text-primary border border-primary/30 text-sm font-medium transition-all duration-300 hover:bg-primary/30 active">All
                    Categories</button>
                <button
                    class="carousel-category px-4 py-2 rounded-lg bg-white/5 backdrop-blur-sm text-white border border-white/10 text-sm font-medium transition-all duration-300 hover:bg-white/10">Technology</button>
                <button
                    class="carousel-category px-4 py-2 rounded-lg bg-white/5 backdrop-blur-sm text-white border border-white/10 text-sm font-medium transition-all duration-300 hover:bg-white/10">Home
                    Services</button>
                <button
                    class="carousel-category px-4 py-2 rounded-lg bg-white/5 backdrop-blur-sm text-white border border-white/10 text-sm font-medium transition-all duration-300 hover:bg-white/10">Business</button>
            </div>

            <div class="flex gap-3">
                <button id="carousel-prev"
                    class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="carousel-next"
                    class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Carousel container with overflow -->
        <div class="relative overflow-hidden">
            <div id="carousel-slider" class="flex transition-transform duration-500 ease-out space-x-2">
                <!-- Provider Card 1 -->
                <div class="provider-card flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-primary/10 h-full">
                        <!-- Provider header with photo -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1531891437562-4301cf35b7e4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="Provider">

                            <!-- Verification Badge -->
                            <div
                                class="absolute top-3 right-3 z-20 bg-primary/20 backdrop-blur-md rounded-full p-1 border border-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Provider profile picture -->
                            <div class="absolute bottom-0 left-6 transform translate-y-1/2 z-20">
                                <div class="rounded-full p-1 bg-gradient-to-r from-primary to-secondary">
                                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-dark"
                                        alt="Sarah Johnson">
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div class="pt-10 px-6 pb-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-primary transition-colors duration-300">
                                        Sarah Johnson</h3>
                                    <p class="text-gray-400 text-sm">UX/UI Designer</p>
                                </div>
                                <div class="flex items-center bg-white/5 rounded-lg px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-white ml-1 text-sm font-medium">4.9</span>
                                </div>
                            </div>

                            <!-- Service details -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">78 Projects Completed</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-support mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">Usually responds within 4 hours</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-accent/10 text-accent text-xs rounded-full">Interior
                                    Design</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Home Decor</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Space
                                    Planning</span>
                            </div>

                            <!-- Testimonial -->
                            <div class="bg-white/5 rounded-lg p-3 border border-white/10 relative">
                                <div class="absolute -top-2 left-3 text-accent text-2xl">"</div>
                                <p class="text-gray-300 text-sm italic mt-1">Emily redesigned our entire office space
                                    and the result was incredible. She understood our brand and translated it into our
                                    environment.</p>
                                <div class="flex items-center mt-2">
                                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                                        class="w-6 h-6 rounded-full mr-2" alt="Client">
                                    <p class="text-xs text-gray-400">Alex R., Director at CreativeSpace</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-5">
                                <a href="#"
                                    class="block text-center py-2.5 rounded-lg bg-gradient-to-r from-accent to-support text-white font-medium hover:shadow-lg hover:shadow-accent/20 transition-all duration-300 transform hover:-translate-y-1">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Provider Card 2 -->
                <div class="provider-card flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-secondary/10 h-full">
                        <!-- Provider header with photo -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="Provider">

                            <!-- Verification Badge -->
                            <div
                                class="absolute top-3 right-3 z-20 bg-primary/20 backdrop-blur-md rounded-full p-1 border border-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Provider profile picture -->
                            <div class="absolute bottom-0 left-6 transform translate-y-1/2 z-20">
                                <div class="rounded-full p-1 bg-gradient-to-r from-secondary to-accent">
                                    <img src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-dark"
                                        alt="David Rodriguez">
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div class="pt-10 px-6 pb-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-secondary transition-colors duration-300">
                                        David Rodriguez</h3>
                                    <p class="text-gray-400 text-sm">Full-Stack Developer</p>
                                </div>
                                <div class="flex items-center bg-white/5 rounded-lg px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-white ml-1 text-sm font-medium">4.8</span>
                                </div>
                            </div>

                            <!-- Service details -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">93 Projects Completed</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">Usually responds within 3 hours</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    class="px-3 py-1 bg-secondary/10 text-secondary text-xs rounded-full">React</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Node.js</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">MongoDB</span>
                            </div>

                            <!-- Testimonial -->
                            <div class="bg-white/5 rounded-lg p-3 border border-white/10 relative">
                                <div class="absolute -top-2 left-3 text-secondary text-2xl">"</div>
                                <p class="text-gray-300 text-sm italic mt-1">David built our e-commerce platform from
                                    scratch and delivered it ahead of schedule. His technical expertise is outstanding!
                                </p>
                                <div class="flex items-center mt-2">
                                    <img src="https://images.unsplash.com/photo-1541823709867-1b206113eafd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                                        class="w-6 h-6 rounded-full mr-2" alt="Client">
                                    <p class="text-xs text-gray-400">Jennifer L., Founder of StyleMarket</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-5">
                                <a href="#"
                                    class="block text-center py-2.5 rounded-lg bg-gradient-to-r from-secondary to-accent text-white font-medium hover:shadow-lg hover:shadow-secondary/20 transition-all duration-300 transform hover:-translate-y-1">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Provider Card 4 -->
                <div class="provider-card flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-support/10 h-full">
                        <!-- Provider header with photo -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="Provider">

                            <!-- Verification Badge -->
                            <div
                                class="absolute top-3 right-3 z-20 bg-primary/20 backdrop-blur-md rounded-full p-1 border border-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Provider profile picture -->
                            <div class="absolute bottom-0 left-6 transform translate-y-1/2 z-20">
                                <div class="rounded-full p-1 bg-gradient-to-r from-support to-primary">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-dark"
                                        alt="James Wilson">
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div class="pt-10 px-6 pb-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-support transition-colors duration-300">
                                        James Wilson</h3>
                                    <p class="text-gray-400 text-sm">Marketing Consultant</p>
                                </div>
                                <div class="flex items-center bg-white/5 rounded-lg px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-white ml-1 text-sm font-medium">4.7</span>
                                </div>
                            </div>

                            <!-- Service details -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-support mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">105 Projects Completed</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">Usually responds within 2 hours</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-support/10 text-support text-xs rounded-full">Digital
                                    Marketing</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">SEO</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Social
                                    Media</span>
                            </div>

                            <!-- Testimonial -->
                            <div class="bg-white/5 rounded-lg p-3 border border-white/10 relative">
                                <div class="absolute -top-2 left-3 text-support text-2xl">"</div>
                                <p class="text-gray-300 text-sm italic mt-1">James helped us increase our online
                                    traffic by 230% in just three months. His strategic approach to marketing was
                                    exactly what we needed.</p>
                                <div class="flex items-center mt-2">
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                                        class="w-6 h-6 rounded-full mr-2" alt="Client">
                                    <p class="text-xs text-gray-400">Robert K., Owner of FitLife</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-5">
                                <a href="#"
                                    class="block text-center py-2.5 rounded-lg bg-gradient-to-r from-support to-primary text-white font-medium hover:shadow-lg hover:shadow-support/20 transition-all duration-300 transform hover:-translate-y-1">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Provider Card 1 -->
                <div class="provider-card flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-primary/10 h-full">
                        <!-- Provider header with photo -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1531891437562-4301cf35b7e4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="Provider">

                            <!-- Verification Badge -->
                            <div
                                class="absolute top-3 right-3 z-20 bg-primary/20 backdrop-blur-md rounded-full p-1 border border-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Provider profile picture -->
                            <div class="absolute bottom-0 left-6 transform translate-y-1/2 z-20">
                                <div class="rounded-full p-1 bg-gradient-to-r from-primary to-secondary">
                                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-dark"
                                        alt="Sarah Johnson">
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div class="pt-10 px-6 pb-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-primary transition-colors duration-300">
                                        Sarah Johnson</h3>
                                    <p class="text-gray-400 text-sm">UX/UI Designer</p>
                                </div>
                                <div class="flex items-center bg-white/5 rounded-lg px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-white ml-1 text-sm font-medium">4.9</span>
                                </div>
                            </div>

                            <!-- Service details -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">78 Projects Completed</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-support mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">Usually responds within 4 hours</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-accent/10 text-accent text-xs rounded-full">Interior
                                    Design</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Home Decor</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Space
                                    Planning</span>
                            </div>

                            <!-- Testimonial -->
                            <div class="bg-white/5 rounded-lg p-3 border border-white/10 relative">
                                <div class="absolute -top-2 left-3 text-accent text-2xl">"</div>
                                <p class="text-gray-300 text-sm italic mt-1">Emily redesigned our entire office space
                                    and the result was incredible. She understood our brand and translated it into our
                                    environment.</p>
                                <div class="flex items-center mt-2">
                                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                                        class="w-6 h-6 rounded-full mr-2" alt="Client">
                                    <p class="text-xs text-gray-400">Alex R., Director at CreativeSpace</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-5">
                                <a href="#"
                                    class="block text-center py-2.5 rounded-lg bg-gradient-to-r from-accent to-support text-white font-medium hover:shadow-lg hover:shadow-accent/20 transition-all duration-300 transform hover:-translate-y-1">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Provider Card 4 -->
                <div class="provider-card flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-support/10 h-full">
                        <!-- Provider header with photo -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="Provider">

                            <!-- Verification Badge -->
                            <div
                                class="absolute top-3 right-3 z-20 bg-primary/20 backdrop-blur-md rounded-full p-1 border border-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Provider profile picture -->
                            <div class="absolute bottom-0 left-6 transform translate-y-1/2 z-20">
                                <div class="rounded-full p-1 bg-gradient-to-r from-support to-primary">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-dark"
                                        alt="James Wilson">
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div class="pt-10 px-6 pb-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-support transition-colors duration-300">
                                        James Wilson</h3>
                                    <p class="text-gray-400 text-sm">Marketing Consultant</p>
                                </div>
                                <div class="flex items-center bg-white/5 rounded-lg px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-white ml-1 text-sm font-medium">4.7</span>
                                </div>
                            </div>

                            <!-- Service details -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-support mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">105 Projects Completed</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300 text-sm">Usually responds within 2 hours</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-support/10 text-support text-xs rounded-full">Digital
                                    Marketing</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">SEO</span>
                                <span class="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full">Social
                                    Media</span>
                            </div>

                            <!-- Testimonial -->
                            <div class="bg-white/5 rounded-lg p-3 border border-white/10 relative">
                                <div class="absolute -top-2 left-3 text-support text-2xl">"</div>
                                <p class="text-gray-300 text-sm italic mt-1">James helped us increase our online
                                    traffic by 230% in just three months. His strategic approach to marketing was
                                    exactly what we needed.</p>
                                <div class="flex items-center mt-2">
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                                        class="w-6 h-6 rounded-full mr-2" alt="Client">
                                    <p class="text-xs text-gray-400">Robert K., Owner of FitLife</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-5">
                                <a href="#"
                                    class="block text-center py-2.5 rounded-lg bg-gradient-to-r from-support to-primary text-white font-medium hover:shadow-lg hover:shadow-support/20 transition-all duration-300 transform hover:-translate-y-1">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation dots -->
            <div class="flex justify-center mt-8 space-x-2">
                <button class="w-3 h-3 rounded-full bg-primary transition-all duration-300"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white/30 hover:bg-white/50 transition-all duration-300"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white/30 hover:bg-white/50 transition-all duration-300"></button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate section underline
        const sectionUnderline = document.getElementById('section-underline');
        if (sectionUnderline) {
            setTimeout(() => {
                sectionUnderline.style.transform = 'scaleX(1)';
            }, 500);
        }

        // Initialize carousel functionality
        const carouselSlider = document.getElementById('carousel-slider');
        const prevButton = document.getElementById('carousel-prev');
        const nextButton = document.getElementById('carousel-next');
        const providerCards = document.querySelectorAll('.provider-card');

        if (!carouselSlider || !prevButton || !nextButton || !providerCards.length) return;

        let currentIndex = 0;
        const cardWidth = providerCards[0].offsetWidth;
        const cardsToShow = getCardsToShow();
        const maxIndex = providerCards.length - cardsToShow;

        // Calculate number of cards to show based on screen width
        function getCardsToShow() {
            if (window.innerWidth >= 1280) return 4; // xl
            if (window.innerWidth >= 1024) return 3; // lg
            if (window.innerWidth >= 640) return 2; // sm
            return 1; // mobile
        }

        // Update carousel on window resize
        window.addEventListener('resize', function() {
            const newCardsToShow = getCardsToShow();
            if (newCardsToShow !== cardsToShow) {
                currentIndex = 0;
                updateCarousel();
            }
        });

        // Handle previous button click
        prevButton.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            } else {
                // Optional: Loop to the end
                currentIndex = maxIndex;
                updateCarousel();
            }
        });

        // Handle next button click
        nextButton.addEventListener('click', function() {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateCarousel();
            } else {
                // Optional: Loop to the beginning
                currentIndex = 0;
                updateCarousel();
            }
        });

        // Update carousel position
        function updateCarousel() {
            const translateX = -currentIndex * (cardWidth + 24); // 24px is the gap (space-x-6)
            carouselSlider.style.transform = `translateX(${translateX}px)`;

            // Update navigation dots
            updateDots();
        }

        // Update navigation dots
        function updateDots() {
            const dots = document.querySelectorAll('.flex.justify-center.mt-8 button');
            if (!dots.length) return;

            dots.forEach((dot, index) => {
                if (index === Math.floor(currentIndex / (providerCards.length / dots.length))) {
                    dot.classList.remove('bg-white/30');
                    dot.classList.add('bg-primary');
                } else {
                    dot.classList.remove('bg-primary');
                    dot.classList.add('bg-white/30');
                }
            });
        }

        // Handle category filter clicks
        const categoryButtons = document.querySelectorAll('.carousel-category');
        if (categoryButtons.length) {
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-primary/20',
                            'border-primary/30');
                        btn.classList.add('bg-white/5', 'border-white/10');
                    });

                    // Add active class to clicked button
                    this.classList.add('active', 'bg-primary/20', 'border-primary/30');
                    this.classList.remove('bg-white/5', 'border-white/10');

                    // Here you would filter providers by category
                    // For demo, we'll just reset the carousel
                    currentIndex = 0;
                    updateCarousel();

                    // Add animation to provider cards
                    providerCards.forEach(card => {
                        card.style.opacity = '0.5';
                        card.style.transform = 'scale(0.95)';
                    });

                    setTimeout(() => {
                        providerCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'scale(1)';
                            }, index * 100);
                        });
                    }, 300);
                });
            });
        }

        // Initialize carousel by showing cards with an animation
        providerCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 150));
        });

        // Optional: Auto-scroll carousel every 5 seconds
        let autoScrollInterval = setInterval(() => {
            if (currentIndex < maxIndex) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        }, 5000);

        // Pause auto-scroll when user interacts with carousel
        carouselSlider.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });

        // Resume auto-scroll when user leaves carousel
        carouselSlider.addEventListener('mouseleave', () => {
            autoScrollInterval = setInterval(() => {
                if (currentIndex < maxIndex) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }, 5000);
        });
    });
</script>
