<?php

// Page-specific variables
$pageTitle = 'Challenges | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Challenges';
$loaderText = 'Loading challenge domains...';
$currentPage = 'challenges';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Innovation Domains">Innovation Domains</h1>
        <div class="max-w-4xl mx-auto">
            <p class="text-lg md:text-xl mb-6 text-gray-300 leading-relaxed">
                Explore five cutting-edge domains where technology meets real-world challenges. Each domain represents a unique opportunity to create meaningful impact through innovation.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <div class="bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-lg p-4 backdrop-blur-sm">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                        <span class="text-cyan-400 font-semibold text-sm">Technology Freedom</span>
                    </div>
                    <p class="text-gray-300 text-xs">Use any tech stack of your choice</p>
                </div>
                <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-500/20 rounded-lg p-4 backdrop-blur-sm">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                        <span class="text-purple-400 font-semibold text-sm">Real Impact</span>
                    </div>
                    <p class="text-gray-300 text-xs">Solve meaningful real-world problems</p>
                </div>
                <div class="bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/20 rounded-lg p-4 backdrop-blur-sm">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-green-400 font-semibold text-sm">Innovation Focus</span>
                    </div>
                    <p class="text-gray-300 text-xs">Push boundaries with creative solutions</p>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-8">
            <a href="#domains" class="cyber-button primary">
                <span>Explore Domains</span>
                <i></i>
            </a>
            <a href="registration.php" class="cyber-button secondary">
                <span>Register Team</span>
                <i></i>
            </a>
        </div>
    </div>
    
    <!-- Floating elements -->
    <div class="floating-elements">
        <div class="floating-cube cube-1"></div>
        <div class="floating-cube cube-2"></div>
        <div class="floating-cube cube-3"></div>
        <div class="floating-sphere"></div>
    </div>
</section>

<!-- Challenge Domains Bento Grid -->
<section id="domains" class="py-16 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Innovation <span class="text-cyan-400">Domains</span></h2>
            <div class="w-32 h-1 bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-lg text-gray-300 max-w-4xl mx-auto mb-6">
                Five specialized domains where cutting-edge technology meets real-world impact. Each domain offers unique opportunities to showcase your innovation and creativity.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto mb-8">
                <div class="bg-gradient-to-r from-cyan-500/10 to-blue-500/10 backdrop-blur-md border border-cyan-400/30 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <p class="text-cyan-400 font-semibold">Complete Technology Freedom</p>
                    </div>
                    <p class="text-gray-300 text-sm">Choose any programming languages, frameworks, or platforms that best suit your solution.</p>
                </div>
                <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 backdrop-blur-md border border-purple-400/30 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <p class="text-purple-400 font-semibold">Innovation-Driven Approach</p>
                    </div>
                    <p class="text-gray-300 text-sm">Focus on creative problem-solving and breakthrough solutions that make a real difference.</p>
                </div>
            </div>
        </div>
        
        <!-- Clean Domain Cards Grid -->
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Agriculture Domain -->
                <div class="clean-domain-card">
                    <div class="absolute top-4 right-4">
                        <span class="domain-tag sustainable">SUSTAINABLE</span>
                    </div>
                    <div class="domain-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" class="domain-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="domain-title">Agriculture</h3>
                    <p class="domain-description">Revolutionize farming with sustainable technology solutions</p>
                </div>

                <!-- Healthcare Domain -->
                <div class="clean-domain-card">
                    <div class="absolute top-4 right-4">
                        <span class="domain-tag critical">CRITICAL</span>
                    </div>
                    <div class="domain-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" class="domain-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="domain-title">Healthcare</h3>
                    <p class="domain-description">Build tech innovations to improve healthcare accessibility</p>
                </div>

                <!-- IoT & XR Tech Domain -->
                <div class="clean-domain-card">
                    <div class="absolute top-4 right-4">
                        <span class="domain-tag immersive">IMMERSIVE</span>
                    </div>
                    <div class="domain-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" class="domain-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="domain-title">IoT & XR Tech</h3>
                    <p class="domain-description">Connect digital and physical worlds through immersive technology</p>
                </div>

                <!-- Cyber Security Domain -->
                <div class="clean-domain-card">
                    <div class="absolute top-4 right-4">
                        <span class="domain-tag secure">SECURE</span>
                    </div>
                    <div class="domain-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" class="domain-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="domain-title">Cyber Security</h3>
                    <p class="domain-description">Build the next generation of digital defense systems</p>
                </div>

                <!-- Open Innovation Domain -->
                <div class="clean-domain-card md:col-span-2 lg:col-span-1">
                    <div class="absolute top-4 right-4">
                        <span class="domain-tag freestyle">FREESTYLE</span>
                    </div>
                    <div class="domain-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" class="domain-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="domain-title">Open Innovation</h3>
                    <p class="domain-description">Push technological boundaries with your unique ideas</p>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Challenge Process Section -->
