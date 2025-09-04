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

<script>
document.addEventListener('DOMContentLoaded', function() {
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
            
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');
            
            if (daysEl) daysEl.textContent = days.toString().padStart(2, '0');
            if (hoursEl) hoursEl.textContent = hours.toString().padStart(2, '0');
            if (minutesEl) minutesEl.textContent = minutes.toString().padStart(2, '0');
            if (secondsEl) secondsEl.textContent = seconds.toString().padStart(2, '0');
        } else {
            // Timer expired
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');
            
            if (daysEl) daysEl.textContent = '00';
            if (hoursEl) hoursEl.textContent = '00';
            if (minutesEl) minutesEl.textContent = '00';
            if (secondsEl) secondsEl.textContent = '00';
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