// Early Bird Popup JavaScript
class EarlyBirdPopup {
    constructor() {
        this.popup = null;
        this.countdownInterval = null;
        this.endDate = null;
        this.hasShown = false;
        
        // Set the end date to 2 days from now
        this.setEndDate();
        
        // Initialize popup after DOM is loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.init());
        } else {
            this.init();
        }
    }
    
    setEndDate() {
        // Set end date to 2 days from now (48 hours)
        const now = new Date();
        this.endDate = new Date(now.getTime() + (2 * 24 * 60 * 60 * 1000));
        
        // For testing, you can set a shorter time like 5 minutes:
        // this.endDate = new Date(now.getTime() + (5 * 60 * 1000));
    }
    
    init() {
        // Check if popup should be shown (once per session)
        if (this.shouldShowPopup()) {
            this.createPopup();
            this.showPopup();
        }
    }
    
    shouldShowPopup() {
        // Check localStorage to see if popup was shown recently
        const lastShown = localStorage.getItem('earlyBirdPopupLastShown');
        const now = new Date().getTime();
        
        // Show popup only once per day (24 hours = 24 * 60 * 60 * 1000 ms)
        const oneDayInMs = 24 * 60 * 60 * 1000;
        
        if (!lastShown) {
            return true; // Never shown before
        }
        
        const timeSinceLastShown = now - parseInt(lastShown);
        return timeSinceLastShown > oneDayInMs; // Show if more than 24 hours have passed
    }
    
    createPopup() {
        // Create popup HTML
        const popupHTML = `
            <div class="early-bird-popup" id="earlyBirdPopup">
                <div class="popup-content">
                    <button class="popup-close" id="popupClose" aria-label="Close popup">
                        ×
                    </button>
                    
                    <div class="popup-header">
                        <div class="popup-badge">🚀 Early Bird Special</div>
                        <h2 class="popup-title">Limited Time Offer!</h2>
                        <p class="popup-subtitle">Free Registration for All Students</p>
                    </div>
                    
                    <div class="popup-countdown" id="popupCountdown">
                        <div class="countdown-unit">
                            <span class="countdown-number" id="days">00</span>
                            <span class="countdown-label">Days</span>
                        </div>
                        <div class="countdown-unit">
                            <span class="countdown-number" id="hours">00</span>
                            <span class="countdown-label">Hours</span>
                        </div>
                        <div class="countdown-unit">
                            <span class="countdown-number" id="minutes">00</span>
                            <span class="countdown-label">Minutes</span>
                        </div>
                        <div class="countdown-unit">
                            <span class="countdown-number" id="seconds">00</span>
                            <span class="countdown-label">Seconds</span>
                        </div>
                    </div>
                    
                    <div class="popup-description">
                        <p>🎓 <span class="popup-highlight">Students, this is your chance!</span> Register now for ByteVerse 1.0 completely <span class="popup-highlight">FREE</span> during our exclusive early bird period.</p>
                        <p><strong>Hurry up!</strong> This offer expires in just 2 days. Don't miss out on the ultimate coding hackathon experience!</p>
                    </div>
                    
                    <div class="popup-actions">
                        <a href="registration.php" class="popup-btn primary" id="registerBtn">
                            Register Now - FREE!
                        </a>
                    </div>
                </div>
            </div>
        `;
        
        // Insert popup into body
        document.body.insertAdjacentHTML('beforeend', popupHTML);
        this.popup = document.getElementById('earlyBirdPopup');
        
        // Bind events
        this.bindEvents();
    }
    
    bindEvents() {
        const closeBtn = document.getElementById('popupClose');
        const registerBtn = document.getElementById('registerBtn');
        
        // Close popup events
        closeBtn.addEventListener('click', () => this.closePopup());
        
        // Close on backdrop click
        this.popup.addEventListener('click', (e) => {
            if (e.target === this.popup) {
                this.closePopup();
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.popup.classList.contains('show')) {
                this.closePopup();
            }
        });
        
        // Track registration button click
        registerBtn.addEventListener('click', () => {
            // Track conversion
            this.trackEvent('early_bird_register_click');
        });
    }
    
    showPopup() {
        if (!this.popup) return;
        
        // Show popup with delay for better UX
        setTimeout(() => {
            this.popup.classList.add('show');
            this.startCountdown();
            
            // Mark as shown with current timestamp
            localStorage.setItem('earlyBirdPopupLastShown', new Date().getTime().toString());
            
            // Track popup shown
            this.trackEvent('early_bird_popup_shown');
        }, 2000); // Show after 2 seconds
    }
    
    closePopup() {
        if (!this.popup) return;
        
        this.popup.classList.remove('show');
        this.stopCountdown();
        
        // Track popup closed
        this.trackEvent('early_bird_popup_closed');
        
        // Remove popup after animation
        setTimeout(() => {
            if (this.popup && this.popup.parentNode) {
                this.popup.parentNode.removeChild(this.popup);
            }
        }, 300);
    }
    
    startCountdown() {
        this.updateCountdown(); // Update immediately
        
        // Use more reliable interval for mobile devices
        this.countdownInterval = setInterval(() => {
            try {
                this.updateCountdown();
            } catch (error) {
                console.error('Countdown update error:', error);
                // Restart countdown if there's an error
                this.stopCountdown();
                setTimeout(() => this.startCountdown(), 1000);
            }
        }, 1000);
    }
    
    stopCountdown() {
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
            this.countdownInterval = null;
        }
    }
    
    updateCountdown() {
        try {
            const now = new Date().getTime();
            const distance = this.endDate.getTime() - now;
            
            if (distance < 0) {
                this.handleExpired();
                return;
            }
            
            // Calculate time units with better precision for mobile
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Ensure values are valid numbers
            const safeValues = {
                days: isNaN(days) ? 0 : Math.max(0, days),
                hours: isNaN(hours) ? 0 : Math.max(0, hours),
                minutes: isNaN(minutes) ? 0 : Math.max(0, minutes),
                seconds: isNaN(seconds) ? 0 : Math.max(0, seconds)
            };
            
            // Update display with safe values
            this.updateCountdownDisplay('days', safeValues.days);
            this.updateCountdownDisplay('hours', safeValues.hours);
            this.updateCountdownDisplay('minutes', safeValues.minutes);
            this.updateCountdownDisplay('seconds', safeValues.seconds);
        } catch (error) {
            console.error('Error updating countdown:', error);
            // Set all to 00 if there's an error
            ['days', 'hours', 'minutes', 'seconds'].forEach(unit => {
                this.updateCountdownDisplay(unit, 0);
            });
        }
    }
    
    updateCountdownDisplay(unit, value) {
        const element = document.getElementById(unit);
        if (element) {
            const formattedValue = value.toString().padStart(2, '0');
            if (element.textContent !== formattedValue) {
                // Use requestAnimationFrame for better mobile performance
                requestAnimationFrame(() => {
                    element.textContent = formattedValue;
                    
                    // Add animation class for number change
                    element.classList.add('number-change');
                    setTimeout(() => {
                        element.classList.remove('number-change');
                    }, 300);
                });
            }
        }
    }
    
    handleExpired() {
        this.stopCountdown();
        
        // Update popup to show expired state
        const popupContent = this.popup.querySelector('.popup-content');
        const badge = this.popup.querySelector('.popup-badge');
        const title = this.popup.querySelector('.popup-title');
        const subtitle = this.popup.querySelector('.popup-subtitle');
        const description = this.popup.querySelector('.popup-description');
        const registerBtn = this.popup.querySelector('#registerBtn');
        
        if (popupContent) popupContent.classList.add('expired');
        if (badge) badge.textContent = '⏰ Offer Expired';
        if (title) title.textContent = 'Early Bird Ended';
        if (subtitle) subtitle.textContent = 'But you can still register!';
        if (description) {
            description.innerHTML = `
                <p>The early bird free registration period has ended, but don't worry!</p>
                <p>You can still register for ByteVerse 1.0 at regular pricing. Join hundreds of other participants in this amazing coding experience!</p>
            `;
        }
        if (registerBtn) {
            registerBtn.textContent = 'Register Now';
            registerBtn.classList.remove('primary');
            registerBtn.classList.add('secondary');
        }
        
        // Set all countdown to 00
        ['days', 'hours', 'minutes', 'seconds'].forEach(unit => {
            this.updateCountdownDisplay(unit, 0);
        });
        
        // Track expiration
        this.trackEvent('early_bird_popup_expired');
    }
    
    trackEvent(eventName) {
        // Google Analytics tracking if available
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, {
                event_category: 'early_bird_popup',
                event_label: 'popup_interaction'
            });
        }
        
        // Console log for debugging
        console.log('Early Bird Popup Event:', eventName);
    }
    
    // Public method to manually show popup (for testing)
    forceShow() {
        if (!this.popup) {
            this.createPopup();
        }
        this.showPopup();
    }
    
    // Public method to manually close popup
    forceClose() {
        this.closePopup();
    }
    
    // Public method to reset popup storage (for testing)
    resetPopupStorage() {
        localStorage.removeItem('earlyBirdPopupLastShown');
        console.log('Early Bird Popup storage cleared. Popup will show on next page load.');
    }
}

// Add CSS animation for number changes
const style = document.createElement('style');
style.textContent = `
    .countdown-number.number-change {
        animation: numberPulse 0.3s ease;
    }
    
    @keyframes numberPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); color: var(--primary-accent-light); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);

// Initialize popup when script loads
let earlyBirdPopup;

// Wait for DOM to be ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        earlyBirdPopup = new EarlyBirdPopup();
    });
} else {
    earlyBirdPopup = new EarlyBirdPopup();
}

// Expose to global scope for debugging
window.EarlyBirdPopup = EarlyBirdPopup;
window.earlyBirdPopup = earlyBirdPopup;