<section class="py-16 relative">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Challenge <span class="text-cyan-400">Process</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-8"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                How the ByteVerse hackathon challenges work, from selection to submission.
            </p>
        </div>
        
        <!-- Process Steps -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 max-w-6xl mx-auto">
            <!-- Step 1 -->
            <div class="process-step bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 relative" data-aos="fade-up">
                <div class="step-number absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold text-sm sm:text-base">1</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white pt-2">Select Domain</h3>
                <p class="text-gray-300">Choose from one of our five challenge domains based on your team's interests and expertise.</p>
            </div>
            
            <!-- Step 2 -->
            <div class="process-step bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 relative" data-aos="fade-up" data-aos-delay="100">
                <div class="step-number absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold text-sm sm:text-base">2</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white pt-2">Form Team</h3>
                <p class="text-gray-300">Gather a team of 3-5 members with complementary skills to tackle the challenge effectively.</p>
            </div>
            
            <!-- Step 3 -->
            <div class="process-step bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 relative" data-aos="fade-up" data-aos-delay="200">
                <div class="step-number absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold text-sm sm:text-base">3</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white pt-2">Build Solution</h3>
                <p class="text-gray-300">Develop your innovative solution during the 24-hour hackathon with support from our mentors.</p>
            </div>
            
            <!-- Step 4 -->
            <div class="process-step bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 relative" data-aos="fade-up" data-aos-delay="300">
                <div class="step-number absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-cyan-400 flex items-center justify-center text-gray-900 font-bold text-sm sm:text-base">4</div>
                <h3 class="text-xl font-chakra font-bold mb-4 text-white pt-2">Present & Win</h3>
                <p class="text-gray-300">Showcase your solution to our panel of expert judges and compete for exciting prizes and recognition.</p>
            </div>
        </div>
    </div>
</section>

