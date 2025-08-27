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
                Join ByteVerse as a sponsor and connect with the brightest tech talent. Choose a tier that aligns with your goals.
            </p>
        </div>
        
        <!-- Sponsor tiers grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Title Sponsor Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-red-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-rose-400">Title Sponsor</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹50,000+</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-rose-400 to-red-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-rose-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Highest level of visibility and branding
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-rose-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on T-shirts, certificates, banners, posters
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-rose-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Stall space + speaking opportunity
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-rose-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Featured on social media, website & event stage mentions
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6 flex items-center justify-center">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary" >
                        <span>Become Title Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Gold Sponsor Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-yellow-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-yellow-400">Gold Sponsor</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹25,000+</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-yellow-400 to-amber-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on website, flyers, banners, and certificates
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Social media recognition
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Medium-size logo on T-shirts
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Option to provide goodies or branded merchandise
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6 flex items-center justify-center">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary">
                        <span>Become Gold Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Silver Sponsor Tier -->
            <div class="sponsor-tier p-6 rounded-lg border border-gray-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-orbitron font-bold text-gray-300">Silver Sponsor</h3>
                        <div class="text-xl mt-2 mb-4 font-chakra">₹10,000+</div>
                        <div class="w-16 h-1 bg-gradient-to-r from-gray-400 to-gray-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-6 space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Logo on selected promotional material (flyers, banners)
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Small-size logo inclusion
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Verbal mention during event + digital certificate of appreciation
                        </li>
                    </ul>
                </div>

                <div class="mt-6 flex items-center justify-center">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button primary">
                        <span>Become Silver Sponsor</span>
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

        <!-- Secondary Tier Packages -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
            <!-- Supporter Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-indigo-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-orbitron font-bold text-indigo-400">Supporter</h3>
                        <div class="text-sm text-gray-400 mt-1">(Community Tier)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">Under ₹10,000</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-indigo-400 to-indigo-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm ">
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-indigo-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Name/logo on digital flyers and website
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-indigo-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Mention in post-event thank-you posts
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-indigo-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Recognition in the closing ceremony
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6 flex items-center justify-center">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Become Supporter</span>
                        <i></i>
                    </a>
                </div>
            </div>
            
            <!-- Mission Go Green Sponsor Tier -->
            <div class="sponsor-tier p-5 rounded-lg border border-green-500 bg-opacity-20 backdrop-blur-sm bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-orbitron font-bold text-green-400">Mission Go Green</h3>
                        <div class="text-sm text-gray-400 mt-1">(Eco Tier)</div>
                        <div class="text-lg mt-2 mb-3 font-chakra">Custom</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-green-400 to-green-600 mx-auto"></div>
                    </div>
                    
                    <ul class="mt-4 space-y-2 text-gray-300 text-sm">
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Contribution to our tree plantation initiative
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Name/logo featured on "Go Green" banner
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="h-4 w-4 text-green-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Certificate of appreciation + shout out
                        </li>
                    </ul>
                </div>

                <div class="mt-6 flex items-center justify-center">
                    <a href="#contact-form" class="block w-full py-2 px-4 text-center rounded cyber-button secondary-sm">
                        <span>Become Green Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sponsor categories -->
        <div class="mt-20 max-w-5xl mx-auto">
            <h3 class="text-2xl font-orbitron font-bold mb-10 text-center">Sponsor <span class="text-cyan-400">Categories</span></h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-4 border-t-2 border-rose-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-rose-400">Title Sponsors</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                    </div>
                </div>
                
                <div class="p-4 border-t-2 border-yellow-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-yellow-400">Gold Sponsors</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                    </div>
                </div>
                
                <div class="p-4 border-t-2 border-gray-500">
                    <h4 class="text-xl font-chakra font-bold mb-3 text-gray-300">Silver Sponsors</h4>
                    <div class="flex flex-wrap gap-4">
                        <!-- Add real sponsor logos here -->
                        <div class="h-10 w-24  rounded">
                            <img src="assets/images/sponsors/idfc.png" alt="Sponsor 3" class="max-h-10">
                        </div>
                        <div class="h-10 w-12 rounded">
                            <img src="assets/images/sponsors/chinar_forge_limited_logo.png" alt="Sponsor 4" class="max-h-5">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="p-3 border-t-2 border-indigo-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-indigo-400">Supporters</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
                    </div>
                </div>
                
                <div class="p-3 border-t-2 border-green-500">
                    <h4 class="text-lg font-chakra font-bold mb-2 text-green-400">Mission Go Green Sponsors</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="h-10 w-24 bg-gray-800 rounded flex items-center justify-center">COMING SOON</div>
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
                <img src="assets/Images/sponsors/chinar_forge_limited_logo.png" alt="Sponsor 1" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/Images/sponsors/idfc.png" alt="Sponsor 2" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor3.png" alt="COMING SOON" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor4.png" alt="COMING SOON" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor5.png" alt="COMING SOON" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor6.png" alt="COMING SOON" class="sponsor-logo max-h-16">
            </div>
            
            <div class="sponsor-logo-container bg-gray-900/50 border border-gray-700 hover:border-cyan-400 p-6 rounded-lg flex items-center justify-center transition-all duration-300">
                <img src="assets/images/sponsors/sponsor7.png" alt="COMING SOON" class="sponsor-logo max-h-16">
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

