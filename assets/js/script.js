// Indian languages for the loader
const indianLanguages = [
    { text: "बाइटवर्स", language: "Hindi" },
    { text: "বাইটভার্স", language: "Bengali" },
    { text: "பைட்வெர்ஸ்", language: "Tamil" },
    { text: "బైట్‌వర్స్", language: "Telugu" },
    { text: "ಬೈಟ್‌ವರ್ಸ್", language: "Kannada" },
    { text: "ബൈറ്റ്‌വേഴ്‌സ്", language: "Malayalam" },
    { text: "બાઇટવર્સ", language: "Gujarati" },
    { text: "ਬਾਈਟਵਰਸ", language: "Punjabi" },
    { text: "बाइटव्हर्स", language: "Marathi" }
];

// Custom cursor
document.addEventListener('mousemove', (e) => {
    const cursor = document.querySelector('.custom-cursor');
    const trailer = document.querySelector('.cursor-trailer');
    
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
    
    // Add delay for trailer
    setTimeout(() => {
        trailer.style.left = e.clientX + 'px';
        trailer.style.top = e.clientY + 'px';
    }, 100);
});

// Make cursor larger when hovering over interactive elements
document.querySelectorAll('a, button').forEach(el => {
    el.addEventListener('mouseenter', () => {
        const trailer = document.querySelector('.cursor-trailer');
        trailer.style.width = '70px';
        trailer.style.height = '70px';
        trailer.style.borderColor = 'var(--primary-accent)';
    });
    
    el.addEventListener('mouseleave', () => {
        const trailer = document.querySelector('.cursor-trailer');
        trailer.style.width = '40px';
        trailer.style.height = '40px';
        trailer.style.borderColor = 'var(--primary-accent-light)';
    });
});

// Loading screen animation
document.addEventListener('DOMContentLoaded', () => {
    // Initialize
    const loader = document.getElementById('loader');
    const content = document.getElementById('content');
    const logoText = document.getElementById('logo-text');
    const languageText = document.getElementById('language-animation');
    const progressBar = document.querySelector('.loader-progress-bar');
    const statusText = document.querySelector('.loader-status');
    
    // Show ByteVerse with typing animation but without scroll effects
    if (logoText) {
        logoText.style.opacity = "1"; // Ensure logo is always visible
        gsap.to(logoText, {
            duration: 1,
            text: "ByteVerse",
            ease: "none",
            onComplete: () => startLanguageAnimation()
        });
    }
    
    // Progress bar animation
    gsap.to(progressBar, {
        width: "100%",
        duration: 10,
        ease: "power1.inOut"
    });
    
    // Status messages
    const statusMessages = [
        "Loading assets...",
        "Initializing ByteVerse...",
        "Configuring neural networks...",
        "Syncing quantum processors...",
        "Launching digital experience..."
    ];
    
    let messageIndex = 0;
    const statusInterval = setInterval(() => {
        if (messageIndex < statusMessages.length) {
            gsap.to(statusText, {
                opacity: 0,
                duration: 0.5,
                onComplete: () => {
                    statusText.textContent = statusMessages[messageIndex];
                    gsap.to(statusText, {
                        opacity: 1,
                        duration: 0.5
                    });
                }
            });
            messageIndex++;
        } else {
            clearInterval(statusInterval);
        }
    }, 2000);
    
    // Function to animate through Indian languages
    function startLanguageAnimation() {
        gsap.to(languageText, {
            opacity: 1,
            duration: 0.5
        });
        
        let langIndex = 0;
        const langInterval = setInterval(() => {
            if (langIndex < indianLanguages.length) {
                gsap.to(languageText, {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => {
                        languageText.innerHTML = `${indianLanguages[langIndex].text} <span class="text-xs opacity-50">${indianLanguages[langIndex].language}</span>`;
                        gsap.to(languageText, {
                            opacity: 1,
                            duration: 0.3
                        });
                    }
                });
                langIndex++;
            } else {
                clearInterval(langInterval);
                setTimeout(completeLoading, 1000);
            }
        }, 800);
    }
    
    // Complete loading and show content
    function completeLoading() {
        gsap.to(loader, {
            opacity: 0,
            duration: 1,
            onComplete: () => {
                loader.style.display = 'none';
                content.style.opacity = 1;
                initializeMainAnimations();
                initializeMatrixEffect();
                initThreeJsBackground();
            }
        });
    }

    initThemeSwitcher();
    initTerminal();
    initCountdown();
    initMobileMenu();
    initSoundEffects();
});