<!-- Prizes Section -->
<section class="py-16 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Challenge <span class="text-cyan-400">Prizes</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-8"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                Exciting rewards await the most innovative solutions in each domain.
            </p>
        </div>
        
        <!-- Coming Soon Banner -->
        <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-400/20 rounded-xl p-4 sm:p-8 md:p-12 max-w-5xl mx-auto relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-cyan-500/5 to-purple-600/5 z-0"></div>
            
            <div class="relative z-10 text-center">
                <div class="mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-cyan-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6 text-white glitch-text" data-text="Coming Soon">Coming Soon</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    We're finalizing our exciting prize pool for ByteVerse 1.0! Stay tuned for announcements about cash prizes, internship opportunities, tech gadgets, and special category awards.
                </p>
                <div class="cyber-button-border w-full sm:w-auto inline-block text-sm sm:text-base">
                    <div class="cyber-button-glitch"></div>
                    <div class="cyber-button-tag px-4 sm:px-8 py-2 sm:py-3">Prize Announcements Coming Soon</div>
                </div>
                
                <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 max-w-6xl mx-auto">
                    <div class="prize-placeholder bg-opacity-10 backdrop-blur-md bg-gray-800 border border-gray-700/30 rounded-lg p-4">
                        <h4 class="text-lg font-chakra text-amber-400 mb-2">1st Place</h4>
                        <p class="text-gray-400 text-sm">Details coming soon</p>
                    </div>
                    
                    <div class="prize-placeholder bg-opacity-10 backdrop-blur-md bg-gray-800 border border-gray-700/30 rounded-lg p-4">
                        <h4 class="text-lg font-chakra text-gray-400 mb-2">2nd Place</h4>
                        <p class="text-gray-400 text-sm">Details coming soon</p>
                    </div>
                    
                    <div class="prize-placeholder bg-opacity-10 backdrop-blur-md bg-gray-800 border border-gray-700/30 rounded-lg p-4">
                        <h4 class="text-lg font-chakra text-amber-700 mb-2">3rd Place</h4>
                        <p class="text-gray-400 text-sm">Details coming soon</p>
                    </div>
                    
                    <div class="prize-placeholder bg-opacity-10 backdrop-blur-md bg-gray-800 border border-gray-700/30 rounded-lg p-4">
                        <h4 class="text-lg font-chakra text-cyan-400 mb-2">Domain Prizes</h4>
                        <p class="text-gray-400 text-sm">Details coming soon</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Special Category Prizes Teaser -->
        <div class="mt-12 text-center">
            <h3 class="text-2xl font-orbitron font-bold mb-4">Special Category Prizes</h3>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-8">
                We'll also announce special prizes for excellence in specific areas
            </p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="special-prize bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-4">
                    <h4 class="text-lg font-chakra text-cyan-400 mb-2">Best UI/UX Design</h4>
                    <p class="text-gray-400 text-sm">Coming soon</p>
                </div>
                
                <div class="special-prize bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-4">
                    <h4 class="text-lg font-chakra text-cyan-400 mb-2">Most Innovative Solution</h4>
                    <p class="text-gray-400 text-sm">Coming soon</p>
                </div>
                
                <div class="special-prize bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-4">
                    <h4 class="text-lg font-chakra text-cyan-400 mb-2">Best Use of AI/ML</h4>
                    <p class="text-gray-400 text-sm">Coming soon</p>
                </div>
                
                <div class="special-prize bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-4">
                    <h4 class="text-lg font-chakra text-cyan-400 mb-2">Social Impact Award</h4>
                    <p class="text-gray-400 text-sm">Coming soon</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Call to Action Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-400/20 rounded-xl p-8 md:p-12 max-w-5xl mx-auto relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-cyan-500/5 to-purple-600/5 z-0"></div>
            
            <div class="relative z-10 text-center">
                <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6 text-white">Ready to Take on the Challenge?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Join ByteVerse 1.0 and be part of a community of innovators building solutions for a better future. Register your team today!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-6 justify-center items-center">
                    <a href="registration.php" class="cyber-button primary w-full sm:w-auto">
                        <span>Register Now</span>
                        <i></i>
                    </a>
                    <a href="schedule.php" class="cyber-button secondary w-full sm:w-auto">
                        <span>View Schedule</span>
                        <i></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Early Bird Popup -->
