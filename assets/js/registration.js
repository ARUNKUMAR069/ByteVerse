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
    initDietaryControl();
    
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
                    invalidFields[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
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
            step.classList.toggle("active", index === stepIndex);
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
        const checkboxGroups = currentStepEl.querySelectorAll("[data-require-one='true']");
        checkboxGroups.forEach(group => {
            const checkboxes = group.querySelectorAll("input[type='checkbox']");
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
    const participationType = document.querySelectorAll("[name='participation_type']");
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
                    if (memberCount < maxMembers) {
                        addMemberBtn.style.display = "inline-flex";
                        addMemberBtn.classList.add("pulse");
                        setTimeout(() => addMemberBtn.classList.remove("pulse"), 1000);
                    }
                }, 300);
            });
            
            // Hide add button if at max
            if (memberCount >= maxMembers) {
                addMemberBtn.style.display = "none";
            }
            
            // Focus first field
            setTimeout(() => {
                memberItem.querySelector('input').focus();
            }, 350);
        }
    });
    
    // Initialize dietary restrictions toggle
    function initDietaryControl() {
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
        }
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
                    successMsg.style.transform = "translateY(0)";
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