// Main content animations
function initializeMainAnimations() {
    // Remove animations that might hide elements during scroll
    
    // Animate hero elements without affecting visibility on scroll
    gsap.from(".glitch-text", {
        y: 50,
        opacity: 0,
        duration: 1,
        ease: "power3.out",
        clearProps: "all" // Clear properties after animation to prevent scroll issues
    });
    
    gsap.from(".hero-subtitle", {
        y: 30,
        opacity: 0,
        duration: 1,
        delay: 0.3,
        ease: "power3.out"
    });
    
    gsap.from("p", {
        y: 30,
        opacity: 0,
        duration: 1,
        delay: 0.5,
        ease: "power3.out"
    });
    
    gsap.from(".cyber-button", {
        y: 20,
        opacity: 0,
        duration: 0.8,
        stagger: 0.2,
        delay: 0.7,
        ease: "power3.out"
    });
    
    // Navbar animation - ensure it stays visible
    gsap.from("nav", {
        y: -100,
        opacity: 0,
        duration: 1,
        delay: 0.2,
        ease: "power3.out",
        clearProps: "all" // Clear animation properties after completion
    });
    
    // Animate stat counters
    const statValues = document.querySelectorAll('.stat-value');
    statValues.forEach(stat => {
        const targetValue = parseInt(stat.getAttribute('data-value'));
        const duration = 2;
        
        gsap.to(stat, {
            innerText: targetValue,
            duration: duration,
            ease: "power2.out",
            snap: { innerText: 1 },
            delay: 1
        });
    });
}

// Matrix rain effect
function initializeMatrixEffect() {
    const canvas = document.getElementById('matrix-canvas');
    const ctx = canvas.getContext('2d');
    
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    const katakana = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
    const latin = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const nums = '0123456789';
    const binary = '01';
    
    const alphabet = binary + nums;
    
    const fontSize = 16;
    const columns = canvas.width / fontSize;
    
    const drops = [];
    for (let x = 0; x < columns; x++) {
        drops[x] = 1;
    }
    
    const draw = () => {
        ctx.fillStyle = 'rgba(5, 10, 24, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        ctx.fillStyle = '#00D7FE';
        ctx.font = fontSize + 'px monospace';
        
        for (let i = 0; i < drops.length; i++) {
            const text = alphabet[Math.floor(Math.random() * alphabet.length)];
            
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);
            
            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            
            drops[i]++;
        }
    };
    
    setInterval(draw, 33);
    
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });
}

// Three.js background effect


// Theme switcher
function initThemeSwitcher() {
    const themeOptions = document.querySelectorAll('.theme-option');
    const root = document.documentElement;
    
    themeOptions.forEach(option => {
        option.addEventListener('click', () => {
            // Remove active class from all options
            themeOptions.forEach(opt => opt.classList.remove('active'));
            
            // Add active class to clicked option
            option.classList.add('active');
            
            // Set the theme
            const theme = option.getAttribute('data-theme');
            root.setAttribute('data-theme', theme);
            
            // Save to localStorage
            localStorage.setItem('byteverse-theme', theme);
        });
    });
    
    // Load saved theme
    const savedTheme = localStorage.getItem('byteverse-theme');
    if (savedTheme) {
        root.setAttribute('data-theme', savedTheme);
        
        // Activate the correct button
        themeOptions.forEach(option => {
            if (option.getAttribute('data-theme') === savedTheme) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });
    }
}

