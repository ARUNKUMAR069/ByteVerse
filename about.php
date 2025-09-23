<?php
// Page-specific variables
$pageTitle = 'About | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Origins';
$loaderText = 'Loading mission data...';
$currentPage = 'about';

// Additional styles specific to the about page
$additionalStyles = '
/* About Cards Layout */
.about-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.about-card {
    position: relative;
    height: 100%;
    min-height: 250px;
    transition: transform 0.3s ease;
    perspective: 1000px;
}

.about-card-inner {
    position: relative;
    background: rgba(0, 215, 254, 0.05);
    border: 1px solid var(--primary-accent);
    padding: 2rem;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.6s ease;
    box-shadow: 0 0 20px rgba(0, 215, 254, 0.1);
    overflow: hidden;
}

.about-card:hover .about-card-inner {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 215, 254, 0.2);
}

.about-card-inner::before {
    content: \'\';
    position: absolute;
    top: -1px;
    left: -1px;
    width: 8px;
    height: 8px;
    background: var(--primary-accent);
    z-index: 2;
}

.about-card-inner::after {
    content: \'\';
    position: absolute;
    bottom: -1px;
    right: -1px;
    width: 8px;
    height: 8px;
    background: var(--primary-accent);
    z-index: 2;
}

/* Circuit background for cards */
.circuit-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        linear-gradient(to right, rgba(0, 215, 254, 0.05) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0, 215, 254, 0.05) 1px, transparent 1px);
    background-size: 20px 20px;
    opacity: 0.3;
    z-index: 0;
}

/* Text Styling */
.tech-text {
    color: var(--text-dim, #c5c5c5);
    line-height: 1.7;
    font-family: \'Rajdhani\', sans-serif;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.gradient-text-small {
    background: linear-gradient(90deg, var(--primary-accent, #00D7FE) 0%, var(--neon-purple, #BD00FF) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-family: \'Orbitron\', sans-serif;
    font-weight: 700;
    font-size: 1.8rem;
    letter-spacing: 1px;
    position: relative;
    z-index: 1;
}

/* Design Elements */
.cyber-line {
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent, #00D7FE), var(--neon-purple, #BD00FF), transparent);
    margin: 0 auto;
    width: 80%;
    max-width: 600px;
    position: relative;
}

.cyber-line::before {
    content: \'\';
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: var(--primary-accent, #00D7FE);
    top: -4px;
    left: 50%;
    transform: translateX(-50%) rotate(45deg);
}

/* Animation for cards */
@keyframes cardPulse {
    0% { box-shadow: 0 0 10px rgba(0, 215, 254, 0.3); }
    50% { box-shadow: 0 0 20px rgba(0, 215, 254, 0.5); }
    100% { box-shadow: 0 0 10px rgba(0, 215, 254, 0.3); }
}

.about-card-inner {
    animation: cardPulse 3s infinite ease-in-out;
}

/* Each card gets different animation delay */
.about-content .about-card:nth-child(1) .about-card-inner {
    animation-delay: 0s;
}

.about-content .about-card:nth-child(2) .about-card-inner {
    animation-delay: 0.5s;
}

.about-content .about-card:nth-child(3) .about-card-inner {
    animation-delay: 1s;
}

/* Stats styling */
.stats-container {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

.stat-item {
    position: relative;
    min-width: 120px;
    padding: 1.5rem;
    border: 1px solid rgba(0, 215, 254, 0.2);
    background: rgba(0, 215, 254, 0.05);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    border-color: var(--primary-accent);
}

.stat-item::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent, #00D7FE), transparent);
    animation: scanner 2s linear infinite;
}

@keyframes scanner {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* College Leaders Section */
.leaders-container {
    display: grid;
    gap: 2rem;
    margin: 2rem auto 0;
    max-width: 1200px;
    padding: 0 1rem;
}

/* Desktop - 4 columns */
@media (min-width: 1025px) {
    .leaders-container {
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }
}

/* Tablet - 2 columns */
@media (min-width: 641px) and (max-width: 1024px) {
    .leaders-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        max-width: 700px;
    }
}

/* Mobile - 1 column */
@media (max-width: 640px) {
    .leaders-container {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        max-width: 400px;
    }
}

.leader-card {
    background: rgba(12, 18, 32, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 0;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    padding: 2rem 1.5rem 1.5rem;
    width: 100%;
    max-width: 100%;
}

.leader-card::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(rgba(0, 215, 254, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 215, 254, 0.02) 1px, transparent 1px);
    background-size: 20px 20px;
    pointer-events: none;
    z-index: 1;
}

.leader-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.15);
}

.leader-image-container {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    margin: 0 auto 20px;
    border: 3px solid rgba(0, 215, 254, 0.4);
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.3);
}

.leader-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.3s ease;
}

