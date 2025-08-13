<?php
// Page-specific variables
$pageTitle = 'Contact Us | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Connect';
$loaderText = 'Loading communication channels...';
$currentPage = 'contact';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Contact Hero Section (No animated icons/text in background) -->
<section class="contact-hero relative overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="hero-content flex flex-col items-center text-center max-w-3xl mx-auto py-16">
            <div class="hero-badge flex items-center gap-2 mb-4">
                <span class="badge-icon text-2xl">📡</span>
                <span class="font-semibold uppercase tracking-wider text-sm">Communication Portal</span>
            </div>
            <h1 class="hero-title text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                <span class="block">GET IN</span>
                <span class="block gradient-text">TOUCH</span>
            </h1>
            <p class="hero-subtitle text-lg text-gray-300 mb-10">
                Ready to join the ByteVerse revolution? Let's connect and build the future together.
            </p>
            <div class="hero-stats flex flex-col md:flex-row gap-6 justify-center items-center w-full mt-4">
                <div class="stat-item bg-black/30 border border-cyan-500 rounded-xl px-8 py-6 flex flex-col items-center min-w-[160px]">
                    <span class="stat-number text-3xl font-bold text-cyan-400 mb-1">24/7</span>
                    <span class="stat-label text-sm text-gray-300 tracking-wide">SUPPORT</span>
                </div>
                <div class="stat-item bg-black/30 border border-cyan-500 rounded-xl px-8 py-6 flex flex-col items-center min-w-[160px]">
                    <span class="stat-number text-3xl font-bold text-cyan-400 mb-1">&lt; 1hr</span>
                    <span class="stat-label text-sm text-gray-300 tracking-wide">RESPONSE</span>
                </div>
                <div class="stat-item bg-black/30 border border-cyan-500 rounded-xl px-8 py-6 flex flex-col items-center min-w-[160px]">
                    <span class="stat-number text-3xl font-bold text-cyan-400 mb-1">500+</span>
                    <span class="stat-label text-sm text-gray-300 tracking-wide">HACKERS</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Contact Section -->
<section class="contact-main">
    <div class="container mx-auto px-4">
        <div class="contact-grid">
            <!-- Contact Cards -->
            <div class="contact-cards">
                <div class="section-header">
                    <h2 class="section-title">Multiple Ways to Connect</h2>
                    <p class="section-subtitle">Choose your preferred method of communication</p>
                </div>
                
                <div class="cards-grid">
                    <!-- Quick Chat Card -->
                    <div class="contact-card primary">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 12h8m-8 4h6m2 5l-1-1h-2.5A6.5 6.5 0 1 1 19 13.5V20z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Quick Chat</h3>
                            <p>Get instant answers to your questions</p>
                            <button class="card-action" onclick="window.open('https://wa.me/919877275894?text=Hello%20ByteVerse%20Team%2C%20I%20have%20an%20enquiry.', '_blank')">
                                <span>Start Chat</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </button>
                        </div>
                        <div class="card-status">
                            <div class="status-dot active"></div>
                            <span>Online Now</span>
                        </div>
                    </div>
                    
                    <!-- Email Card -->
                    <div class="contact-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="4" width="20" height="16" rx="2" stroke="currentColor" stroke-width="2"/>
                                <path d="m22 7-10 5L2 7" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Email Us</h3>
                            <p>enquiry_byteverse@ctgroup.in</p>
                            <a href="mailto:enquiry_byteverse@ctgroup.in" class="card-action">
                                <span>Send Email</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Phone Card -->
                    <div class="contact-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Call Us</h3>
                            <p>+91 9478529300</p>
                            <a href="tel:+919478529300" class="card-action">
                                <span>Call Now</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Location Card -->
                    <div class="contact-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Visit Us</h3>
                            <p>CT Group of Institutions, Shahpur Campus</p>
                            <a href="https://maps.google.com/?q=CT+Group+of+Institutions,+Shahpur+Campus" target="_blank" class="card-action">
                                <span>Get Directions</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Social Links -->
                <!-- <div class="social-section">
                    <h3>Follow Our Journey</h3>
                    <div class="social-links">
                        <a href="#" class="social-link instagram">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="social-link linkedin">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                            </svg>
                            <span>LinkedIn</span>
                        </a>
                        <a href="#" class="social-link github">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                            </svg>
                            <span>GitHub</span>
                        </a>
                        <a href="#" class="social-link twitter">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            <span>Twitter</span>
                        </a>
                    </div>
                </div> -->
            </div>
            
            <!-- Contact Form -->
            <div class="form-section">
                <div class="form-header">
                    <h2>Send us a Message</h2>
                    <p>Tell us about your project or just say hello</p>
                </div>
                
                <form id="contactForm" class="modern-form">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" required>
                            <div class="field-line"></div>
                        </div>
                        <div class="form-field">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required>
                            <div class="field-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="phone">Phone Number (Optional)</label>
                        <input type="tel" id="phone" name="phone">
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a topic</option>
                            <option value="general">General Inquiry</option>
                            <option value="sponsorship">Sponsorship</option>
                            <option value="mentorship">Mentorship</option>
                            <option value="participation">Participation</option>
                            <option value="technical">Technical Support</option>
                            <option value="media">Media & Press</option>
                        </select>
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Tell us about your project, ideas, or questions..." required></textarea>
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-footer">
                        <div class="form-info">
                            <div class="info-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 6v6l4 2"/>
                                </svg>
                                <span>Response within 1 hour</span>
                            </div>
                            <div class="info-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4"/>
                                    <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"/>
                                    <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"/>
                                </svg>
                                <span>Secure & Encrypted</span>
                            </div>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <span class="btn-text">Send Message</span>
                            <span class="btn-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13"/>
                                    <polygon points="22,2 15,22 11,13 2,9"/>
                                </svg>
                            </span>
                            <div class="btn-ripple"></div>
                        </button>
                    </div>
                    
                    <div class="form-status" id="formStatus"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<!-- <section class="faq-section">
    <div class="container mx-auto px-4">
        <div class="faq-header">
            <h2>Frequently Asked Questions</h2>
            <p>Quick answers to common questions about ByteVerse</p>
        </div>
        
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h3>When is ByteVerse happening?</h3>
                    <svg class="faq-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p>ByteVerse 1.0 is scheduled for [Date]. Stay tuned for exact dates and registration details.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h3>Who can participate?</h3>
                    <svg class="faq-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p>Students, professionals, and coding enthusiasts of all skill levels are welcome to join ByteVerse.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h3>What are the prizes?</h3>
                    <svg class="faq-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p>We have exciting prizes including cash rewards, internship opportunities, and exclusive ByteVerse merchandise.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h3>How do I register?</h3>
                    <svg class="faq-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p>Registration will open soon! Follow our social media or contact us to get notified when registration begins.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<style>
<?php include 'assets/css/contact-new.css'; ?>
/* Remove background revolving icons/text if any custom CSS exists */
.hero-bg-animation, .neural-network {
    display: none !important;
}
</style>

<script src="assets/js/contact-new.js"></script>
<script>
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    if (answer.style.display === "block") {
        answer.style.display = "none";
        element.classList.remove("open");
    } else {
        answer.style.display = "block";
        element.classList.add("open");
    }
}

// Optional: Hide all answers by default on page load
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.faq-answer').forEach(function(ans) {
        ans.style.display = "none";
    });
});
</script>

<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>