// Add to script.js
function initTerminal() {
    const terminalContainer = document.querySelector('.terminal-container');
    const terminalToggle = document.querySelector('.terminal-toggle');
    const terminalInput = document.getElementById('terminal-input');
    const terminalOutput = document.getElementById('terminal-output');
    
    // Toggle terminal
    terminalToggle.addEventListener('click', () => {
        terminalContainer.classList.toggle('active');
        if (terminalContainer.classList.contains('active')) {
            terminalInput.focus();
        }
    });
    
    // Initial welcome message
    appendToTerminal('Welcome to ByteVerse 1.0 terminal.', 'success');
    appendToTerminal('Type <span class="text-cyan-400">help</span> to see available commands.', 'normal');
    
    // Handle input
    terminalInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const command = this.value.trim().toLowerCase();
            
            // Display the command
            appendToTerminal(`bytev@rse:~$ ${command}`, 'command');
            
            // Process command
            processCommand(command);
            
            // Clear input
            this.value = '';
        }
    });
    
    // Fix the empty terminal command implementations
    function processCommand(command) {
        switch(command) {
            case 'help':
                appendToTerminal('Available commands:', 'normal');
                appendToTerminal('- <span class="text-cyan-400">help</span>: Show available commands', 'normal');
                appendToTerminal('- <span class="text-cyan-400">about</span>: About ByteVerse 1.0', 'normal');
                appendToTerminal('- <span class="text-cyan-400">register</span>: Registration information', 'normal');
                appendToTerminal('- <span class="text-cyan-400">schedule</span>: Event schedule', 'normal');
                appendToTerminal('- <span class="text-cyan-400">clear</span>: Clear terminal', 'normal');
                appendToTerminal('- <span class="text-cyan-400">egg</span>: Find an easter egg', 'normal');
                break;
            
            case 'about':
                appendToTerminal('ByteVerse 1.0 is the ultimate coding hackathon where technology meets innovation.', 'normal');
                appendToTerminal('Join brilliant minds in a 48-hour journey to build groundbreaking solutions.', 'normal');
                appendToTerminal('Track domains include: Agriculture, Healthcare, IoT & XR Tech, Cybersecurity, and Open Innovation.', 'normal');
                break;
            
            case 'register':
                appendToTerminal('Registration is now open! Participation fee: ₹500 per team.', 'normal');
                appendToTerminal('Team size: Minimum 3, Maximum 5 members.', 'normal');
                appendToTerminal('To register, visit the <a href="registration.php" class="text-cyan-400 underline">registration page</a>.', 'normal');
                break;
            
            case 'schedule':
                appendToTerminal('August 22, 2025:', 'success');
                appendToTerminal('- 09:00 AM: Registration & Check-in', 'normal');
                appendToTerminal('- 10:30 AM: Opening Ceremony', 'normal');
                appendToTerminal('- 12:00 PM: Hackathon Begins', 'normal');
                appendToTerminal('August 23, 2025:', 'success');
                appendToTerminal('- 12:00 PM: Hackathon Ends', 'normal');
                appendToTerminal('- 02:00 PM: Project Presentations', 'normal');
                appendToTerminal('- 05:00 PM: Awards Ceremony', 'normal');
                break;
            
            case 'clear':
                terminalOutput.innerHTML = '';
                break;
            
            case 'egg':
                appendToTerminal('You found a secret easter egg! Here\'s a prize for your curiosity...', 'success');
                appendToTerminal(`<div class="ascii-art">
                    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                    ⠀⠀⠀⠀⠀⠀⣠⣶⣿⣿⣿⣿⣿⣶⣤⡀⠀⠀⠀⠀⠀⠀
                    ⠀⠀⠀⠀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣆⠀⠀⠀⠀⠀
                    ⠀⠀⢀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀
                    ⠀⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀
                    ⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀
                    ⢰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀
                    ⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡀⠀
                    ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀
                    ⢹⣿⣿⣿⡏⠙⠛⠻⣿⣿⣿⣿⣿⡿⠟⠛⠉⢹⣿⣿⡇⠀
                    ⠘⣿⣿⣿⣇⠀⠀⠀⣿⣿⣿⣿⣿⣿⠀⠀⠀⣸⣿⣿⡇⠀
                    ⠀⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⠀⠀
                    ⠀⠀⠈⠉⠙⠛⠛⠛⠛⠛⠛⠛⠛⠛⠛⠋⠉⠁⠀⠀⠀⠀
                </div>`, 'normal');
                break;
            
            case 'matrix':
                appendToTerminal('Activating the Matrix...', 'success');
                document.querySelector('#matrix-canvas').style.opacity = '0.8';
                setTimeout(() => {
                    document.querySelector('#matrix-canvas').style.opacity = '0.3';
                    appendToTerminal('Matrix deactivated.', 'normal');
                }, 5000);
                break;
            
            default:
                appendToTerminal(`Command not found: ${command}. Type 'help' for available commands.`, 'error');
        }
    }
    
    function appendToTerminal(text, type) {
        const line = document.createElement('div');
        line.className = `terminal-output-line`;
        if (type) line.classList.add(`terminal-output-${type}`);
        line.innerHTML = text;
        terminalOutput.appendChild(line);
        
        // Auto scroll to bottom
        terminalOutput.scrollTop = terminalOutput.scrollHeight;
    }
}