<!-- Payment Details Section -->
<section class="py-8 md:py-12 relative">
    <div class="container mx-auto px-3 md:px-4">
        <div class="max-w-4xl mx-auto bg-gray-900/50 border border-cyan-400/20 rounded-xl p-4 md:p-6 backdrop-blur-sm payment-details-container">
            <div class="text-center mb-4 md:mb-8">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-orbitron font-bold mb-3 md:mb-4">Payment <span class="text-cyan-400">Details</span></h2>
                <div class="w-16 md:w-20 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-3 md:mb-4"></div>
                <p class="text-sm md:text-base text-gray-300 max-w-3xl mx-auto mb-4 md:mb-6">
                    Secure your sponsorship by making a direct bank transfer using the details below.
                </p>
            </div>
            
            <div class="payment-info-box bg-gray-800/40 rounded-lg p-3 md:p-5 border border-gray-700 hover:border-cyan-400/30 transition-all duration-300">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                    <div class="payment-info-item p-2 md:p-3 bg-gray-800/70 rounded-md border border-gray-700">
                        <div class="payment-info-label text-xs md:text-sm text-cyan-400 mb-1 font-chakra">Account Name</div>
                        <div class="payment-info-value text-white text-sm md:text-base font-medium">CT Educational Society (CTES)</div>
                    </div>
                    
                    <div class="payment-info-item p-2 md:p-3 bg-gray-800/70 rounded-md border border-gray-700">
                        <div class="payment-info-label text-xs md:text-sm text-cyan-400 mb-1 font-chakra">Account Number</div>
                        <div class="payment-info-value text-white text-sm md:text-base font-medium select-all">6916000100000225</div>
                    </div>
                    
                    <div class="payment-info-item p-2 md:p-3 bg-gray-800/70 rounded-md border border-gray-700 sm:col-span-2">
                        <div class="payment-info-label text-xs md:text-sm text-cyan-400 mb-1 font-chakra">IFSC Code</div>
                        <div class="payment-info-value text-white text-sm md:text-base font-medium select-all">PUNB0691600</div>
                    </div>
                </div>
                
                <div class="payment-info-note bg-gray-800/40 p-3 rounded-md text-center text-xs md:text-sm">
                    <p class="mb-2">Please mention <span class="text-cyan-400 font-medium">"ByteVerse Sponsorship"</span> and your company name in the payment reference.</p>
                    <p>After making the payment, please notify us at <a href="mailto:info_byteverse@ctgroup.in" class="text-cyan-400 hover:underline break-words">info_byteverse@ctgroup.in</a> with your transaction details.</p>
                </div>
            </div>
            
          
        </div>
    </div>
</section>