<div id="earlyBirdPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-cyan-400/30 rounded-xl p-8 max-w-md mx-4 relative overflow-hidden">
        <!-- Close button -->
        <button id="closePopup" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <!-- Background glow effect -->
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-cyan-500/10 to-purple-600/10 z-0"></div>
        
        <div class="relative z-10 text-center">
            <!-- Early Bird Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full text-white font-bold text-sm mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                EARLY BIRD SPECIAL
            </div>
            
            <!-- Main heading -->
            <h2 class="text-2xl font-orbitron font-bold text-white mb-4">
                🎉 Early Bird Registration is <span class="text-cyan-400">LIVE!</span>
            </h2>
            
            <!-- Offer details -->
            <div class="bg-cyan-900/20 border border-cyan-500/30 rounded-lg p-4 mb-6">
                <p class="text-cyan-300 font-semibold text-lg mb-2">FREE Registration</p>
                <p class="text-gray-300 text-sm mb-3">Limited time offer - Only for the first 2 days!</p>
                
                <!-- Countdown timer -->
                <div class="flex justify-center space-x-4 mb-4">
                    <div class="text-center">
                        <div id="days" class="text-2xl font-bold text-cyan-400">01</div>
                        <div class="text-xs text-gray-400">DAYS</div>
                    </div>
                    <div class="text-center">
                        <div id="hours" class="text-2xl font-bold text-cyan-400">23</div>
                        <div class="text-xs text-gray-400">HOURS</div>
                    </div>
                    <div class="text-center">
                        <div id="minutes" class="text-2xl font-bold text-cyan-400">45</div>
                        <div class="text-xs text-gray-400">MINS</div>
                    </div>
                    <div class="text-center">
                        <div id="seconds" class="text-2xl font-bold text-cyan-400">30</div>
                        <div class="text-xs text-gray-400">SECS</div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="registration.php" class="cyber-button primary flex-1">
                    <span>Register Now - FREE!</span>
                    <i></i>
                </a>
                <button id="remindLater" class="cyber-button secondary flex-1">
                    <span>Remind Me Later</span>
                    <i></i>
                </button>
            </div>
            
            <p class="text-xs text-gray-400 mt-4">*After early bird period, regular registration fees apply</p>
        </div>
    </div>
</div>