// Add to script.js
function initCountdown() {
    // First check if countdown elements exist on the current page
    const daysElement = document.getElementById('countdown-days');
    const hoursElement = document.getElementById('countdown-hours');
    const minutesElement = document.getElementById('countdown-minutes');
    const secondsElement = document.getElementById('countdown-seconds');
    
    // Exit the function if countdown elements don't exist on this page
    if (!daysElement || !hoursElement || !minutesElement || !secondsElement) {
        return;
    }
    
    // Hackathon date: August 22, 2025
    const hackathonDate = new Date('August 22, 2025 09:00:00').getTime();
    
    // Update countdown every second
    const countdownInterval = setInterval(function() {
        // Get current date and time
        const now = new Date().getTime();
        
        // Calculate the time difference
        const distance = hackathonDate - now;
        
        // If the countdown is over
        if (distance < 0) {
            clearInterval(countdownInterval);
            daysElement.textContent = '00';
            hoursElement.textContent = '00';
            minutesElement.textContent = '00';
            secondsElement.textContent = '00';
            return;
        }
        
        // Time calculations
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Display the results (now using cached elements)
        daysElement.textContent = days.toString().padStart(2, '0');
        hoursElement.textContent = hours.toString().padStart(2, '0');
        minutesElement.textContent = minutes.toString().padStart(2, '0');
        secondsElement.textContent = seconds.toString().padStart(2, '0');
    }, 1000);
}

// Add to script.js
function initMobileMenu() {
    const mobileMenuButton = document.querySelector('.md\\:hidden');
    const navLinks = document.querySelector('.hidden.md\\:flex');
    
    // Create a mobile menu container
    const mobileMenu = document.createElement('div');
    mobileMenu.className = 'mobile-menu fixed inset-0 bg-black bg-opacity-90 z-50 flex-col items-center justify-center hidden';
    
    // Clone nav links
    const navLinksMobile = navLinks.cloneNode(true);
    navLinksMobile.className = 'flex flex-col space-y-8 items-center';
    
    // Add close button
    const closeButton = document.createElement('button');
    closeButton.className = 'absolute top-4 right-4 text-white p-2';
    closeButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    `;
    
    // Add register button
    const registerButton = document.querySelector('.cyber-button.primary').cloneNode(true);
    
    // Append elements
    mobileMenu.appendChild(closeButton);
    mobileMenu.appendChild(navLinksMobile);
    mobileMenu.appendChild(registerButton);
    
    // Add to document
    document.body.appendChild(mobileMenu);
    
    // Toggle menu
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        mobileMenu.classList.add('flex');
        
        // Animation
        gsap.from(navLinksMobile.children, {
            y: 50,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: "power2.out"
        });
    });
    
    // Close menu
    closeButton.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('flex');
    });
    
    // Close when clicking on links
    navLinksMobile.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex');
        });
    });
}

// Add to script.js
function initSoundEffects() {
    const hoverSound = document.getElementById('hover-sound');
    const clickSound = document.getElementById('click-sound');
    const startupSound = document.getElementById('startup-sound');
    
    // Low volume
    hoverSound.volume = 0.2;
    clickSound.volume = 0.3;
    startupSound.volume = 0.4;
    
    // Play startup sound when content loads
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            startupSound.play().catch(e => console.log('Audio play prevented: user has not interacted yet'));
        }, 1000);
    });
    
    // Hover sounds for buttons and links
    document.querySelectorAll('button, .nav-link, .cyber-button').forEach(element => {
        element.addEventListener('mouseenter', () => {
            hoverSound.currentTime = 0;
            hoverSound.play().catch(e => {});
        });
        
        element.addEventListener('click', () => {
            clickSound.currentTime = 0;
            clickSound.play().catch(e => {});
        });
    });
    
    // Add sound toggle button
    const soundToggle = document.createElement('button');
    soundToggle.className = 'sound-toggle fixed bottom-4 left-4 z-40 bg-opacity-70 backdrop-blur-md p-2 rounded-full border border-gray-700 hover:border-cyan-400 transition-colors';
    soundToggle.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 6a7.975 7.975 0 00-3 1.172m-3 2.128a6 6 0 001.757 4.243M12 6v12m6-6a6 6 0 01-6 6m-6-6a6 6 0 016-6" />
        </svg>
    `;
    
    document.body.appendChild(soundToggle);
    
    // Mute/unmute functionality
    let muted = false;
    soundToggle.addEventListener('click', () => {
        muted = !muted;
        
        [hoverSound, clickSound, startupSound].forEach(sound => {
            sound.muted = muted;
        });
        
        if (muted) {
            soundToggle.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                </svg>
            `;
        } else {
            soundToggle.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 6a7.975 7.975 0 00-3 1.172m-3 2.128a6 6 0 001.757 4.243M12 6v12m6-6a6 6 0 01-6 6m-6-6a6 6 0 016-6" />
                </svg>
            `;
        }
    });
}

