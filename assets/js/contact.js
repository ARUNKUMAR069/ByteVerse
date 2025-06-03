document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");
    const formStatus = document.getElementById("formStatus");
    
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            
            // Show sending status
            showStatus("Sending your message...", "pending");
            
            // Send data to the server - updated path to backend folder
            fetch('backend/api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
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
            });
        });
    }
    
    // Display status message
    function showStatus(message, type) {
        formStatus.textContent = message;
        formStatus.className = "form-status mt-4";
        formStatus.classList.remove("hidden");
        
        if (type) {
            formStatus.classList.add(type);
        }
        
        // Clear success messages after 5 seconds
        if (type === "success") {
            setTimeout(() => {
                formStatus.classList.add("hidden");
            }, 5000);
        }
    }
});