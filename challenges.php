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
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Challenge Domains">Challenge Domains</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Discover the innovative domains where you can make an impact. Choose your battleground and create solutions that can change the future.
            </p>
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
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Challenge <span class="text-cyan-400">Domains</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-8"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-4">
                Each domain represents a critical area where technology can drive meaningful change. Select the one that aligns with your team's expertise and passion.
            </p>
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-4 max-w-3xl mx-auto">
                <p class="text-cyan-400 font-semibold">Technology Freedom</p>
                <p class="text-gray-300">You are free to use any technologies, frameworks, or platforms of your choice to solve problems in your selected domain.</p>
            </div>
        </div>
        
        <!-- Bento Grid Layout -->
        <div class="domain-bento-grid max-w-7xl mx-auto">
            <!-- Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 auto-rows-auto">
                
                <!-- Agriculture Domain (2x2) -->
                <div class="md:col-span-2 md:row-span-2 domain-card theme-green">
                    <!-- Background elements -->
                    <div class="absolute inset-0 bg-circuit-pattern opacity-5"></div>
                    <div class="circuit-line" style="top: 25%; transform: rotate(25deg);"></div>
                    <div class="circuit-line" style="top: 65%; transform: rotate(-15deg);"></div>
                    <div class="circuit-dot" style="top: 15%; left: 25%; width: 4px; height: 4px;"></div>
                    <div class="circuit-dot" style="top: 75%; left: 80%; width: 6px; height: 6px;"></div>
                    
                    <!-- Domain Content -->
                    <div class="domain-content p-6 md:p-8">
                        <!-- Domain Header -->
                        <div class="domain-header mb-6">
                            <div class="flex items-center space-x-4">
                                <div class="domain-icon w-16 h-16 rounded-full bg-green-900/50 flex items-center justify-center border border-green-500/40 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <h3 class="domain-title text-2xl font-orbitron font-bold text-green-400">Agriculture</h3>
                            </div>
                            <div class="absolute top-0 right-0 px-3 py-1 bg-green-500/30 rounded-full text-xs text-green-300 font-medium border border-green-400/20">
                                Featured Domain
                            </div>
                        </div>
                        
                        <!-- Domain Description -->
                        <p class="text-gray-300 mb-6 text-sm md:text-base leading-relaxed">Develop innovative solutions to address challenges in farming, supply chain, crop optimization, and sustainable agriculture.</p>
                        
                        <!-- Tech Stack Freedom Note -->
                        <div class="bg-green-900/20 backdrop-blur-sm border border-green-500/20 rounded-lg p-3 mb-6 relative overflow-hidden text-xs">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-green-500/5 rounded-full blur-xl"></div>
                            <p class="font-medium text-green-300"><span class="font-bold">Tech Freedom:</span> Use any technology stack to solve problems in this domain.</p>
                        </div>
                        
                        <!-- Domain Focus Areas -->
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="tech-tag px-2 py-1 bg-green-900/30 text-green-400 text-xs rounded-md border border-green-500/30">IoT</span>
                                <span class="tech-tag px-2 py-1 bg-green-900/30 text-green-400 text-xs rounded-md border border-green-500/30">AI/ML</span>
                                <span class="tech-tag px-2 py-1 bg-green-900/30 text-green-400 text-xs rounded-md border border-green-500/30">Blockchain</span>
                            </div>
                            <div class="focus-areas rounded-lg p-3 border border-green-500/10">
                                <ul class="space-y-1 list-disc list-inside text-xs text-gray-400 md:columns-2 gap-4">
                                    <li>Smart farming solutions</li>
                                    <li>Farm-to-fork traceability</li>
                                    <li>Crop disease detection</li>
                                    <li>Sustainable farming technologies</li>
                                    <li>Water conservation systems</li>
                                    <li>Agricultural supply chain</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Domain CTA -->
                        <div class="mt-auto">
                            <button class="w-full cyber-button secondary-sm">
                                <span>Choose Problem Statement</span>
                                <i></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Healthcare Domain (2x1) -->
                <div class="md:col-span-2 domain-card theme-red">
                    <!-- Background elements -->
                    <div class="absolute inset-0 bg-circuit-pattern opacity-5"></div>
                    <div class="circuit-line" style="top: 45%; transform: rotate(15deg);"></div>
                    <div class="circuit-dot" style="top: 30%; left: 65%; width: 5px; height: 5px;"></div>
                    
                    <!-- Domain Content -->
                    <div class="domain-content p-6">
                        <!-- Domain Header -->
                        <div class="domain-header mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="domain-icon w-12 h-12 rounded-lg bg-red-900/50 flex items-center justify-center border border-red-500/40 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h3 class="domain-title text-xl font-orbitron font-bold text-red-400">Healthcare</h3>
                            </div>
                        </div>
                        
                        <!-- Two-column layout for description and tags -->
                        <div class="flex flex-col sm:flex-row gap-4 flex-grow">
                            <div class="sm:w-1/2">
                                <p class="text-gray-300 mb-4 text-sm leading-relaxed">Create solutions that revolutionize healthcare delivery, patient monitoring, and medical management.</p>
                                
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="tech-tag px-2 py-1 bg-red-900/30 text-red-400 text-xs rounded-md border border-red-500/30">ML</span>
                                    <span class="tech-tag px-2 py-1 bg-red-900/30 text-red-400 text-xs rounded-md border border-red-500/30">IoT</span>
                                    <span class="tech-tag px-2 py-1 bg-red-900/30 text-red-400 text-xs rounded-md border border-red-500/30">Mobile</span>
                                </div>
                            </div>
                            
                            <div class="sm:w-1/2">
                                <div class="focus-areas bg-red-900/20 border border-red-500/20 rounded-lg p-3 mb-4 relative overflow-hidden text-xs h-full">
                                    <ul class="space-y-1 list-disc list-inside text-xs text-gray-400">
                                        <li>Remote patient monitoring</li>
                                        <li>AI-powered diagnostics</li>
                                        <li>Mental health solutions</li>
                                        <li>Secure medical records</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Domain CTA -->
                        <div class="mt-4">
                            <button class="w-full cyber-button secondary-sm">
                                <span>Choose Problem Statement</span>
                                <i></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- IoT & XR Domain (1x1) -->
                <div class="domain-card theme-cyan">
                    <!-- Background elements -->
                    <div class="absolute inset-0 bg-circuit-pattern opacity-5"></div>
                    <div class="circuit-dot" style="top: 20%; left: 30%; width: 3px; height: 3px;"></div>
                    
                    <!-- Domain Content with compact design -->
                    <div class="domain-content p-5">
                        <!-- Domain Icon & Title -->
                        <div class="domain-header mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="domain-icon w-10 h-10 rounded-lg bg-cyan-900/50 flex items-center justify-center border border-cyan-500/40 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="domain-title text-lg font-orbitron font-bold text-cyan-400">IoT & XR Tech</h3>
                            </div>
                        </div>
                        
                        <!-- Compact content -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            <span class="tech-tag px-2 py-1 bg-cyan-900/30 text-cyan-400 text-xs rounded-md border border-cyan-500/30">IoT</span>
                            <span class="tech-tag px-2 py-1 bg-cyan-900/30 text-cyan-400 text-xs rounded-md border border-cyan-500/30">AR/VR</span>
                        </div>
                        
                        <div class="focus-areas bg-cyan-900/10 border-l-2 border-cyan-500/50 p-2 mb-3">
                            <p class="text-gray-300 text-xs">Build innovative applications with IoT and XR technologies.</p>
                        </div>
                        
                        <!-- Domain CTA -->
                        <button class="w-full cyber-button secondary-xs">
                            <span>Choose Problem</span>
                            <i></i>
                        </button>
                    </div>
                </div>
                
                <!-- Cyber Security Domain (1x1) -->
                <div class="domain-card theme-purple">
                    <!-- Background elements -->
                    <div class="absolute inset-0 bg-circuit-pattern opacity-5"></div>
                    <div class="circuit-dot" style="top: 70%; left: 40%; width: 3px; height: 3px;"></div>
                    
                    <!-- Domain Content with compact design -->
                    <div class="domain-content p-5">
                        <!-- Domain Icon & Title -->
                        <div class="domain-header mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="domain-icon w-10 h-10 rounded-lg bg-purple-900/50 flex items-center justify-center border border-purple-500/40 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="domain-title text-lg font-orbitron font-bold text-purple-400">Cyber Security</h3>
                            </div>
                        </div>
                        
                        <!-- Compact content -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            <span class="tech-tag px-2 py-1 bg-purple-900/30 text-purple-400 text-xs rounded-md border border-purple-500/30">Security</span>
                            <span class="tech-tag px-2 py-1 bg-purple-900/30 text-purple-400 text-xs rounded-md border border-purple-500/30">AI</span>
                        </div>
                        
                        <div class="focus-areas bg-purple-900/10 border-l-2 border-purple-500/50 p-2 mb-3">
                            <p class="text-gray-300 text-xs">Protect digital assets and enhance security infrastructure.</p>
                        </div>
                        
                        <!-- Domain CTA -->
                        <button class="w-full cyber-button secondary-xs">
                            <span>Choose Problem</span>
                            <i></i>
                        </button>
                    </div>
                </div>
                
                <!-- Open Innovation Domain (2x1) -->
                <div class="md:col-span-2 domain-card theme-amber">
                    <!-- Background elements -->
                    <div class="absolute inset-0 bg-circuit-pattern opacity-5"></div>
                    <div class="circuit-line" style="top: 60%; transform: rotate(-10deg);"></div>
                    <div class="circuit-dot" style="top: 25%; left: 75%; width: 4px; height: 4px;"></div>
                    
                    <!-- Domain Content -->
                    <div class="domain-content p-6">
                        <!-- Domain Header -->
                        <div class="domain-header mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="domain-icon w-12 h-12 rounded-lg bg-amber-900/50 flex items-center justify-center border border-amber-500/40 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="domain-title text-xl font-orbitron font-bold text-amber-400">Open Innovation</h3>
                            </div>
                        </div>
                        
                        <!-- Two-column layout for description and tags -->
                        <div class="flex flex-col sm:flex-row gap-4 flex-grow">
                            <div class="sm:w-1/2">
                                <p class="text-gray-300 mb-4 text-sm leading-relaxed">Unleash your creativity with no boundaries. Develop solutions for any problem space that drives positive change.</p>
                                
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="tech-tag px-2 py-1 bg-amber-900/30 text-amber-400 text-xs rounded-md border border-amber-500/30">Open Stack</span>
                                    <span class="tech-tag px-2 py-1 bg-amber-900/30 text-amber-400 text-xs rounded-md border border-amber-500/30">Any Tech</span>
                                </div>
                            </div>
                            
                            <div class="sm:w-1/2">
                                <div class="focus-areas bg-amber-900/20 border border-amber-500/20 rounded-lg p-3 mb-4 relative overflow-hidden text-xs h-full">
                                    <ul class="space-y-1 list-disc list-inside text-xs text-gray-400">
                                        <li>Education technology</li>
                                        <li>Climate tech & sustainability</li>
                                        <li>Financial innovations</li>
                                        <li>Social impact platforms</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Domain CTA -->
                        <div class="mt-4">
                            <button class="w-full cyber-button secondary-sm">
                                <span>Choose Problem Statement</span>
                                <i></i>
                            </button>
                        </div>
                    </div>
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
                <p class="text-gray-300">Develop your innovative solution during the 48-hour hackathon with support from our mentors.</p>
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

