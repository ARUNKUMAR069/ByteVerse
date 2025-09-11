

<nav class="fixed w-full z-40 bg-black/60 backdrop-blur-md border-b border-cyan-900/30">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo - Identical across all screen sizes -->
        <div class="flex items-center">
            <a href="index.php" class="text-xl sm:text-2xl font-bold tracking-wider font-orbitron text-white">
                <span class="text-cyan-400">Byte</span>Verse<span class="text-cyan-400">.</span>
            </a>
        </div>
        
        <!-- Desktop/Tablet Navigation (hidden on mobile) -->
        <div class="hidden md:flex space-x-4 lg:space-x-8 xl:space-x-12 items-center">
            <a href="about.php" class="nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'about' ? 'text-cyan-400' : ''; ?>">ABOUT</a>
            <a href="challenges.php" class="nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'challenges' ? 'text-cyan-400' : ''; ?>">CHALLENGES</a>
            <a href="schedule.php" class="schedule-link nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'schedule' ? 'text-cyan-400' : ''; ?>">SCHEDULE</a>

            <a href="sponsor.php" class="nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'sponsor' ? 'text-cyan-400' : ''; ?>">SPONSORS</a>
            <a href="faq.php" class="nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'faq' ? 'text-cyan-400' : ''; ?>">FAQ</a>
            <a href="contact.php" class="nav-link text-sm lg:text-base text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'contact' ? 'text-cyan-400' : ''; ?>">CONTACT</a>
        </div>
        
        <!-- Right side actions -->
        <div class="flex items-center gap-2 sm:gap-4">
            <!-- Register button - hidden on mobile, visible from sm upward -->
            <a href="https://unstop.com/o/TcOPzJX?lb=pvE5fx9g" class="hidden sm:inline-flex cyber-button primary text-sm lg:text-base">
                <span>REGISTER NOW</span>
                <i></i>
            </a>
            
            <!-- Theme Switcher - hidden on mobile/tablet, visible from lg upward -->
            <div class="theme-switcher hidden lg:flex items-center">
                <span class="text-xs text-white mr-2">Theme</span>
                <div class="theme-options flex space-x-2">
                    <button class="theme-option active" data-theme="cyan" style="background: #00D7FE"></button>
                    <button class="theme-option" data-theme="purple" style="background: #BD00FF"></button>
                    <button class="theme-option" data-theme="green" style="background: #00FF66"></button>
                    <button class="theme-option" data-theme="orange" style="background: #FF7700"></button>
                </div>
            </div>
            
            <!-- Mobile menu button - visible only on mobile/small tablet -->
            <button class="md:hidden text-white p-2 rounded-lg hover:bg-cyan-900/20 transition-colors" id="mobile-menu-btn" aria-label="Open menu" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-black/95 backdrop-blur-md z-50 transform transition-all duration-300 -translate-x-full" aria-hidden="true">
    <div class="container mx-auto px-4 py-6 h-full flex flex-col">
        <!-- Top bar with close button and theme selector -->
        <div class="flex justify-between items-center mb-8">
            <a href="index.php" class="text-xl font-bold tracking-wider font-orbitron text-white">
                <span class="text-cyan-400">Byte</span>Verse<span class="text-cyan-400">.</span>
            </a>
            
            <div class="flex items-center gap-4">
                <!-- Mobile Theme Switcher -->
                <div class="theme-switcher-mobile flex items-center">
                    <div class="theme-options flex space-x-2">
                        <button class="theme-option active" data-theme="cyan" style="background: #00D7FE"></button>
                        <button class="theme-option" data-theme="purple" style="background: #BD00FF"></button>
                        <button class="theme-option" data-theme="green" style="background: #00FF66"></button>
                        <button class="theme-option" data-theme="orange" style="background: #FF7700"></button>
                    </div>
                </div>
                
                <!-- Close button -->
                <button id="mobile-menu-close" class="text-white p-2 rounded-lg hover:bg-cyan-900/20 transition-colors" aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile navigation links -->
        <div class="flex flex-col space-y-6 items-start">
            <a href="about.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'about' ? 'text-cyan-400' : ''; ?>">ABOUT</a>
            <a href="challenges.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'challenges' ? 'text-cyan-400' : ''; ?>">CHALLENGES</a>
            <a href="schedule.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'schedule' ? 'text-cyan-400' : ''; ?>">SCHEDULE</a>
            
            <a href="sponsor.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'sponsor' ? 'text-cyan-400' : ''; ?>">SPONSORS</a>
            <a href="faq.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'faq' ? 'text-cyan-400' : ''; ?>">FAQ</a>
            <a href="contact.php" class="text-xl w-full py-2 border-b border-gray-800 text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'contact' ? 'text-cyan-400' : ''; ?>">CONTACT</a>
        </div>
        
        <!-- Register button (mobile version) -->
        <div class="mt-auto pt-8">
            <a href="https://unstop.com/o/TcOPzJX?lb=pvE5fx9g" class="cyber-button primary w-full text-center">
                <span>REGISTER NOW</span>
                <i></i>
            </a>
        </div>
    </div>
</div>



