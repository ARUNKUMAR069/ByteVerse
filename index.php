<?php
// Page-specific variables
$pageTitle = 'ByteVerse 1.0 | The Ultimate Coding Universe';
$loaderPrefix = 'Welcome to';
$loaderText = 'Loading assets...';
$currentPage = 'home';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Hero Section -->
<section class="min-h-screen relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>

        <div class="mb-3 inline-block mx-auto">
            <span class="date-badge">
                August 22-23, 2025 • Virtual & In-Person
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

        <div class="mb-16 relative">
            <h1 class="glitch-text" data-text="ByteVerse 1.0">ByteVerse 1.0</h1>
            <div class="hero-subtitle">
                <span class="block text-xl md:text-2xl font-rajdhani text-cyan-400 opacity-80 mt-2">
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
                    <div class="stat-value" data-value="500">0</div>
                    <div class="stat-label">Hackers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="48">0</div>
                    <div class="stat-label">Hours</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="25">0</div>
                    <div class="stat-label">Challenges</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" data-value="100">0</div>
                    <div class="stat-label">Prizes</div>
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
<?php require_once('components/cyber-hacker.php'); ?>
<?php require_once('components/algorithm-arena.php'); ?>
<?php
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>