<style>
/* Clean Domain Card Styles */
.clean-domain-card {
    position: relative;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(51, 65, 85, 0.3);
    border-radius: 12px;
    padding: 2rem;
    min-height: 280px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.clean-domain-card:hover {
    transform: translateY(-4px);
    border-color: rgba(6, 182, 212, 0.4);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.domain-tag {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.domain-tag.sustainable {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.domain-tag.critical {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.domain-tag.immersive {
    background: rgba(6, 182, 212, 0.2);
    color: #06b6d4;
    border: 1px solid rgba(6, 182, 212, 0.3);
}

.domain-tag.secure {
    background: rgba(147, 51, 234, 0.2);
    color: #9333ea;
    border: 1px solid rgba(147, 51, 234, 0.3);
}

.domain-tag.freestyle {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.domain-icon-wrapper {
    margin: 2rem 0 1.5rem 0;
}

.domain-icon {
    width: 48px;
    height: 48px;
    color: #06b6d4;
    stroke-width: 1.5;
}

.clean-domain-card:hover .domain-icon {
    color: #0891b2;
    transform: scale(1.1);
    transition: all 0.3s ease;
}

.domain-title {
    font-family: 'Orbitron', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.domain-description {
    color: #94a3b8;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-top: auto;
}

/* Responsive adjustments for clean cards */
@media (max-width: 768px) {
    .clean-domain-card {
        padding: 1.5rem;
        min-height: 240px;
    }
    
    .domain-icon {
        width: 40px;
        height: 40px;
    }
    
    .domain-title {
        font-size: 1.25rem;
    }
    
    .domain-description {
        font-size: 0.875rem;
    }
}

/* Base styles for domain cards */
.domain-card {
    max-width: 100%;
    height: 100%;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

/* Create a circuit pattern background as fallback */
.bg-circuit-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
}

/* Fix domain card hover animations */
.domain-card:hover {
    transform: translateY(-10px);
}

.domain-card:hover .cyber-button {
    border-color: currentColor;
}

/* Secondary-xs button style */
.cyber-button.secondary-xs {
    font-size: 0.75rem;
    padding: 0.5rem 1rem;
}

/* Mobile responsiveness improvements */
@media (max-width: 640px) {
    /* Fix padding and margins for smaller screens */
    section {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Adjust text sizing for mobile */
    .glitch-text {
        font-size: 2.5rem;
    }
    
    h2 {
        font-size: 2rem;
    }
    
    /* Improve domain card readability */
    .domain-card {
        padding: 1.25rem;
    }
    
    .domain-description ul {
        padding-left: 1.25rem;
    }
    
    /* Fix button text overflow */
    .cyber-button span, 
    .cyber-button-tag {
        font-size: 0.875rem;
        white-space: nowrap;
    }
    
    /* Ensure prize placeholders stack nicely */
    .prize-placeholder {
        margin-bottom: 0.75rem;
    }
    
    /* Improve FAQ readability */
    .faq-question h3 {
        font-size: 1rem;
        padding-right: 2rem;
    }
    
    /* Control floating elements on mobile */
    .floating-elements {
        display: none;
    }
}

/* Fix for medium-sized screens */
@media (min-width: 641px) and (max-width: 768px) {
    .domain-card {
        min-height: 500px;
    }
}

/* Bento Grid Styling */
.domain-bento-grid {
    contain: layout;
}

/* Add some 3D effects */
.domain-card {
    transform-style: preserve-3d;
    perspective: 1000px;
}

/* Glowing borders on hover */
.domain-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.5s ease;
    z-index: -1;
}

.domain-card:hover::before {
    opacity: 1;
}

/* Make sure areas fill the entire card */
.domain-card {
    display: flex;
    flex-direction: column;
}

.domain-card > div {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Add some micro-interactions */
@keyframes pulse-glow {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 255, 255, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 255, 255, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 255, 255, 0);
    }
}

.domain-card:hover .w-12 {
    animation: pulse-glow 2s infinite;
}

.cyber-button-border {
    position: relative;
    background: transparent;
    color: #00D7FE;
    border: 2px solid #00D7FE;
    border-radius: 4px;
    overflow: hidden;
    transition: 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
}

.cyber-button-border:hover {
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.5);
    text-shadow: 0 0 15px rgba(0, 215, 254, 0.5);
}

.cyber-button-glitch {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 215, 254, 0.2), transparent);
    animation: glitch 2s infinite;
}

.cyber-button-tag {
    position: relative;
    z-index: 2;
    font-family: 'Orbitron', sans-serif;
    letter-spacing: 1px;
}

@keyframes glitch {
    0% {
        left: -100%;
    }
    50% {
        left: 100%;
    }
    100% {
        left: 100%;
    }
}

/* Enhanced Domain Card Styling */
.domain-card {
    position: relative;
    max-width: 100%;
    height: 100%;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1.25rem;
    background: linear-gradient(145deg, rgba(17, 24, 39, 0.85), rgba(10, 15, 25, 0.95));
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 2px rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05);
    transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
    backdrop-filter: blur(16px);
    transform-style: preserve-3d;
    perspective: 1000px;
    isolation: isolate;
}

/* Add subtle animation to domain cards */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

.domain-card:nth-child(odd) {
    animation: float 6s ease-in-out infinite;
}

.domain-card:nth-child(even) {
    animation: float 6s ease-in-out infinite reverse;
}

.domain-card:hover {
    animation-play-state: paused;
}

/* Enhanced gradient overlays for better visual hierarchy */
.domain-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.1) 0%,
        transparent 50%,
        rgba(0, 0, 0, 0.1) 100%
    );
    pointer-events: none;
    z-index: 1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.domain-card:hover::after {
    opacity: 1;
}

/* Custom themed borders based on domain color */
.domain-card.theme-green {
    border-top: 2px solid rgba(34, 197, 94, 0.4);
    border-left: 2px solid rgba(34, 197, 94, 0.2);
    border-bottom: 2px solid rgba(34, 197, 94, 0.2);
    border-right: 2px solid rgba(34, 197, 94, 0.2);
}

