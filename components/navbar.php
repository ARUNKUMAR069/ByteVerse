<!-- Navbar -->
<nav class="fixed w-full z-40 bg-opacity-10 backdrop-blur-md border-b border-cyan-900/30">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="index.php" class="text-2xl font-bold tracking-wider font-orbitron text-white">
                <span class="text-cyan-400">Byte</span>Verse<span class="text-cyan-400">.</span>
            </a>
        </div>
        
        <div class="hidden md:flex space-x-8 items-center">
            <a href="about.php" class="nav-link <?php echo $currentPage == 'about' ? 'text-cyan-400' : ''; ?>">About</a>
            <a href="challenges.php" class="nav-link <?php echo $currentPage == 'challenges' ? 'text-cyan-400' : ''; ?>">Challenges</a>
            <a href="schedule.php" class="nav-link <?php echo $currentPage == 'schedule' ? 'text-cyan-400' : ''; ?>">Schedule</a>
            <a href="sponsor.php" class="nav-link <?php echo $currentPage == 'sponsor' ? 'text-cyan-400' : ''; ?>">Sponsors</a>
            <a href="faq.php" class="nav-link <?php echo $currentPage == 'faq' ? 'text-cyan-400' : ''; ?>">FAQ</a>
            <a href="contact.php" class="nav-link <?php echo $currentPage == 'contact' ? 'text-cyan-400' : ''; ?>">Contact Us</a>
        </div>
        
        <div class="flex items-center">
            <button class="hidden md:block cyber-button" onclick="window.location.href='registration.php'">
                <span>Register Now</span>
                <i style="opacity: 0.3;"></i>
            </button>
            
            <button class="md:hidden text-white" id="mobile-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Theme Switcher -->
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

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex-col items-center justify-center hidden">
    <button class="absolute top-4 right-4 text-white p-2" id="mobile-menu-close">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    
    <div class="flex flex-col space-y-8 items-center">
        <a href="about.php" class="text-xl text-white hover:text-cyan-400 transition-colors">About</a>
        <a href="challenges.php" class="text-xl text-white hover:text-cyan-400 transition-colors">Challenges</a>
        <a href="schedule.php" class="text-xl text-white hover:text-cyan-400 transition-colors">Schedule</a>
        <a href="sponsor.php" class="text-xl text-white hover:text-cyan-400 transition-colors">Sponsors</a>
        <a href="faq.php" class="text-xl text-white hover:text-cyan-400 transition-colors">FAQ</a>
        <a href="contact.php" class="text-xl text-white hover:text-cyan-400 transition-colors">Contact Us</a>
        
        <button class="cyber-button primary mt-6" onclick="window.location.href='registration.php'">
            <span>Register Now</span>
            <i style="opacity: 0.3;"></i>
        </button>
        
        <!-- Mobile Theme Switcher -->
        <div class="theme-switcher flex flex-col items-center mt-6">
            <span class="text-gray-400 mb-3">Theme</span>
            <div class="theme-options flex space-x-4">
                <button class="theme-option active" data-theme="cyan" style="background: #00D7FE; width: 24px; height: 24px; border-radius: 50%;"></button>
                <button class="theme-option" data-theme="purple" style="background: #BD00FF; width: 24px; height: 24px; border-radius: 50%;"></button>
                <button class="theme-option" data-theme="green" style="background: #00FF66; width: 24px; height: 24px; border-radius: 50%;"></button>
                <button class="theme-option" data-theme="orange" style="background: #FF7700; width: 24px; height: 24px; border-radius: 50%;"></button>
            </div>
        </div>
    </div>
</div>