<?php
// Page-specific variables
$pageTitle = 'Contact Us | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Connect';
$loaderText = 'Loading communication channels...';
$currentPage = 'contact';

// Additional styles specific to the contact page
$additionalStyles = '
/* Contact Page Specific Styles - Gen Z Edition */

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
    border-radius: 24px; /* More rounded corners for Gen Z */
    padding: 2.5rem;
    height: 100%;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.contact-info:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 215, 254, 0.2);
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
    letter-spacing: 1px;
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
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 16px;
}

.contact-method:hover {
    background: rgba(0, 215, 254, 0.07);
    transform: translateX(5px);
}

.contact-icon {
    width: 55px;
    height: 55px;
    border-radius: 18px; /* Rounded square look for Gen Z */
    background: rgba(0, 215, 254, 0.1);
    border: 2px solid var(--primary-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: var(--primary-accent);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.contact-icon svg {
    width: 24px;
    height: 24px;
    fill: currentColor;
}

.contact-icon::after {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, transparent 0%, rgba(0, 215, 254, 0.2) 50%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.contact-method:hover .contact-icon {
    background: var(--primary-accent);
    color: var(--primary-dark);
    transform: translateY(-5px) rotate(5deg);
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.3);
}

.contact-method:hover .contact-icon::after {
    opacity: 1;
}

.contact-text h3 {
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1.3rem;
    color: var(--text-bright);
    margin-bottom: 0.2rem;
    letter-spacing: 0.5px;
}

.contact-text p {
    font-family: \'Rajdhani\', sans-serif;
    color: var(--text-dim);
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Social Icons - Updated for Gen Z */
.contact-social {
    display: flex;
    gap: 1rem;
    margin-top: 2.5rem;
    justify-content: center;
}

.social-icon {
    width: 48px;
    height: 48px;
    border-radius: 16px; /* Squircle style popular with Gen Z */
    background: rgba(0, 0, 0, 0.2);
    border: 2px solid var(--primary-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-accent);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Bouncy effect */
    position: relative;
    overflow: hidden;
}

.social-icon svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

/* Emoji indicator for Gen Z flair */
.social-icon::after {
    content: \'✨\';
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 16px;
    opacity: 0;
    transition: all 0.3s ease;
}

.social-icon:hover {
    color: var(--primary-dark);
    transform: translateY(-8px) scale(1.1);
    box-shadow: 0 10px 25px rgba(0, 215, 254, 0.4);
    border-color: transparent;
}

.social-icon:hover::before {
    top: 0;
}

.social-icon:hover::after {
    top: -25px;
    opacity: 1;
}

/* Contact Form */
.contact-form-container {
    position: relative;
    background: rgba(22, 32, 53, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(189, 0, 255, 0.3);
    border-radius: 24px; /* More rounded corners for Gen Z */
    padding: 3rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.contact-form-container:hover {
    box-shadow: 0 15px 40px rgba(189, 0, 255, 0.2);
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
    width: 50px;
    height: 50px;
    background: rgba(0, 215, 254, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px; /* Gen Z style */
    color: var(--primary-accent);
    margin-right: 1rem;
    transition: all 0.3s ease;
    border: 2px solid rgba(0, 215, 254, 0.3);
}

.input-icon svg {
    width: 22px;
    height: 22px;
    fill: currentColor;
}

.message-icon {
    height: 50px;
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
    border-radius: 16px; /* Gen Z style */
    padding: 1.2rem;
    font-family: \'Rajdhani\', sans-serif;
    color: var(--text-bright);
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
}

.contact-form textarea {
    min-height: 150px;
    resize: vertical;
}

/* Floating Label */
.contact-form label {
    position: absolute;
    top: 1.2rem;
    left: 1.2rem;
    color: var(--text-dim);
    font-family: \'Chakra Petch\', sans-serif;
    transition: all 0.3s ease;
    pointer-events: none;
    font-size: 1rem;
}

.contact-form input:focus ~ label,
.contact-form input:not(:placeholder-shown) ~ label,
.contact-form textarea:focus ~ label,
.contact-form textarea:not(:placeholder-shown) ~ label {
    top: -1.8rem;
    left: 0;
    color: var(--primary-accent);
    font-size: 0.9rem;
    font-weight: bold;
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
    box-shadow: 0 0 0 3px rgba(0, 215, 254, 0.2), inset 0 2px 4px rgba(0, 0, 0, 0.2);
    transform: scale(1.01);
}

.input-line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px; /* Thicker for Gen Z */
    background: linear-gradient(90deg, var(--primary-accent) 0%, var(--neon-purple) 100%);
    transition: width 0.4s cubic-bezier(0.19, 1, 0.22, 1);
    border-radius: 3px;
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
    box-shadow: 0 0 20px rgba(0, 215, 254, 0.5);
    transform: translateY(-5px) rotate(10deg);
}

/* Submit Button */
.submit-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 1.2rem 1.5rem;
    background: linear-gradient(90deg, var(--primary-accent-dark) 0%, var(--primary-accent) 100%);
    color: var(--text-bright);
    border: none;
    border-radius: 18px; /* Gen Z style */
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    margin-top: 1.5rem;
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
    box-shadow: 0 15px 30px rgba(0, 215, 254, 0.4);
    transform: translateY(-5px) scale(1.02);
    letter-spacing: 3px;
}

.submit-button:hover::before {
    left: 100%;
}

.submit-button i {
    margin-left: 0.8rem;
    transition: transform 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6);
    font-size: 1.2rem;
}

.submit-button:hover i {
    transform: translateX(8px) rotate(15deg);
}

/* Form Status Message */
.form-status {
    text-align: center;
    margin-top: 1.5rem;
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1rem;
    height: 1.5rem;
    font-weight: bold;
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
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.cyber-line {
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), var(--neon-purple), transparent);
    margin: 2rem auto;
    width: 80%;
    max-width: 600px;
    position: relative;
    border-radius: 3px;
}

.cyber-line::before {
    content: \'\';
    position: absolute;
    width: 12px;
    height: 12px;
    background-color: var(--primary-accent);
    top: -5px;
    left: 50%;
    transform: translateX(-50%) rotate(45deg);
    box-shadow: 0 0 15px var(--primary-accent);
}

/* Footer */
.contact-footer {
    text-align: center;
    margin-top: 3rem;
    color: var(--text-dim);
    position: relative;
    padding-top: 2rem;
    font-family: \'Rajdhani\', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
}

.tech-circuit {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 2px;
    background: var(--primary-accent);
    opacity: 0.5;
}

.tech-circuit::before,
.tech-circuit::after {
    content: \'\';
    position: absolute;
    width: 6px;
    height: 6px;
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

/* Gen Z FAQ Button */
.faq-button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.cyber-button.secondary {
    position: relative;
    padding: 0.8rem 2rem;
    background: transparent;
    color: var(--text-bright);
    border: 2px solid var(--primary-accent);
    border-radius: 12px;
    font-family: \'Chakra Petch\', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    overflow: hidden;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    z-index: 1;
}

.cyber-button.secondary::before {
    content: \'\';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: linear-gradient(90deg, var(--primary-accent) 0%, var(--neon-purple) 100%);
    transition: all 0.4s ease;
    z-index: -1;
}

.cyber-button.secondary:hover {
    color: var(--primary-dark);
    box-shadow: 0 10px 20px rgba(0, 215, 254, 0.3);
    transform: translateY(-5px);
}

.cyber-button.secondary:hover::before {
    width: 100%;
}

.cyber-button.secondary span {
    position: relative;
    z-index: 2;
}

.cyber-button.secondary i {
    margin-left: 0.5rem;
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.cyber-button.secondary:hover i {
    transform: translateX(5px);
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .contact-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-info,
    .contact-form-container {
        max-width: 700px;
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
        font-size: 2.5rem;
    }
    
    .contact-method {
        padding: 0.3rem;
    }
}

@media (max-width: 480px) {
    .form-group {
        flex-direction: column;
        align-items: center;
    }
    
    .input-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 0.8rem;
    }
    
    .contact-form-container,
    .contact-info {
        padding: 1.5rem;
        border-radius: 20px;
    }
    
    .submit-button {
        padding: 1rem;
    }
    
    .contact-social {
        flex-wrap: wrap;
        justify-content: center;
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
    0% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(50px, -50px) rotate(90deg); }
    50% { transform: translate(100px, 0) rotate(180deg); }
    75% { transform: translate(50px, 50px) rotate(270deg); }
    100% { transform: translate(0, 0) rotate(360deg); }
}

.circuit-line {
    position: absolute;
    right: 0;
    width: 150px;
    height: 2px;
    background: var(--primary-accent);
    opacity: 0.3;
    overflow: hidden;
}

.circuit-line::after {
    content: \'\';
    position: absolute;
    top: -1px;
    left: 0;
    width: 15px;
    height: 4px;
    background: var(--primary-accent);
    animation: circuit-pulse 3s infinite linear;
}

@keyframes circuit-pulse {
    0% { left: -15px; }
    100% { left: 150px; }
}

.animate-in {
    animation: slide-up 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Gen Z text emoji additions */
.emoji-icon {
    display: inline-block;
    font-style: normal;
    margin-left: 5px;
    vertical-align: middle;
    transition: all 0.3s ease;
}

.contact-method:hover .emoji-icon {
    transform: scale(1.2);
}

/* REACH OUT Heading Fix - Prevent Duplication */
.glitch-text {
    position: relative;
    display: inline-block;
}

.glitch-text::before,
.glitch-text::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    clip: rect(0, 0, 0, 0);
    z-index: -1;
}

.glitch-text::before {
    left: -2px;
    text-shadow: 2px 0 var(--primary-accent);
    animation: glitch-1 2s infinite linear alternate-reverse;
}

.glitch-text::after {
    left: 2px;
    text-shadow: -2px 0 var(--neon-purple);
    animation: glitch-2 3s infinite linear alternate-reverse;
}

@keyframes glitch-1 {
    0%, 80%, 100% { clip: rect(0, 9999px, 2px, 0); }
    20%, 60% { clip: rect(0, 9999px, var(--font-size), 0); }
    40% { clip: rect(45px, 9999px, 56px, 0); }
}

@keyframes glitch-2 {
    0%, 80%, 100% { clip: rect(0, 9999px, 2px, 0); }
    20%, 60% { clip: rect(0, 9999px, var(--font-size), 0); }
    40% { clip: rect(35px, 9999px, 36px, 0); }
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
                showStatus("Please fill in all required fields ✨", "error");
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
            if (!emailRegex.test(email)) {
                showStatus("Please enter a valid email address 📧", "error");
                return;
            }
            
            // Phone validation (optional field)
            if (phone !== "") {
                const phoneRegex = /^\\+?[0-9\\s\\-\\(\\)]{7,20}$/;
                if (!phoneRegex.test(phone)) {
                    showStatus("Please enter a valid phone number 📱", "error");
                    return;
                }
            }
            
            // Simulate form submission
            showStatus("Sending... ⚡", "");
            
            // In a real application, you would send the data to a server here
            setTimeout(() => {
                showStatus("Message sent successfully! We\'ll get back to you soon. 🚀", "success");
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
    
    // Add emoji tooltips to social icons for Gen Z flair
    const socialIcons = document.querySelectorAll(".social-icon");
    const emojiList = ["✨", "🔥", "💯", "⚡"];
    
    socialIcons.forEach((icon, index) => {
        const emoji = emojiList[index % emojiList.length];
        icon.setAttribute("title", `Connect with us ${emoji}`);
    });
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
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" >REACH OUT</h1>
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
                <h2 class="gradient-text-small">Let's Connect <span class="emoji-icon">🚀</span></h2>
                <p class="tech-text">Have questions about ByteVerse? Want to become a sponsor or mentor? Drop us a message and our team will get back to you quickly!</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>Location <span class="emoji-icon">📍</span></h3>
                            <p>CT GROUP OF INSTITUTIONS SHAHPUR CAMPUS</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>Email <span class="emoji-icon">📧</span></h3>
                            <p>madhav.2201660@stu.ctgroup.in</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>Call Us <span class="emoji-icon">📱</span></h3>
                            <p>9478529300</p>
                        </div>
                    </div>
                    
                    <div class="contact-social">
                        <a href="#" class="social-icon" title="Connect with us on Twitter ✨">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon" title="Connect with us on Instagram 🔥">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon" title="Connect with us on LinkedIn 💯">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon" title="Connect with us on GitHub ⚡">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                <form id="contactForm" class="contact-form">
                    <div class="form-group">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" placeholder="Full Name" required>
                            <label for="name">Full Name</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                            <label for="email">Email Address</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="input-wrapper">
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number">
                            <label for="phone">Phone Number</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon message-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                            </svg>
                        </div>
                        <div class="input-wrapper">
                            <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                            <label for="message">Your Message</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">
                        <span>Send Message</span>
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                    
                    <div class="form-status" id="formStatus"></div>
                </form>
            </div>
        </div>
        
        <div class="contact-footer">
            <div class="tech-circuit"></div>
            <p>Join us in creating the future at ByteVerse Hackathon <span class="emoji-icon">💻✨</span></p>
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
                <h3 class="text-xl font-chakra font-bold mb-3 text-white">Can beginners participate? <span class="emoji-icon">🤔</span></h3>
                <p class="text-gray-300">Absolutely! ByteVerse welcomes hackers of all skill levels. We have workshops, mentors, and a supportive community to help beginners thrive.</p>
            </div>
            
            <div class="p-6 rounded-lg bg-opacity-10 backdrop-blur-sm bg-gray-800 border border-gray-700 text-left">
                <h3 class="text-xl font-chakra font-bold mb-3 text-white">What should I bring? <span class="emoji-icon">🎒</span></h3>
                <p class="text-gray-300">Bring your laptop, charger, any hardware you plan to use, and your enthusiasm! We'll provide food, drinks, and a comfortable hacking environment.</p>
            </div>
        </div>
        
        <div class="faq-button-wrapper mt-10">
            <a href="faq.php" class="cyber-button secondary">
                <span>View All FAQs</span>
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                </svg>
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