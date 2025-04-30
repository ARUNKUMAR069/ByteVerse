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
                Choose the sponsorship package that aligns with your goals and budget. Custom packages are also available.
            </p>
        </div>
        
        <!-- Sponsor tiers grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Alpha Partner Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-purple-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-purple-400">Alpha Partner</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹1,00,000+</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Premium booth in high-traffic area
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Keynote speaking opportunity
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on event t-shirts & merchandise
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            10 VIP passes + 20 general passes
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Exclusive workshop branding
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary">
                        <span>Become Alpha Partner</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Hype Sponsor Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-cyan-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-cyan-400">Hype Sponsor</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹50,000</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Standard booth in main hall
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Panel participation opportunity
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on event banners & website
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            5 VIP passes + 10 general passes
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Branded hackathon category
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary">
                        <span>Become Hype Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Boost Sponsor Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-blue-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-blue-400">Boost Sponsor</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹30,000</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Table space for demos
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on event website
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Social media recognition
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            2 VIP passes + 5 general passes
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sponsored prize opportunity
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary">
                        <span>Become Boost Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Secondary Tiers Header -->
        <div class="text-center mt-16 mb-10">
            <h3 class="text-2xl font-orbitron font-bold">Additional <span class="text-cyan-400">Sponsorship</span> Options</h3>
            <p class="text-gray-300 mt-4 max-w-3xl mx-auto">
                We offer a variety of affordable sponsorship options to suit different goals and budgets.
            </p>
        </div>

        <!-- Secondary Tier Packages - Add this right after your "Additional Sponsorship Options" header -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <!-- Vibe Sponsor Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-gray-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-orbitron font-bold text-gray-300">Vibe Sponsor</h3>
                        <div class="text-sm text-gray-400 mt-1">(Silver Tier)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">₹20,000</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-gray-400 to-gray-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on posters & website
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Social media shoutout
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Certificate of appreciation
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Select This Tier</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Crew Sponsor Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-teal-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-orbitron font-bold text-teal-400">Crew Sponsor</h3>
                        <div class="text-sm text-gray-400 mt-1">(Community Tier)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">₹10,000</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-teal-400 to-teal-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-teal-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo/name listed as "Community Partner"
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-teal-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Digital appreciation certificate
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-teal-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Mention in post-event newsletter
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Select This Tier</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Green Soul Sponsor Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-green-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-orbitron font-bold text-green-400">Green Soul</h3>
                        <div class="text-sm text-gray-400 mt-1">(Eco Tier)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">₹7,000</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-green-400 to-green-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sponsor the plant distribution drive
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on Green Corner banner
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Featured in Eco Awareness Post
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Select This Tier</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Mystery Drop Partner Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-amber-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4 relative">
                        <div class="absolute -top-3 -right-3 bg-amber-500 text-xs text-black px-2 py-1 rounded transform rotate-12 font-bold">
                            Special
                        </div>
                        <h3 class="text-xl font-orbitron font-bold text-amber-400">Mystery Drop</h3>
                        <div class="text-sm text-gray-400 mt-1">(Prize Contributor)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">Custom</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-amber-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Mention as "Prize Pool Partner"
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-amber-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo under "Prize Powered By" on website
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-amber-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Recognition in winner reveal posts
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Become Prize Partner</span>
                        <i></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sponsor categories -->
        <div class="mt-20 max-w-5xl mx-auto">
            <h3 class="text-2xl font-orbitron font-bold mb-10 text-center">Sponsor <span class="text-cyan-400">Categories</span></h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-4 border-t-2 border-purple-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-purple-400">Alpha Partners</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24 bg-gray-800 rounded"></div>
                        <div class="h-10 w-24 bg-gray-800 rounded"></div>
                    </div>
                </div>
                
                <div class="p-4 border-t-2 border-cyan-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-cyan-400">Hype Sponsors</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24 bg-gray-800 rounded"></div>
                        <div class="h-10 w-24 bg-gray-800 rounded"></div>
                    </div>
                </div>
                
                <div class="p-4 border-t-2 border-blue-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-blue-400">Boost Sponsors</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24 bg-gray-800 rounded"></div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                <div class="p-3 border-t-2 border-gray-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-gray-300">Vibe Sponsors</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                    </div>
                </div>
                
                <div class="p-3 border-t-2 border-teal-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-teal-400">Crew Sponsors</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                    </div>
                </div>
                
                <div class="p-3 border-t-2 border-green-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-green-400">Green Soul</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                    </div>
                </div>
                
                <div class="p-3 border-t-2 border-amber-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-amber-400">Prize Partners</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                        <div class="h-8 w-20 bg-gray-800 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Sponsors Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Our <span class="text-cyan-400">Partners</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-12"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-10">
                We're proud to partner with these innovative organizations that make ByteVerse 1.0 possible.
            </p>
        </div>
        
        <!-- Sponsors grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 max-w-5xl mx-auto">
            <!-- Replace with actual sponsor logos - this is a placeholder structure -->
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor1.png" alt="Sponsor 1" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor2.png" alt="Sponsor 2" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor3.png" alt="Sponsor 3" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor4.png" alt="Sponsor 4" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor5.png" alt="Sponsor 5" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor6.png" alt="Sponsor 6" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor7.png" alt="Sponsor 7" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-purple-400 p-6 rounded-lg flex items-center justify-center group transition-all duration-300">
                <div class="text-center">
                    <div class="text-xl font-chakra text-cyan-400 mb-2">Your Logo Here</div>
                    <a href="#contact-form" class="text-sm text-white hover:text-cyan-400 transition-colors">Become a sponsor</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sponsor Contact Form -->
