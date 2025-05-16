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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.leader-card {
    background: rgba(12, 18, 32, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 0;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    padding-top: 30px;
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
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
    margin-bottom: 0.25rem;
}

.leader-title {
    color: var(--primary-accent, #00D7FE);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.leader-bio {
    color: #c5c5c5;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-top: 0.75rem;
    margin-bottom: 1rem;
}

.leader-socials {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

.social-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    background: rgba(0, 215, 254, 0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 215, 254, 0.3);
}

.social-link:hover {
    background: rgba(0, 215, 254, 0.2);
    transform: translateY(-3px);
}

.social-link svg {
    width: 20px;
    height: 20px;
}

/* CTA section */
.cta-section {
    position: relative;
    margin-top: 5rem;
    padding: 3rem;
    background: rgba(0, 215, 254, 0.05);
    border: 1px solid var(--primary-accent, #00D7FE);
    border-radius: 10px;
    overflow: hidden;
}

.cta-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 10% 20%, rgba(0, 215, 254, 0.1) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(189, 0, 255, 0.1) 0%, transparent 20%);
    z-index: 0;
}

.cta-content {
    position: relative;
    z-index: 1;
    text-align: center;
}

.cta-title {
    font-family: \'Orbitron\', sans-serif;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
    color: white;
}

.cta-text {
    font-family: \'Rajdhani\', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #c5c5c5;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive styles */
@media (max-width: 768px) {
    .about-content {
        grid-template-columns: 1fr;
    }
    
    .stats-container {
        gap: 1rem;
    }
    
    .stat-item {
        min-width: 100px;
        padding: 1rem;
    }
    
    .gradient-text-small {
        font-size: 1.5rem;
    }
    
    /* Leader section improvements */
    .leaders-container {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .leader-image-container {
        width: 150px;
        height: 150px;
    }
    
    .leader-name {
        font-size: 1.3rem;
    }
    
    .leader-title {
        font-size: 1rem;
    }
    
    .leader-bio {
        font-size: 0.9rem;
    }
    
    .social-link {
        width: 36px;
        height: 36px;
    }
    
    /* CTA section improvements */
    .cta-section {
        padding: 2rem 1.5rem;
    }
    
    .cta-title {
        font-size: 1.7rem;
    }
    
    .cta-text {
        font-size: 1.1rem;
    }
    
    /* Other existing responsive code */
    .timeline::before {
        left: 0;
    }
    
    .timeline-item {
        width: 100%;
        margin-left: 0 !important;
        text-align: left !important;
        padding-left: 30px;
    }
    
    .timeline-item:nth-child(odd) .timeline-date,
    .timeline-item:nth-child(even) .timeline-date {
        left: 0;
        top: -40px;
    }
    
    .team-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}

/* Additional mobile breakpoint for smaller devices */
@media (max-width: 480px) {
    .leaders-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .leader-image-container {
        width: 140px;
        height: 140px;
    }
    
    .stat-item {
        min-width: 80px;
        padding: 0.75rem;
    }
    
    .stat-value {
        font-size: 1.8rem;
    }
    
    .stat-label {
        font-size: 0.8rem;
    }
    
    .glitch-text {
        font-size: 2.5rem !important;
    }
    
    .about-content {
        gap: 1.5rem;
    }
    
    .about-card-inner {
        padding: 1.5rem;
    }
    
    .tech-text {
        font-size: 1rem;
    }
    
    .cta-section {
        padding: 1.5rem;
        margin-top: 3rem;
    }
    
    .cyber-button {
        width: 100%;
        margin-bottom: 1rem;
    }
}

/* Specific breakpoint for headings on smaller screens */
@media (max-width: 700px) {
    .glitch-text {
        font-size: 2.8rem !important;
    }
    
    .text-3xl.md\\:text-4xl {
        font-size: 2rem;
    }
    
    .gradient-text-small {
        font-size: 1.4rem;
    }
    
    .leader-name {
        font-size: 1.2rem;
    }
    
    .cta-title {
        font-size: 1.6rem;
    }
    
    .mb-16 {
        margin-bottom: 1.5rem !important;
    }
    
    .mb-6 {
        margin-bottom: 0.75rem !important;
    }
}

/* Ensure all text is white */
.tech-text, p, .team-name, .testimonial-content, .cta-text {
    color: white !important;
}
';

// Add this line to include about.css via <link> tag in the head
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
                        ByteVerse is where innovation meets opportunity. We are a high-energy, 48-hour coding sprint
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
                    <p class="leader-bio">
                        Leading with vision and integrity, guiding our institution toward excellence in technology
                        education.
                    </p>
                    <div class="leader-socials">
                        <a href="#" class="social-link instagram" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
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
                    <p class="leader-bio">
                        Bringing strategic insight and educational expertise to foster growth and innovation across
                        campus.
                    </p>
                    <div class="leader-socials">
                        <a href="#" class="social-link instagram" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
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
                    <p class="leader-bio">
                        Driving operational excellence and ensuring our institution remains at the forefront of
                        educational innovation.
                    </p>
                    <div class="leader-socials">
                        <a href="#" class="social-link instagram" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <div class="cta-section">
            <div class="cta-bg"></div>
            <div class="cta-content">
                <h2 class="cta-title">Ready to join the <span class="text-cyan-400">ByteVerse</span>?</h2>
                <p class="cta-text">
                    Whether you are a coding wizard or just starting out, ByteVerse has a place for you.
                    Join hundreds of passionate innovators for a weekend of creation, learning, and fun.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="register.php" class="cyber-button primary">
                        <span>Register Now</span>
                        <i></i>
                    </a>
                    <a href="sponsor.php" class="cyber-button secondary">
                        <span>Become a Sponsor</span>
                        <i></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include terminal and footer -->
<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>