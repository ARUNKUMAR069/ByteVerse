<?php
// Page-specific variables
$pageTitle = 'Contact Us | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Connect';
$loaderText = 'Loading communication channels...';
$currentPage = 'contact';

// Additional styles specific to the contact page
$additionalStyles = '
/* Contact Page Specific Styles */

/* Main Container Layout */
.contact-container {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 3rem;
    margin: 2rem 0;
}

/* Contact Info Section */
.contact-info {
    position: relative;
    background: rgba(22, 32, 53, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 16px;
    padding: 2.5rem;
    height: 100%;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.contact-info::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0, 215, 254, 0.05) 0%, rgba(189, 0, 255, 0.05) 100%);
    z-index: -1;
}

.gradient-text-small {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    font-family: \'Orbitron\', sans-serif;
    background: linear-gradient(90deg, var(--primary-accent) 0%, var(--neon-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tech-text {
    color: var(--text-dim);
    font-family: \'Rajdhani\', sans-serif;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

/* Contact Methods */
.contact-methods {
    margin-top: 2rem;
}

.contact-method {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.contact-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid var(--primary-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: var(--primary-accent);
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.contact-method:hover .contact-icon {
    background: var(--primary-accent);
    color: var(--primary-dark);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.3);
}

.contact-text h3 {
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1.2rem;
    color: var(--text-bright);
    margin-bottom: 0.2rem;
}

.contact-text p {
    font-family: \'Rajdhani\', sans-serif;
    color: var(--text-dim);
}

/* Social Icons */
.contact-social {
    display: flex;
    gap: 1rem;
    margin-top: 2.5rem;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.2);
    border: 1px solid var(--primary-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-accent);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: var(--primary-accent);
    color: var(--primary-dark);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.3);
}

/* Contact Form */
.contact-form-container {
    position: relative;
    background: rgba(22, 32, 53, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(189, 0, 255, 0.3);
    border-radius: 16px;
    padding: 3rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.contact-form-container::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(189, 0, 255, 0.05) 0%, rgba(0, 215, 254, 0.05) 100%);
    z-index: -1;
}

.contact-form {
    position: relative;
    z-index: 1;
}

/* Form Groups */
.form-group {
    position: relative;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
}

.input-icon {
    width: 45px;
    height: 45px;
    background: rgba(0, 215, 254, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    color: var(--primary-accent);
    font-size: 1.2rem;
    margin-right: 1rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 215, 254, 0.3);
}

.message-icon {
    height: 45px;
    align-self: flex-start;
}

.input-wrapper {
    flex: 1;
    position: relative;
}

/* Input Styling */
.contact-form input, 
.contact-form textarea {
    width: 100%;
    background: rgba(10, 20, 40, 0.2);
    border: none;
    border-radius: 12px;
    padding: 1rem;
    font-family: \'Rajdhani\', sans-serif;
    color: var(--text-bright);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.contact-form textarea {
    min-height: 150px;
    resize: vertical;
}

/* Floating Label */
.contact-form label {
    position: absolute;
    top: 1rem;
    left: 1rem;
    color: var(--text-dim);
    font-family: \'Chakra Petch\', sans-serif;
    transition: all 0.3s ease;
    pointer-events: none;
    font-size: 0.9rem;
}

.contact-form input:focus ~ label,
.contact-form input:not(:placeholder-shown) ~ label,
.contact-form textarea:focus ~ label,
.contact-form textarea:not(:placeholder-shown) ~ label {
    top: -1.5rem;
    left: l0;
    color: var(--primary-accent);
    font-size: 0.8rem;
}

.contact-form input::placeholder,
.contact-form textarea::placeholder {
    color: transparent;
}

/* Focus Effects */
.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    background: rgba(10, 20, 40, 0.3);
    box-shadow: 0 0 0 3px rgba(0, 215, 254, 0.2);
}

.input-line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-accent) 0%, var(--neon-purple) 100%);
    transition: width 0.3s ease;
}

.contact-form input:focus ~ .input-line,
.contact-form textarea:focus ~ .input-line,
.contact-form input:not(:placeholder-shown) ~ .input-line,
.contact-form textarea:not(:placeholder-shown) ~ .input-line {
    width: 100%;
}

.form-group:focus-within .input-icon {
    background: var(--primary-accent);
    color: var(--primary-dark);
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.4);
    transform: translateY(-5px);
}

/* Submit Button */
.submit-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 1rem 1.5rem;
    background: linear-gradient(90deg, var(--primary-accent-dark) 0%, var(--primary-accent) 100%);
    color: var(--text-bright);
    border: none;
    border-radius: 12px;
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin-top: 1rem;
}

.submit-button::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.5s ease;
}

.submit-button:hover {
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.3);
    transform: translateY(-2px);
}

.submit-button:hover::before {
    left: 100%;
}