<!-- Sponsor Contact Form -->
<section id="contact-form" class="py-12 md:py-20 relative">
    <div class="container mx-auto px-3 md:px-4">
        <div class="max-w-4xl mx-auto bg-gray-900/50 border border-cyan-400/20 rounded-xl p-4 md:p-6 lg:p-8 backdrop-blur-sm">
            <div class="text-center mb-6 md:mb-10">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-orbitron font-bold mb-4 md:mb-6">Become a <span class="text-cyan-400">Sponsor</span></h2>
                <div class="w-16 md:w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
            </div>
            
            <!-- Added security attributes: novalidate for custom validation, autocomplete off -->
            <form id="sponsor-form" class="sponsor-form grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6" novalidate autocomplete="off">
                <!-- CSRF protection token -->
                <input type="hidden" name="csrf_token" value="<?php echo isset($_SESSION['csrf_token']) ? htmlspecialchars($_SESSION['csrf_token']) : ''; ?>">
                
                <!-- Honeypot field to catch bots - hidden from real users -->
                <div class="form-group" style="display:none; position: absolute; left: -9999px;">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="company" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Company Name *</label>
                    <input type="text" id="company" name="company" 
                           required 
                           class="w-full p-2 md:p-3 rounded-lg text-base" 
                           placeholder="Your company name"
                           maxlength="100"
                           pattern="^[A-Za-z0-9\s\.,'-]{2,100}$">
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="name" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Contact Person *</label>
                    <input type="text" id="name" name="name" 
                           required 
                           class="w-full p-2 md:p-3 rounded-lg text-base" 
                           placeholder="Full name"
                           maxlength="50"
                           pattern="^[A-Za-z\s.-]{2,50}$">
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="email" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Email Address *</label>
                    <input type="email" id="email" name="email" 
                           required 
                           class="w-full p-2 md:p-3 rounded-lg text-base" 
                           placeholder="email@company.com"
                           maxlength="100"
                           pattern="^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$">
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-1">
                    <label for="phone" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" 
                           required 
                           class="w-full p-2 md:p-3 rounded-lg text-base" 
                           placeholder="Your contact number"
                           maxlength="20"
                           pattern="^[0-9+\-\s()]{10,20}$">
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-2">
                    <label for="sponsorship_tier" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Interested Sponsorship Tier *</label>
                    <select id="sponsorship_tier" name="sponsorship_tier" required class="w-full p-2 md:p-3 rounded-lg text-base">
                        <option value="">Select a tier</option>
                        <option value="title_sponsor">Title Sponsor (₹50,000+)</option>
                        <option value="gold_sponsor">Gold Sponsor (₹25,000+)</option>
                        <option value="silver_sponsor">Silver Sponsor (₹10,000+)</option>
                        <option value="supporter">Supporter (Under ₹10,000)</option>
                        <option value="green_soul">Mission Go Green Sponsor</option>
                        <option value="custom">Custom Package</option>
                    </select>
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-2">
                    <label for="message" class="block text-sm font-chakra mb-1 md:mb-2 text-cyan-400">Additional Information or Requirements</label>
                    <textarea id="message" name="message" 
                              rows="4" 
                              class="w-full p-2 md:p-3 rounded-lg text-base" 
                              placeholder="Tell us about your sponsorship goals and any specific requirements"
                              maxlength="1000"></textarea>
                    <div class="char-count text-xs text-gray-400 mt-1 text-right"><span id="messageChars">0</span>/1000</div>
                    <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                </div>
                
                <div class="form-group md:col-span-2 text-center mt-2 md:mt-4 flex items-center justify-center">
                    <button type="submit" id="submitBtn" class="cyber-button primary w-full md:w-auto py-3 md:py-2 px-3 md:px-6 text-base">
                        <span>Submit</span>
                        <i></i>
                    </button>
                </div>
            </form>
            
            <div class="mt-6 md:mt-8 text-center text-xs md:text-sm text-gray-400">
                <p>Our sponsorship team will get back to you within 48 hours to discuss your sponsorship opportunity.</p>
            </div>

            <!-- Form status message -->
            <div id="formStatus" class="form-status mt-4 md:mt-6 hidden"></div>
        </div>
    </div>
</section>

