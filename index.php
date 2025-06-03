<?php
// Set this flag to true for the index page
$isHomePage = true;
$pageTitle = 'ByteVerse 1.0 | The Ultimate Coding Universe';

// Optional loader customization
$loaderPrefix = 'Welcome to'; 
$loaderText = 'Loading assets...';

// Include the header
include 'components/header.php';

// Include navbar
require_once('components/navbar.php');
?>

<!-- Hero Section -->
<section class="min-h-screen relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>

        <div class="mb-3 inline-block mx-auto">
            <span class="date-badge">
                August 22-23, 2025
            </span>
        </div>

        <div class="countdown-container">
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-days">00</div>
                <div class="countdown-label">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-hours">00</div>
                <div class="countdown-label">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-minutes">00</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-seconds">00</div>
                <div class="countdown-label">Seconds</div>
            </div>
        </div>

        <div class="mb-8 sm:mb-12 md:mb-16 relative">
            <h1 class="glitch-text text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl" data-text="ByteVerse 1.0">
                ByteVerse 1.0
            </h1>
            <div class="hero-subtitle">
                <span class="block text-sm xs:text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-rajdhani text-cyan-400 opacity-80 mt-2 leading-tight">
                    Decode · Develop · Disrupt
                </span>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Enter the ultimate <span class="text-cyan-400">coding universe</span> where technology meets innovation.
                Join brilliant minds in a <span class="text-cyan-400">48-hour</span> journey to build
                groundbreaking solutions and redefine the digital frontier.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-12">
            <a href="registration.php" class="cyber-button primary w-full sm:w-auto">
                <span>Register Now</span>
                <i></i>
            </a>
            <a href="challenges.php" class="cyber-button secondary w-full sm:w-auto">
                <span>Explore Challenges</span>
                <i></i>
            </a>
        </div>

        <div class="mt-24 flex items-center justify-center">
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-value" data-value="200">0</div>
                    <div class="stat-label">Teams</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="700">0</div>
                    <div class="stat-label">Participants</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="5">0</div>
                    <div class="stat-label">Challenges</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="24">0</div>
                    <div class="stat-label">Hours</div>
                </div>
            </div>
        </div>

        <!-- 3D floating elements -->
        <div class="floating-elements">
            <div class="floating-cube cube-1"></div>
            <div class="floating-cube cube-2"></div>
            <div class="floating-cube cube-3"></div>
            <div class="floating-sphere"></div>
        </div>
    </div>
</section>


<?php
require_once('components/domain-showcase.php');
require_once('components/sponsors-showcase.php');
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>

<style>
/* Responsive Glitch Text - IMPORTANT overrides */
@media (max-width: 320px) {
    .glitch-text {
        font-size: 1.75rem !important;
        letter-spacing: 1px !important;
        line-height: 1.1 !important;
    }
    
    .hero-subtitle span {
        font-size: 0.75rem !important;
        letter-spacing: 0.02em !important;
    }
}

@media (min-width: 321px) and (max-width: 374px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 2px !important;
    }
    
    .hero-subtitle span {
        font-size: 0.875rem !important;
    }
}

@media (min-width: 375px) and (max-width: 424px) {
    .glitch-text {
        font-size: 2.25rem !important;
        letter-spacing: 2px !important;
    }
    
    .hero-subtitle span {
        font-size: 0.9375rem !important;
    }
}

@media (min-width: 425px) and (max-width: 639px) {
    .glitch-text {
        font-size: 2.5rem !important;
        letter-spacing: 3px !important;
    }
    
    .hero-subtitle span {
        font-size: 1rem !important;
    }
}

@media (min-width: 640px) and (max-width: 767px) {
    .glitch-text {
        font-size: 3rem !important;
        letter-spacing: 3px !important;
    }
    
    .hero-subtitle span {
        font-size: 1.125rem !important;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .glitch-text {
        font-size: 3.5rem !important;
        letter-spacing: 3px !important;
    }
    
    .hero-subtitle span {
        font-size: 1.25rem !important;
    }
}

@media (min-width: 1024px) and (max-width: 1279px) {
    .glitch-text {
        font-size: 4rem !important;
        letter-spacing: 4px !important;
    }
    
    .hero-subtitle span {
        font-size: 1.375rem !important;
    }
}

@media (min-width: 1280px) and (max-width: 1535px) {
    .glitch-text {
        font-size: 4.5rem !important;
        letter-spacing: 4px !important;
    }
    
    .hero-subtitle span {
        font-size: 1.5rem !important;
    }
}

@media (min-width: 1536px) {
    .glitch-text {
        font-size: 5rem !important;
        letter-spacing: 4px !important;
    }
    
    .hero-subtitle span {
        font-size: 1.75rem !important;
    }
}

/* Landscape orientation for mobile - IMPORTANT */
@media (max-height: 500px) and (orientation: landscape) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 2px !important;
    }
    
    .hero-subtitle span {
        font-size: 0.875rem !important;
    }
    
    .mb-8 { 
        margin-bottom: 1rem !important; 
    }
    
    .sm\:mb-12 { 
        margin-bottom: 1.5rem !important; 
    }
    
    .md\:mb-16 { 
        margin-bottom: 2rem !important; 
    }
}

/* Ultra small screens - IMPORTANT */
@media (max-width: 280px) {
    .glitch-text {
        font-size: 1.5rem !important;
        letter-spacing: 0.5px !important;
    }
    
    .hero-subtitle span {
        font-size: 0.7rem !important;
        word-spacing: 0.02em !important;
    }
}

/* Override existing glitch text size - IMPORTANT */
@media (max-width: 400px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 2px !important;
    }
}

/* Hero subtitle responsive adjustments - IMPORTANT */
.hero-subtitle {
    text-align: center !important;
    padding: 0 1rem !important;
}

.hero-subtitle span {
    display: block !important;
    font-weight: 600 !important;
    text-shadow: 0 0 10px rgba(0, 215, 254, 0.5) !important;
    word-spacing: 0.1em !important;
    line-height: 1.3 !important;
}

@media (max-width: 640px) {
    .hero-subtitle {
        padding: 0 0.5rem !important;
    }
    
    .hero-subtitle span {
        word-spacing: 0.05em !important;
        letter-spacing: 0.02em !important;
    }
}

/* Ensure glitch animations work on all screen sizes - IMPORTANT */
.glitch-text::before,
.glitch-text::after {
    font-size: inherit !important;
    letter-spacing: inherit !important;
}

/* Simple width increase for mobile */
@media (max-width: 768px) {
    .container {
        max-width: 95% !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }
    
    .stats-container {
        width: 100% !important;
        max-width: 350px !important;
    }
    
    .stat-item {
        min-width: 100px !important;
    }
}
</style>

