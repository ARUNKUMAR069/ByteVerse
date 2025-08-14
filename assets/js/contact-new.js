document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");
    const formStatus = document.getElementById("formStatus");
    
    if (contactForm) {
        // Form validation functions
        const validateEmail = (email) => {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        };
        
        const validateRequired = (value) => {
            return value && value.trim() !== '';
        };
        
        // Field validation with visual feedback
        const validateField = (field) => {
            const value = field.value;
            let isValid = true;
            
            if (field.hasAttribute('required') && !validateRequired(value)) {
                showFieldError(field, 'This field is required');
                isValid = false;
            } 
            else if (field.type === 'email' && value && !validateEmail(value)) {
                showFieldError(field, 'Please enter a valid email address');
                isValid = false;
            }
            
            if (isValid) {
                removeFieldError(field);
            }
            
            return isValid;
        };
        
        const showFieldError = (field, message) => {
            field.classList.add('error');
            let errorMsg = field.parentElement.querySelector('.field-error-msg');
            if (!errorMsg) {
                errorMsg = document.createElement('div');
                errorMsg.className = 'field-error-msg';
                field.parentElement.appendChild(errorMsg);
            }
            errorMsg.textContent = message;
        };
        
        const removeFieldError = (field) => {
            field.classList.remove('error');
            const errorMsg = field.parentElement.querySelector('.field-error-msg');
            if (errorMsg) errorMsg.remove();
        };
        
        // IMPORTANT: Prevent default form submission and handle with AJAX
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault(); // This prevents the form from submitting normally
            
            // Validate all fields before submission
            let formValid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!validateField(field)) {
                    formValid = false;
                }
            });
            
            if (!formValid) {
                showStatus("Please fill all required fields correctly", "error");
                return;
            }
            
            // Get form data
            const formData = new FormData(contactForm);
            
            // Show sending status
            showStatus("Sending your message...", "pending");
            
            // Add loading state to form
            contactForm.classList.add('loading');
            
            // Send data to the server via fetch
            fetch('backend/api/contact', {
                method: 'POST',
                body: formData
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
                } else {
                    showStatus(data.message, "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showStatus("An error occurred. Please try again later.", "error");
            })
            .finally(() => {
                // Remove loading state
                contactForm.classList.remove('loading');
            });
        });
        
        // Individual field validation on blur
        const formFields = contactForm.querySelectorAll('input, select, textarea');
        formFields.forEach(field => {
            field.addEventListener('blur', () => {
                if (field.value) validateField(field);
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