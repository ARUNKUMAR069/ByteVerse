<?php
// Page-specific variables
$pageTitle = 'Contact Us | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Connect';
$loaderText = 'Loading communication channels...';
$currentPage = 'contact';

// Include header
require_once('components/header.php');
?>

<!-- Contact Hero Section (No animated icons/text in background) -->

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
                    <!-- Email Card: Make the whole card clickable -->
                    <a href="mailto:enquiry_byteverse@ctgroup.in" class="contact-card primary" style="text-decoration:none;color:inherit;">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="4" width="20" height="16" rx="2" stroke="currentColor" stroke-width="2"/>
                                <path d="m22 7-10 5L2 7" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Email Us</h3>
                            <p>enquiry_byteverse@ctgroup.in</p>
                            <!-- <span class="card-action">
                                Send Email
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </span> -->
                        </div>
                    </a>
                    
                    <!-- Phone Card -->
                    <div class="contact-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Call Us</h3>
                            <p>+91 9877275894</p>
                            <!-- <a href="tel:+919877275894" class="card-action">
                                <span>Call Now</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a> -->
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
                            <!-- <a href="https://maps.google.com/?q=CT+Group+of+Institutions,+Shahpur+Campus" target="_blank" class="card-action">
                                <span>Get Directions</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="form-section">
                <div class="form-header">
                    <h2>Send us a Message</h2>
                    <p>Tell us about your project or just say hello</p>
                </div>
                
                <!-- FIXED: Added method="POST" and action attribute -->
                <form id="contactForm" class="modern-form" method="POST" action="backend/api/contact">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="firstName" required>
                            <div class="field-line"></div>
                        </div>
                        <div class="form-field">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="lastName" required>
                            <div class="field-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="phone">Phone Number (Optional)</label>
                        <input type="tel" id="phone" name="phone">
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required class="cyber-select">
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
                        <label for="message">Message *</label>
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
                    
                    <div class="form-status hidden" id="formStatus"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
<?php include 'assets/css/contact-new.css'; ?>
/* Remove background revolving icons/text if any custom CSS exists */
.hero-bg-animation, .neural-network {
    display: none !important;
}

/* Fix for dropdown visibility */
.form-field select {
    background-color: #111827;
    color: #f3f4f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
    padding: 0.75rem 1rem;
    border-radius: 4px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2306b6d4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.25em;
    padding-right: 2.5rem;
}

.form-field select:focus {
    outline: 2px solid rgba(6, 182, 212, 0.5);
    border-color: rgba(6, 182, 212, 0.7);
}

/* Make sure option text is visible */
.form-field select option {
    background-color: #1f2937; /* Darker background */
    color: #f3f4f6; /* Light text */
    padding: 10px;
}

/* Better dropdown styling for select on hover */
.form-field select:hover {
    border-color: rgba(6, 182, 212, 0.6);
}

/* Improve responsive card grid after removing one card */
@media (min-width: 768px) {
    .cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 767px) {
    .cards-grid {
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
    }
    
    /* Make email card stand out on mobile */
    .contact-card.primary {
        grid-column: 1 / -1;
    }
}

/* Improve contact-grid layout */
@media (max-width: 991px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .form-section {
        margin-top: 1rem;
    }
}

/* Fix for iOS select appearance */
@supports (-webkit-touch-callout: none) {
    .form-field select {
        font-size: 16px;
        /* Force custom dropdown arrow on iOS */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2306b6d4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") !important;
    }
}

/* Add to your existing CSS in contact.php or contact-new.css */
.form-field.error input,
.form-field.error select,
.form-field.error textarea {
    border-color: #ff5252 !important;
    background-color: rgba(255, 82, 82, 0.05);
}

.field-error-msg {
    color: #ff5252;
    font-size: 0.85rem;
    margin-top: 4px;
    font-family: inherit;
}

/* Loading state */
.modern-form.loading {
    position: relative;
    pointer-events: none;
    opacity: 0.8;
}

/* Form status message */
.form-status {
    padding: 12px 16px;
    margin-top: 20px;
    border-radius: 4px;
    display: flex;
    align-items: center;
}

.form-status.success {
    background-color: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.form-status.error {
    background-color: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.form-status.pending {
    background-color: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.form-status .status-icon {
    margin-right: 8px;
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