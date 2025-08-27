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
                
                <!-- Added security attributes: autocomplete, novalidate (for custom validation) -->
                <form id="contactForm" class="modern-form" method="POST" action="backend/api/contact" autocomplete="off" novalidate>
                    <!-- CSRF protection token - server side will validate this -->
                    <input type="hidden" name="csrf_token" value="<?php echo isset($_SESSION['csrf_token']) ? htmlspecialchars($_SESSION['csrf_token']) : ''; ?>">
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label for="firstName">First Name *</label>
                            <!-- Enhanced with pattern attribute for name validation -->
                            <input type="text" id="firstName" name="firstName" 
                                   required
                                   pattern="^[A-Za-z\s]{1,50}$"
                                   title="Letters only, maximum 50 characters"
                                   maxlength="50">
                            <div class="field-line"></div>
                        </div>
                        <div class="form-field">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="lastName" 
                                   required
                                   pattern="^[A-Za-z\s]{1,50}$"
                                   title="Letters only, maximum 50 characters"
                                   maxlength="50">
                            <div class="field-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="email">Email Address *</label>
                        <!-- Enhanced email validation pattern -->
                        <input type="email" id="email" name="email" 
                               required
                               pattern="^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
                               title="Please enter a valid email address"
                               maxlength="100">
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="phone">Phone Number (Optional)</label>
                        <!-- Added phone number validation -->
                        <input type="tel" id="phone" name="phone"
                               pattern="^[0-9+\-\s()]{6,20}$"
                               title="Valid phone number, 6-20 digits"
                               maxlength="20">
                        <div class="field-line"></div>
                    </div>
                    
                    <div class="form-field">
                        <label for="subject">Subject *</label>
                        <!-- Limited to specific options to prevent injection -->
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
                        <!-- Limited message length and will be sanitized -->
                        <textarea id="message" name="message" 
                                 rows="6" 
                                 placeholder="Tell us about your project, ideas, or questions..." 
                                 required
                                 maxlength="1000"></textarea>
                        <div class="field-line"></div>
                        <small class="char-count"><span id="messageChars">0</span>/1000 characters</small>
                    </div>
                    
                    <!-- Added honeypot field to catch bots -->
                    <div class="form-field" style="display:none;">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
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
                        
                        <!-- Added extra protection against double submission -->
                        <button type="submit" class="submit-btn" id="submitBtn">
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