.leader-card:hover .leader-image {
    transform: scale(1.05);
}

.leader-details {
    padding: 1.5rem;
    text-align: center;
    position: relative;
    z-index: 2;
}

.leader-name {
    font-size: 1.3rem;
    font-weight: bold;
    color: white;
    margin-bottom: 0.5rem;
}

.leader-title {
    color: var(--primary-accent, #00D7FE);
    font-weight: 600;
    margin-bottom: 0;
    font-size: 1.1rem;
}

/* Adjust card height for simplified layout */
.leader-card {
    min-height: 300px;
}

@media (max-width: 768px) {
    .leader-card {
        min-height: 250px;
    }
}

@media (max-width: 480px) {
    .leader-card {
        min-height: 220px;
    }
}

/* About ByteVerse H1 Responsive - IMPORTANT */
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

/* Mobile Landscape for About */
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

/* Container padding adjustments for About */
@media (max-width: 640px) {/* Lines 412-421 omitted */}

/* Hackathon Coordinators Section Styles */
.coordinators-grid {
    display: grid;
    gap: 2rem;
    margin: 2rem auto 0;
    max-width: 1200px;
    padding: 0 1rem;
}

/* Grid layouts for different teams */
.executive-grid {
    grid-template-columns: repeat(2, 1fr);
    max-width: 700px;
    margin: 0 auto;
    gap: 2rem;
}

.technical-grid {
    grid-template-columns: 1fr;
    max-width: 350px;
    margin: 0 auto;
}

.sponsor-grid {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

.registration-grid {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

.marketing-grid {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

/* Desktop - 4 columns for marketing team */
@media (min-width: 1025px) {
    .marketing-grid {
        grid-template-columns: repeat(4, 1fr);
    }
    .sponsor-grid, .registration-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Tablet - 3 columns */
@media (min-width: 769px) and (max-width: 1024px) {
    .marketing-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    .sponsor-grid, .registration-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Small tablet - 2 columns */
@media (min-width: 481px) and (max-width: 768px) {
    .marketing-grid, .sponsor-grid, .registration-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .executive-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

/* Mobile - 1 column */
@media (max-width: 480px) {
    .coordinators-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    .executive-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

.coordinator-card {
    background: rgba(12, 18, 32, 0.9);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    padding: 0;
    width: 100%;
    max-width: 100%;
    height: auto;
    min-height: 320px;
    display: flex;
    flex-direction: column;
}

.coordinator-card::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(0deg, rgba(0, 215, 254, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 215, 254, 0.02) 1px, transparent 1px);
    background-size: 20px 20px;
    pointer-events: none;
    z-index: 1;
}

.coordinator-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 215, 254, 0.2);
    border-color: rgba(0, 215, 254, 0.6);
}

/* Team-specific card colors */
.executive-card:hover {
    box-shadow: 0 12px 25px rgba(255, 215, 0, 0.2);
    border-color: rgba(255, 215, 0, 0.6);
}

.technical-card:hover {
    box-shadow: 0 12px 25px rgba(34, 197, 94, 0.2);
    border-color: rgba(34, 197, 94, 0.6);
}

.sponsor-card:hover {
    box-shadow: 0 12px 25px rgba(168, 85, 247, 0.2);
    border-color: rgba(168, 85, 247, 0.6);
}

.registration-card:hover {
    box-shadow: 0 12px 25px rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.6);
}

.marketing-card:hover {
    box-shadow: 0 12px 25px rgba(236, 72, 153, 0.2);
    border-color: rgba(236, 72, 153, 0.6);
}

.coordinator-image-container {
    width: 100%;
    height: 200px;
    overflow: hidden;
    position: relative;
    margin: 0;
    border-radius: 12px 12px 0 0;
}

.coordinator-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.3s ease;
    position: relative;
    z-index: 2;
}

.coordinator-card:hover .coordinator-image {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0, 215, 254, 0.1), rgba(189, 0, 255, 0.1));
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 3;
}

.coordinator-card:hover .image-overlay {
    opacity: 1;
}

.coordinator-details {
    text-align: center;
    position: relative;
    z-index: 2;
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.coordinator-name {
    font-family: \'Orbitron\', sans-serif;
    font-weight: 600;
    font-size: 1.2rem;
    color: #ffffff;
    margin-bottom: 8px;
    line-height: 1.3;
}

.coordinator-title {
    font-family: \'Rajdhani\', sans-serif;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 12px;
}

.coordinator-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    font-family: \'Rajdhani\', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(0, 215, 254, 0.1);
    color: #00D7FE;
    border: 1px solid rgba(0, 215, 254, 0.3);
    margin-top: auto;
}

/* Team-specific badge colors */
.executive-card .coordinator-badge {
    background: rgba(255, 215, 0, 0.1);
    color: #FFD700;
    border-color: rgba(255, 215, 0, 0.3);
}

.technical-card .coordinator-badge {
    background: rgba(34, 197, 94, 0.1);
    color: #22C55E;
    border-color: rgba(34, 197, 94, 0.3);
}

.sponsor-card .coordinator-badge {
    background: rgba(168, 85, 247, 0.1);
    color: #A855F7;
    border-color: rgba(168, 85, 247, 0.3);
}

.registration-card .coordinator-badge {
    background: rgba(59, 130, 246, 0.1);
    color: #3B82F6;
    border-color: rgba(59, 130, 246, 0.3);
}

.marketing-card .coordinator-badge {
    background: rgba(236, 72, 153, 0.1);
    color: #EC4899;
    border-color: rgba(236, 72, 153, 0.3);
}

/* Special styling for executive cards */
.executive-card {
    min-height: 360px;
    border: 2px solid rgba(255, 215, 0, 0.3);
}

.executive-card .coordinator-image-container {
    height: 220px;
}

.executive-card .coordinator-name {
    font-size: 1.3rem;
    color: #FFD700;
}

.executive-card .coordinator-title {
    font-size: 1.1rem;
    color: rgba(255, 215, 0, 0.9);
}

/* Special styling for technical card */
.technical-card {
    min-height: 380px;
    border: 2px solid rgba(34, 197, 94, 0.3);
}

.technical-card .coordinator-image-container {
    height: 240px;
}

.technical-card .coordinator-name {
    font-size: 1.3rem;
    color: #22C55E;
}

.technical-card .coordinator-title {
    font-size: 1.1rem;
    color: rgba(34, 197, 94, 0.9);
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .coordinator-card {
        min-height: 300px;
    }
    
    .coordinator-image-container {
        height: 180px;
    }
    
    .coordinator-details {
        padding: 1.25rem;
    }
    
    .coordinator-name {
        font-size: 1.1rem;
    }
    
    .coordinator-title {
        font-size: 0.95rem;
    }
    
    .executive-card {
        min-height: 320px;
    }
    
    .executive-card .coordinator-image-container,
    .technical-card .coordinator-image-container {
        height: 180px;
    }
}

@media (max-width: 480px) {
    .coordinator-card {
        min-height: 280px;
    }
    
    .coordinator-image-container {
        height: 300px;
    }
    
    .coordinator-details {
        padding: 1rem;
    }
    
    .coordinator-name {
        font-size: 1rem;
    }
    
    .coordinator-title {
        font-size: 0.9rem;
    }
    
    .coordinator-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }
    
    .executive-card,
    .technical-card {
        min-height: 300px;
    }
    
    .executive-card .coordinator-image-container,
    .technical-card .coordinator-image-container {
        height: 160px;
    }
}

