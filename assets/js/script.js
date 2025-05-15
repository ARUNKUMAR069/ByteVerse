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
function initThreeJsBackground() {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 0.1, 1000);
    
    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    document.getElementById('particles-container').appendChild(renderer.domElement);
    
    // Add ambient light
    const ambientLight = new THREE.AmbientLight(0x404040);
    scene.add(ambientLight);
    
    // Add directional light
    const directionalLight = new THREE.DirectionalLight(0x00d7fe, 0.5);
    directionalLight.position.set(0, 1, 1);
    scene.add(directionalLight);
    
    // Create a group for all objects
    const objectsGroup = new THREE.Group();
    scene.add(objectsGroup);
    
    // Add geometric objects
    const geometries = [
        new THREE.IcosahedronGeometry(1, 0),
        new THREE.OctahedronGeometry(1, 0),
        new THREE.TetrahedronGeometry(1, 0)
    ];
    
    const colors = [0x00d7fe, 0xbd00ff, 0xff00e5];
    
    for (let i = 0; i < 15; i++) {
        const geometry = geometries[Math.floor(Math.random() * geometries.length)];
        const material = new THREE.MeshPhongMaterial({
            color: colors[Math.floor(Math.random() * colors.length)],
            transparent: true,
            opacity: 0.7,
            wireframe: Math.random() > 0.5
        });
        
        const mesh = new THREE.Mesh(geometry, material);
        
        // Random position
        mesh.position.x = (Math.random() - 0.5) * 20;
        mesh.position.y = (Math.random() - 0.5) * 20;
        mesh.position.z = (Math.random() - 0.5) * 10 - 5;
        
        // Random size
        const scale = Math.random() * 0.5 + 0.2;
        mesh.scale.set(scale, scale, scale);
        
        // Random rotation
        mesh.rotation.x = Math.random() * Math.PI;
        mesh.rotation.y = Math.random() * Math.PI;
        
        objectsGroup.add(mesh);
    }
    
    // Add shader-based holographic circle
    const circleGeometry = new THREE.PlaneGeometry(8, 8);
    const shaderMaterial = new THREE.ShaderMaterial({
        uniforms: {
            time: { value: 0.0 },
            color: { value: new THREE.Color(0x00d7fe) }
        },
        vertexShader: document.getElementById('vertexShader').textContent,
        fragmentShader: document.getElementById('fragmentShader').textContent,
        transparent: true,
        side: THREE.DoubleSide
    });
    
    const circle = new THREE.Mesh(circleGeometry, shaderMaterial);
    circle.position.z = -10;
    scene.add(circle);
    
    // Position camera
    camera.position.z = 5;
    
    // Interactive mouse movement
    const mouse = new THREE.Vector2();
    
    window.addEventListener('mousemove', (event) => {
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    });
    
    // Handle window resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
    
    // Animation loop
    function animate() {
        requestAnimationFrame(animate);
        
        // Update objects
        objectsGroup.children.forEach((mesh, i) => {
            mesh.rotation.x += 0.003;
            mesh.rotation.y += 0.004;
            
            // Subtle movement based on mouse position
            mesh.position.x += (mouse.x * 0.1 - mesh.position.x * 0.05) * 0.02;
            mesh.position.y += (mouse.y * 0.1 - mesh.position.y * 0.05) * 0.02;
        });
        
        // Rotate the entire group slowly
        objectsGroup.rotation.y += 0.001;
        
        // Update shader uniforms
        shaderMaterial.uniforms.time.value += 0.01;
        
        renderer.render(scene, camera);
    }
    
    animate();
}

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
                break;
            
            case 'register':
                appendToTerminal('Registration is now open! Click the "Register Now" button on the main page.', 'normal');
                appendToTerminal('Early bird registration ends on February 15, 2025.', 'normal');
                break;
            
            case 'schedule':
                appendToTerminal('April 28, 2025:', 'success');
                appendToTerminal('- 09:00 AM: Registration & Check-in', 'normal');
                appendToTerminal('- 10:30 AM: Opening Ceremony', 'normal');
                appendToTerminal('- 12:00 PM: Hackathon Begins', 'normal');
                appendToTerminal('April 30, 2025:', 'success');
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
                    ⠀⠀⠀⠀⢀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀
                    ⠀⠀⠀⢠⣿⣿⣿⡟⢡⣾⣿⣿⣷⡜⢿⣿⣿⣧⠀⠀⠀⠀
                    ⠀⠀⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀
                    ⠀⠀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀
                    ⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀
                    ⠀⣾⣿⣿⣿⠋⣿⣿⣿⣏⠹⣿⣿⣿⡏⢿⣿⣿⣿⣿⡇⠀
                    ⠀⣿⣿⣿⣿⠀⣿⣿⣿⣿⠀⣿⣿⣿⡇⢸⣿⣿⣿⣿⡇⠀
                    ⠀⣿⣿⣿⣿⣷⣿⣿⣿⣿⣷⣿⣿⣿⣷⣿⣿⣿⣿⣿⡇⠀
                    ⠀⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠀⠀
                    ⠀⠀⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⠁⠀⠀
                    ⠀⠀⠀⠀⠉⠛⠛⠛⠛⠛⠛⠛⠛⠛⠛⠛⠉⠀⠀⠀⠀⠀
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
    // Hackathon date: April 28, 2025
    const hackathonDate = new Date('April 28, 2025 09:00:00').getTime();
    
    // Update countdown every second
    const countdownInterval = setInterval(function() {
        // Get current date and time
        const now = new Date().getTime();
        
        // Calculate the time difference
        const distance = hackathonDate - now;
        
        // If the countdown is over
        if (distance < 0) {
            clearInterval(countdownInterval);
            document.getElementById('countdown-days').textContent = '00';
            document.getElementById('countdown-hours').textContent = '00';
            document.getElementById('countdown-minutes').textContent = '00';
            document.getElementById('countdown-seconds').textContent = '00';
            return;
        }
        
        // Time calculations
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Display the results
        document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
        document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
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