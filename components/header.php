
<!-- filepath: c:\xampp\htdocs\new2\components\header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'ByteVerse 1.0 | The Ultimate Coding Universe'; ?></title>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NS87CQ5R');</script>
    <!-- End Google Tag Manager -->

    <!-- Rest of your head content remains the same -->
    
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

    <!-- Rest of your styles remain the same -->

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