/* Animation delays for staggered effect */
.coordinator-card:nth-child(1) { animation-delay: 0.1s; }
.coordinator-card:nth-child(2) { animation-delay: 0.2s; }
.coordinator-card:nth-child(3) { animation-delay: 0.3s; }
.coordinator-card:nth-child(4) { animation-delay: 0.4s; }
.coordinator-card:nth-child(5) { animation-delay: 0.5s; }
.coordinator-card:nth-child(6) { animation-delay: 0.6s; }
.coordinator-card:nth-child(7) { animation-delay: 0.7s; }
.coordinator-card:nth-child(8) { animation-delay: 0.8s; }
.coordinator-card:nth-child(9) { animation-delay: 0.9s; }
.coordinator-card:nth-child(10) { animation-delay: 1.0s; }
.coordinator-card:nth-child(11) { animation-delay: 1.1s; }
.coordinator-card:nth-child(12) { animation-delay: 1.2s; }
.coordinator-card:nth-child(13) { animation-delay: 1.3s; }
.coordinator-card:nth-child(14) { animation-delay: 1.4s; }
.coordinator-card:nth-child(15) { animation-delay: 1.5s; }
.coordinator-card:nth-child(16) { animation-delay: 1.6s; }

/* Fade in animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.coordinator-card {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}
';

/* Add this line to include about.css via <link> tag in the head */
$additionalHead = '<link rel="stylesheet" href="assets/css/about.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">';

