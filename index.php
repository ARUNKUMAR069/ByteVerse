<?php
// Set this flag to false to disable the loader on the index page
$isHomePage = false;
$pageTitle = 'ByteVerse 1.0 | The Ultimate Coding Universe';

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
                September 27-28, 2025
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
                    The Ultimate Hackathon Experience <br>
                    Where Ideas Meet Execution!
                </span>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Step into ByteVerse 1.0 — a <span class="text-cyan-400">24-hour coding hackathon</span> where innovation meets execution. Solve real-world challenges in AI, Web, Blockchain & more with your team, and build solutions that matter.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-12">
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
?>



<?php
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>

<script>
// Direct stats animation trigger for index page
document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for all resources to load
    setTimeout(function() {
        const statValues = document.querySelectorAll('.stat-value');
        console.log('Direct trigger: Found stats elements:', statValues.length);
        
        if (statValues.length > 0) {
            statValues.forEach(function(stat, index) {
                const targetValue = parseInt(stat.getAttribute('data-value'));
                console.log('Animating stat', index, 'to:', targetValue);
                
                // Simple counter animation
                let current = 0;
                const increment = targetValue / 60; // 60 frames for smooth animation
                const timer = setInterval(function() {
                    current += increment;
                    if (current >= targetValue) {
                        stat.textContent = targetValue;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 33); // ~30fps
            });
        }
    }, 1000);
});
</script>

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

/* Studio Environment */
.studio-floor {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60%;
    background: linear-gradient(to top, #0a0a0a 0%, transparent 100%);
    background-image: 
        radial-gradient(circle at 25% 100%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 100%, rgba(255, 215, 0, 0.08) 0%, transparent 50%);
}

.studio-lights {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 40%;
    background: linear-gradient(to bottom, 
        rgba(255, 215, 0, 0.03) 0%, 
        rgba(255, 215, 0, 0.01) 50%, 
        transparent 100%);
}

.ambient-glow {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, 
        rgba(255, 215, 0, 0.02) 0%, 
        transparent 70%);
}

/* Premium Badge */
.premium-badge {
    position: relative;
    display: inline-block;
    background: linear-gradient(135deg, #d4af37, #ffd700, #d4af37);
    color: #000;
    padding: 12px 30px;
    font-size: 14px;
    font-weight: 900;
    letter-spacing: 2px;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 
        0 0 30px rgba(255, 215, 0, 0.4),
        inset 0 2px 0 rgba(255, 255, 255, 0.3);
}

.badge-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shine 3s infinite;
}