// Add mobile typewriter animation
document.addEventListener('DOMContentLoaded', function() {
    // Only apply for mobile devices
    if (window.innerWidth <= 768) {
        const byteEl = document.querySelector('.mobile-logo-text .byte');
        const verseEl = document.querySelector('.mobile-logo-text .verse');
        
        if (byteEl && verseEl) {
            // Ensure elements stay visible during and after animation
            byteEl.style.opacity = "1";
            verseEl.style.opacity = "1";
            
            // Clear initial text and add typewriter effect
            byteEl.textContent = '';
            verseEl.textContent = '';
            
            // Type Byte first
            setTimeout(() => {
                typeWriter(byteEl, 'Byte', 0, 150, function() {
                    // After Byte is complete, type Verse
                    setTimeout(() => {
                        typeWriter(verseEl, 'Verse', 0, 150, function() {
                            // Remove cursor after typing is complete
                            setTimeout(() => {
                                const cursor = byteEl.querySelector('::after');
                                if (cursor) cursor.style.display = 'none';
                            }, 500);
                            
                            // Continue with any other animations
                            if (typeof startLanguageAnimation === 'function') {
                                startLanguageAnimation();
                            }
                        });
                    }, 300);
                });
            }, 500);
        }
    }
    
    // Typewriter function
    function typeWriter(element, text, index, speed, callback) {
        if (index < text.length) {
            element.textContent = text.substring(0, index + 1);
            setTimeout(function() {
                typeWriter(element, text, index + 1, speed, callback);
            }, speed);
        } else if (callback) {
            callback();
        }
    }
    
    // Prevent hiding on scroll by setting a scroll event handler
    window.addEventListener('scroll', function() {
        // Keep ByteVerse visible in both desktop and mobile views
        const navLogo = document.querySelector('.text-2xl.font-bold.tracking-wider.font-orbitron');
        const mobileLogo = document.querySelector('.mobile-logo-text');
        
        if (navLogo) navLogo.style.opacity = "1";
        if (mobileLogo) mobileLogo.style.opacity = "1";
    });
});

/**
 * ByteVerse Custom Background
 * A unique cyberpunk-themed grid animation with techno elements
 */