// Additional scripts for the about page
$additionalScripts = '
// Counter animation
const counters = document.querySelectorAll(".counter");
counters.forEach(counter => {
    const target = parseInt(counter.getAttribute("data-target"));
    const duration = 2000; // ms
    const step = target / (duration / 16); // 60fps
    
    let current = 0;
    const updateCounter = () => {
        current += step;
        if (current < target) {
            counter.textContent = Math.floor(current);
            requestAnimationFrame(updateCounter);
        } else {
            counter.textContent = target;
        }
    };
    
    // Start counting when element is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                updateCounter();
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(counter);
});

// Fix for testimonial slider - add null checks
const track = document.querySelector(".testimonials-track");
const slides = document.querySelectorAll(".testimonial");
const dots = document.querySelectorAll(".testimonial-dot");
const prevBtn = document.querySelector(".testimonial-prev");
const nextBtn = document.querySelector(".testimonial-next");

let currentIndex = 0;

function goToSlide(index) {
    // Only proceed if track element exists
    if (!track) return;
    
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    
    track.style.transform = `translateX(${-index * 100}%)`;
    
    // Update dots if they exist
    if (dots.length > 0) {
        dots.forEach(dot => dot.classList.remove("active"));
        dots[index].classList.add("active");
    }
    
    currentIndex = index;
}

// Event listeners - add null checks
if (prevBtn) {
    prevBtn.addEventListener("click", () => goToSlide(currentIndex - 1));
}

if (nextBtn) {
    nextBtn.addEventListener("click", () => goToSlide(currentIndex + 1));
}

// Only add event listeners if dots exist
if (dots.length > 0) {
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => goToSlide(index));
    });
}

// Auto slide every 5 seconds - only if elements exist
let slideInterval;
if (track && slides.length > 0) {
    slideInterval = setInterval(() => goToSlide(currentIndex + 1), 5000);

    // Pause auto slide on hover
    const testimonialSlider = document.querySelector(".testimonials-slider");
    if (testimonialSlider) {
        testimonialSlider.addEventListener("mouseenter", () => clearInterval(slideInterval));
        testimonialSlider.addEventListener("mouseleave", () => {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => goToSlide(currentIndex + 1), 5000);
        });
    }

    // Initialize
    goToSlide(0);
}

// Add hover effect to timeline items
const timelineItems = document.querySelectorAll(".timeline-item");
timelineItems.forEach(item => {
    item.addEventListener("mouseenter", () => {
        item.style.zIndex = "10";
    });
    
    item.addEventListener("mouseleave", () => {
        item.style.zIndex = "1";
    });
});

// Parallax effect for floating elements
document.addEventListener("mousemove", (e) => {
    const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
    const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
    
    document.querySelectorAll(".floating-cube").forEach((cube, index) => {
        const factor = (index + 1) * 0.5;
        cube.style.transform = `translate(${moveX * factor}px, ${moveY * factor}px) rotate(${moveX}deg)`;
    });
});
';

// Now the PHP require statements
require_once('components/header.php');
require_once('components/navbar.php');
?>

