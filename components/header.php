<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'ByteVerse 1.0 | The Ultimate Coding Universe'; ?></title>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NS87CQ5R');
    </script>
    <!-- End Google Tag Manager -->

    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">

    <!-- Tailwind CSS -->
    <link href="./src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/minfied.min.css">
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
            opacity: 0.3 !important;
            /* Keep slight visual effect without animation */
            background: linear-gradient(90deg, var(--primary-accent-dark) 0%, var(--primary-accent) 100%) !important;
        }

        .cyber-button:hover {
            box-shadow: 0 0 5px var(--primary-accent) !important;
            background-color: rgba(0, 215, 254, 0.1) !important;
        }

        .cyber-button:hover i {
            opacity: 0.5 !important;
            /* Slightly increase opacity on hover for visual feedback */
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
            0% {
                opacity: 0.4;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <?php if (isset($additionalStyles)): ?>
        <style>
            <?php echo $additionalStyles; ?>
        </style>
    <?php endif; ?>

    <!-- Add at the end, before closing </head> tag -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>
    <script src="assets/js/domain-showcase.js"></script>
    <script src="assets/js/sponsors-showcase.js"></script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NS87CQ5R"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Custom cursor -->
    <div class="custom-cursor"></div>
    <div class="cursor-trailer"></div>

    <!-- Noise overlay -->
    <div class="noise"></div>

    <?php
    // Check if we're on the index page
    $isIndexPage = isset($isHomePage) && $isHomePage === true;

    // Only display loader on index.php
    if ($isIndexPage):
    ?>
        <!-- Loader screen - Only shown on index.php -->
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

        <!-- Add typewriter animation script - Only for index page -->
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
    <?php else: ?>
        <!-- For non-index pages, initialize content without animation -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show content immediately without loader
                const contentElement = document.getElementById('content');
                if (contentElement) {
                    contentElement.style.opacity = '1';
                }
            });
        </script>
    <?php endif; ?>

    <!-- Main content -->
    <div id="content" class="<?php echo $isIndexPage ? 'opacity-0' : 'opacity-100'; ?>">
        <!-- Animated background -->
        <div id="particles-container" class="fixed inset-0 z-0"></div>
        <canvas id="matrix-canvas" class="fixed inset-0 z-0 opacity-30"></canvas>
    </div>
</body>

</html>