.submit-button i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.submit-button:hover i {
    transform: translateX(5px);
}

/* Form Status Message */
.form-status {
    text-align: center;
    margin-top: 1.5rem;
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 0.9rem;
    height: 1.5rem;
}

.form-status.success {
    color: #27C93F;
}

.form-status.error {
    color: #FF5F56;
}

/* Subtitle & Decorative Elements */
.contact-subtitle {
    color: var(--primary-accent-light);
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
}

.cyber-line {
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), var(--neon-purple), transparent);
    margin: 2rem auto;
    width: 80%;
    max-width: 600px;
    position: relative;
}

.cyber-line::before {
    content: \'\';
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: var(--primary-accent);
    top: -4px;
    left: 50%;
    transform: translateX(-50%) rotate(45deg);
}

/* Footer */
.contact-footer {
    text-align: center;
    margin-top: 3rem;
    color: var(--text-dim);
    position: relative;
    padding-top: 2rem;
}

.tech-circuit {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 1px;
    background: var(--primary-accent);
    opacity: 0.5;
}

.tech-circuit::before,
.tech-circuit::after {
    content: \'\';
    position: absolute;
    width: 5px;
    height: 5px;
    background-color: var(--primary-accent);
    border-radius: 50%;
    top: -2px;
}

.tech-circuit::before {
    left: 30%;
}

.tech-circuit::after {
    right: 30%;
}

/* Data Nodes Animation */
.data-nodes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.data-nodes::before {
    content: \'\';
    position: absolute;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, var(--primary-accent) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0.1;
    animation: float 8s infinite ease-in-out;
    top: 20%;
    left: 10%;
}

.data-nodes::after {
    content: \'\';
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, var(--neon-purple) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0.1;
    animation: float 10s infinite ease-in-out reverse;
    bottom: 10%;
    right: 10%;
}

@keyframes float {
    0% { transform: translate(0, 0); }
    50% { transform: translate(20px, 20px); }
    100% { transform: translate(0, 0); }
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .contact-container {
        grid-template-columns: 1fr;
    }
    
    .contact-info,
    .contact-form-container {
        max-width: 600px;
        margin: 0 auto;
    }
}

@media (max-width: 768px) {
    .contact-form-container,
    .contact-info {
        padding: 2rem;
    }
    
    .gradient-text-small {
        font-size: 2rem;
    }
    
    .glitch-text {
        font-size: 3rem;
    }
}

@media (max-width: 480px) {
    .form-group {
        flex-direction: column;
    }
    
    .input-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
    
    .contact-form-container,
    .contact-info {
        padding: 1.5rem;
    }
}

/* Data node styles added via JS */
.data-node {
    position: absolute;
    border-radius: 50%;
    opacity: 0.3;
    animation: float-around linear infinite;
}

@keyframes float-around {
    0% { transform: translate(0, 0); }
    25% { transform: translate(50px, -50px); }
    50% { transform: translate(100px, 0); }
    75% { transform: translate(50px, 50px); }
    100% { transform: translate(0, 0); }
}

.circuit-line {
    position: absolute;
    right: 0;
    width: 150px;
    height: 1px;
    background: var(--primary-accent);
    opacity: 0.3;
    overflow: hidden;
}

.circuit-line::after {
    content: \'\';
    position: absolute;
    top: -1px;
    left: 0;
    width: 10px;
    height: 3px;
    background: var(--primary-accent);
    animation: circuit-pulse 3s infinite linear;
}

@keyframes circuit-pulse {
    0% { left: -10px; }
    100% { left: 150px; }
}

.animate-in {
    animation: slide-up 0.8s ease forwards;
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
';

// Additional scripts for the contact page
$additionalScripts = '
// Form validation and submission
document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");
    const formStatus = document.getElementById("formStatus");
    
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Get form data
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const message = document.getElementById("message").value.trim();
            
            // Simple validation
            if (name === "" || email === "" || message === "") {
                showStatus("Please fill in all required fields", "error");
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
            if (!emailRegex.test(email)) {
                showStatus("Please enter a valid email address", "error");
                return;
            }
            
            // Phone validation (optional field)
            if (phone !== "") {
                const phoneRegex = /^\\+?[0-9\\s\\-\\(\\)]{7,20}$/;
                if (!phoneRegex.test(phone)) {
                    showStatus("Please enter a valid phone number", "error");
                    return;
                }
            }
            
            // Simulate form submission
            showStatus("Sending...", "");
            
            // In a real application, you would send the data to a server here
            setTimeout(() => {
                showStatus("Message sent successfully! We\'ll get back to you soon.", "success");
                contactForm.reset();
            }, 1500);
        });
    }
    
    // Display status message
    function showStatus(message, type) {
        formStatus.textContent = message;
        formStatus.className = "form-status";
        if (type) {
            formStatus.classList.add(type);
        }
        
        // Clear status after 5 seconds if it\'s a success message
        if (type === "success") {
            setTimeout(() => {
                formStatus.textContent = "";
                formStatus.className = "form-status";
            }, 5000);
        }
    }
});