<!-- About Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>

        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="About ByteVerse">About ByteVerse</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Discover the story behind ByteVerse, our mission, and the team that makes it all possible.
                We are building more than just a hackathon—we are creating a community.
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Our <span class="text-cyan-400">Mission</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
        </div>

        <div class="about-content">
            <div class="about-card">
                <div class="about-card-inner">
                    <div class="circuit-bg"></div>
                    <h3 class="gradient-text-small mb-4">Innovation Hub</h3>
                    <p class="tech-text">
                        ByteVerse is where innovation meets opportunity. We are a high-energy, 24-hour coding sprint
                        that transforms bold ideas into reality. Our mission? To spark creativity and empower students
                        from all disciplines—computer science, design, business, and beyond—to collaborate and build
                        tech-based solutions for real-world challenges.
                    </p>
                </div>
            </div>

            <div class="about-card">
                <div class="about-card-inner">
                    <div class="circuit-bg"></div>
                    <h3 class="gradient-text-small mb-4">Diverse Community</h3>
                    <p class="tech-text">
                        ByteVerse celebrates diversity in thought and background. Whether you are a coding veteran or a
                        curious newcomer, our hackathon is your playground. We believe breakthrough innovation happens
                        when different perspectives converge—where designers meet developers, entrepreneurs meet
                        engineers, and creativity meets code.
                    </p>
                </div>
            </div>

            <div class="about-card">
                <div class="about-card-inner">
                    <div class="circuit-bg"></div>
                    <h3 class="gradient-text-small mb-4">Student-Powered</h3>
                    <p class="tech-text">
                        Created by students, for students, ByteVerse is powered by a passionate team of undergraduate
                        leaders and mentors who believe in the potential of their peers. We've crafted an experience
                        that balances rigorous problem-solving with genuine fun—because we're convinced learning thrives
                        in an atmosphere of excitement, collaboration, and inclusivity.
                    </p>
                </div>
            </div>
        </div>


    </div>
</section>

<!-- College Leaders Section -->
<section class="py-20 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6 text-white">College <span
                    class="text-cyan-400">Leaders</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
            <p class="text-white mt-6 max-w-2xl mx-auto">
                Meet the visionaries leading our institution to new heights of innovation and excellence
            </p>
        </div>

        <div class="leaders-container">
            <!-- Chairman -->
            <div class="leader-card">
                <div class="leader-image-container">
                    <img src="assets/Images/about/Chairman.webp" alt="Chairman" class="leader-image" loading="lazy">
                </div>
                <div class="leader-details">
                    <h3 class="leader-name">S. Charanjit Singh Channi</h3>
                    <p class="leader-title">Chairman</p>
                </div>
            </div>


            <!-- Managing Director -->
            <div class="leader-card">
                <div class="leader-image-container">
                    <img src="assets/Images/about/MD.webp" alt="Managing Director" class="leader-image" loading="lazy">
                </div>
                <div class="leader-details">
                    <h3 class="leader-name">Dr. Manbir Singh</h3>
                    <p class="leader-title">Managing Director</p>
                </div>
            </div>
            <!-- Vice Chairman -->
            <div class="leader-card">
                <div class="leader-image-container">
                    <img src="assets/Images/about/vc.webp" alt="Vice Chairman" class="leader-image" loading="lazy">
                </div>
                <div class="leader-details">
                    <h3 class="leader-name">Mr. Harpreet Singh</h3>
                    <p class="leader-title">Vice Chairman</p>
                </div>
            </div>

            <div class="leader-card">
                <div class="leader-image-container">
                    <img src="assets/Images/about/ed.png" alt="Chairman" class="leader-image" loading="lazy">
                </div>
                <div class="leader-details">
                    <h3 class="leader-name">Dr. Nitin Tandon</h3>
                    <p class="leader-title">Executive Director</p>
                </div>
            </div>


        </div>
    </div>
</section>

