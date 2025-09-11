<?php
// Page-specific variables
$pageTitle = 'Sponsorship | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Sponsors';
$loaderText = 'Loading sponsorship data...';
$currentPage = 'sponsor';

// Use link to external CSS instead of inline styles
$additionalStyles = '';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- In the header.php file, add this line below the main CSS file -->
<link rel="stylesheet" href="assets/css/sponsor.css">

<!-- Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Sponsorship">Sponsorship</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Partner with ByteVerse 1.0 to connect with the brightest minds in tech and showcase your brand
                at the forefront of innovation. Together, let's build the future.
            </p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-8">
            <a href="#sponsor-tiers" class="cyber-button primary">
                <span>Sponsorship Packages</span>
                <i></i>
            </a>
            <a href="#contact-form" class="cyber-button secondary">
                <span>Become a Sponsor</span>
                <i></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Sponsor Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="data-circuit"></div>
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Why <span class="text-cyan-400">Sponsor</span> ByteVerse?</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
            <div class="relative p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 transform transition-all hover:-translate-y-2 hover:border-cyan-400" data-aos="fade-up">
                <div class="absolute -top-5 -left-5 w-10 h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold">1</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white">Talent Recruitment</h3>
                <p class="text-gray-300">Connect with over 500 talented developers, designers, and innovators from across the tech ecosystem.</p>
            </div>
            
            <div class="relative p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 transform transition-all hover:-translate-y-2 hover:border-cyan-400" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute -top-5 -left-5 w-10 h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold">2</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white">Brand Visibility</h3>
                <p class="text-gray-300">Showcase your brand to a tech-focused audience and gain exposure through our marketing channels and press coverage.</p>
            </div>
            
            <div class="relative p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 transform transition-all hover:-translate-y-2 hover:border-cyan-400" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute -top-5 -left-5 w-10 h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold">3</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white">Product Feedback</h3>
                <p class="text-gray-300">Get real-time feedback on your APIs, tools, and platforms from developers who will build with them during the event.</p>
            </div>
        </div>
        
        <div class="text-center mt-16">
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                ByteVerse offers a unique opportunity to engage with the next generation of tech talent while positioning your organization as a leader in innovation.
            </p>
        </div>
    </div>
</section>