.domain-card.theme-red {
    border-top: 2px solid rgba(239, 68, 68, 0.4);
    border-left: 2px solid rgba(239, 68, 68, 0.2);
    border-bottom: 2px solid rgba(239, 68, 68, 0.2);
    border-right: 2px solid rgba(239, 68, 68, 0.2);
}

.domain-card.theme-cyan {
    border-top: 2px solid rgba(6, 182, 212, 0.4);
    border-left: 2px solid rgba(6, 182, 212, 0.2);
    border-bottom: 2px solid rgba(6, 182, 212, 0.2);
    border-right: 2px solid rgba(6, 182, 212, 0.2);
}

.domain-card.theme-purple {
    border-top: 2px solid rgba(147, 51, 234, 0.4);
    border-left: 2px solid rgba(147, 51, 234, 0.2);
    border-bottom: 2px solid rgba(147, 51, 234, 0.2);
    border-right: 2px solid rgba(147, 51, 234, 0.2);
}

.domain-card.theme-amber {
    border-top: 2px solid rgba(245, 158, 11, 0.4);
    border-left: 2px solid rgba(245, 158, 11, 0.2);
    border-bottom: 2px solid rgba(245, 158, 11, 0.2);
    border-right: 2px solid rgba(245, 158, 11, 0.2);
}

/* Enhanced glow effect on hover */
.domain-card.theme-green:hover {
    box-shadow: 
        0 0 30px rgba(34, 197, 94, 0.3),
        0 0 60px rgba(34, 197, 94, 0.1),
        inset 0 0 15px rgba(34, 197, 94, 0.05);
    border-top: 2px solid rgba(34, 197, 94, 0.8);
    border-left: 2px solid rgba(34, 197, 94, 0.6);
    border-bottom: 2px solid rgba(34, 197, 94, 0.4);
    border-right: 2px solid rgba(34, 197, 94, 0.6);
}

.domain-card.theme-red:hover {
    box-shadow: 
        0 0 30px rgba(239, 68, 68, 0.3),
        0 0 60px rgba(239, 68, 68, 0.1),
        inset 0 0 15px rgba(239, 68, 68, 0.05);
    border-top: 2px solid rgba(239, 68, 68, 0.8);
    border-left: 2px solid rgba(239, 68, 68, 0.6);
    border-bottom: 2px solid rgba(239, 68, 68, 0.4);
    border-right: 2px solid rgba(239, 68, 68, 0.6);
}

.domain-card.theme-cyan:hover {
    box-shadow: 
        0 0 30px rgba(6, 182, 212, 0.3),
        0 0 60px rgba(6, 182, 212, 0.1),
        inset 0 0 15px rgba(6, 182, 212, 0.05);
    border-top: 2px solid rgba(6, 182, 212, 0.8);
    border-left: 2px solid rgba(6, 182, 212, 0.6);
    border-bottom: 2px solid rgba(6, 182, 212, 0.4);
    border-right: 2px solid rgba(6, 182, 212, 0.6);
}

.domain-card.theme-purple:hover {
    box-shadow: 
        0 0 30px rgba(147, 51, 234, 0.3),
        0 0 60px rgba(147, 51, 234, 0.1),
        inset 0 0 15px rgba(147, 51, 234, 0.05);
    border-top: 2px solid rgba(147, 51, 234, 0.8);
    border-left: 2px solid rgba(147, 51, 234, 0.6);
    border-bottom: 2px solid rgba(147, 51, 234, 0.4);
    border-right: 2px solid rgba(147, 51, 234, 0.6);
}

.domain-card.theme-amber:hover {
    box-shadow: 
        0 0 30px rgba(245, 158, 11, 0.3),
        0 0 60px rgba(245, 158, 11, 0.1),
        inset 0 0 15px rgba(245, 158, 11, 0.05);
    border-top: 2px solid rgba(245, 158, 11, 0.8);
    border-left: 2px solid rgba(245, 158, 11, 0.6);
    border-bottom: 2px solid rgba(245, 158, 11, 0.4);
    border-right: 2px solid rgba(245, 158, 11, 0.6);
}