/* Add character count style */
.char-count {
    display: block;
    text-align: right;
    font-size: 0.75rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

/* Error highlight for validation failures */
input:invalid:not(:placeholder-shown),
textarea:invalid:not(:placeholder-shown),
select:invalid:not(:focus) {
    border-color: #ef4444 !important;
}

/* Give visual feedback when input passes validation */
input:valid:not(:placeholder-shown),
textarea:valid:not(:placeholder-shown),
select:valid:not([value=""]) {
    border-color: #22c55e !important;
}
</style>

<!-- Updated JavaScript with enhanced validation and security -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");
    const formStatus = document.getElementById("formStatus");
    const submitBtn = document.getElementById("submitBtn");
    const messageField = document.getElementById("message");
    const messageChars = document.getElementById("messageChars");
    
    // Character counter for message
    if (messageField && messageChars) {
        messageField.addEventListener("input", function() {
            const length = this.value.length;
            messageChars.textContent = length;
            
            // Visual feedback for character limit
            if (length > 950) {
                messageChars.style.color = length >= 1000 ? "#ef4444" : "#f59e0b";
            } else {
                messageChars.style.color = "";
            }
        });
    }
    
    if (contactForm) {
        // Security-enhanced validation functions
        const validateEmail = (email) => {
            // Strict email regex pattern
            const re = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
            return re.test(String(email).toLowerCase()) && email.length <= 100;
        };
        
        const validateName = (name) => {
            // Only letters, spaces, hyphens, apostrophes
            const re = /^[A-Za-z\s'\-]{1,50}$/;
            return re.test(name);
        };
        
        const validatePhone = (phone) => {
            // Basic phone validation: numbers, +, -, (), spaces
            if (!phone) return true; // Optional field
            const re = /^[0-9+\-\s()]{6,20}$/;
            return re.test(phone);
        };
        
        const validateMessage = (message) => {
            // Limit length and disallow dangerous HTML/JS
            if (!message || message.length > 1000) return false;
            
            // Check for potential script tags, iframes, etc.
            const dangerousPatterns = [
                /<script/i, 
                /<\/script>/i, 
                /<iframe/i, 
                /<object/i, 
                /javascript:/i, 
                /onerror=/i, 
                /onload=/i, 
                /onclick=/i
            ];
            
            return !dangerousPatterns.some(pattern => pattern.test(message));
        };
        
        // Sanitize input to prevent XSS
        const sanitizeInput = (input) => {
            if (!input) return '';
            
            // Convert HTML entities
            return input
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        };
        
        // Field validation with visual feedback
        const validateField = (field) => {
            const value = field.value.trim();
            let isValid = true;
            let errorMessage = '';
            
            // Check if field is required
            if (field.hasAttribute('required') && !value) {
                isValid = false;
                errorMessage = 'This field is required';
            } 
            // Type-specific validation
            else if (value) {
                switch(field.id) {
                    case 'firstName':
                    case 'lastName':
                        if (!validateName(value)) {
                            isValid = false;
                            errorMessage = 'Please enter a valid name (letters only)';
                        }
                        break;
                        
                    case 'email':
                        if (!validateEmail(value)) {
                            isValid = false;
                            errorMessage = 'Please enter a valid email address';
                        }
                        break;
                        
                    case 'phone':
                        if (!validatePhone(value)) {
                            isValid = false;
                            errorMessage = 'Please enter a valid phone number';
                        }
                        break;
                        
                    case 'message':
                        if (!validateMessage(value)) {
                            isValid = false;
                            errorMessage = value.length > 1000 ? 
                                'Message is too long (max 1000 characters)' : 
                                'Message contains invalid content';
                        }
                        break;
                }
            }
            
            if (isValid) {
                removeFieldError(field);
            } else {
                showFieldError(field, errorMessage);
            }
            
            return isValid;
        };
        
        const showFieldError = (field, message) => {
            field.classList.add('error');
            const parent = field.parentElement;
            
            // Create error message element if it doesn't exist
            let errorMsg = parent.querySelector('.field-error-msg');
            if (!errorMsg) {
                errorMsg = document.createElement('div');
                errorMsg.className = 'field-error-msg';
                parent.appendChild(errorMsg);
            }
            errorMsg.textContent = message;
        };
        
        const removeFieldError = (field) => {
            field.classList.remove('error');
            const errorMsg = field.parentElement.querySelector('.field-error-msg');
            if (errorMsg) errorMsg.remove();
        };
        
        // Form submission handler with security enhancements
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Disable button to prevent double submission
            submitBtn.disabled = true;
            
            // Check honeypot field
            const honeypot = document.getElementById('website');
            if (honeypot && honeypot.value) {
                console.log('Bot submission detected');
                setTimeout(() => {
                    showStatus("Form submitted successfully!", "success");
                    contactForm.reset();
                    submitBtn.disabled = false;
                }, 1500);
                return;
            }
            
            // Validate all fields before submission
            let formValid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!validateField(field)) {
                    formValid = false;
                }
            });
            
            // Also validate optional phone if provided
            const phone = document.getElementById('phone');
            if (phone && phone.value && !validateField(phone)) {
                formValid = false;
            }
            
            // Stop submission if form is invalid
            if (!formValid) {
                showStatus("Please fill all fields correctly", "error");
                submitBtn.disabled = false;
                return;
            }
            
            // Show sending status
            showStatus("Sending your message...", "pending");
            
            // Add loading state to form
            contactForm.classList.add('loading');
            
            // Prepare form data with sanitized inputs
            const formData = new FormData();
            
            // Add CSRF token
            const csrfToken = document.querySelector('input[name="csrf_token"]').value;
            formData.append('csrf_token', csrfToken);
            
            // Add sanitized form fields
            formData.append('firstName', sanitizeInput(document.getElementById('firstName').value.trim()));
            formData.append('lastName', sanitizeInput(document.getElementById('lastName').value.trim()));
            formData.append('email', sanitizeInput(document.getElementById('email').value.trim()));
            formData.append('phone', sanitizeInput(document.getElementById('phone').value.trim()));
            formData.append('subject', document.getElementById('subject').value);
            formData.append('message', sanitizeInput(document.getElementById('message').value.trim()));
            
            // Add timestamp to avoid caching
            formData.append('timestamp', new Date().getTime());
            
            // Send data to the server with fetch API
            fetch('backend/api/contact', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Network error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showStatus(data.message, "success");
                    contactForm.reset();
                    if (messageChars) messageChars.textContent = '0';
                } else {
                    showStatus(data.message || "An error occurred", "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showStatus("An error occurred. Please try again later.", "error");
            })
            .finally(() => {
                // Remove loading state and re-enable button
                contactForm.classList.remove('loading');
                submitBtn.disabled = false;
            });
        });
        
        // Individual field validation on blur
        const formFields = contactForm.querySelectorAll('input, select, textarea');
        formFields.forEach(field => {
            // Skip honeypot field
            if (field.id === 'website') return;
            
            field.addEventListener('blur', () => {
                if (field.value.trim()) validateField(field);
            });
            
            field.addEventListener('input', () => {
                if (field.classList.contains('error')) {
                    removeFieldError(field);
                }
            });
        });
    }
    
    // Display status message with improved styling
    function showStatus(message, type) {
        if (!formStatus) return;
        
        formStatus.textContent = message;
        formStatus.className = "form-status mt-4";
        formStatus.classList.remove("hidden");
        formStatus.classList.remove("success", "error", "pending");
        
        if (type) {
            formStatus.classList.add(type);
            
            const icon = document.createElement('span');
            icon.className = 'status-icon';
            
            switch(type) {
                case 'success':
                    icon.innerHTML = '✓';
                    break;
                case 'error':
                    icon.innerHTML = '✗';
                    break;
                case 'pending':
                    icon.innerHTML = '⟳';
                    break;
            }
            
            formStatus.prepend(icon);
        }
        
        // Auto-hide success messages after 5 seconds
        if (type === "success") {
            setTimeout(() => {
                formStatus.classList.add("fade-out");
                setTimeout(() => {
                    formStatus.classList.add("hidden");
                    formStatus.classList.remove("fade-out");
                }, 500);
            }, 5000);
        }
        
        // Scroll to status message
        formStatus.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});

// Remove other scripts that aren't needed for the contact form
</script>

<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>