document.addEventListener("DOMContentLoaded", function() {
    // Form elements
    const form = document.getElementById('registration-form');
    const steps = document.querySelectorAll('.step');
    const stepCircles = document.querySelectorAll('.step-circle');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    
    // Team size selection handler
    const teamSizeSelect = document.getElementById('team_size');
    const additionalMembersContainer = document.getElementById('additional-members');
    
    // Razorpay button
    const razorpayButton = document.getElementById('razorpay-button');
    const submitButton = document.getElementById('submit-registration');
    
    // Initialize the form
    let currentStep = 1;
    updateStepIndicators(currentStep);
    
    // Handle step navigation - next buttons
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.getAttribute('data-next'));
            
            if (validateStep(currentStep)) {
                showStep(nextStep);
                currentStep = nextStep;
                updateStepIndicators(currentStep);
                
                // Scroll to top of form
                form.scrollIntoView({ behavior: 'smooth' });
            } else {
                // Shake animation for validation errors
                const invalidInputs = document.querySelectorAll(`#step-${currentStep} .cyber-input:invalid, #step-${currentStep} .checkbox-control:invalid`);
                invalidInputs.forEach(input => {
                    input.classList.add('shake-error');
                    setTimeout(() => {
                        input.classList.remove('shake-error');
                    }, 600);
                });
                
                // Focus first invalid field
                if (invalidInputs.length > 0) {
                    invalidInputs[0].focus();
                }
            }
        });
    });
    
    // Handle step navigation - previous buttons
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.getAttribute('data-prev'));
            showStep(prevStep);
            currentStep = prevStep;
            updateStepIndicators(currentStep);
            
            // Scroll to top of form
            form.scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // Handle team size selection to generate member fields
    if (teamSizeSelect) {
        teamSizeSelect.addEventListener('change', function() {
            const teamSize = parseInt(this.value);
            generateTeamMemberFields(teamSize);
        });
    }
    
    // Initialize Razorpay on button click
    if (razorpayButton) {
        razorpayButton.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                initializeRazorpayPayment();
            }
        });
    }
    
    // Form submission handler
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (document.getElementById('payment_status').value !== 'completed') {
                showPaymentError("Please complete the payment before submitting");
                return;
            }
            
            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<span>Processing...</span><i></i>';
            
            // Submit the form data to Firebase
            saveRegistrationData()
                .then(() => {
                    // Hide form and show success message
                    form.style.display = 'none';
                    document.getElementById('registration-success').style.display = 'block';
                })
                .catch(error => {
                    console.error("Error saving registration:", error);
                    alert("An error occurred while saving your registration. Please try again.");
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<span>Complete Registration</span><i></i>';
                });
        });
    }
    
    // Functions
    
    // Show a specific step
    function showStep(stepNumber) {
        steps.forEach(step => {
            step.style.display = 'none';
        });
        
        document.getElementById(`step-${stepNumber}`).style.display = 'block';
    }
    
    // Update step indicators
    function updateStepIndicators(currentStep) {
        stepCircles.forEach((circle, index) => {
            // +1 because step indices are 0-based but our steps are 1-based
            const stepNum = index + 1;
            
            if (stepNum < currentStep) {
                // Completed steps
                circle.classList.add('active', 'completed');
                circle.classList.remove('current');
                circle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
            } else if (stepNum === currentStep) {
                // Current step
                circle.classList.add('active', 'current');
                circle.classList.remove('completed');
                circle.innerHTML = stepNum;
            } else {
                // Future steps
                circle.classList.remove('active', 'current', 'completed');
                circle.innerHTML = stepNum;
            }
        });
    }
    
    // Validate the current step
    function validateStep(stepNumber) {
        const currentStepEl = document.getElementById(`step-${stepNumber}`);
        const requiredInputs = currentStepEl.querySelectorAll('[required]');
        let isValid = true;
        
        requiredInputs.forEach(input => {
            if (!input.value.trim() && input.type !== 'checkbox') {
                input.classList.add('error');
                isValid = false;
            } else if (input.type === 'checkbox' && !input.checked) {
                input.parentElement.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
                if (input.type === 'checkbox') {
                    input.parentElement.classList.remove('error');
                }
            }
            
            // Email validation
            if (input.type === 'email' && input.value.trim()) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.value)) {
                    input.classList.add('error');
                    isValid = false;
                }
            }
        });
        
        // Special validation for checkboxes - technologies
        if (stepNumber === 3) {
            const techCheckboxes = currentStepEl.querySelectorAll('input[name="technologies[]"]:checked');
            if (techCheckboxes.length === 0) {
                currentStepEl.querySelector('.tech-checkboxes').classList.add('error-border');
                currentStepEl.querySelector('.group-error').style.display = 'block';
                isValid = false;
            } else {
                currentStepEl.querySelector('.tech-checkboxes').classList.remove('error-border');
                currentStepEl.querySelector('.group-error').style.display = 'none';
            }
        }
        
        return isValid;
    }
    
    // Generate team member form fields based on team size
    function generateTeamMemberFields(teamSize) {
        // Clear previous fields
        additionalMembersContainer.innerHTML = '';
        
        // Generate fields for additional members (excluding the leader)
        for (let i = 1; i < teamSize; i++) {
            const memberNum = i + 1; // Start from 2 since 1 is the leader
            
            const memberCard = document.createElement('div');
            memberCard.className = 'team-member-card mb-8 opacity-0';
            memberCard.style.transform = 'translateY(20px)';
            memberCard.innerHTML = `
                <div class="card-header flex justify-between items-center mb-4">
                    <h3 class="text-xl text-white">Team Member ${memberNum}</h3>
                    <span class="badge bg-gray-800 text-gray-400 py-1 px-3 rounded-full text-sm">Member</span>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="member${memberNum}_name" class="input-label field-required">Full Name</label>
                        <input type="text" class="cyber-input" id="member${memberNum}_name" name="member${memberNum}_name" placeholder="Member's full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="member${memberNum}_email" class="input-label field-required">Email Address</label>
                        <input type="email" class="cyber-input" id="member${memberNum}_email" name="member${memberNum}_email" placeholder="Member's email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="member${memberNum}_phone" class="input-label field-required">Phone Number</label>
                        <input type="tel" class="cyber-input" id="member${memberNum}_phone" name="member${memberNum}_phone" placeholder="Member's phone number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="member${memberNum}_role" class="input-label field-required">Role in Team</label>
                        <div class="select-wrapper">
                            <select class="cyber-input" id="member${memberNum}_role" name="member${memberNum}_role" required>
                                <option value="" disabled selected>Select role</option>
                                <option value="frontend">Frontend Developer</option>
                                <option value="backend">Backend Developer</option>
                                <option value="fullstack">Full Stack Developer</option>
                                <option value="mobile">Mobile Developer</option>
                                <option value="ui_ux">UI/UX Designer</option>
                                <option value="ml_ai">ML/AI Engineer</option>
                                <option value="devops">DevOps Engineer</option>
                                <option value="project_manager">Project Manager</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            
            additionalMembersContainer.appendChild(memberCard);
            
            // Animate appearance
            setTimeout(() => {
                memberCard.style.transition = 'opacity 0.5s, transform 0.5s';
                memberCard.style.opacity = '1';
                memberCard.style.transform = 'translateY(0)';
            }, 50 * i);
        }
        
        // Initialize typing effect for new inputs
        const newInputs = additionalMembersContainer.querySelectorAll('.cyber-input');
        applyTypingEffectToInputs(newInputs);
    }
    
    // Initialize Razorpay with enhanced UI and feedback
    function initializeRazorpayPayment() {
        // Get team info for the order
        const teamName = document.getElementById('team_name').value;
        const leaderEmail = document.getElementById('leader_email').value;
        const leaderName = document.getElementById('leader_name').value;
        const leaderPhone = document.getElementById('leader_phone').value;
        
        // Change button to loading state with animation
        razorpayButton.disabled = true;
        razorpayButton.innerHTML = `
            <div class="payment-loader">
                <span>Initializing Payment</span>
                <div class="loader-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        `;
        
        // Show a processing overlay
        const paymentProcessingOverlay = document.createElement('div');
        paymentProcessingOverlay.className = 'payment-processing-overlay';
        paymentProcessingOverlay.innerHTML = `
            <div class="payment-processing-content">
                <div class="cyber-spinner"></div>
                <div class="processing-text">Connecting to payment gateway...</div>
            </div>
        `;
        document.body.appendChild(paymentProcessingOverlay);
        
        // Check if Razorpay is loaded
        if (typeof Razorpay === 'undefined') {
            console.error("Razorpay SDK is not loaded");
            
            // Remove processing overlay
            if (document.body.contains(paymentProcessingOverlay)) {
                document.body.removeChild(paymentProcessingOverlay);
            }
            
            // Show error message
            showPaymentError("Payment gateway not loaded. Please refresh the page and try again.");
            
            // Reset button state
            razorpayButton.disabled = false;
            razorpayButton.innerHTML = '<span>Try Again ₹500</span>';
            return;
        }
        
        // Razorpay options with enhanced configuration
        const options = {
            key: "rzp_test_hM7CeyUq1NGLLA", // Your Razorpay test key ID
            amount: 50000, // Amount in paisa (₹500)
            currency: "INR",
            name: "ByteVerse 1.0",
            description: "Team Registration Fee",
            image: "assets/img/logo.png", // Your logo URL
            handler: function(response) {
                // Remove processing overlay
                document.body.removeChild(paymentProcessingOverlay);
                
                // Payment was successful
                document.getElementById('payment_id').value = response.razorpay_payment_id;
                document.getElementById('payment_status').value = 'completed';
                
                // Show success message with animation
                showPaymentSuccess(response.razorpay_payment_id);
                
                // Enable the submit button with animation
                submitButton.disabled = false;
                submitButton.classList.add('pulse-success');
                setTimeout(() => submitButton.classList.remove('pulse-success'), 2000);
                
                // Add confetti effect for successful payment
                launchConfetti();
            },
            prefill: {
                name: leaderName,
                email: leaderEmail,
                contact: leaderPhone
            },
            notes: {
                team_name: teamName
            },
            theme: {
                color: "#00D7FE" // ByteVerse cyan
            },
            modal: {
                ondismiss: function() {
                    // Remove processing overlay
                    if (document.body.contains(paymentProcessingOverlay)) {
                        document.body.removeChild(paymentProcessingOverlay);
                    }
                    
                    // Reset button state
                    razorpayButton.disabled = false;
                    razorpayButton.innerHTML = '<span>Pay Now ₹500</span>';
                }
            }
        };
        
        // Create Razorpay object with error handling
        try {
            const rzp = new Razorpay(options);
            
            // Open Razorpay checkout
            setTimeout(() => {
                rzp.open();
            }, 1000); // Slight delay for better UX
        } catch (error) {
            console.error("Razorpay initialization error:", error);
            
            // Remove processing overlay
            if (document.body.contains(paymentProcessingOverlay)) {
                document.body.removeChild(paymentProcessingOverlay);
            }
            
            // Show error message
            showPaymentError("Failed to initialize payment gateway. Please try again.");
            
            // Reset button
            razorpayButton.disabled = false;
            razorpayButton.innerHTML = '<span>Try Again ₹500</span>';
        }
    }
    
    // Simple confetti effect for payment success
    function launchConfetti() {
        const confettiContainer = document.createElement('div');
        confettiContainer.className = 'confetti-container';
        document.body.appendChild(confettiContainer);
        
        const colors = ['#00D7FE', '#BD00FF', '#00FF66', '#FF7700'];
        
        for (let i = 0; i < 100; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            confetti.style.opacity = Math.random() + 0.5;
            confettiContainer.appendChild(confetti);
        }
        
        setTimeout(() => {
            document.body.removeChild(confettiContainer);
        }, 5000);
    }
    
    // Enhance payment success display
    function showPaymentSuccess(paymentId) {
        const paymentStatus = document.getElementById('payment-status');
        paymentStatus.classList.remove('hidden');
        
        // Create success animation with typing effect for the transaction ID
        paymentStatus.innerHTML = `
            <div class="payment-success-card">
                <div class="success-icon-animate">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                    </svg>
                </div>
                <div class="success-title">Payment Successful!</div>
                <div class="transaction-id-container">
                    <span class="transaction-label">Transaction ID:</span>
                    <span class="transaction-id typing-effect">${paymentId}</span>
                </div>
                <div class="success-message">
                    Your payment has been processed successfully. You can now complete your registration.
                </div>
            </div>
        `;
        
        // Hide the pay now button with slide-out animation
        razorpayButton.style.animation = 'slide-out-right 0.5s forwards';
        setTimeout(() => {
            razorpayButton.style.display = 'none';
        }, 500);
    }
    
    // Show payment error message
    function showPaymentError(message) {
        const paymentStatus = document.getElementById('payment-status');
        paymentStatus.classList.remove('hidden');
        paymentStatus.innerHTML = `
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Payment Error:</strong>
                <span class="block sm:inline"> ${message}</span>
            </div>
        `;
    }
    
    // Save registration data to Firebase
    async function saveRegistrationData() {
        // Get form data
        const formData = new FormData(form);
        const teamData = {
            team_name: formData.get('team_name'),
            team_size: formData.get('team_size'),
            institution: formData.get('institution'),
            challenge_track: formData.get('challenge_track'),
            project_title: formData.get('project_title'),
            project_description: formData.get('project_description'),
            technologies: formData.getAll('technologies[]'),
            payment_id: formData.get('payment_id'),
            payment_status: formData.get('payment_status'),
            registration_date: new Date().toISOString(),
            members: [
                {
                    name: formData.get('leader_name'),
                    email: formData.get('leader_email'),
                    phone: formData.get('leader_phone'),
                    role: formData.get('leader_role'),
                    is_leader: true
                }
            ]
        };
        
        // Add other team members
        const teamSize = parseInt(formData.get('team_size'));
        for (let i = 2; i <= teamSize; i++) {
            teamData.members.push({
                name: formData.get(`member${i}_name`),
                email: formData.get(`member${i}_email`),
                phone: formData.get(`member${i}_phone`),
                role: formData.get(`member${i}_role`),
                is_leader: false
            });
        }
        
        // Save to Firebase
        try {
            const db = firebase.firestore();
            await db.collection('teams').add(teamData);
            return true;
        } catch (error) {
            console.error("Error saving registration:", error);
            throw error;
        }
    }
    
    // Apply typing effect to a specific set of inputs
    function applyTypingEffectToInputs(inputs) {
        const colors = ['#00D7FE', '#BD00FF', '#00FF66', '#FF7700'];
        
        inputs.forEach(input => {
            let colorIndex = 0;
            let typingTimer;
            
            input.addEventListener('input', function() {
                // Clear existing timer
                clearTimeout(typingTimer);
                
                // Create ripple effect
                const ripple = document.createElement('span');
                ripple.className = 'input-ripple';
                ripple.style.position = 'absolute';
                ripple.style.backgroundColor = colors[colorIndex];
                ripple.style.borderRadius = '50%';
                ripple.style.transformOrigin = 'center';
                ripple.style.pointerEvents = 'none';
                ripple.style.zIndex = '0';
                ripple.style.opacity = '0.2';
                
                // Position ripple near cursor (approximate)
                const rect = this.getBoundingClientRect();
                const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Calculate where to place ripple based on input text length
                const textWidth = this.value.length * 8; // Approximate character width
                const rippleX = Math.min(textWidth, rect.width - 40);
                
                ripple.style.width = '12px';
                ripple.style.height = '12px';
                ripple.style.left = `${rippleX}px`;
                ripple.style.top = `${rect.height/2 - 6}px`;
                
                // Add to parent if it's positioned
                if (this.parentNode.style.position !== 'static') {
                    this.parentNode.appendChild(ripple);
                    
                    // Animate ripple
                    ripple.animate([
                        { transform: 'scale(1)', opacity: '0.2' },
                        { transform: 'scale(8)', opacity: '0' }
                    ], {
                        duration: 600,
                        easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
                    });
                    
                    // Remove after animation
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                }
                
                // Change color
                colorIndex = (colorIndex + 1) % colors.length;
                const currentColor = colors[colorIndex];
                
                // Apply to border with glow
                this.style.borderColor = currentColor;
                this.style.boxShadow = `0 0 12px rgba(${hexToRgb(currentColor)}, 0.5), inset 0 0 5px rgba(${hexToRgb(currentColor)}, 0.2)`;
                
                // Apply to text with glow
                if (this.value) {
                    this.style.color = currentColor;
                    this.style.textShadow = `0 0 2px rgba(${hexToRgb(currentColor)}, 0.7)`;
                    
                    // Add a slight bump animation for feedback
                    this.animate([
                        { transform: 'translateY(0)' },
                        { transform: 'translateY(-1px)' },
                        { transform: 'translateY(0)' }
                    ], {
                        duration: 120,
                        easing: 'ease-out'
                    });
                }
                
                // Reset after a delay of inactivity
                typingTimer = setTimeout(() => {
                    if (this.value) {
                        // Keep color but reduce glow
                        this.style.boxShadow = `0 0 8px rgba(${hexToRgb(currentColor)}, 0.3)`;
                        this.style.textShadow = `0 0 1px rgba(${hexToRgb(currentColor)}, 0.5)`;
                    } else {
                        // Reset if empty
                        this.style.color = '';
                        this.style.textShadow = '';
                        this.style.borderColor = '';
                        this.style.boxShadow = '';
                    }
                }, 2000);
            });
            
            // Handle focus state
            input.addEventListener('focus', function() {
                const baseColor = colors[0];
                this.style.borderColor = baseColor;
                this.style.boxShadow = `0 0 15px rgba(${hexToRgb(baseColor)}, 0.4), inset 0 0 5px rgba(${hexToRgb(baseColor)}, 0.2)`;
                
                // Add a mini scanner line animation on focus
                const scanner = document.createElement('div');
                scanner.className = 'input-scanner';
                scanner.style.position = 'absolute';
                scanner.style.height = '2px';
                scanner.style.width = '100%';
                scanner.style.top = '0';
                scanner.style.left = '0';
                scanner.style.background = `linear-gradient(90deg, 
                    transparent 0%, 
                    ${baseColor} 50%,
                    transparent 100%)`;
                scanner.style.opacity = '0.7';
                scanner.style.zIndex = '1';
                scanner.style.animation = 'scan-input 2s infinite';
                scanner.style.pointerEvents = 'none';
                
                if (this.parentNode.style.position !== 'static') {
                    this.parentNode.appendChild(scanner);
                }
                
                // Add this keyframe to your CSS
                // @keyframes scan-input {
                //   0% { transform: translateY(0); }
                //   100% { transform: translateY(100%); }
                // }
            });
            
            // Handle blur state
            input.addEventListener('blur', function() {
                // Remove any scanners
                const scanner = this.parentNode.querySelector('.input-scanner');
                if (scanner) {
                    scanner.parentNode.removeChild(scanner);
                }
                
                if (!this.value) {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                }
            });
        });
    }
    
    // Helper function to convert hex to RGB
    function hexToRgb(hex) {
        hex = hex.replace('#', '');
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);
        return `${r}, ${g}, ${b}`;
    }
    
    // Enhance select/dropdown interactivity
    function enhanceDropdowns() {
        const selects = document.querySelectorAll('select.cyber-input');
        
        selects.forEach(select => {
            // Add open/close animation for dropdowns
            select.addEventListener('mousedown', function() {
                // Pulse animation on dropdown click
                this.animate([
                    { boxShadow: '0 0 0px rgba(0, 215, 254, 0.7)' },
                    { boxShadow: '0 0 20px rgba(0, 215, 254, 0.7)' },
                    { boxShadow: '0 0 5px rgba(0, 215, 254, 0.7)' }
                ], {
                    duration: 300,
                    easing: 'ease-out'
                });
            });
            
            // Style changes when the dropdown shows options
            select.addEventListener('change', function() {
                // Add a "selected" class to the selected option
                Array.from(this.options).forEach(option => {
                    if (option.selected) {
                        this.style.color = '#00D7FE';
                        this.style.fontWeight = 'bold';
                    }
                });
                
                // Create a success ripple
                const wrapper = this.closest('.select-wrapper');
                if (wrapper) {
                    const ripple = document.createElement('div');
                    ripple.className = 'select-success-ripple';
                    ripple.style.position = 'absolute';
                    ripple.style.inset = '0';
                    ripple.style.borderRadius = '6px';
                    ripple.style.border = '2px solid #00FF66';
                    ripple.style.opacity = '0';
                    ripple.style.pointerEvents = 'none';
                    
                    wrapper.appendChild(ripple);
                    
                    ripple.animate([
                        { opacity: '0.7', transform: 'scale(1)' },
                        { opacity: '0', transform: 'scale(1.05)' }
                    ], {
                        duration: 400,
                        easing: 'ease-out'
                    });
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 400);
                }
            });
        });
    }
    
    // Initialize typing effect for inputs
    function initTypingEffect() {
        const inputs = document.querySelectorAll('.cyber-input');
        applyTypingEffectToInputs(inputs);
    }
    
    // Initialize all enhancements
    initTypingEffect();
    enhanceDropdowns();
    
    // Make form labels more interactive
    const formLabels = document.querySelectorAll('.input-label');
    formLabels.forEach(label => {
        label.addEventListener('click', function() {
            const inputId = this.getAttribute('for');
            if (inputId) {
                const input = document.getElementById(inputId);
                if (input) {
                    input.focus();
                }
            }
        });
    });
    
    // Add this to your CSS
    document.head.insertAdjacentHTML('beforeend', `
    <style>
    @keyframes scan-input {
      0% { transform: translateY(0); }
      100% { transform: translateY(100%); }
    }
    </style>
    `);
});