<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div id="loader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black">
        <div class="mb-10">
            <div id="logo-animation" class="text-7xl font-bold text-center">
                <span class="block mb-2 font-chakra uppercase tracking-wider text-sm text-cyan-400">
                    <?php echo isset($loaderPrefix) ? $loaderPrefix : 'Welcome to'; ?>
                </span>
                <span id="logo-text" class="gradient-text"></span>
                <span class="text-5xl text-white">1.0</span>
            </div>
            <div id="language-animation" class="text-2xl font-medium text-center mt-4 text-cyan-400 opacity-0"></div>
        </div>
        <div class="loader-progress">
            <div class="loader-progress-bar"></div>
        </div>
        <div class="text-sm text-gray-400 mt-4 loader-status">
            <?php echo isset($loaderText) ? $loaderText : 'Loading assets...'; ?>
        </div>
    </div>
    
    <!-- Main content -->
    <div id="content" class="opacity-0">
        <!-- Animated background -->
        <div id="particles-container" class="fixed inset-0 z-0"></div>
        <canvas id="matrix-canvas" class="fixed inset-0 z-0 opacity-30"></canvas>