<!-- Add form submission script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sponsorForm = document.getElementById('sponsor-form');
    const formStatus = document.getElementById('formStatus');
    const submitBtn = document.getElementById('submitBtn');
    const messageField = document.getElementById('message');
    const messageChars = document.getElementById('messageChars');
    
    // Character counter for message field
    if (messageField && messageChars) {
        updateCharCount();
        
        messageField.addEventListener("input", function() {
            updateCharCount();
        });
    }
    
    function updateCharCount() {
        const length = messageField.value.length;
        messageChars.textContent = length;
        
        // Visual feedback for character limit
        if (length > 900) {
            messageChars.style.color = length >= 1000 ? "#ef4444" : "#f59e0b";
        } else {
            messageChars.style.color = "";
        }
    }
    
    // Validation functions with security checks
    const validators = {
        company: (value) => {
            const regex = /^[A-Za-z0-9\s\.,'-]{2,100}$/;
            return {
                valid: regex.test(value),
                message: "Company name should only contain letters, numbers, spaces, and basic punctuation"
            };
        },
        name: (value) => {
            const regex = /^[A-Za-z\s.-]{2,50}$/;
            return {
                valid: regex.test(value),
                message: "Please enter a valid name (letters, spaces, dots, and hyphens only)"
            };
        },
        email: (value) => {
            const regex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
            return {
                valid: regex.test(value),
                message: "Please enter a valid email address"
            };
        },
        phone: (value) => {
            const regex = /^[0-9+\-\s()]{10,20}$/;
            return {
                valid: regex.test(value),
                message: "Please enter a valid phone number (10-20 digits)"
            };
        },
        sponsorship_tier: (value) => {
            return {
                valid: value !== "",
                message: "Please select a sponsorship tier"
            };
        },
        message: (value) => {
            if (value.length > 1000) {
                return {
                    valid: false,
                    message: "Message is too long (maximum 1000 characters)"
                };
            }
            
            // Check for potentially malicious content
            const dangerousPatterns = [
                /<script/i, 
                /<\/script>/i, 
                /<iframe/i, 
                /javascript:/i, 
                /onerror=/i, 
                /onload=/i, 
                /onclick=/i,
                /eval\(/i
            ];
            
            const hasDangerousPattern = dangerousPatterns.some(pattern => pattern.test(value));
            
            return {
                valid: !hasDangerousPattern,
                message: hasDangerousPattern ? "Message contains disallowed content" : ""
            };
        }
    };
    
    // Sanitize input to prevent XSS
    function sanitizeInput(input) {
        if (!input) return '';
        
        return input
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
    
    // Validate individual field
    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        const errorElement = field.nextElementSibling;
        
        // Skip validation for non-required empty fields
        if (!field.required && !value) {
            hideError(field);
            return true;
        }
        
        // Required field check
        if (field.required && !value) {
            showError(field, "This field is required");
            return false;
        }
        
        // Field-specific validation
        if (validators[fieldName]) {
            const validation = validators[fieldName](value);
            if (!validation.valid) {
                showError(field, validation.message);
                return false;
            }
        }
        
        hideError(field);
        return true;
    }
    
    function showError(field, message) {
        field.classList.add('error-input');
        const errorElement = field.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
    }
    
    function hideError(field) {
        field.classList.remove('error-input');
        const errorElement = field.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.classList.add('hidden');
        }
    }
    
    // Set up form submission with security
    if (sponsorForm) {
        // Validate fields on blur
        const formInputs = sponsorForm.querySelectorAll('input:not([type="hidden"]), select, textarea');
        formInputs.forEach(input => {
            if (input.id === 'website') return; // Skip honeypot field
            
            input.addEventListener('blur', () => {
                if (input.value.trim()) {
                    validateField(input);
                }
            });
            
            input.addEventListener('input', () => {
                // Clear error when user starts typing
                hideError(input);
            });
        });
        
        // Form submission handler with security checks
        sponsorForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Disable button to prevent double submission
            submitBtn.disabled = true;
            
            // Check honeypot field (bot detection)
            const honeypot = document.getElementById('website');
            if (honeypot && honeypot.value) {
                console.log('Bot submission detected');
                // Pretend the form submitted successfully to fool the bot
                setTimeout(() => {
                    showStatus("Thank you for your interest! Our team will contact you soon.", "success");
                    sponsorForm.reset();
                    submitBtn.disabled = false;
                }, 1500);
                return;
            }
            
            // Validate all form fields
            let formValid = true;
            
            formInputs.forEach(input => {
                if (input.id === 'website') return; // Skip honeypot field
                
                if (!validateField(input)) {
                    formValid = false;
                }
            });
            
            if (!formValid) {
                showStatus("Please correct the errors in the form", "error");
                submitBtn.disabled = false;
                return;
            }
            
            // Show sending status
            showStatus("Sending your inquiry...", "pending");
            
            // Create FormData with sanitized inputs
            const formData = new FormData();
            
            // Sanitize and add all input values
            formData.append('company', sanitizeInput(document.getElementById('company').value.trim()));
            formData.append('name', sanitizeInput(document.getElementById('name').value.trim()));
            formData.append('email', sanitizeInput(document.getElementById('email').value.trim()));
            formData.append('phone', sanitizeInput(document.getElementById('phone').value.trim()));
            formData.append('sponsorship_tier', document.getElementById('sponsorship_tier').value);
            
            const messageValue = document.getElementById('message').value.trim();
            formData.append('message', sanitizeInput(messageValue));
            
            // Add timestamp to prevent caching
            formData.append('timestamp', new Date().getTime());
            
            // Send data to the server with security headers
            fetch('backend/api/sponsor.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Network error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showStatus(data.message, "success");
                    sponsorForm.reset();
                    
                    // Reset character counter
                    if (messageChars) {
                        messageChars.textContent = '0';
                        messageChars.style.color = '';
                    }
                } else {
                    showStatus(data.message || "An error occurred", "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showStatus("An error occurred. Please try again later.", "error");
            })
            .finally(() => {
                // Re-enable the submit button
                submitBtn.disabled = false;
            });
        });
    }
    
    // Display status message with enhanced styling
    function showStatus(message, type) {
        if (!formStatus) return;
        
        formStatus.textContent = message;
        formStatus.className = "form-status mt-6 p-4 rounded-lg";
        formStatus.classList.remove("hidden");
        
        switch(type) {
            case 'success':
                formStatus.classList.add('bg-green-900/30', 'text-green-400', 'border', 'border-green-400/30');
                formStatus.innerHTML = `<svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> ${message}`;
                break;
            case 'error':
                formStatus.classList.add('bg-red-900/30', 'text-red-400', 'border', 'border-red-400/30');
                formStatus.innerHTML = `<svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> ${message}`;
                break;
            case 'pending':
                formStatus.classList.add('bg-blue-900/30', 'text-blue-400', 'border', 'border-blue-400/30');
                formStatus.innerHTML = `<svg class="inline w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> ${message}`;
                break;
        }
        
        // Scroll to the status message
        formStatus.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Auto-hide success messages after 5 seconds
        if (type === "success") {
            setTimeout(() => {
                formStatus.style.opacity = '0';
                formStatus.style.transition = 'opacity 0.5s ease';
                
                setTimeout(() => {
                    formStatus.classList.add("hidden");
                    formStatus.style.opacity = '1';
                }, 500);
            }, 5000);
        }
    }
});
</script>
<style>
/* Sponsorship H1 Responsive - IMPORTANT */
@media (max-width: 320px) {
    .glitch-text {
        font-size: 1.75rem !important;
        letter-spacing: 1px !important;
        line-height: 1.1 !important;
    }
    
    .max-w-3xl p {
        font-size: 0.875rem !important;
        line-height: 1.4 !important;
    }
}