// Add animated data nodes to background
function createDataNodes() {
    const dataNodesContainer = document.querySelector(".data-nodes");
    if (!dataNodesContainer) return;
    
    const count = 15;
    
    for (let i = 0; i < count; i++) {
        const size = Math.random() * 10 + 3;
        const x = Math.random() * 100;
        const y = Math.random() * 100;
        const duration = Math.random() * 20 + 10;
        const delay = Math.random() * 5;
        
        const node = document.createElement("div");
        node.classList.add("data-node");
        node.style.width = `${size}px`;
        node.style.height = `${size}px`;
        node.style.left = `${x}%`;
        node.style.top = `${y}%`;
        node.style.animationDuration = `${duration}s`;
        node.style.animationDelay = `${delay}s`;
        
        // Randomly assign colors
        const colors = ["var(--primary-accent)", "var(--neon-purple)", "var(--primary-accent-light)"];
        node.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        
        dataNodesContainer.appendChild(node);
    }
}

// Create circuit lines
function createCircuitLines() {
    const container = document.querySelector(".contact-form-container");
    if (!container) return;
    
    const circuitCount = 3;
    
    for (let i = 0; i < circuitCount; i++) {
        const circuit = document.createElement("div");
        circuit.classList.add("circuit-line");
        circuit.style.top = `${20 + i * 30}%`;
        container.appendChild(circuit);
    }
}

// Initialize decorative elements
document.addEventListener("DOMContentLoaded", function() {
    createDataNodes();
    createCircuitLines();
    
    // Add animation to the form when it comes into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-in");
                observer.unobserve(entry.target);
            }
        });
    });
    
    const formContainer = document.querySelector(".contact-form-container");
    if (formContainer) {
        observer.observe(formContainer);
    }
});
';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Contact Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="REACH OUT">REACH OUT</h1>
        <div class="max-w-3xl mx-auto">
            <p class="contact-subtitle">Got questions? We've got answers. Connect with our hackathon team.</p>
        </div>
        <div class="cyber-line"></div>
    </div>
</section>

<!-- Contact Main Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        <!-- Floating elements for visual interest -->
        <div class="floating-elements">
            <div class="floating-cube cube-1"></div>
            <div class="floating-cube cube-2"></div>
            <div class="floating-sphere"></div>
            <div class="floating-cube cube-3"></div>
            <div class="data-nodes"></div>
        </div>
        
        <div class="contact-container">
            <div class="contact-info">
                <h2 class="gradient-text-small">Let's Connect</h2>
                <p class="tech-text">Have questions about ByteVerse? Want to become a sponsor or mentor? Drop us a message and our team will get back to you quickly!</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Location</h3>
                            <p>Tech Building, University Campus</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Email</h3>
                            <p>team@byteverse.tech</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Call Us</h3>
                            <p>+1 (123) 456-7890</p>
                        </div>
                    </div>
                    
                    <div class="contact-social">
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                <form id="contactForm" class="contact-form">
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" placeholder="Full Name" required>
                            <label for="name">Full Name</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                            <label for="email">Email Address</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="input-wrapper">
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number">
                            <label for="phone">Phone Number</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon message-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="input-wrapper">
                            <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                            <label for="message">Your Message</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    
                    <div class="form-status" id="formStatus"></div>
                </form>
            </div>
        </div>
        
        <div class="contact-footer">
            <div class="tech-circuit"></div>
            <p>Join us in creating the future at ByteVerse Hackathon</p>
        </div>
    </div>
</section>

<!-- FAQ Teaser Section -->
<section class="py-20 relative bg-gradient-to-b from-transparent to-gray-900/30">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-orbitron font-bold mb-6">Frequently Asked <span class="text-cyan-400">Questions</span></h2>
        <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-600 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 text-left">
                <h3 class="text-xl font-chakra font-bold mb-3 text-white">Can beginners participate?</h3>
                <p class="text-gray-300">Absolutely! ByteVerse welcomes hackers of all skill levels. We have workshops, mentors, and a supportive community to help beginners thrive.</p>
            </div>
            
            <div class="p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 text-left">
                <h3 class="text-xl font-chakra font-bold mb-3 text-white">What should I bring?</h3>
                <p class="text-gray-300">Bring your laptop, charger, any hardware you plan to use, and your enthusiasm! We'll provide food, drinks, and a comfortable hacking environment.</p>
            </div>
        </div>
        
        <div class="mt-10">
            <a href="faq.php" class="cyber-button secondary">
                <span>View All FAQs</span>
                <i></i>
            </a>
        </div>
    </div>
</section>

<!-- Include terminal -->
<?php 
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>