document.addEventListener('DOMContentLoaded', function() {
    // Remove any existing Three.js container elements
    const oldContainer = document.getElementById('particles-container');
    if (oldContainer) {
        oldContainer.innerHTML = '';
    }
    
    // Create canvas for the cyberpunk grid
    const canvas = document.createElement('canvas');
    canvas.id = 'cyberpunk-grid';
    canvas.className = 'fixed inset-0 z-0';
    canvas.style.opacity = '0.4';
    
    // Add to container
    oldContainer.appendChild(canvas);
    
    // Initialize canvas
    const ctx = canvas.getContext('2d');
    
    // Set canvas size
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    
    // Configuration
    const config = {
        gridSize: 60,
        lineColor: 'rgba(0, 215, 254, 0.2)',
        lineColorAlt: 'rgba(189, 0, 255, 0.15)',
        highlightColor: 'rgba(0, 215, 254, 0.5)',
        highlightColorAlt: 'rgba(255, 0, 128, 0.4)',
        glowIntensity: 20,
        pulseSpeed: 0.02,
        moveSpeed: 0.5,
        perspective: 800,
        floatingElements: []
    };
    
    // Create floating tech elements
    function createFloatingElements() {
        const elements = [];
        const shapes = [drawCircuit, drawCodeBlock, drawDataNode];
        
        // Add 15-25 elements based on screen size
        const count = Math.floor(window.innerWidth / 100);
        
        for (let i = 0; i < count; i++) {
            elements.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                size: Math.random() * 40 + 20,
                opacity: Math.random() * 0.5 + 0.2,
                speed: Math.random() * 0.4 + 0.1,
                direction: Math.random() * Math.PI * 2,
                rotation: Math.random() * Math.PI * 2,
                rotationSpeed: (Math.random() - 0.5) * 0.01,
                shape: shapes[Math.floor(Math.random() * shapes.length)]
            });
        }
        
        return elements;
    }
    
    // Drawing functions for different tech elements
    function drawCircuit(ctx, x, y, size, rotation, opacity) {
        ctx.save();
        ctx.translate(x, y);
        ctx.rotate(rotation);
        ctx.globalAlpha = opacity;
        
        // Circuit board pattern
        ctx.beginPath();
        ctx.moveTo(-size/2, -size/4);
        ctx.lineTo(size/2, -size/4);
        ctx.moveTo(-size/4, -size/2);
        ctx.lineTo(-size/4, size/2);
        ctx.moveTo(size/4, -size/2);
        ctx.lineTo(size/4, 0);
        ctx.moveTo(0, size/4);
        ctx.lineTo(size/2, size/4);
        
        // Draw lines
        ctx.lineWidth = 2;
        ctx.strokeStyle = config.highlightColor;
        ctx.stroke();
        
        // Draw nodes
        for (let i = 0; i < 3; i++) {
            const nodeX = (Math.random() - 0.5) * size * 0.8;
            const nodeY = (Math.random() - 0.5) * size * 0.8;
            ctx.beginPath();
            ctx.arc(nodeX, nodeY, size/10, 0, Math.PI * 2);
            ctx.fillStyle = i % 2 === 0 ? config.highlightColor : config.highlightColorAlt;
            ctx.fill();
        }
        
        ctx.restore();
    }
    
    function drawCodeBlock(ctx, x, y, size, rotation, opacity) {
        ctx.save();
        ctx.translate(x, y);
        ctx.rotate(rotation);
        ctx.globalAlpha = opacity;
        
        // Code block background
        ctx.fillStyle = 'rgba(10, 20, 30, 0.7)';
        ctx.fillRect(-size/2, -size/2, size, size);
        
        // Code lines
        const lineHeight = size / 6;
        ctx.fillStyle = config.highlightColor;
        
        for (let i = 0; i < 4; i++) {
            const lineY = -size/2 + (i+1) * lineHeight;
            const lineWidth = Math.random() * (size * 0.7) + (size * 0.3);
            ctx.fillRect(-size/2 + size * 0.1, lineY, lineWidth, lineHeight/3);
        }
        
        // Border
        ctx.strokeStyle = config.highlightColorAlt;
        ctx.lineWidth = 1;
        ctx.strokeRect(-size/2, -size/2, size, size);
        
        ctx.restore();
    }
    
    function drawDataNode(ctx, x, y, size, rotation, opacity) {
        ctx.save();
        ctx.translate(x, y);
        ctx.rotate(rotation);
        ctx.globalAlpha = opacity;
        
        // Data node center
        ctx.beginPath();
        ctx.arc(0, 0, size/3, 0, Math.PI * 2);
        ctx.fillStyle = config.highlightColorAlt;
        ctx.fill();
        
        // Outer ring
        ctx.beginPath();
        ctx.arc(0, 0, size/2, 0, Math.PI * 2);
        ctx.strokeStyle = config.highlightColor;
        ctx.lineWidth = 2;
        ctx.stroke();
        
        // Connection lines
        const lineCount = Math.floor(Math.random() * 3) + 3;
        for (let i = 0; i < lineCount; i++) {
            const angle = (Math.PI * 2 / lineCount) * i;
            const endX = Math.cos(angle) * size;
            const endY = Math.sin(angle) * size;
            
            ctx.beginPath();
            ctx.moveTo(Math.cos(angle) * (size/2), Math.sin(angle) * (size/2));
            ctx.lineTo(endX, endY);
            ctx.strokeStyle = i % 2 === 0 ? config.highlightColor : config.highlightColorAlt;
            ctx.stroke();
            
            // Data packets
            if (Math.random() > 0.5) {
                ctx.beginPath();
                ctx.arc(Math.cos(angle) * (size*0.75), Math.sin(angle) * (size*0.75), size/10, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
                ctx.fill();
            }
        }
        
        ctx.restore();
    }
    
    // Create initial elements
    config.floatingElements = createFloatingElements();
    
    // Animation variables
    let phase = 0;
    let gridOffset = 0;
    
    // Draw grid with perspective effect
    function drawGrid() {
        // Perspective grid effect
        let gridSize = config.gridSize;
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Draw horizontal lines with perspective
        for (let y = 0; y < canvas.height + gridSize; y += gridSize) {
            const perspectiveOffset = (y - canvas.height / 2) / config.perspective;
            const distanceFactor = Math.abs(perspectiveOffset);
            
            // Calculate starting and ending x based on perspective
            const startX = canvas.width * perspectiveOffset;
            const endX = canvas.width - startX;
            
            ctx.beginPath();
            ctx.moveTo(startX, y + gridOffset % gridSize);
            ctx.lineTo(endX, y + gridOffset % gridSize);
            
            // Lines get brighter as they approach the center of the screen
            const opacity = 0.7 - distanceFactor;
            ctx.strokeStyle = y % (gridSize * 2) === 0 ? 
                `rgba(0, 215, 254, ${opacity})` : 
                `rgba(189, 0, 255, ${opacity * 0.7})`;
            
            ctx.lineWidth = Math.max(0.5, 1 - distanceFactor);
            ctx.stroke();
        }
        
        // Draw vertical lines with glow effect
        for (let x = 0; x < canvas.width + gridSize; x += gridSize) {
            // Pulse effect with sine wave
            const pulse = Math.sin(phase + x / 100) * 0.5 + 0.5;
            
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, canvas.height);
            
            // Different colors for alternating lines
            if (x % (gridSize * 2) === 0) {
                ctx.strokeStyle = `rgba(0, 215, 254, ${0.2 + pulse * 0.3})`;
            } else {
                ctx.strokeStyle = `rgba(189, 0, 255, ${0.15 + pulse * 0.2})`;
            }
            
            ctx.lineWidth = 1;
            ctx.stroke();
            
            // Add glow effect to some lines
            if (Math.random() < 0.1) {
                ctx.shadowColor = x % (gridSize * 2) === 0 ? 'rgba(0, 215, 254, 0.8)' : 'rgba(189, 0, 255, 0.8)';
                ctx.shadowBlur = config.glowIntensity * pulse;
                ctx.stroke();
                ctx.shadowBlur = 0;
            }
        }
        
        // Draw floating elements
        config.floatingElements.forEach(element => {
            // Draw based on element's shape function
            element.shape(
                ctx, 
                element.x, 
                element.y, 
                element.size, 
                element.rotation, 
                element.opacity
            );
            
            // Update element position
            element.x += Math.cos(element.direction) * element.speed;
            element.y += Math.sin(element.direction) * element.speed;
            element.rotation += element.rotationSpeed;
            
            // Wrap around screen
            if (element.x < -element.size) element.x = canvas.width + element.size;
            if (element.x > canvas.width + element.size) element.x = -element.size;
            if (element.y < -element.size) element.y = canvas.height + element.size;
            if (element.y > canvas.height + element.size) element.y = -element.size;
        });
        
        // Update animation parameters
        phase += config.pulseSpeed;
        gridOffset += config.moveSpeed;
        
        // Request next frame
        requestAnimationFrame(drawGrid);
    }
    
    // Start animation
    drawGrid();
    
    // Add mouse interaction
    let mouseX = 0;
    let mouseY = 0;
    
    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        // Affect nearby elements
        config.floatingElements.forEach(element => {
            const dx = mouseX - element.x;
            const dy = mouseY - element.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            
            // If cursor is close to the element, push it away slightly
            if (distance < 150) {
                const angle = Math.atan2(dy, dx);
                element.direction = angle + Math.PI; // Move away from cursor
                element.speed = Math.max(element.speed, 0.8); // Increase speed temporarily
            }
        });
    });
});