/* Enhanced hover effects */
.domain-card:hover {
    transform: translateY(-8px) scale(1.02);
}

/* Illuminate the card content on hover */
.domain-card:hover .domain-title {
    text-shadow: 0 0 8px currentColor;
}

.domain-card:hover .domain-icon {
    box-shadow: 0 0 15px currentColor;
}

/* Better card interior design */
.domain-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.domain-header {
    position: relative;
    overflow: hidden;
    border-top-left-radius: 0.75rem;
    border-top-right-radius: 0.75rem;
}

.domain-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg, 
        rgba(255, 255, 255, 0) 0%, 
        rgba(255, 255, 255, 0.08) 50%, 
        rgba(255, 255, 255, 0) 100%
    );
    transform: translateX(-100%);
    transition: transform 0.5s ease-in-out;
}

.domain-card:hover .domain-header::before {
    transform: translateX(100%);
}

.domain-icon {
    transition: all 0.3s ease;
}

/* Glowing tag labels */
.tech-tag {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.domain-card:hover .tech-tag {
    box-shadow: 0 0 8px currentColor;
}

/* Pulsing animation for icons */
@keyframes pulse-glow {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        transform: scale(1);
    }
    50% {
        box-shadow: 0 0 10px 3px currentColor;
        transform: scale(1.05);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        transform: scale(1);
    }
}

.domain-card:hover .domain-icon {
    animation: pulse-glow 2s infinite;
}

/* Cyber button enhancement */
.domain-card .cyber-button {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.domain-card:hover .cyber-button::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(
        circle,
        rgba(255, 255, 255, 0.1) 0%,
        rgba(255, 255, 255, 0) 70%
    );
    transition: transform 0.5s ease-out;
    z-index: -1;
}

/* Background details */
.circuit-line {
    position: absolute;
    background: linear-gradient(90deg, transparent, currentColor, transparent);
    height: 1px;
    width: 100%;
    opacity: 0.2;
    transform-origin: left center;
}

/* Circuit dot enhancements */
.circuit-dot {
    position: absolute;
    border-radius: 50%;
    background-color: currentColor;
    opacity: 0.4;
    filter: blur(1px);
}

/* Focus areas styling */
.focus-areas {
    position: relative;
    z-index: 2;
    backdrop-filter: blur(4px);
    background: rgba(0, 0, 0, 0.2);
}

/* Challenge Domains H1 Responsive - IMPORTANT */
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

/* Mobile Landscape */
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

