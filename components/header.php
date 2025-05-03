<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'ByteVerse 1.0 | The Ultimate Coding Universe'; ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Animation Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/TextPlugin.min.js"></script>
    
    <!-- Three.js for 3D effects -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    
    <!-- Modern tech fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&family=Chakra+Petch:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Registration CSS -->
    <link rel="stylesheet" href="assets/css/registration.css">
    
    <!-- Additional styling for mobile responsive loader -->
    <style>
        /* Mobile-specific styling for ByteVerse text */
        @media (max-width: 768px) {
            .mobile-logo-text {
                display: flex;
                flex-direction: column;
                line-height: 1;
                min-height: 80px;
            }
            
            .mobile-logo-text .byte {
                color: var(--primary-accent);
                margin-bottom: -5px;
                position: relative;
            }
            
            .mobile-logo-text .byte::after {
                content: '';
                position: absolute;
                right: -4px;
                top: 50%;
                transform: translateY(-50%);
                width: 2px;
                height: 70%;
                background-color: var(--primary-accent);
                animation: cursor-blink 0.8s infinite;
            }
            
            .mobile-logo-text .verse {
                color: var(--neon-purple);
            }
            
            .mobile-logo-text .byte,
            .mobile-logo-text .verse {
                background: linear-gradient(90deg, var(--primary-accent) 0%, var(--primary-accent-light) 50%, var(--neon-purple) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            @keyframes cursor-blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0; }
            }
        }
    </style>
    
    <!-- Global button animation fix -->
    <style>
    /* Fix animation issues with cyber buttons */
    .cyber-button {
        animation: none !important;
        transition: background-color 0.2s ease !important;
    }

    .cyber-button i {
        animation: none !important;
        position: absolute !important;
        inset: 0 !important;
        display: block !important;
        opacity: 0.3 !important; /* Keep slight visual effect without animation */
        background: linear-gradient(90deg, var(--primary-accent-dark) 0%, var(--primary-accent) 100%) !important;
    }

    .cyber-button:hover {
        box-shadow: 0 0 5px var(--primary-accent) !important;
        background-color: rgba(0, 215, 254, 0.1) !important;
    }

    .cyber-button:hover i {
        opacity: 0.5 !important; /* Slightly increase opacity on hover for visual feedback */
    }

    .cyber-button.secondary i {
        background: linear-gradient(90deg, var(--neon-pink) 0%, var(--neon-purple) 100%) !important;
    }

    /* Fix login button animation */
    #login-form .cyber-button {
        position: relative !important;
        overflow: hidden !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Fix for loader dots on login button */
    .loader-dots {
        display: flex !important;
        gap: 4px !important;
    }

    .loader-dots .dot {
        width: 6px !important;
        height: 6px !important;
        background-color: white !important;
        border-radius: 50% !important;
        animation: loader-dot-pulse 1s infinite alternate ease-in-out !important;
    }

    .loader-dots .dot:nth-child(2) {
        animation-delay: 0.2s !important;
    }

    .loader-dots .dot:nth-child(3) {
        animation-delay: 0.4s !important;
    }

    @keyframes loader-dot-pulse {
        0% { opacity: 0.4; transform: scale(0.8); }
        100% { opacity: 1; transform: scale(1); }
    }
    </style>
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
    <?php if (isset($additionalStyles)): ?>
    <style>
        <?php echo $additionalStyles; ?>
    </style>
    <?php endif; ?>
</head>
<body>
    <!-- Custom cursor -->
    <div class="custom-cursor"></div>
    <div class="cursor-trailer"></div>
    
    <!-- Noise overlay -->
    <div class="noise"></div>
    
    <!-- Loader screen -->
    <div id="loader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black px-4">
        <div class="mb-6 md:mb-10">
            <div id="logo-animation" class="text-4xl md:text-7xl font-bold text-center">
                <span class="block mb-2 font-chakra uppercase tracking-wider text-xs md:text-sm text-cyan-400">
                    <?php echo isset($loaderPrefix) ? $loaderPrefix : 'Welcome to'; ?>
                </span>
                
                <!-- Desktop version (hidden on mobile) -->
                <span id="logo-text" class="gradient-text hidden md:block"></span>
                
                <!-- Mobile version (shown only on mobile) -->
                <div class="mobile-logo-text md:hidden">
                    <span class="byte">Byte</span>
                    <span class="verse">Verse</span>
                </div>
                
                <span class="text-3xl md:text-5xl text-white">1.0</span>
            </div>
            <div id="language-animation" class="text-lg md:text-2xl font-medium text-center mt-3 md:mt-4 text-cyan-400 opacity-0"></div>
        </div>
        <div class="loader-progress w-full max-w-[300px]">
            <div class="loader-progress-bar"></div>
        </div>
        <div class="text-xs md:text-sm text-gray-400 mt-3 md:mt-4 loader-status text-center">
            <?php echo isset($loaderText) ? $loaderText : 'Loading assets...'; ?>
        </div>
    </div>
    
    <!-- Main content -->
    <div id="content" class="opacity-0">
        <!-- Animated background -->
        <div id="particles-container" class="fixed inset-0 z-0"></div>
        <canvas id="matrix-canvas" class="fixed inset-0 z-0 opacity-30"></canvas>
    </div>
    
    <!-- Add typewriter animation script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Desktop typewriter is likely handled elsewhere
            
            // Mobile typewriter animation
            if (window.innerWidth <= 768) {
                const byteEl = document.querySelector('.mobile-logo-text .byte');
                const verseEl = document.querySelector('.mobile-logo-text .verse');
                
                // Make elements visible initially with 0 width
                setTimeout(() => {
                    // Show Byte with typewriter effect
                    byteEl.style.visibility = 'visible';
                    typeWriter(byteEl, 'Byte', 0, 100, function() {
                        // After Byte is complete, show Verse
                        setTimeout(() => {
                            verseEl.style.visibility = 'visible';
                            typeWriter(verseEl, 'Verse', 0, 100, function() {
                                // Continue with language animation if it exists
                                if (typeof startLanguageAnimation === 'function') {
                                    startLanguageAnimation();
                                }
                            });
                        }, 300);
                    });
                }, 500);
                
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
            }
        });
    </script>
</body>
</html>