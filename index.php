<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteVerse 1.0 | The Ultimate Coding Universe</title>
    
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
                <span class="block mb-2 font-chakra uppercase tracking-wider text-sm text-cyan-400">Welcome to</span>
                <span id="logo-text" class="gradient-text"></span>
                <span class="text-5xl text-white">1.0</span>
            </div>
            <div id="language-animation" class="text-2xl font-medium text-center mt-4 text-cyan-400 opacity-0"></div>
        </div>
        <div class="loader-progress">
            <div class="loader-progress-bar"></div>
        </div>
        <div class="text-sm text-gray-400 mt-4 loader-status">Loading assets...</div>
    </div>
    
    <!-- Main content -->
    <div id="content" class="opacity-0">
        <!-- Animated background -->
        <div id="particles-container" class="fixed inset-0 z-0"></div>
        <canvas id="matrix-canvas" class="fixed inset-0 z-0 opacity-30"></canvas>
        
        <!-- Navbar -->
        <nav class="fixed w-full z-40 bg-opacity-10 backdrop-blur-md border-b border-cyan-900/30">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="text-2xl font-bold tracking-wider font-orbitron text-white">
                        <span class="text-cyan-400">Byte</span>Verse<span class="text-cyan-400">.</span>
                    </div>
                </div>
                
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="nav-link">About</a>
                    <a href="#" class="nav-link">Challenges</a>
                    <a href="#" class="nav-link">Schedule</a>
                    <a href="#" class="nav-link">Sponsors</a>
                    <a href="#" class="nav-link">FAQ</a>
                </div>
                
                <div class="flex items-center">
                    <button class="hidden md:block cyber-button">
                        <span>Register Now</span>
                        <i></i>
                    </button>
                    
                    <button class="md:hidden text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Add this to your navbar -->
                    <div class="theme-switcher hidden md:flex items-center ml-4">
                        <span class="text-xs text-gray-400 mr-2">Theme</span>
                        <div class="theme-options flex space-x-2">
                            <button class="theme-option active" data-theme="cyan" style="background: #00D7FE"></button>
                            <button class="theme-option" data-theme="purple" style="background: #BD00FF"></button>
                            <button class="theme-option" data-theme="green" style="background: #00FF66"></button>
                            <button class="theme-option" data-theme="orange" style="background: #FF7700"></button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="min-h-screen relative overflow-hidden flex items-center justify-center pt-24">
            <div class="container mx-auto px-4 py-20 relative z-10 text-center">
                <div class="grid-lines"></div>
                
                <div class="mb-3 inline-block mx-auto">
                    <span class="date-badge">
                        April 28-30, 2025 • Virtual & In-Person
                    </span>
                </div>

                <div class="countdown-container">
                    <div class="countdown-item">
                        <div class="countdown-value" id="countdown-days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="countdown-hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="countdown-minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="countdown-seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
                
                <div class="mb-16 relative">
                    <h1 class="glitch-text" data-text="ByteVerse 1.0">ByteVerse 1.0</h1>
                    <div class="hero-subtitle">
                        <span class="block text-xl md:text-2xl font-rajdhani text-cyan-400 opacity-80 mt-2">
                            Decode · Develop · Disrupt
                        </span>
                    </div>
                </div>
                
                <div class="max-w-2xl mx-auto">
                    <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                        Enter the ultimate <span class="text-cyan-400">coding universe</span> where technology meets innovation. 
                        Join brilliant minds in a <span class="text-cyan-400">48-hour</span> journey to build 
                        groundbreaking solutions and redefine the digital frontier.
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-12">
                    <button class="cyber-button primary">
                        <span>Register Now</span>
                        <i></i>
                    </button>
                    <button class="cyber-button secondary">
                        <span>Explore Challenges</span>
                        <i></i>
                    </button>
                </div>
                
                <div class="mt-24 flex items-center justify-center">
                    <div class="stats-container">
                        <div class="stat-item">
                            <div class="stat-value" data-value="500">0</div>
                            <div class="stat-label">Hackers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" data-value="48">0</div>
                            <div class="stat-label">Hours</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" data-value="25">0</div>
                            <div class="stat-label">Challenges</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" data-value="100">0</div>
                            <div class="stat-label">Prizes</div>
                        </div>
                    </div>
                </div>
                
                <!-- 3D floating elements -->
                <div class="floating-elements">
                    <div class="floating-cube cube-1"></div>
                    <div class="floating-cube cube-2"></div>
                    <div class="floating-cube cube-3"></div>
                    <div class="floating-sphere"></div>
                </div>
            </div>
        </section>

        <!-- Add this after your Hero Section -->
        <div class="terminal-container">
            <div class="terminal-header">
                <div class="terminal-buttons">
                    <span class="terminal-button red"></span>
                    <span class="terminal-button yellow"></span>
                    <span class="terminal-button green"></span>
                </div>
                <div class="terminal-title">bytev@rse:~</div>
            </div>
            <div class="terminal-body">
                <div id="terminal-output"></div>
                <div class="terminal-input-line">
                    <span class="terminal-prompt">bytev@rse:~$</span>
                    <input type="text" id="terminal-input" autocomplete="off" autofocus>
                </div>
            </div>
            <button class="terminal-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 9a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3A.5.5 0 0 1 6 9zM3.854 4.146a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
                    <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h12z"/>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

    <script id="vertexShader" type="x-shader/x-vertex">
      varying vec2 vUv;
      void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
      }
    </script>

    <script id="fragmentShader" type="x-shader/x-fragment">
      uniform float time;
      uniform vec3 color;
      varying vec2 vUv;
      
      void main() {
        vec2 position = vUv * 2.0 - 1.0;
        float dist = length(position);
        float ripple = sin(dist * 20.0 - time * 2.0) * 0.5 + 0.5;
        float edge = smoothstep(0.8, 0.81, dist);
        
        gl_FragColor = vec4(color * ripple * (1.0 - edge), 1.0);
      }
    </script>

    <!-- Add this to the end of the body -->
    <audio id="hover-sound" src="https://assets.codepen.io/217233/klik.mp3" preload="auto"></audio>
    <audio id="click-sound" src="https://assets.codepen.io/217233/click.mp3" preload="auto"></audio>
    <audio id="startup-sound" src="https://assets.codepen.io/217233/startup.mp3" preload="auto"></audio>
</body>
</html>