<!-- Hackathon Coordinators Section -->
<section class="py-20 relative bg-gradient-to-b from-gray-900/30 to-transparent">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6 text-white">Hackathon <span class="text-cyan-400">Coordinators</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto"></div>
            <p class="text-white mt-6 max-w-2xl mx-auto">
                Meet the dedicated team behind ByteVerse 1.0 - the visionaries, organizers, and innovators who made this hackathon possible
            </p>
        </div>

        <!-- Executive Team -->
        <div class="mb-16">
            <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-yellow-400">Executive Team</h3>
            <div class="coordinators-grid" style="grid-template-columns: repeat(3, 1fr); max-width: 1200px; margin: 0 auto; gap: 2rem;">
                <!-- President -->
                <div class="coordinator-card executive-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/President.jpg" alt="Madhav Arora - President" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Madhav Arora</h4>
                        <p class="coordinator-title">President</p>
                        <div class="coordinator-badge">Executive</div>
                    </div>
                </div>

                <!-- Vice President -->
                <div class="coordinator-card executive-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/VicePresident.webp" alt="Bhoomika - Vice President" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Bhoomika</h4>
                        <p class="coordinator-title">Vice President</p>
                        <div class="coordinator-badge">Executive</div>
                    </div>
                </div>

                <!-- Overall Coordinator -->
                <div class="coordinator-card executive-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Overall1.jpg" alt="Harshdeep Maan - Overall Coordinator" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Harshdeep Maan</h4>
                        <p class="coordinator-title">Overall Coordinator</p>
                        <div class="coordinator-badge">Executive</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- technical Team  -->
        <div class="mb-16">
            <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-yellow-400">Website Team</h3>
            <div class="coordinators-grid executive-grid">
                <!-- President -->
                <div class="coordinator-card executive-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/WebsiteDeveloper.jpg" alt="Arun Kumar - Website Developer" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Arun Kumar</h4>
                        <p class="coordinator-title">Website Developer</p>
                        <div class="coordinator-badge">Website Team</div>
                    </div>
                </div>

                <!-- Vice President -->
                <div class="coordinator-card executive-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Website2.jpg" alt="Arshdeep Kaur - Website Developer" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Arshdeep Kaur</h4>
                        <p class="coordinator-title">Website Developer</p>
                        <div class="coordinator-badge">Website Team</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Technical Team -->





        <!-- Sponsor Team -->
        <div class="mb-16">
            <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-purple-400">Sponsor Relations Team</h3>
            <div class="coordinators-grid sponsor-grid">
                <!-- Sponsor Team Member 1 -->
                <!-- <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor1.JPG" alt="Rahul Sharma - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Rahul Sharma</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div> -->

                <!-- Sponsor Team Member 2 -->
                <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor2.jpg" alt="Tamana - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Tamana</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div>

                <!-- Sponsor Team Member 3 -->
                <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor3.jpg" alt="Rohan - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Rohan</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div>

                <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor4.jpg" alt="Nitin Verma - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Nitin Verma</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div>

                <!-- Sponsor Team Member 4 -->
                <!-- <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor4.HEIC" alt="Nitin Verma - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Nitin Verma</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- Registration Team -->
        <div class="mb-16">
            <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-blue-400">Registration Team</h3>
            <div class="coordinators-grid registration-grid">

                <div class="coordinator-card registration-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Registration2.jpg" alt="Kashish Singh - Registration Team" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Kashish Singh</h4>
                        <p class="coordinator-title">Team Leader</p>
                        <div class="coordinator-badge">Registration</div>
                    </div>
                </div>











                <!-- Registration Team Member 1 -->
                <div class="coordinator-card registration-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Registration.jpg" alt="Ridhia Gupta - Registration Team" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Ridhia Gupta</h4>
                        <p class="coordinator-title">Registration Coordinator</p>
                        <div class="coordinator-badge">Registration</div>
                    </div>
                </div>

                <!-- Registration Team Member 2 -->


                <!-- Registration Team Member 3 -->
                <div class="coordinator-card registration-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Registration3.webp" alt="Aditi - Registration Team" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Aditi Yadav</h4>
                        <p class="coordinator-title">Registration Coordinator</p>
                        <div class="coordinator-badge">Registration</div>
                    </div>
                </div>

                <!-- Registration Team Member 4 -->
                <div class="coordinator-card registration-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Registration4.png" alt="Registration Team Member - Registration Team" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Simranpreet Kaur</h4>
                        <p class="coordinator-title">Registration Coordinator</p>
                        <div class="coordinator-badge">Registration</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Marketing Team -->
        <div class="mb-16">
            <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-pink-400">Marketing Team</h3>
            <div class="coordinators-grid marketing-grid">
                <!-- Marketing Team Members 1-16 -->

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing2.jpg" alt="Marketing Team Member 2" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Manish</h4>
                        <p class="coordinator-title">Team Leader</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>









                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing4.JPG" alt="Marketing Team Member 4" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Nisha</h4>
                        <p class="coordinator-title">Shoot Management</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>


                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing3.jpg" alt="Marketing Team Member 3" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Hargun Kaur</h4>
                        <p class="coordinator-title">Vice Coordinator</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing1.jpg" alt="Marketing Team Member 1" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Himanshu Sodhi</h4>
                        <p class="coordinator-title">Social Media Handler</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>


                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing5.png" alt="Marketing Team Member 5" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Karan</h4>
                        <p class="coordinator-title">Video Editor</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing5(1).jpg" alt="Marketing Team Member 6" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Tania</h4>
                        <p class="coordinator-title">Content Creation</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing6.jpg" alt="Marketing Team Member 7" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Prem</h4>
                        <p class="coordinator-title">Cameraman</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing7.png" alt="Marketing Team Member 8" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Lakshay</h4>
                        <p class="coordinator-title">Video Editor</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing8.png" alt="Marketing Team Member 9" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Kashish</h4>
                        <p class="coordinator-title">Graphic Designer</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <!-- <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing9.png" alt="Marketing Team Member 10" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Marketing Coordinator</h4>
                        <p class="coordinator-title">Marketing Team</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div> -->

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing10.jpg" alt="Marketing Team Member 11" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Ranveer</h4>
                        <p class="coordinator-title">Video Editor</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <!-- <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing11.webp" alt="Marketing Team Member 12" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Marketing Coordinator</h4>
                        <p class="coordinator-title">Marketing Team</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div> -->

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing12.jpg" alt="Marketing Team Member 13" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Harpreet</h4>
                        <p class="coordinator-title">Team Member</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing13.jpg" alt="Marketing Team Member 14" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Ahsaas</h4>
                        <p class="coordinator-title">Team Member</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing14.jpg" alt="Marketing Team Member 15" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Anjali Rana</h4>
                        <p class="coordinator-title">Team Member</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>

                <div class="coordinator-card marketing-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Marketing15.jpg" alt="Marketing Team Member 16" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Akashdeep</h4>
                        <p class="coordinator-title">Team Member</p>
                        <div class="coordinator-badge">Marketing</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Logistics Team -->
