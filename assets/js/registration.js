document.addEventListener("DOMContentLoaded", function() {
    const registrationForm = document.getElementById("registration-form");
    const steps = document.querySelectorAll(".step");
    const nextButtons = document.querySelectorAll(".next-step");
    const prevButtons = document.querySelectorAll(".prev-step");
    const stepCircles = document.querySelectorAll(".step-circle");
    const submitButton = document.getElementById("submit-registration");
    
    // Initialize session ID from localStorage (or create empty one)
    let sessionId = localStorage.getItem('registration_session_id') || '';
    
    // Set up API endpoint
    const API_ENDPOINT = 'backend/api/registration.php';
    
    // Initialize steps
    let currentStep = 1;
    
    // Set up step navigation
    nextButtons.forEach(button => {
        button.addEventListener("click", function() {
            const nextStep = parseInt(this.getAttribute('data-next'));
            
            // Validate current step before proceeding
            if (validateStep(currentStep)) {
                // Save current step data
                saveStepData(currentStep)
                    .then(response => {
                        if (response.success) {
                            // Save session ID if it's returned
                            if (response.data && response.data.session_id) {
                                sessionId = response.data.session_id;
                                localStorage.setItem('registration_session_id', sessionId);
                            }
                            
                            // Move to next step
                            goToStep(nextStep);
                        } else {
                            showError(response.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error saving step data:", error);
                        showError("An error occurred. Please try again.");
                    });
            }
        });
    });
    
    prevButtons.forEach(button => {
        button.addEventListener("click", function() {
            const prevStep = parseInt(this.getAttribute('data-prev'));
            goToStep(prevStep);
        });
    });
    
    // Handle form submission
    if (registrationForm) {
        registrationForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Validate final step
            if (validateStep(3)) {
                submitRegistration();
            }
        });
    }
    
    // Function to validate step data
    function validateStep(step) {
        // Reset all error messages
        const errorMessages = document.querySelectorAll(".form-error");
        errorMessages.forEach(msg => msg.style.display = "none");
        
        switch (step) {
            case 1: // Team Information
                return validateStepOne();
            case 2: // Team Members
                return validateStepTwo();
            case 3: // Project Details
                return validateStepThree();
            default:
                return false;
        }
    }
    
    // Validate Step 1: Team Information
    function validateStepOne() {
        const teamName = document.getElementById("team_name").value.trim();
        const teamSize = document.getElementById("team_size").value;
        const institution = document.getElementById("institution").value.trim();
        const challengeTrack = document.getElementById("challenge_track").value;
        
        if (!teamName || !teamSize || !institution || !challengeTrack) {
            showError("Please fill in all required fields.");
            return false;
        }
        
        return true;
    }
    
    // Validate Step 2: Team Members
    function validateStepTwo() {
        const leaderName = document.getElementById("leader_name").value.trim();
        const leaderEmail = document.getElementById("leader_email").value.trim();
        const leaderPhone = document.getElementById("leader_phone").value.trim();
        const leaderRole = document.getElementById("leader_role").value;
        
        if (!leaderName || !leaderEmail || !leaderPhone || !leaderRole) {
            showError("Please fill in all team leader details.");
            return false;
        }
        
        // Validate email format
        if (!validateEmail(leaderEmail)) {
            showError("Please enter a valid email address for team leader.");
            return false;
        }
        
        // Validate other team members if they've been added to the form
        const teamSize = parseInt(document.getElementById("team_size").value);
        for (let i = 2; i <= teamSize; i++) {
            const memberNameField = document.getElementById(`member${i}_name`);
            const memberEmailField = document.getElementById(`member${i}_email`);
            
            if (memberNameField && memberEmailField) {
                const memberName = memberNameField.value.trim();
                const memberEmail = memberEmailField.value.trim();
                
                if (memberName && !memberEmail) {
                    showError(`Please enter an email address for team member ${i-1}.`);
                    return false;
                }
                
                if (!memberName && memberEmail) {
                    showError(`Please enter a name for team member ${i-1}.`);
                    return false;
                }
                
                if (memberEmail && !validateEmail(memberEmail)) {
                    showError(`Please enter a valid email address for team member ${i-1}.`);
                    return false;
                }
            }
        }
        
        return true;
    }
    
    // Validate Step 3: Project Details
    function validateStepThree() {
        const projectTitle = document.getElementById("project_title").value.trim();
        const projectDescription = document.getElementById("project_description").value.trim();
        const termsAgreed = document.getElementById("terms_agree").checked;
        
        if (!projectTitle || !projectDescription) {
            showError("Please fill in all required fields.");
            return false;
        }
        
        // Check if at least one technology is selected
        const technologies = document.querySelectorAll('input[name="technologies[]"]:checked');
        if (technologies.length === 0) {
            document.querySelector(".group-error").style.display = "block";
            return false;
        }
        
        if (!termsAgreed) {
            showError("You must agree to the terms and conditions.");
            return false;
        }
        
        return true;
    }
    
    // Function to save step data
    function saveStepData(step) {
        const formData = new FormData(registrationForm);
        formData.append('step', step);
        formData.append('session_id', sessionId);
        
        return fetch(API_ENDPOINT, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .catch(error => {
            console.error('Error:', error);
            return { success: false, message: "An error occurred. Please try again later." };
        });
    }
    
    // Function to handle final submission
    function submitRegistration() {
        const formData = new FormData(registrationForm);
        formData.append('step', 3);
        formData.append('session_id', sessionId);
        formData.append('final_submit', 'true');
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<span>Processing...</span><i></i>';
        
        fetch(API_ENDPOINT, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                registrationForm.style.display = 'none';
                document.getElementById('registration-success').style.display = 'block';
                
                // Clear the session ID
                localStorage.removeItem('registration_session_id');
                localStorage.removeItem('registration_current_step');
                
                // Store team ID for payment page if provided
                if (data.data && data.data.team_id) {
                    localStorage.setItem('team_id', data.data.team_id);
                }
            } else {
                showError(data.message);
                submitButton.disabled = false;
                submitButton.innerHTML = '<span>Complete Registration</span><i></i>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError("An error occurred. Please try again.");
            submitButton.disabled = false;
            submitButton.innerHTML = '<span>Complete Registration</span><i></i>';
        });
    }
    
    // Go to a specific step
    function goToStep(step) {
        // Hide all steps
        steps.forEach(s => s.style.display = "none");
        
        // Show the target step
        document.getElementById(`step-${step}`).style.display = "block";
        
        // Update step indicators
        stepCircles.forEach((circle, index) => {
            if (index + 1 < step) {
                circle.classList.add("completed");
                circle.classList.remove("active");
            } else if (index + 1 === step) {
                circle.classList.add("active");
                circle.classList.remove("completed");
            } else {
                circle.classList.remove("active", "completed");
            }
        });
        
        // Update current step
        currentStep = step;
        
        // Scroll to top of form
        registrationForm.scrollIntoView({ behavior: 'smooth' });
        
        // Save current step to localStorage
        localStorage.setItem('registration_current_step', currentStep);
    }
    
    // Show error message
    function showError(message) {
        const errorEl = document.createElement('div');
        errorEl.className = 'form-error-message';
        errorEl.textContent = message;
        errorEl.style.color = '#FF5F56';
        errorEl.style.marginTop = '10px';
        errorEl.style.marginBottom = '10px';
        errorEl.style.fontWeight = 'bold';
        
        // Remove any existing error messages
        const existingErrors = document.querySelectorAll('.form-error-message');
        existingErrors.forEach(el => el.remove());
        
        // Add the new error message
        const currentStepEl = document.getElementById(`step-${currentStep}`);
        const navButtons = currentStepEl.querySelector('.form-navigation');
        currentStepEl.insertBefore(errorEl, navButtons);
        
        // Scroll to error
        errorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Remove error after 5 seconds
        setTimeout(() => {
            errorEl.remove();
        }, 5000);
    }
    
    // Helper function to validate email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Add team members dynamically when team size is selected
    const teamSizeSelect = document.getElementById('team_size');
    if (teamSizeSelect) {
        teamSizeSelect.addEventListener('change', function() {
            const teamSize = parseInt(this.value);
            const membersContainer = document.getElementById('additional-members');
            
            // Clear existing members
            membersContainer.innerHTML = '';
            
            // Add member forms based on team size (minus the leader)
            for (let i = 2; i <= teamSize; i++) {
                const memberHtml = `
                <div class="team-member-card mb-8">
                    <div class="card-header flex justify-between items-center mb-4">
                        <h3 class="text-xl text-white">Team Member ${i-1}</h3>
                        <span class="badge bg-gray-700 text-gray-300 py-1 px-3 rounded-full text-sm">Member</span>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="member${i}_name" class="input-label field-required">Full Name</label>
                            <input type="text" class="cyber-input" id="member${i}_name" name="member${i}_name" placeholder="Team member's name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="member${i}_email" class="input-label field-required">Email Address</label>
                            <input type="email" class="cyber-input" id="member${i}_email" name="member${i}_email" placeholder="Team member's email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="member${i}_phone" class="input-label">Phone Number (Optional)</label>
                            <input type="tel" class="cyber-input" id="member${i}_phone" name="member${i}_phone" placeholder="Team member's phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="member${i}_role" class="input-label">Role in Team</label>
                            <div class="select-wrapper">
                                <select class="cyber-input" id="member${i}_role" name="member${i}_role">
                                    <option value="" disabled selected>Select role</option>
                                    <option value="frontend">Frontend Developer</option>
                                    <option value="backend">Backend Developer</option>
                                    <option value="fullstack">Full Stack Developer</option>
                                    <option value="mobile">Mobile Developer</option>
                                    <option value="ui_ux">UI/UX Designer</option>
                                    <option value="ml_ai">ML/AI Engineer</option>
                                    <option value="devops">DevOps Engineer</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>`;
                
                membersContainer.innerHTML += memberHtml;
            }
        });
    }
    
    // Check if there's an existing session and restore progress
    if (sessionId) {
        // Allow the user to continue from where they left off
        const storedStep = localStorage.getItem('registration_current_step');
        if (storedStep) {
            goToStep(parseInt(storedStep));
        }
    }
});