/* Container padding adjustments */
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Early Bird Popup functionality
    const popup = document.getElementById('earlyBirdPopup');
    const closeBtn = document.getElementById('closePopup');
    const remindBtn = document.getElementById('remindLater');
    
    // Show popup after 3 seconds if not dismissed before
    setTimeout(() => {
        if (!localStorage.getItem('earlyBirdDismissed')) {
            popup.classList.remove('hidden');
        }
    }, 3000);
    
    // Close popup functionality
    function closePopup() {
        popup.classList.add('hidden');
        localStorage.setItem('earlyBirdDismissed', 'true');
    }
    
    closeBtn.addEventListener('click', closePopup);
    remindBtn.addEventListener('click', closePopup);
    
    // Close popup when clicking outside
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            closePopup();
        }
    });
    
    // Countdown Timer
    function updateCountdown() {
        // Set end date (2 days from now for demo - adjust as needed)
        const endDate = new Date();
        endDate.setDate(endDate.getDate() + 2);
        
        const now = new Date().getTime();
        const distance = endDate.getTime() - now;
        
        if (distance > 0) {
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        } else {
            // Timer expired
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
        }
    }
    
    // Update countdown every second
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // FAQ Accordion functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const arrow = this.querySelector('svg');
            
            // Toggle answer visibility
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                answer.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        });
    });

    // Better way to handle card heights (debounced)
    const equalizeCardHeights = () => {
        const domainCards = document.querySelectorAll('.domain-card');
        if (window.innerWidth < 768 || domainCards.length === 0) return;
        
        // Reset heights first
        domainCards.forEach(card => card.style.height = 'auto');
        
        // Group cards by rows
        const rows = {};
        domainCards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const rowTop = Math.floor(rect.top);
            rows[rowTop] = rows[rowTop] || [];
            rows[rowTop].push(card);
        });
        
        // Set equal heights per row
        Object.values(rows).forEach(rowCards => {
            let maxHeight = 0;
            rowCards.forEach(card => {
                maxHeight = Math.max(maxHeight, card.offsetHeight);
            });
            rowCards.forEach(card => {
                card.style.height = `${maxHeight}px`;
            });
        });
    };

    // Debounce function
    const debounce = (fn, delay) => {
        let timer;
        return function() {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, arguments), delay);
        };
    };

    // Add event listeners with debouncing
    window.addEventListener('resize', debounce(equalizeCardHeights, 100));
    window.addEventListener('load', equalizeCardHeights);

    // Fix hover effects to prevent transform conflicts
    document.querySelectorAll('.domain-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            // Only affect siblings, not the hovered card itself
            const siblingCards = document.querySelectorAll('.domain-card:not(:hover)');
            siblingCards.forEach(sibling => {
                sibling.style.transform = 'scale(0.98)';
                sibling.style.filter = 'brightness(0.9)';
            });
        });
        
        card.addEventListener('mouseleave', function() {
            // Reset siblings
            const siblingCards = document.querySelectorAll('.domain-card');
            siblingCards.forEach(sibling => {
                // Remove inline styles to let CSS handle the transforms
                sibling.style.transform = '';
                sibling.style.filter = '';
            });
            
            // Add a small delay to let the transition complete
            setTimeout(() => {
                equalizeCardHeights();
            }, 300);
        });
    });

    // Enhanced domain card interactions
    document.querySelectorAll('.domain-card').forEach(card => {
        // Add more circuit dots and lines on larger cards
        if (card.classList.contains('md:col-span-2')) {
            for (let i = 0; i < 3; i++) {
                const dot = document.createElement('div');
                dot.classList.add('circuit-dot');
                dot.style.top = `${Math.random() * 100}%`;
                dot.style.left = `${Math.random() * 100}%`;
                dot.style.width = `${Math.random() * 3 + 2}px`;
                dot.style.height = `${Math.random() * 3 + 2}px`;
                card.appendChild(dot);
                
            }
        }
        
        // Add glowing effect on mousemove
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left; // x position within the card
            const y = e.clientY - rect.top;  // y position within the card
            
            // Make the glow follow the cursor slightly
            let color = 'rgba(255, 255, 255, 0.1)';
            if (this.classList.contains('theme-green')) color = 'rgba(34, 197, 94, 0.15)';
            if (this.classList.contains('theme-red')) color = 'rgba(239, 68, 68, 0.15)';
            if (this.classList.contains('theme-cyan')) color = 'rgba(6, 182, 212, 0.15)';
            if (this.classList.contains('theme-purple')) color = 'rgba(147, 51, 234, 0.15)';
            if (this.classList.contains('theme-amber')) color = 'rgba(245, 158, 11, 0.15)';
            
            this.style.background = `radial-gradient(circle at ${x}px ${y}px, ${color}, rgba(10, 15, 25, 0.95) 40%)`;
        });
        
        // Reset on mouseleave
        card.addEventListener('mouseleave', function() {
            this.style.background = 'linear-gradient(145deg, rgba(17, 24, 39, 0.8), rgba(10, 15, 25, 0.95))';
        });
    });
});
</script>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>