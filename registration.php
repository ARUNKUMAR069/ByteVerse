<?php
// Page-specific variables
$pageTitle = 'Registration | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Sign-up';
$loaderText = 'Initializing registration process...';
$currentPage = 'registration';

// Add all CSS directly in the registration.php file
$additionalStyles = '
/* Registration Page Specific Styles */
.registration-container {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.registration-form {
    background: rgba(10, 20, 40, 0.3);
    border: 1px solid rgba(0, 215, 254, 0.2);
    border-radius: 8px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group.full-width {
    grid-column: span 2;
}

@media (max-width: 768px) {
    .form-group.full-width {
        grid-column: span 1;
    }
}

.input-label {
    display: block;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    color: var(--primary-accent-light);
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    background: rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 4px;
    padding: 0.75rem 1rem;
    font-family: "Rajdhani", sans-serif;
    font-size: 1rem;
    color: white;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-accent);
    box-shadow: 0 0 0 2px rgba(0, 215, 254, 0.2);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.form-help {
    display: block;
    font-family: "Rajdhani", sans-serif;
    font-size: 0.8rem;
    color: var(--text-dim);
    margin-top: 0.5rem;
}

.form-error {
    display: none;
    font-family: "Rajdhani", sans-serif;
    font-size: 0.8rem;
    color: #FF5F56;
    margin-top: 0.5rem;
}

.form-control.error {
    border-color: #FF5F56;
}

.form-control.error + .form-error {
    display: block;
}

.form-section {
    margin-bottom: 2.5rem;
}

.section-title {
    font-family: "Orbitron", sans-serif;
    font-size: 1.25rem;
    color: var(--primary-accent);
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px dashed rgba(0, 215, 254, 0.3);
}

.radios-group,
.checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 0.5rem;
}

.radio-item,
.checkbox-item {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.radio-control,
.checkbox-control {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.radio-label,
.checkbox-label {
    display: flex;
    align-items: center;
    font-family: "Chakra Petch", sans-serif;
    color: var(--text-dim);
    cursor: pointer;
    transition: all 0.3s ease;
}

.radio-label:before,
.checkbox-label:before {
    content: "";
    width: 20px;
    height: 20px;
    margin-right: 0.5rem;
    border: 1px solid rgba(0, 215, 254, 0.3);
    background: rgba(0, 0, 0, 0.2);
    display: inline-block;
    transition: all 0.3s ease;
}

.radio-label:before {
    border-radius: 50%;
}

.checkbox-label:before {
    border-radius: 4px;
}

.radio-control:checked + .radio-label,
.checkbox-control:checked + .checkbox-label {
    color: white;
}

.radio-control:checked + .radio-label:before {
    border-color: var(--primary-accent);
    background: rgba(0, 215, 254, 0.1);
    box-shadow: inset 0 0 0 4px rgba(0, 0, 0, 0.3);
}

.checkbox-control:checked + .checkbox-label:before {
    border-color: var(--primary-accent);
    background: var(--primary-accent);
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'black\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 12 10 16 18 8\'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
    background-repeat: no-repeat;
    background-position: center;
}

.select-wrapper {
    position: relative;
}

.select-wrapper:after {
    content: "";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid var(--primary-accent);
    pointer-events: none;
}

select.form-control {
    appearance: none;
    padding-right: 2.5rem;
    cursor: pointer;
}

.team-section {
    padding: 1.5rem;
    background: rgba(0, 215, 254, 0.05);
    border-radius: 8px;
    margin-top: 1rem;
    border: 1px dashed rgba(0, 215, 254, 0.2);
}

.team-members {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.member-item {
    padding: 1rem;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 6px;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.member-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
}

.member-item .remove-member {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 95, 86, 0.2);
    border: 1px solid rgba(255, 95, 86, 0.3);
    border-radius: 50%;
    color: #FF5F56;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.member-item .remove-member:hover {
    background: rgba(255, 95, 86, 0.3);
}

.add-member-btn {
    margin-top: 1rem;
    display: inline-flex;
    align-items: center;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    color: var(--primary-accent);
    cursor: pointer;
    transition: all 0.3s ease;
}

.add-member-btn svg {
    margin-right: 0.5rem;
    width: 18px;
    height: 18px;
}

.add-member-btn:hover {
    color: var(--primary-accent-light);
    transform: translateY(-2px);
}

.scanner-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
    animation: scan-vertical 3s infinite linear;
    opacity: 0.5;
    z-index: 10;
}

.form-submit {
    margin-top: 2rem;
    text-align: center;
}

.multi-step-form .step {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease-out;
}

.multi-step-form .step.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

.form-nav-btn {
    padding: 0.75rem 1.5rem;
    font-family: "Chakra Petch", sans-serif;
    background: rgba(10, 20, 40, 0.5);
    border: 1px solid rgba(0, 215, 254, 0.3);
    color: var(--primary-accent);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-nav-btn:hover {
    background: rgba(0, 215, 254, 0.1);
    border-color: var(--primary-accent);
}

.form-nav-btn.next {
    margin-left: auto;
}

.step-indicator {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.step-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid rgba(0, 215, 254, 0.3);
    transition: all 0.3s ease;
}

.step-dot.active {
    background: var(--primary-accent);
    box-shadow: 0 0 10px var(--primary-accent);
}

.form-success {
    text-align: center;
    padding: 3rem 2rem;
    display: none;
}

.form-success h3 {
    font-family: "Orbitron", sans-serif;
    font-size: 1.5rem;
    color: var(--primary-accent);
    margin-bottom: 1.5rem;
}

.form-success p {
    font-family: "Rajdhani", sans-serif;
    color: var(--text-dim);
    margin-bottom: 2rem;
}

.success-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(39, 201, 63, 0.1);
    border: 1px solid rgba(39, 201, 63, 0.3);
    color: #27C93F;
    font-size: 2rem;
}

/* Form validation styling */
.field-required:after {
    content: "*";
    color: #FF5F56;
    margin-left: 0.25rem;
}

.registration-info {
    background: rgba(0, 215, 254, 0.05);
    border: 1px solid rgba(0, 215, 254, 0.2);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.registration-info h3 {
    font-family: "Orbitron", sans-serif;
    font-size: 1.1rem;
    color: var(--primary-accent);
    margin-bottom: 1rem;
}

.registration-info p {
    font-family: "Rajdhani", sans-serif;
    color: var(--text-dim);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.info-list {
    margin-top: 1rem;
}

.info-list li {
    font-family: "Rajdhani", sans-serif;
    color: var(--text-dim);
    margin-bottom: 0.5rem;
    position: relative;
    padding-left: 1.5rem;
}

.info-list li:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0.6rem;
    width: 8px;
    height: 8px;
    background: var(--primary-accent);
    border-radius: 50%;
}

.circuit-dots {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(0, 215, 254, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 75% 75%, rgba(0, 215, 254, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    z-index: -1;
    opacity: 0.3;
    pointer-events: none;
}

@media (max-width: 768px) {
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-nav-btn.next {
        margin-left: 0;
    }
}

/* Enhanced animations for form elements */
@keyframes scan-vertical {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(calc(100vh - 2px));
    }
    100% {
        transform: translateY(0);
    }
}

/* Form enhancements */
.form-control.valid {
    border-color: rgba(39, 201, 63, 0.5);
}

.form-control.error {
    animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
}

@keyframes shake {
    10%, 90% { transform: translateX(-1px); }
    20%, 80% { transform: translateX(2px); }
    30%, 50%, 70% { transform: translateX(-4px); }
    40%, 60% { transform: translateX(4px); }
}

/* Floating effect for form inputs */
.form-floating {
    position: relative;
}

.form-floating .form-control {
    padding-top: 1.5rem;
    padding-bottom: 0.5rem;
}

.form-floating .input-label {
    position: absolute;
    top: 0.75rem;
    left: 1rem;
    transition: all 0.2s ease;
    font-size: 0.9rem;
    opacity: 0.7;
    pointer-events: none;
}

.form-floating .form-control:focus + .input-label,
.form-floating .form-control:not(:placeholder-shown) + .input-label {
    top: 0.3rem;
    left: 0.8rem;
    font-size: 0.7rem;
    opacity: 1;
}

/* Group error styles */
.checkbox-group.error {
    position: relative;
}

.group-error {
    display: none;
    margin-top: 0.5rem;
}

/* Create loading effect for submit button */
.loader-dots {
    display: inline-flex;
    gap: 0.3rem;
    margin-right: 0.5rem;
}

.loader-dots .dot {
    width: 6px;
    height: 6px;
    background-color: currentColor;
    border-radius: 50%;
    animation: pulse 1s infinite ease-in-out;
}

.loader-dots .dot:nth-child(2) {
    animation-delay: 0.2s;
}

.loader-dots .dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes pulse {
    0%, 100% { transform: scale(0.5); opacity: 0.5; }
    50% { transform: scale(1); opacity: 1; }
}
';

// Add JavaScript
$additionalScripts = '
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Multi-step form navigation
    const form = document.getElementById("registration-form");
    const steps = form.querySelectorAll(".step");
    const nextBtns = form.querySelectorAll(".btn-next");
    const prevBtns = form.querySelectorAll(".btn-prev");
    const stepDots = document.querySelectorAll(".step-dot");
    let currentStep = 0;
    
    // Initialize form
    showStep(currentStep);
    
    // Next button click handler
    nextBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            } else {
                // Add shake animation to invalid fields
                const invalidFields = steps[currentStep].querySelectorAll(".error");
                invalidFields.forEach(field => {
                    field.classList.add("shake");
                    setTimeout(() => {
                        field.classList.remove("shake");
                    }, 600);
                });
                
                // Scroll to first error
                if (invalidFields.length > 0) {
                    invalidFields[0].scrollIntoView({ behavior: "smooth", block: "center" });
                    invalidFields[0].focus();
                }
            }
        });
    });
    
    // Previous button click handler
    prevBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            currentStep--;
            showStep(currentStep);
        });
    });
    
    // Show specific step
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.remove("active");
            
            // Add a small delay before showing the next step for smoother transition
            if (index === stepIndex) {
                setTimeout(() => {
                    step.classList.add("active");
                }, 50);
            }
        });
        
        stepDots.forEach((dot, index) => {
            dot.classList.toggle("active", index <= stepIndex);
        });
        
        // Handle buttons visibility
        form.querySelector(".btn-prev").style.display = stepIndex === 0 ? "none" : "flex";
        
        const nextBtn = form.querySelector(".btn-next");
        const submitBtn = form.querySelector(".btn-submit");
        
        if (stepIndex === steps.length - 1) {
            nextBtn.style.display = "none";
            submitBtn.style.display = "flex";
        } else {
            nextBtn.style.display = "flex";
            submitBtn.style.display = "none";
        }
    }
    
    // Validate current step
    function validateStep(stepIndex) {
        const currentStepEl = steps[stepIndex];
        const requiredFields = currentStepEl.querySelectorAll("[required]");
        let valid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add("error");
                valid = false;
            } else {
                field.classList.remove("error");
                field.classList.add("valid");
            }
            
            // Email validation
            if (field.type === "email" && field.value.trim()) {
                const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
                if (!emailPattern.test(field.value)) {
                    field.classList.add("error");
                    field.classList.remove("valid");
                    valid = false;
                }
            }
        });
        
        // Validate checkbox groups
        const checkboxGroups = currentStepEl.querySelectorAll("[data-require-one=\'true\']");
        checkboxGroups.forEach(group => {
            const checkboxes = group.querySelectorAll("input[type=\'checkbox\']");
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            
            if (!anyChecked) {
                group.classList.add("error");
                const errorEl = group.querySelector(".group-error");
                if (errorEl) errorEl.style.display = "block";
                valid = false;
            } else {
                group.classList.remove("error");
                const errorEl = group.querySelector(".group-error");
                if (errorEl) errorEl.style.display = "none";
            }
        });
        
        return valid;
    }
    
    // Team registration logic
    const participationType = document.querySelectorAll("[name=\'participation_type\']");
    const teamSection = document.querySelector(".team-section");
    
    participationType.forEach(option => {
        option.addEventListener("change", function() {
            if (this.value === "team") {
                teamSection.style.display = "block";
                // Add animation
                teamSection.style.opacity = 0;
                teamSection.style.transform = "translateY(20px)";
                setTimeout(() => {
                    teamSection.style.opacity = 1;
                    teamSection.style.transform = "translateY(0)";
                }, 10);
            } else {
                // Fade out
                teamSection.style.opacity = 0;
                teamSection.style.transform = "translateY(20px)";
                setTimeout(() => {
                    teamSection.style.display = "none";
                }, 300);
            }
        });
    });
    
    // Add team member functionality
    const addMemberBtn = document.getElementById("add-member");
    const teamMembers = document.querySelector(".team-members");
    let memberCount = 1; // Already have the team lead (user)
    const maxMembers = 4;
    
    addMemberBtn.addEventListener("click", function() {
        if (memberCount < maxMembers) {
            memberCount++;
            const memberItem = document.createElement("div");
            memberItem.className = "member-item";
            memberItem.style.opacity = 0;
            memberItem.style.transform = "translateY(20px)";
            
            memberItem.innerHTML = `
                <span class="remove-member">&times;</span>
                <div class="form-group">
                    <label class="input-label field-required">Member ${memberCount} Name</label>
                    <input type="text" class="form-control" name="team_member_${memberCount}_name" required>
                </div>
                <div class="form-group">
                    <label class="input-label field-required">Member ${memberCount} Email</label>
                    <input type="email" class="form-control" name="team_member_${memberCount}_email" required>
                </div>
                <div class="form-group">
                    <label class="input-label">Member ${memberCount} Role</label>
                    <input type="text" class="form-control" name="team_member_${memberCount}_role" placeholder="e.g., Developer, Designer">
                </div>
            `;
            teamMembers.appendChild(memberItem);
            
            // Animate appearance
            setTimeout(() => {
                memberItem.style.opacity = 1;
                memberItem.style.transform = "translateY(0)";
            }, 10);
            
            // Bind remove event
            const removeBtn = memberItem.querySelector(".remove-member");
            removeBtn.addEventListener("click", function() {
                memberItem.style.opacity = 0;
                memberItem.style.transform = "translateY(20px)";
                
                setTimeout(() => {
                    teamMembers.removeChild(memberItem);
                    memberCount--;
                    
                    // Update remaining member numbers
                    const remainingMembers = teamMembers.querySelectorAll(".member-item");
                    remainingMembers.forEach((member, index) => {
                        const labels = member.querySelectorAll(".input-label");
                        const inputs = member.querySelectorAll(".form-control");
                        
                        labels.forEach(label => {
                            label.textContent = label.textContent.replace(/Member [0-9]+/, `Member ${index + 2}`);
                        });
                        
                        inputs.forEach(input => {
                            const newName = input.name.replace(/team_member_[0-9]+/, `team_member_${index + 2}`);
                            input.name = newName;
                        });
                    });
                    
                    // Show add button if below max
                    addMemberBtn.style.display = memberCount < maxMembers ? "inline-flex" : "none";
                }, 300);
            });
            
            // Hide add button if at max
            if (memberCount >= maxMembers) {
                addMemberBtn.style.display = "none";
            }
            
            // Focus the first input in the new member item
            setTimeout(() => {
                memberItem.querySelector("input").focus();
            }, 350);
        }
    });
    
    // Initialize dietary restrictions toggle
    const dietOtherCheckbox = document.getElementById("diet_other");
    const dietOtherField = document.querySelector(".dietary-other");
    
    if (dietOtherCheckbox && dietOtherField) {
        dietOtherCheckbox.addEventListener("change", function() {
            if (this.checked) {
                dietOtherField.style.display = "block";
                dietOtherField.style.opacity = 0;
                dietOtherField.style.transform = "translateY(10px)";
                
                setTimeout(() => {
                    dietOtherField.style.opacity = 1;
                    dietOtherField.style.transform = "translateY(0)";
                    dietOtherField.querySelector("input").focus();
                }, 10);
            } else {
                dietOtherField.style.opacity = 0;
                dietOtherField.style.transform = "translateY(10px)";
                
                setTimeout(() => {
                    dietOtherField.style.display = "none";
                }, 300);
            }
        });
        
        // Initialize state on page load
        dietOtherField.style.display = dietOtherCheckbox.checked ? "block" : "none";
    }
    
    // Form submission
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        
        if (validateStep(currentStep)) {
            // Show loading indicator
            const submitBtn = document.querySelector(".btn-submit");
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <div class="loader-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
                <span>Processing...</span>
            `;
            submitBtn.disabled = true;
            
            // Simulate form submission (in a real app, this would be an AJAX call)
            setTimeout(() => {
                // Hide form and show success message
                document.getElementById("registration-form").style.display = "none";
                const successMsg = document.querySelector(".form-success");
                successMsg.style.display = "block";
                successMsg.style.opacity = 0;
                
                setTimeout(() => {
                    successMsg.style.opacity = 1;
                }, 10);
                
                // Reset for next time
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }, 1500);
            
            // In a real application, you would use AJAX to submit the form:
            /*
            const formData = new FormData(form);
            fetch("register-process.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("registration-form").style.display = "none";
                    document.querySelector(".form-success").style.display = "block";
                } else {
                    alert("There was an error: " + data.message);
                }
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            })
            .catch(error => {
                console.error("Error:", error);
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
                alert("An error occurred while submitting the form. Please try again.");
            });
            */
        }
    });
});
</script>
';

// Include header with proper $additionalHeaderContent
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Registration Hero Section -->
<section class="min-h-[40vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-16 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Registration">Registration</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Join ByteVerse 1.0 and be part of the next evolution in hackathons. Register now to secure your spot and prepare to create, innovate, and disrupt.
            </p>
        </div>
    </div>
</section>

<!-- Registration Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        <div class="registration-container">
            <!-- Registration Info Box -->
            <div class="registration-info">
                <h3>Registration Information</h3>
                <p>ByteVerse 1.0 will take place from April 28-30, 2025. Before registering, please note:</p>
                <ul class="info-list">
                    <li>Registration is free but limited to 300 participants</li>
                    <li>You can register individually or as a team (max 4 members)</li>
                    <li>All participants must be 18+ or have guardian consent</li>
                    <li>Each participant must bring their own laptop</li>
                    <li>Registration closes on April 15, 2025 or when capacity is reached</li>
                </ul>
                <p class="mt-3">Fields marked with an asterisk (*) are required.</p>
            </div>
            
            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot" data-step="2"></div>
                <div class="step-dot" data-step="3"></div>
                <div class="step-dot" data-step="4"></div>
            </div>
            
            <!-- Registration Form -->
            <form id="registration-form" class="registration-form multi-step-form">
                <div class="scanner-line"></div>
                
                <!-- Step 1: Personal Information -->
                <div class="step active">
                    <div class="form-section">
                        <h2 class="section-title">Personal Information</h2>
                        <div class="form-grid">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder=" " required>
                                <label class="input-label field-required" for="first_name">First Name</label>
                                <span class="form-error">First name is required</span>
                            </div>
                            
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder=" " required>
                                <label class="input-label field-required" for="last_name">Last Name</label>
                                <span class="form-error">Last name is required</span>
                            </div>
                            
                            <div class="form-group form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                                <label class="input-label field-required" for="email">Email Address</label>
                                <span class="form-error">Valid email is required</span>
                            </div>
                            
                            <div class="form-group form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder=" " required>
                                <label class="input-label field-required" for="phone">Phone Number</label>
                                <span class="form-error">Phone number is required</span>
                            </div>
                            
                            <div class="form-group full-width form-floating">
                                <input type="text" class="form-control" id="institution" name="institution" placeholder=" " required>
                                <label class="input-label field-required" for="institution">University / Company</label>
                                <span class="form-error">University or company name is required</span>
                            </div>
                            
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" id="github" name="github" placeholder=" ">
                                <label class="input-label" for="github">GitHub Profile (Optional)</label>
                            </div>
                            
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder=" ">
                                <label class="input-label" for="linkedin">LinkedIn Profile (Optional)</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Skills & Experience -->
                <div class="step">
                    <div class="form-section">
                        <h2 class="section-title">Skills & Experience</h2>
                        
                        <div class="form-group">
                            <label class="input-label field-required">Programming Experience Level</label>
                            <div class="radios-group">
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="exp_beginner" name="experience_level" value="beginner" required>
                                    <label class="radio-label" for="exp_beginner">Beginner</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="exp_intermediate" name="experience_level" value="intermediate" required>
                                    <label class="radio-label" for="exp_intermediate">Intermediate</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="exp_advanced" name="experience_level" value="advanced" required>
                                    <label class="radio-label" for="exp_advanced">Advanced</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="exp_expert" name="experience_level" value="expert" required>
                                    <label class="radio-label" for="exp_expert">Expert</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label field-required">Primary Role</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="primary_role" required>
                                    <option value="" selected disabled>Select your primary role</option>
                                    <option value="frontend">Frontend Developer</option>
                                    <option value="backend">Backend Developer</option>
                                    <option value="fullstack">Full Stack Developer</option>
                                    <option value="mobile">Mobile Developer</option>
                                    <option value="designer">UI/UX Designer</option>
                                    <option value="data">Data Scientist/ML Engineer</option>
                                    <option value="product">Product Manager</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label field-required">Technical Skills (Select all that apply)</label>
                            <div class="checkbox-group" data-require-one="true">
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_javascript" name="skills[]" value="javascript">
                                    <label class="checkbox-label" for="skill_javascript">JavaScript</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_python" name="skills[]" value="python">
                                    <label class="checkbox-label" for="skill_python">Python</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_react" name="skills[]" value="react">
                                    <label class="checkbox-label" for="skill_react">React</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_node" name="skills[]" value="node">
                                    <label class="checkbox-label" for="skill_node">Node.js</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_mobile" name="skills[]" value="mobile">
                                    <label class="checkbox-label" for="skill_mobile">Mobile Dev</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_design" name="skills[]" value="design">
                                    <label class="checkbox-label" for="skill_design">UI/UX Design</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_ai" name="skills[]" value="ai_ml">
                                    <label class="checkbox-label" for="skill_ai">AI/ML</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_cloud" name="skills[]" value="cloud">
                                    <label class="checkbox-label" for="skill_cloud">Cloud Computing</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_blockchain" name="skills[]" value="blockchain">
                                    <label class="checkbox-label" for="skill_blockchain">Blockchain</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="skill_ar_vr" name="skills[]" value="ar_vr">
                                    <label class="checkbox-label" for="skill_ar_vr">AR/VR</label>
                                </div>
                                <span class="group-error form-error">Please select at least one skill</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label">Other Skills (Optional)</label>
                            <input type="text" class="form-control" name="other_skills" placeholder="List any other skills not mentioned above">
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label field-required">Previous Hackathons</label>
                            <div class="radios-group">
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="hack_0" name="previous_hackathons" value="0" required>
                                    <label class="radio-label" for="hack_0">0 (First time)</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="hack_1_3" name="previous_hackathons" value="1-3" required>
                                    <label class="radio-label" for="hack_1_3">1-3</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="hack_4_10" name="previous_hackathons" value="4-10" required>
                                    <label class="radio-label" for="hack_4_10">4-10</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="hack_10plus" name="previous_hackathons" value="10+" required>
                                    <label class="radio-label" for="hack_10plus">10+</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Team & Project Info -->
                <div class="step">
                    <div class="form-section">
                        <h2 class="section-title">Team & Project Information</h2>
                        
                        <div class="form-group">
                            <label class="input-label field-required">Participation Type</label>
                            <div class="radios-group">
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="type_individual" name="participation_type" value="individual" required>
                                    <label class="radio-label" for="type_individual">Individual (I'll form/join a team at the event)</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="radio-control" id="type_team" name="participation_type" value="team" required>
                                    <label class="radio-label" for="type_team">Team (I have a team)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-section" style="display: none;">
                            <div class="form-group">
                                <label class="input-label field-required" for="team_name">Team Name</label>
                                <input type="text" class="form-control" id="team_name" name="team_name">
                                <span class="form-help">Create a unique name for your team (max 20 characters)</span>
                            </div>
                            
                            <h3 class="text-lg text-cyan-400 font-orbitron mt-4 mb-2">Team Members</h3>
                            <p class="text-gray-400 text-sm mb-3">You are already listed as Team Member 1 (Team Lead). Add up to 3 more members below.</p>
                            
                            <div class="team-members">
                                <!-- Team members will be added here dynamically -->
                            </div>
                            
                            <button type="button" id="add-member" class="add-member-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Team Member
                            </button>
                        </div>
                        
                        <div class="form-group mt-6">
                            <label class="input-label field-required">Challenge Track Interests (Select all that apply)</label>
                            <div class="checkbox-group" data-require-one="true">
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_ai" name="tracks[]" value="ai">
                                    <label class="checkbox-label" for="track_ai">AI & Machine Learning</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_health" name="tracks[]" value="health">
                                    <label class="checkbox-label" for="track_health">Healthcare Innovation</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_climate" name="tracks[]" value="climate">
                                    <label class="checkbox-label" for="track_climate">Climate Tech</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_fintech" name="tracks[]" value="fintech">
                                    <label class="checkbox-label" for="track_fintech">FinTech</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_web3" name="tracks[]" value="web3">
                                    <label class="checkbox-label" for="track_web3">Web3 & Blockchain</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_social" name="tracks[]" value="social">
                                    <label class="checkbox-label" for="track_social">Social Good</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="track_open" name="tracks[]" value="open">
                                    <label class="checkbox-label" for="track_open">Open Innovation</label>
                                </div>
                                <span class="group-error form-error">Please select at least one track</span>
                            </div>
                            <span class="form-help">Final challenge tracks will be announced at the event, but this helps us understand your interests</span>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label">Project Idea (Optional)</label>
                            <textarea class="form-control" name="project_idea" placeholder="If you already have a project idea in mind, briefly describe it here..."></textarea>
                            <span class="form-help">This is not binding - you can change your idea at the event</span>
                        </div>
                    </div>
                </div>
                
                <!-- Step 4: Additional Information -->
                <div class="step">
                    <div class="form-section">
                        <h2 class="section-title">Additional Information</h2>
                        
                        <div class="form-group">
                            <label class="input-label field-required">T-Shirt Size</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="tshirt_size" required>
                                    <option value="" selected disabled>Select your size</option>
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                    <option value="xxl">XXL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label">Dietary Restrictions (Select all that apply)</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="diet_none" name="dietary[]" value="none">
                                    <label class="checkbox-label" for="diet_none">None</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="diet_vegetarian" name="dietary[]" value="vegetarian">
                                    <label class="checkbox-label" for="diet_vegetarian">Vegetarian</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="diet_vegan" name="dietary[]" value="vegan">
                                    <label class="checkbox-label" for="diet_vegan">Vegan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="diet_gluten" name="dietary[]" value="gluten_free">
                                    <label class="checkbox-label" for="diet_gluten">Gluten-Free</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" class="checkbox-control" id="diet_other" name="dietary[]" value="other">
                                    <label class="checkbox-label" for="diet_other">Other</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group dietary-other" style="display: none;">
                            <label class="input-label" for="dietary_other">Please specify dietary restrictions</label>
                            <input type="text" class="form-control" id="dietary_other" name="dietary_other">
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label">How did you hear about ByteVerse 1.0?</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="referral_source">
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="friend">Friend or Colleague</option>
                                    <option value="social">Social Media</option>
                                    <option value="email">Email</option>
                                    <option value="university">University/School</option>
                                    <option value="website">Website/Blog</option>
                                    <option value="event">Another Event</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label">Any questions or additional information? (Optional)</label>
                            <textarea class="form-control" name="additional_info" placeholder="Let us know if you have any questions or need any accommodations..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="terms_agreement" name="terms_agreement" required>
                                <label class="checkbox-label" for="terms_agreement">I agree to the <a href="#" class="text-cyan-400 hover:underline">Terms & Conditions</a> and <a href="#" class="text-cyan-400 hover:underline">Code of Conduct</a></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="marketing_consent" name="marketing_consent">
                                <label class="checkbox-label" for="marketing_consent">I would like to receive updates about future ByteVerse events and opportunities (optional)</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Navigation -->
                <div class="form-navigation">
                    <button type="button" class="form-nav-btn btn-prev" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>
                    
                    <button type="button" class="form-nav-btn btn-next">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    
                    <button type="submit" class="cyber-button primary btn-submit" style="display: none;">
                        <span>Submit Registration</span>
                        <i></i>
                    </button>
                </div>
            </form>
            
            <!-- Success Message (hidden by default) -->
            <div class="form-success">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3>Registration Complete!</h3>
                <p>Your ByteVerse 1.0 registration has been successfully submitted. Check your email for confirmation details and next steps.</p>
                <a href="index.php" class="cyber-button">
                    <span>Return to Home</span>
                    <i></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Include terminal and footer -->
<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>