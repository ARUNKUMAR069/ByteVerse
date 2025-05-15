/**
 * ByteVerse Mobile Menu JavaScript
 * Handles mobile menu interactions, theme switching, and animations
 */

document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    const body = document.body;
    
    // Theme switching elements
    const desktopThemeOptions = document.querySelectorAll('.theme-options:not(.theme-switcher-mobile) .theme-option');
    const mobileThemeOptions = document.querySelectorAll('.theme-switcher-mobile .theme-option');
    
    // Initialize mobile menu functionality
    if (mobileMenuBtn && mobileMenuClose && mobileMenu) {
        // Open mobile menu with transform
        mobileMenuBtn.addEventListener('click', function() {
            openMobileMenu();
        });
        
        // Close menu with X button
        mobileMenuClose.addEventListener('click', function() {
            closeMobileMenu();
        });
        
        // Close menu when clicking on links
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenu.classList.contains('translate-x-0') && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuBtn.contains(event.target)) {
                closeMobileMenu();
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && mobileMenu.classList.contains('translate-x-0')) {
                closeMobileMenu();
            }
        });
    }
    
    // Set up theme switching
    initThemeSwitching();
    
    /**
     * Opens the mobile menu with animation
     */
    function openMobileMenu() {
        mobileMenu.classList.remove('-translate-x-full');
        mobileMenu.classList.add('translate-x-0');
        body.style.overflow = 'hidden'; // Prevent background scrolling
        mobileMenuBtn.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-hidden', 'false');
        
        // Animation with GSAP if available
        if (typeof gsap !== 'undefined') {
            gsap.fromTo(mobileMenu, 
                { x: '-100%' }, 
                { x: '0%', duration: 0.3, ease: "power2.out" }
            );
            
            gsap.fromTo(mobileMenu.querySelectorAll('a, button:not(#mobile-menu-close)'), {
                y: 20,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.4,
                stagger: 0.05,
                ease: "power2.out",
                delay: 0.1
            });
        }
    }
    
    /**
     * Closes the mobile menu with animation
     */
    function closeMobileMenu() {
        if (typeof gsap !== 'undefined') {
            gsap.to(mobileMenu, {
                x: '-100%', 
                duration: 0.3, 
                ease: "power2.in",
                onComplete: function() {
                    mobileMenu.classList.add('-translate-x-full');
                    mobileMenu.classList.remove('translate-x-0');
                }
            });
        } else {
            mobileMenu.classList.add('-translate-x-full');
            mobileMenu.classList.remove('translate-x-0');
        }
        
        body.style.overflow = ''; // Restore scrolling
        mobileMenuBtn.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
    }
    
    /**
     * Initializes theme switching functionality
     */
    function initThemeSwitching() {
        // Apply saved theme on page load
        const savedTheme = localStorage.getItem('theme') || 'cyan';
        applyTheme(savedTheme);
        
        // Set up event listeners for desktop theme options
        desktopThemeOptions.forEach((option, index) => {
            option.addEventListener('click', function() {
                const theme = this.getAttribute('data-theme');
                applyTheme(theme);
                
                // Update active class on both mobile and desktop
                desktopThemeOptions.forEach(opt => opt.classList.remove('active'));
                mobileThemeOptions.forEach(opt => opt.classList.remove('active'));
                
                this.classList.add('active');
                if (mobileThemeOptions[index]) mobileThemeOptions[index].classList.add('active');
            });
        });
        
        // Set up event listeners for mobile theme options
        mobileThemeOptions.forEach((option, index) => {
            option.addEventListener('click', function() {
                const theme = this.getAttribute('data-theme');
                applyTheme(theme);
                
                // Update active class on both mobile and desktop
                mobileThemeOptions.forEach(opt => opt.classList.remove('active'));
                desktopThemeOptions.forEach(opt => opt.classList.remove('active'));
                
                this.classList.add('active');
                if (desktopThemeOptions[index]) desktopThemeOptions[index].classList.add('active');
            });
        });
    }
    
    /**
     * Applies the selected theme and saves it to localStorage
     * @param {string} theme - Theme name to apply
     */
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        
        // Update active class on theme buttons
        document.querySelectorAll('.theme-option').forEach(option => {
            if (option.getAttribute('data-theme') === theme) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });
        
        // Custom animation for theme change if GSAP is available
        if (typeof gsap !== 'undefined') {
            // Flash effect for theme change
            const flash = document.createElement('div');
            flash.style.position = 'fixed';
            flash.style.inset = '0';
            flash.style.backgroundColor = getThemeColor(theme);
            flash.style.opacity = '0';
            flash.style.zIndex = '9999';
            flash.style.pointerEvents = 'none';
            document.body.appendChild(flash);
            
            gsap.to(flash, {
                opacity: 0.1,
                duration: 0.2,
                ease: "power1.inOut",
                onComplete: function() {
                    gsap.to(flash, {
                        opacity: 0,
                        duration: 0.2,
                        delay: 0.1,
                        ease: "power1.inOut",
                        onComplete: function() {
                            document.body.removeChild(flash);
                        }
                    });
                }
            });
        }
    }
    
    /**
     * Gets color value for a theme
     * @param {string} theme - Theme name
     * @returns {string} - Color value
     */
    function getThemeColor(theme) {
        const colors = {
            cyan: '#00D7FE',
            purple: '#BD00FF',
            green: '#00FF66',
            orange: '#FF7700'
        };
        return colors[theme] || colors.cyan;
    }
});