<section id="contact-form" class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gray-900/50 border border-cyan-400/20 rounded-xl p-8 backdrop-blur-sm">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Become a <span class="text-cyan-400">Sponsor</span></h2>
                <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
            </div>
            
            <form class="sponsor-form grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group md:col-span-1">
                    <label for="company" class="block text-sm font-chakra mb-2 text-cyan-400">Company Name *</label>
                    <input type="text" id="company" name="company" required class="w-full p-3 rounded-lg">
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="name" class="block text-sm font-chakra mb-2 text-cyan-400">Contact Person *</label>
                    <input type="text" id="name" name="name" required class="w-full p-3 rounded-lg">
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="email" class="block text-sm font-chakra mb-2 text-cyan-400">Email Address *</label>
                    <input type="email" id="email" name="email" required class="w-full p-3 rounded-lg">
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="phone" class="block text-sm font-chakra mb-2 text-cyan-400">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required class="w-full p-3 rounded-lg">
                </div>
                
                <div class="form-group md:col-span-2">
                    <label for="sponsorship_tier" class="block text-sm font-chakra mb-2 text-cyan-400">Interested Sponsorship Tier *</label>
                    <select id="sponsorship_tier" name="sponsorship_tier" required class="w-full p-3 rounded-lg">
                        <option value="">Select a tier</option>
                        <option value="alpha_partner">Alpha Partner (₹1,00,000+)</option>
                        <option value="hype_sponsor">Hype Sponsor (₹50,000)</option>
                        <option value="boost_sponsor">Boost Sponsor (₹30,000)</option>
                        <option value="vibe_sponsor">Vibe Sponsor (₹20,000)</option>
                        <option value="crew_sponsor">Crew Sponsor (₹10,000)</option>
                        <option value="green_soul">Green Soul Sponsor (₹7,000)</option>
                        <option value="mystery_drop">Mystery Drop Partner (Prize Support)</option>
                        <option value="custom">Custom Package</option>
                    </select>
                </div>
                
                <div class="form-group md:col-span-2">
                    <label for="message" class="block text-sm font-chakra mb-2 text-cyan-400">Additional Information or Requirements</label>
                    <textarea id="message" name="message" rows="5" class="w-full p-3 rounded-lg"></textarea>
                </div>
                
                <div class="form-group md:col-span-2 text-center">
                    <button type="submit" class="cyber-button primary">
                        <span>Submit Sponsorship Inquiry</span>
                        <i></i>
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center text-sm text-gray-400">
                <p>Our sponsorship team will get back to you within 48 hours to discuss your sponsorship opportunity.</p>
            </div>

            <!-- Form status message -->
            <div id="formStatus" class="form-status mt-6 hidden"></div>
        </div>
    </div>
</section>

<!-- Add form submission script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sponsorForm = document.querySelector('.sponsor-form');
    const formStatus = document.getElementById('formStatus');
    
    if (sponsorForm) {
        sponsorForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Get form data
            const company = document.getElementById("company").value.trim();
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const tier = document.getElementById("sponsorship_tier").value;
            
            // Simple validation
            if (!company || !name || !email || !phone || !tier) {
                showStatus("Please fill in all required fields.", "error");
                return;
            }
            
            // Email validation
            if (!validateEmail(email)) {
                showStatus("Please enter a valid email address.", "error");
                return;
            }
            
            // Simulate form submission
            showStatus("Sending your inquiry...", "pending");
            
            // Simulate API call delay
            setTimeout(() => {
                showStatus("Thank you for your interest! Our team will contact you within 48 hours.", "success");
                sponsorForm.reset();
            }, 1500);
        });
    }
    
    // Validate email format
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Display status message
    function showStatus(message, type) {
        formStatus.textContent = message;
        formStatus.className = "form-status mt-6";
        formStatus.classList.remove("hidden");
        
        if (type) {
            formStatus.classList.add(type);
        }
        
        // Clear success messages after 5 seconds
        if (type === "success") {
            setTimeout(() => {
                formStatus.classList.add("hidden");
            }, 5000);
        }
    }
});
</script>

<!-- Interactive Game Section -->
<?php require_once('components/circuit-game.php'); ?>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>