<div class="mb-16">
    <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-purple-400">Tech Support & Logistics Team</h3>
    <div class="coordinators-grid sponsor-grid">
        <!-- Sponsor Team Member 1 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/TechSupport1.jpg" alt="Deepak - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Deepak</h4>
                <p class="coordinator-title">Team Leader</p>
                <div class="coordinator-badge">Tech Support & Logistics Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 2 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/TechSupport2.jpg" alt="Pratham - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Pratham</h4>
                <p class="coordinator-title">Team Member</p>
                <div class="coordinator-badge">Tech Support & Logistics Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 3 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/TechSupport3.jpg" alt="Suman Krishna - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Suman Krishna</h4>
                <p class="coordinator-title">Team Member</p>
                <div class="coordinator-badge">Tech Support & Logistics Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 4 -->

    </div>
</div>

<!-- Fun Activity Team -->

<div class="mb-16">
    <h3 class="text-2xl font-orbitron font-bold text-center mb-10 text-purple-400">Fun Activity Team </h3>
    <div class="coordinators-grid sponsor-grid">
        <!-- Sponsor Team Member 1 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/Activity1.png" alt="Deepak - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Anmol</h4>
                <p class="coordinator-title">Team Leader</p>
                <div class="coordinator-badge">Fun Activity Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 2 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/Activity2.png" alt=" Pratham - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Vicky</h4>
                <p class="coordinator-title">Team Member</p>
                <div class="coordinator-badge">Fun Activity Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 3 -->
        <div class="coordinator-card sponsor-card">
            <div class="coordinator-image-container">
                <img src="assets/Images/students/Activity3.png" alt="Suman Krishna - Tech Support & Logistics Team" class="coordinator-image" loading="lazy">
                <div class="image-overlay"></div>
            </div>
            <div class="coordinator-details">
                <h4 class="coordinator-name">Sahil</h4>
                <p class="coordinator-title">Team Member</p>
                <div class="coordinator-badge">Fun Activity Team</div>
            </div>
        </div>

        <!-- Sponsor Team Member 4 -->
        <!-- <div class="coordinator-card sponsor-card">
                    <div class="coordinator-image-container">
                        <img src="assets/Images/students/Sponsor4.HEIC" alt="Nitin Verma - Sponsor Relations" class="coordinator-image" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="coordinator-details">
                        <h4 class="coordinator-name">Nitin Verma</h4>
                        <p class="coordinator-title">Sponsor Relations</p>
                        <div class="coordinator-badge">Sponsor Team</div>
                    </div>
                </div> -->
    </div>
</div>




<!-- Include terminal and footer -->
<?php
require_once('components/terminal.php');
require_once('components/footer.php');
?>