@media (min-width: 321px) and (max-width: 374px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 1px !important;
    }
    
    .max-w-3xl p {
        font-size: 0.9375rem !important;
    }
}

@media (min-width: 375px) and (max-width: 424px) {
    .glitch-text {
        font-size: 2.25rem !important;
        letter-spacing: 2px !important;
    }
    
    .max-w-3xl p {
        font-size: 1rem !important;
    }
}

@media (min-width: 425px) and (max-width: 639px) {
    .glitch-text {
        font-size: 2.5rem !important;
        letter-spacing: 2px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.125rem !important;
    }
}

@media (min-width: 640px) and (max-width: 767px) {
    .glitch-text {
        font-size: 3rem !important;
        letter-spacing: 3px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.25rem !important;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .glitch-text {
        font-size: 3.5rem !important;
        letter-spacing: 3px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.375rem !important;
    }
}

@media (min-width: 1024px) {
    .glitch-text {
        font-size: 4rem !important;
        letter-spacing: 4px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.5rem !important;
    }
}

/* Mobile Landscape for Sponsorship */
@media (max-height: 500px) and (orientation: landscape) and (max-width: 896px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 2px !important;
        margin-bottom: 1rem !important;
    }
    
    .max-w-3xl p {
        font-size: 0.875rem !important;
        margin-bottom: 2rem !important;
    }
}

/* Container padding adjustments for Sponsorship */
@media (max-width: 640px) {
    .container {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    .py-20 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
}

/* Form validation styles */
.sponsor-form input.error-input,
.sponsor-form select.error-input,
.sponsor-form textarea.error-input {
    border-color: #ef4444 !important;
    background-color: rgba(239, 68, 68, 0.05);
}

.sponsor-form input:focus,
.sponsor-form select:focus,
.sponsor-form textarea:focus {
    outline: none;
    border-color: #06b6d4;
}

.error-message {
    font-size: 0.75rem;
    margin-top: 0.25rem;
    color: #ef4444;
}

/* Status message styles */
.form-status {
    transition: all 0.3s ease;
}

/* Character counter */
.char-count {
    text-align: right;
    font-size: 0.75rem;
    color: #94a3b8;
    transition: color 0.3s ease;
}

/* Disabled button state */
.cyber-button[disabled] {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Loading spinner animation */
@keyframes spin {
    to {transform: rotate(360deg);}
}
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>