@keyframes shine {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Golden Divider */
.golden-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.divider-line {
    width: 120px;
    height: 2px;
    background: linear-gradient(to right, transparent, #ffd700, transparent);
    border-radius: 1px;
}

.divider-diamond {
    width: 16px;
    height: 16px;
    background: #ffd700;
    transform: rotate(45deg);
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
    animation: diamondPulse 2s infinite;
}

@keyframes diamondPulse {
    0%, 100% { transform: rotate(45deg) scale(1); }
    50% { transform: rotate(45deg) scale(1.2); }
}

/* Champion Spotlight - Dual Layout */
.podium-section {
    text-align: center;
    max-width: 1000px;
    margin: 0 auto;
}

.podium-header h3 {
    text-shadow: 0 0 20px rgba(255, 212, 0, 0.8);
}

.title-underline {
    width: 200px;
    height: 3px;
    background: linear-gradient(to right, transparent, #ffd700, transparent);
    margin: 0 auto;
    border-radius: 2px;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
}

.dual-champions-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 80px;
    margin: 50px auto;
    flex-wrap: wrap;
}

.champion-spotlight {
    position: relative;
    width: 350px;
    height: 350px;
    flex-shrink: 0;
}

.champion-left .spotlight-beams {
    animation-delay: 0s;
}

.champion-right .spotlight-beams {
    animation-delay: 2s;
}

.spotlight-beams {
    position: absolute;
    inset: 0;
    border-radius: 50%;
}

.beam {
    position: absolute;
    background: conic-gradient(from 0deg, 
        rgba(255, 215, 0, 0.3), 
        rgba(255, 255, 255, 0.1), 
        rgba(255, 215, 0, 0.3));
    border-radius: 50%;
    animation: rotateBeams 20s linear infinite;
}

.beam-1 { inset: 0; }
.beam-2 { inset: 20px; animation-delay: -5s; }
.beam-3 { inset: 40px; animation-delay: -10s; }
.beam-4 { inset: 60px; animation-delay: -15s; }

@keyframes rotateBeams {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.champion-pedestal {
    position: absolute;
    inset: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.pedestal-top {
    width: 230px;
    height: 230px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-frame {
    position: relative;
    width: 190px;
    height: 190px;
    border-radius: 50%;
    overflow: hidden;
}

.frame-glow {
    position: absolute;
    inset: -10px;
    background: conic-gradient(from 0deg, #ffd700, #fff, #ffd700, #fff, #ffd700);
    border-radius: 50%;
    animation: frameRotate 8s linear infinite;
    filter: blur(8px);
}

@keyframes frameRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.logo-container {
    position: relative;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.95) 0%, rgba(240, 240, 240, 0.9) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px;
    z-index: 2;
    box-shadow: 
        inset 0 0 30px rgba(255, 215, 0, 0.3),
        0 0 50px rgba(255, 215, 0, 0.4);
}

.champion-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.2));
}

.premium-border {
    position: absolute;
    inset: 0;
    border: 4px solid #ffd700;
    border-radius: 50%;
    z-index: 3;
    box-shadow: 
        0 0 0 2px rgba(255, 215, 0, 0.3),
        inset 0 0 0 2px rgba(255, 255, 255, 0.5);
}

.pedestal-base {
    margin-top: 15px;
    text-align: center;
}

.base-text {
    font-size: 18px;
    font-weight: 900;
    color: #ffd700;
    letter-spacing: 2px;
    text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    margin-bottom: 6px;
}

.base-subtitle {
    font-size: 13px;
    color: #ccc;
    font-style: italic;
    letter-spacing: 0.8px;
}

.spotlight-particles {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: #ffd700;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
    animation: particleFloat 4s infinite ease-in-out;
}

.champion-left .particle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
.champion-left .particle:nth-child(2) { top: 30%; right: 25%; animation-delay: 1s; }
.champion-left .particle:nth-child(3) { bottom: 30%; left: 30%; animation-delay: 2s; }
.champion-left .particle:nth-child(4) { bottom: 20%; right: 20%; animation-delay: 3s; }
.champion-left .particle:nth-child(5) { top: 50%; left: 10%; animation-delay: 0.5s; }

.champion-right .particle:nth-child(1) { top: 25%; left: 25%; animation-delay: 0.3s; }
.champion-right .particle:nth-child(2) { top: 35%; right: 20%; animation-delay: 1.3s; }
.champion-right .particle:nth-child(3) { bottom: 25%; left: 35%; animation-delay: 2.3s; }
.champion-right .particle:nth-child(4) { bottom: 25%; right: 25%; animation-delay: 3.3s; }
.champion-right .particle:nth-child(5) { top: 55%; left: 15%; animation-delay: 0.8s; }

@keyframes particleFloat {
    0%, 100% { transform: translateY(0px) scale(1); opacity: 0.6; }
    50% { transform: translateY(-20px) scale(1.5); opacity: 1; }
}

/* Champions Connection */
.champions-connection {
    position: relative;
    width: 100%;
    height: 60px;
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.connection-line {
    position: relative;
    width: 300px;
    height: 2px;
    background: rgba(255, 215, 0, 0.3);
    border-radius: 1px;
}

.line-glow {
    position: absolute;
    inset: -2px;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 215, 0, 0.6) 20%, 
        rgba(255, 215, 0, 0.8) 50%, 
        rgba(255, 215, 0, 0.6) 80%, 
        transparent);
    border-radius: 3px;
    filter: blur(2px);
    animation: lineGlow 3s ease-in-out infinite alternate;
}

@keyframes lineGlow {
    from { opacity: 0.4; }
    to { opacity: 1; }
}

.connection-center {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.center-diamond {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, #ffd700, #fff, #ffd700);
    border: 2px solid #ffd700;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 0 20px rgba(255, 215, 0, 0.6),
        inset 0 0 10px rgba(255, 255, 255, 0.3);
    animation: diamondPulse 2s infinite;
}

.diamond-text {
    font-size: 20px;
    color: #333;
    text-shadow: 0 0 5px rgba(255, 215, 0, 0.8);
}

@keyframes diamondPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Premium Gallery */
.gallery-divider {
    width: 300px;
    height: 2px;
    background: linear-gradient(to right, transparent, rgba(255, 215, 0, 0.6), transparent);
    margin: 0 auto;
    border-radius: 1px;
}

.premium-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Display Case Styling */
.sponsor-display-case {
    position: relative;
    height: 320px;
    background: linear-gradient(135deg, rgba(20, 20, 20, 0.9), rgba(40, 40, 40, 0.8));
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    transition: transform 0.4s ease;
}

.sponsor-display-case:hover {
    transform: translateY(-10px);
}

.case-lighting {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.top-light {
    position: absolute;
    top: 0;
    left: 20%;
    right: 20%;
    height: 60%;
    background: linear-gradient(to bottom, 
        rgba(255, 215, 0, 0.15) 0%, 
        rgba(255, 215, 0, 0.05) 50%, 
        transparent 100%);
    border-radius: 0 0 50% 50%;
    filter: blur(10px);
}

.side-light-left {
    position: absolute;
    top: 20%;
    left: 0;
    width: 30%;
    height: 60%;
    background: linear-gradient(to right, 
        rgba(255, 215, 0, 0.08) 0%, 
        transparent 100%);
    border-radius: 0 50% 50% 0;
    filter: blur(8px);
}

.side-light-right {
    position: absolute;
    top: 20%;
    right: 0;
    width: 30%;
    height: 60%;
    background: linear-gradient(to left, 
        rgba(255, 215, 0, 0.08) 0%, 
        transparent 100%);
    border-radius: 50% 0 0 50%;
    filter: blur(8px);
}

.display-glass {
    position: relative;
    height: 100%;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 30px 20px 20px;
    backdrop-filter: blur(5px);
}

.glass-reflection {
    position: absolute;
    top: 0;
    left: 20%;
    width: 30%;
    height: 60%;
    background: linear-gradient(135deg, 
        rgba(255, 255, 255, 0.1) 0%, 
        transparent 50%);
    border-radius: 0 0 0 100%;
    pointer-events: none;
}

.sponsor-item {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    padding: 30px;
    margin: 0 10px;
    box-shadow: 
        inset 0 0 20px rgba(255, 215, 0, 0.1),
        0 5px 20px rgba(0, 0, 0, 0.2);
}

.premium-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
    transition: transform 0.3s ease;
}

.sponsor-display-case:hover .premium-logo {
    transform: scale(1.05);
}

.sponsor-nameplate {
    text-align: center;
    padding: 15px 10px;
}

.nameplate-text {
    font-size: 14px;
    font-weight: 800;
    color: #ffd700;
    letter-spacing: 1.5px;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
    margin-bottom: 8px;
}

.nameplate-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(to right, transparent, #ffd700, transparent);
    margin: 0 auto;
    border-radius: 1px;
}

/* Appreciation Banner */
.appreciation-banner {
    position: relative;
    text-align: center;
    background: rgba(20, 20, 20, 0.8);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 20px;
    padding: 40px;
    max-width: 600px;
    margin: 0 auto;
    overflow: hidden;
}

.banner-glow {
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, 
        rgba(255, 215, 0, 0.1), 
        rgba(255, 255, 255, 0.05), 
        rgba(255, 215, 0, 0.1));
    border-radius: 18px;
    filter: blur(15px);
    animation: bannerGlow 3s ease-in-out infinite alternate;
}

@keyframes bannerGlow {
    from { opacity: 0.3; }
    to { opacity: 0.7; }
}

.banner-content {
    position: relative;
    z-index: 2;
}

.appreciation-icon {
    position: relative;
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-rays {
    position: absolute;
    inset: 0;
    background: conic-gradient(from 0deg, 
        rgba(255, 215, 0, 0.4), 
        transparent, 
        rgba(255, 215, 0, 0.4), 
        transparent);
    border-radius: 50%;
    animation: iconRotate 6s linear infinite;
}

@keyframes iconRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.icon-text {
    font-size: 36px;
    color: #ffd700;
    text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    z-index: 2;
    position: relative;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dual-champions-container {
        flex-direction: column;
        gap: 40px;
        align-items: center;
    }
    
    .champion-spotlight {
        width: 280px;
        height: 280px;
    }
    
    .champion-pedestal {
        inset: 50px;
    }
    
    .pedestal-top {
        width: 180px;
        height: 180px;
    }
    
    .logo-frame {
        width: 150px;
        height: 150px;
    }
    
    .base-text {
        font-size: 16px;
        letter-spacing: 1.5px;
    }
    
    .base-subtitle {
        font-size: 12px;
    }
    
    .connection-line {
        width: 200px;
    }
    
    .premium-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .sponsor-display-case {
        height: 280px;
    }
    
    .sponsor-item {
        padding: 20px;
        margin: 0 5px;
    }
}

@media (max-width: 480px) {
    .dual-champions-container {
        gap: 30px;
    }
    
    .champion-spotlight {
        width: 220px;
        height: 220px;
    }
    
    .champion-pedestal {
        inset: 35px;
    }
    
    .pedestal-top {
        width: 150px;
        height: 150px;
    }
    
    .logo-frame {
        width: 120px;
        height: 120px;
    }
    
    .base-text {
        font-size: 14px;
        letter-spacing: 1px;
    }
    
    .base-subtitle {
        font-size: 11px;
    }
    
    .connection-line {
        width: 150px;
    }
    
    .center-diamond {
        width: 30px;
        height: 30px;
    }
    
    .diamond-text {
        font-size: 16px;
    }
    
    .premium-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .sponsor-display-case {
        height: 250px;
    }
}
</style>

