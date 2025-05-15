<!-- Navbar -->
<nav class="fixed w-full z-40 bg-black/60 backdrop-blur-md border-b border-cyan-900/30">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <a href="index.php" class="text-2xl font-bold tracking-wider font-orbitron text-white">
                <span class="text-cyan-400">Byte</span>Verse<span class="text-cyan-400">.</span>
            </a>
        </div>
        
        <div class="hidden lg:flex space-x-8 xl:space-x-12 items-center">
            <a href="about.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'about' ? 'text-cyan-400' : ''; ?>">ABOUT</a>
            <a href="challenges.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'challenges' ? 'text-cyan-400' : ''; ?>">CHALLENGES</a>
            <a href="schedule.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'schedule' ? 'text-cyan-400' : ''; ?>">SCHEDULE</a>
            <a href="sponsor.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'sponsor' ? 'text-cyan-400' : ''; ?>">SPONSORS</a>
            <a href="faq.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'faq' ? 'text-cyan-400' : ''; ?>">FAQS</a>
            <a href="contact.php" class="nav-link text-white hover:text-cyan-400 transition-colors font-medium <?php echo $currentPage == 'contact' ? 'text-cyan-400' : ''; ?>">CONTACT US</a>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Use multiple breakpoint classes to ensure it's hidden on all mobile sizes -->
            <a href="registration.php" class="hidden sm:hidden md:hidden lg:inline-flex cyber-button primary">
                <span>REGISTER NOW</span>
                <i></i>
            </a>
            
            <button class="lg:hidden text-white mr-2" id="mobile-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Theme Switcher -->
            <div class="theme-switcher hidden xl:flex items-center">
                <span class="text-xs text-white mr-2">Theme</span>
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
<div id="mobile-menu" class="fixed inset-0 bg-black z-50 hidden">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <button class="absolute top-4 right-4 text-white p-2" id="mobile-menu-close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <div class="flex flex-col space-y-10 items-center">
            <!-- Navigation links -->
            <a href="about.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">ABOUT</a>
            <a href="challenges.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">CHALLENGES</a>
            <a href="schedule.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">SCHEDULE</a>
            <a href="sponsor.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">SPONSORS</a>
            <a href="faq.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">FAQ</a>
            <a href="contact.php" class="text-2xl text-white hover:text-cyan-400 transition-colors font-medium">CONTACT US</a>
            
            <!-- Register button (only one in mobile view) -->
            <a href="register.php" class="cyber-button primary mt-10 w-72 text-center">
                <span>REGISTER NOW</span>
                <i></i>
            </a>
            
        </div>
    </div>
</div>

<!-- Improved script for mobile menu and themes -->