<!-- FAQ Section -->
<section class="py-16 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Frequently Asked <span class="text-cyan-400">Questions</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-8"></div>
        </div>
        
        <!-- FAQ Accordion -->
        <div class="max-w-4xl mx-auto">
            <!-- FAQ Item 1 -->
            <div class="faq-item mb-4 bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg overflow-hidden">
                <div class="faq-question p-4 cursor-pointer flex justify-between items-center">
                    <h3 class="font-chakra text-white text-sm sm:text-base pr-6">Can I participate in more than one challenge domain?</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-cyan-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="faq-answer p-4 pt-0 border-t border-cyan-900/30 hidden">
                    <p class="text-gray-300">Each team must select one primary challenge domain at the time of registration. However, your solution can incorporate elements from multiple domains. The judging will be based on your performance in your selected primary domain.</p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="faq-item mb-4 bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg overflow-hidden">
                <div class="faq-question p-4 cursor-pointer flex justify-between items-center">
                    <h3 class="font-chakra text-white text-sm sm:text-base pr-6">What technologies can I use in my solution?</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-cyan-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="faq-answer p-4 pt-0 border-t border-cyan-900/30 hidden">
                    <p class="text-gray-300">You are free to use any technology stack, programming languages, frameworks, or platforms that best suit your solution. We encourage innovative combinations of technologies. Make sure to explain your technology choices during your presentation.</p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="faq-item mb-4 bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg overflow-hidden">
                <div class="faq-question p-4 cursor-pointer flex justify-between items-center">
                    <h3 class="font-chakra text-white text-sm sm:text-base pr-6">Is there a minimum requirement for project completion?</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-cyan-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="faq-answer p-4 pt-0 border-t border-cyan-900/30 hidden">
                    <p class="text-gray-300">Your submission must include a working prototype that demonstrates the core functionality of your solution. It doesn't need to be a fully polished product, but judges should be able to understand and evaluate your implementation. Documentation and a presentation explaining your solution are also required.</p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="faq-item mb-4 bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg overflow-hidden">
                <div class="faq-question p-4 cursor-pointer flex justify-between items-center">
                    <h3 class="font-chakra text-white text-sm sm:text-base pr-6">Will mentors be available during the hackathon?</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-cyan-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="faq-answer p-4 pt-0 border-t border-cyan-900/30 hidden">
                    <p class="text-gray-300">Yes, industry experts and mentors will be available throughout the hackathon to provide guidance, feedback, and technical support. You'll have scheduled mentor sessions as well as opportunities for impromptu consultations.</p>
                </div>
            </div>
            
            <!-- FAQ Item 5 -->
            <div class="faq-item mb-4 bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg overflow-hidden">
                <div class="faq-question p-4 cursor-pointer flex justify-between items-center">
                    <h3 class="font-chakra text-white text-sm sm:text-base pr-6">Who will own the intellectual property rights to our solution?</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-cyan-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="faq-answer p-4 pt-0 border-t border-cyan-900/30 hidden">
                    <p class="text-gray-300">Teams retain full ownership of their intellectual property. ByteVerse may request permission to showcase your solution for promotional purposes, but you maintain all rights to your work and are free to continue developing it after the hackathon.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="faq.php" class="cyber-button secondary">
                <span>View All FAQs</span>
                <i></i>
            </a>
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

<style>
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
    border-radius: 1rem;
    background: linear-gradient(145deg, rgba(17, 24, 39, 0.8), rgba(10, 15, 25, 0.95));
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2), 
                inset 0 1px 2px rgba(255, 255, 255, 0.1);
    transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
    backdrop-filter: blur(12px);
    transform-style: preserve-3d;
    perspective: 1000px;
    isolation: isolate;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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