<!-- Sponsor Tier Showcase Section -->
<section id="sponsor-tiers" class="py-20 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Sponsorship <span class="text-cyan-400">Packages</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-12"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-10">
                Join ByteVerse as a sponsor and connect with the brightest tech talent. Compare tiers to find the perfect match for your goals.
            </p>
        </div>
        
        <!-- Sponsorship Tiers Comparison Table -->
        <div class="relative max-w-7xl mx-auto px-4">
            <!-- Mobile scroll indicator -->
            <div class="md:hidden text-center mb-4 text-gray-400 text-sm flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg>
                Scroll horizontally to view all tiers
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg>
            </div>
            
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-cyan-500 scrollbar-track-gray-800 rounded-lg shadow-lg border border-gray-700">
                <!-- Scroll fade indicators -->
                <div class="absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-gray-900 to-transparent pointer-events-none z-10 md:hidden"></div>
                <div class="absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-gray-900 to-transparent pointer-events-none z-10 md:hidden"></div>
                
                <table class="w-full min-w-[900px] border-collapse">
                    <!-- Table Header -->
                    <thead>
                        <tr>
                            <!-- Benefits Column Header -->
                            <th class="w-1/3 p-4 bg-gray-800/80 border border-gray-600 rounded-tl-lg text-left">
                                <h3 class="text-xl font-orbitron text-white">Benefits</h3>
                            </th>
                            
                            <!-- Title Sponsor Column Header -->
                            <th class="w-1/6 p-4 bg-rose-900/20 border border-rose-500/30 relative overflow-hidden text-center">
                                <div class="absolute -top-2 -right-12 w-24 h-6 bg-rose-500 rotate-45 flex items-center justify-center">
                                    <span class="text-xs font-bold text-gray-900">PREMIER</span>
                                </div>
                                <h3 class="text-lg font-orbitron text-rose-400">Title Sponsor</h3>
                                <p class="text-xl font-chakra mt-1 font-bold">₹50,000+</p>
                            </th>
                            
                            <!-- Gold Sponsor Column Header -->
                            <th class="w-1/6 p-4 bg-amber-900/20 border border-amber-500/30 text-center">
                                <h3 class="text-lg font-orbitron text-amber-400">Gold</h3>
                                <p class="text-xl font-chakra mt-1 font-bold">₹30,000+</p>
                            </th>
                            
                            <!-- Silver Sponsor Column Header -->
                            <th class="w-1/6 p-4 bg-gray-700/20 border border-gray-500/30 text-center">
                                <h3 class="text-lg font-orbitron text-gray-300">Silver</h3>
                                <p class="text-xl font-chakra mt-1 font-bold">₹20,000+</p>
                            </th>
                            
                            <!-- Support Tier Column Header -->
                            <th class="w-1/6 p-4 bg-indigo-900/20 border border-indigo-500/30 rounded-tr-lg text-center">
                                <h3 class="text-lg font-orbitron text-indigo-400">Support</h3>
                                <p class="text-xl font-chakra mt-1 font-bold">₹10,000+</p>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!-- Table Row Group - Branding Benefits -->
                        <tr>
                            <td colspan="5" class="p-2 bg-gray-900 border-x border-gray-600 text-center">
                                <span class="text-cyan-400 font-orbitron text-sm tracking-wider">BRANDING BENEFITS</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Logo on Event Website -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Logo on Event Website</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-indigo-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Logo on Event T-shirts -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Logo on Event T-shirts</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500 font-medium">Premium</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500 font-medium">Standard</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300 font-medium">Small</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Logo on Banners & Posters -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Logo on Banners & Posters</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500 font-medium">Premium</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Logo on Certificates -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Logo on Certificates</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row Group - Event Benefits -->
                        <tr>
                            <td colspan="5" class="p-2 bg-gray-900 border-x border-gray-600 text-center">
                                <span class="text-purple-400 font-orbitron text-sm tracking-wider">EVENT BENEFITS</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Branding -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Branding</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-indigo-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Speaking Right -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Speaking Right</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Product Showcasing -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Product Showcasing</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Judging Role -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Judging Role</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Workshops -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Workshops</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Social Media Collab -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Social Media Collab</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-indigo-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row Group - Additional Benefits -->
                        <tr>
                            <td colspan="5" class="p-2 bg-gray-900 border-x border-gray-600 text-center">
                                <span class="text-cyan-400 font-orbitron text-sm tracking-wider">ADDITIONAL BENEFITS</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - AfterMovie -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">AfterMovie</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Inauguration -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Inauguration</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Creative Assets -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Creative Assets</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Special Installation -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Special Installation</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Recognition -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Recognition</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-indigo-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Memorandums -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Memorandums</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-indigo-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Verbal Mention -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Verbal Mention</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Problem Statement -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Problem Statement</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Logo Placement -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Logo Placement</span>
                            </td>
                            <td class="bg-rose-900/10 p-4 border border-rose-500/20 text-center">
                                <span class="text-rose-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-amber-900/10 p-4 border border-amber-500/20 text-center">
                                <span class="text-amber-500">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-gray-700/10 p-4 border border-gray-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-indigo-900/10 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Row - Marketing Collateral -->
                        <tr>
                            <td class="p-4 bg-gray-800/30 border border-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-cyan-500 mr-2"></div>
                                <span class="font-chakra font-medium text-white">Marketing Collateral</span>
                            </td>
                            <td class="bg-rose-900/5 p-4 border border-rose-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-amber-900/5 p-4 border border-amber-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                            <td class="bg-gray-700/5 p-4 border border-gray-500/20 text-center">
                                <span class="text-gray-300">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Yes</span>
                            </td>
                            <td class="bg-indigo-900/5 p-4 border border-indigo-500/20 text-center">
                                <span class="text-red-400">
                                    <svg class="h-6 w-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">No</span>
                            </td>
                        </tr>
                        
                        <!-- Table Footer - Action Buttons -->
                        <tr>
                            <td class="p-4 bg-gray-800/60 border border-gray-600 rounded-bl-lg"></td>
                            <td class="p-4 bg-rose-900/10 border border-rose-500/20 text-center">
                                <a href="#contact-form" class="inline-block w-full text-center py-2 px-4 bg-rose-500/80 hover:bg-rose-600 text-white font-bold rounded-md transition-colors">
                                    Select Tier
                                </a>
                            </td>
                            <td class="p-4 bg-amber-900/10 border border-amber-500/20 text-center">
                                <a href="#contact-form" class="inline-block w-full text-center py-2 px-4 bg-amber-500/80 hover:bg-amber-600 text-white font-bold rounded-md transition-colors">
                                    Select Tier
                                </a>
                            </td>
                            <td class="p-4 bg-gray-700/10 border border-gray-500/20 text-center">
                                <a href="#contact-form" class="inline-block w-full text-center py-2 px-4 bg-gray-500/80 hover:bg-gray-600 text-white font-bold rounded-md transition-colors">
                                    Select Tier
                                </a>
                            </td>
                            <td class="p-4 bg-indigo-900/10 border border-indigo-500/20 rounded-br-lg text-center">
                                <a href="#contact-form" class="inline-block w-full text-center py-2 px-4 bg-indigo-500/80 hover:bg-indigo-600 text-white font-bold rounded-md transition-colors">
                                    Select Tier
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Mission Go Green Special Section -->
        <!-- <div class="mt-16 max-w-3xl mx-auto bg-gray-800/30 border border-green-500/20 rounded-lg p-6">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="w-full md:w-1/3">
                    <div class="bg-green-900/20 rounded-full h-40 w-40 mx-auto flex items-center justify-center border-2 border-green-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                </div>
                
                <div class="w-full md:w-2/3 text-center md:text-left">
                    <h3 class="text-2xl font-orbitron font-bold text-green-400 mb-3">Mission Go Green</h3>
                    <p class="text-gray-300 mb-4">Support our environmental initiatives and showcase your company's commitment to sustainability. This special sponsorship tier helps fund our tree planting efforts.</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-800/60 p-3 rounded flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">Green Banner Recognition</span>
                        </div>
                        <div class="bg-gray-800/60 p-3 rounded flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">Environmental Shoutout</span>
                        </div>
                    </div>
                    
                    <div class="text-center md:text-left">
                        <a href="#contact-form" class="inline-block py-2 px-6 bg-green-500/80 hover:bg-green-600 text-white font-bold rounded-md transition-colors">
                            Become a Green Sponsor
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
        

    </div>
</section>

<style>
.scrollbar-thin::-webkit-scrollbar {
    height: 8px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background-color: rgba(31, 41, 55, 0.3);
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: rgba(6, 182, 212, 0.5);
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background-color: rgba(6, 182, 212, 0.7);
}

/* Custom animation for scroll indicator */
@keyframes gentle-pulse {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}

.animate-pulse {
    animation: gentle-pulse 1.5s infinite ease-in-out;
}

/* Make sure the table is always centered */
table {
    margin: 0 auto;
    border-spacing: 0;
}

/* Ensure borders connect properly */
td, th {
    position: relative;
    border-collapse: collapse;
}

/* Add glow effect to borders on hover */
table:hover {
    box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
}

@media (max-width: 768px) {
    .scrollbar-thin {
        padding-bottom: 12px;
    }
}
</style>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>