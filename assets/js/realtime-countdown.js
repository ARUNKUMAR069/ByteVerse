/**
 * Real-time Countdown Timer with Persistent State
 * Counts down from 48 hours (4 PM Aug 14 to 4 PM Aug 16) in real-time
 * Maintains accurate time across browser sessions and page reloads
 */

class RealtimeCountdown {
    constructor() {
        this.startTime = null;
        this.endTime = null;
        this.currentTime = null;
        this.sessionId = null;
        this.isRunning = false;
        this.intervalId = null;
        this.syncIntervalId = null;
        this.lastSyncTime = null;
        this.totalDuration = 48 * 60 * 60 * 1000; // 48 hours in milliseconds
        
        // DOM elements
        this.elements = {
            hours: document.getElementById('rt-hours'),
            minutes: document.getElementById('rt-minutes'),
            seconds: document.getElementById('rt-seconds'),
            hoursProgress: document.getElementById('hours-progress'),
            minutesProgress: document.getElementById('minutes-progress'),
            secondsProgress: document.getElementById('seconds-progress'),
            startTimeDisplay: document.getElementById('start-time'),
            elapsedTimeDisplay: document.getElementById('elapsed-time'),
            sessionIdDisplay: document.getElementById('session-id'),
            statusIndicator: document.getElementById('timer-status'),
            statusText: document.getElementById('status-text'),
            resetBtn: document.getElementById('reset-timer'),
            syncBtn: document.getElementById('sync-timer'),
            container: document.querySelector('.realtime-countdown-container')
        };
        
        // Configuration
        this.config = {
            storageKey: 'byteverse_realtime_countdown',
            syncInterval: 30000, // Sync every 30 seconds
            maxDrift: 2000, // Maximum allowed drift in milliseconds
            progressRingCircumference: 220 // SVG circle circumference
        };
        
        this.init();
    }
    
    init() {
        this.loadPersistedState();
        this.bindEvents();
        this.startTimer();
        this.startSyncTimer();
        this.updateDisplay();
        
        // Set initial status
        this.setStatus('active', 'Active');
        this.elements.container.classList.add('active');
    }
    
    loadPersistedState() {
        try {
            const saved = localStorage.getItem(this.config.storageKey);
            if (saved) {
                const data = JSON.parse(saved);
                this.startTime = new Date(data.startTime);
                this.endTime = new Date(data.endTime);
                this.sessionId = data.sessionId;
                this.isRunning = true;
                
                console.log('Loaded persisted countdown state:', {
                    startTime: this.startTime,
                    endTime: this.endTime,
                    sessionId: this.sessionId
                });
            } else {
                this.createNewSession();
            }
        } catch (error) {
            console.error('Error loading persisted state:', error);
            this.createNewSession();
        }
    }
    
    createNewSession() {
        // Set start time to current time when timer is first created
        this.startTime = new Date();
        
        // Set end time to 4 PM on August 16, 2025 (fixed target time)
        this.endTime = new Date(2025, 7, 16, 16, 0, 0, 0); // Month is 0-indexed, so 7 = August
        
        this.sessionId = this.generateSessionId();
        this.isRunning = true;
        this.saveState();
        
        const remainingTime = this.endTime - this.startTime;
        const remainingHours = Math.floor(remainingTime / (1000 * 60 * 60));
        
        console.log('Created new countdown session:', {
            startTime: this.startTime,
            endTime: this.endTime,
            remainingHours: remainingHours,
            sessionId: this.sessionId
        });
    }
    
    generateSessionId() {
        return 'RT-' + Date.now().toString(36) + '-' + Math.random().toString(36).substr(2, 5);
    }
    
    saveState() {
        try {
            const data = {
                startTime: this.startTime.toISOString(),
                endTime: this.endTime.toISOString(),
                sessionId: this.sessionId,
                lastUpdate: new Date().toISOString()
            };
            localStorage.setItem(this.config.storageKey, JSON.stringify(data));
        } catch (error) {
            console.error('Error saving state:', error);
        }
    }
    
    bindEvents() {
        // Reset button
        this.elements.resetBtn.addEventListener('click', () => {
            this.resetTimer();
        });
        
        // Sync button
        this.elements.syncBtn.addEventListener('click', () => {
            this.syncWithServer();
        });
        
        // Handle page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                this.syncTime();
            }
        });
        
        // Handle page unload
        window.addEventListener('beforeunload', () => {
            this.saveState();
        });
        
        // Handle storage changes from other tabs
        window.addEventListener('storage', (e) => {
            if (e.key === this.config.storageKey) {
                this.loadPersistedState();
                this.updateDisplay();
            }
        });
    }
    
    startTimer() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        
        this.intervalId = setInterval(() => {
            this.updateDisplay();
        }, 1000);
        
        this.isRunning = true;
    }
    
    startSyncTimer() {
        if (this.syncIntervalId) {
            clearInterval(this.syncIntervalId);
        }
        
        this.syncIntervalId = setInterval(() => {
            this.syncTime();
        }, this.config.syncInterval);
    }
    
    updateDisplay() {
        if (!this.startTime || !this.endTime) return;
        
        this.currentTime = new Date();
        const timeRemaining = this.endTime - this.currentTime;
        
        // Check if countdown has ended
        if (timeRemaining <= 0) {
            this.handleCountdownEnd();
            return;
        }
        
        // Calculate time components (remaining time)
        const totalSeconds = Math.floor(timeRemaining / 1000);
        const days = Math.floor(totalSeconds / (24 * 3600));
        const hours = Math.floor((totalSeconds % (24 * 3600)) / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        
        // Display hours including days (e.g., 47 hours instead of 1 day 23 hours)
        const totalHours = Math.floor(totalSeconds / 3600);
        
        // Update digit displays with animation
        this.updateDigit(this.elements.hours, totalHours.toString().padStart(2, '0'));
        this.updateDigit(this.elements.minutes, minutes.toString().padStart(2, '0'));
        this.updateDigit(this.elements.seconds, seconds.toString().padStart(2, '0'));
        
        // Update progress rings (showing progress towards completion)
        const totalDuration = this.endTime - this.startTime;
        const elapsed = this.currentTime - this.startTime;
        const overallProgress = Math.max(0, Math.min(1, elapsed / totalDuration));
        
        this.updateProgressRing(this.elements.hoursProgress, (minutes + seconds/60) / 60);
        this.updateProgressRing(this.elements.minutesProgress, seconds / 60);
        this.updateProgressRing(this.elements.secondsProgress, (this.currentTime.getMilliseconds()) / 1000);
        
        // Update info displays
        this.elements.startTimeDisplay.textContent = this.formatDateTime(this.startTime);
        this.elements.elapsedTimeDisplay.textContent = 'Aug 16, 4:00 PM';
        this.elements.sessionIdDisplay.textContent = this.sessionId;
        
        // Save state periodically
        if (totalSeconds % 10 === 0) {
            this.saveState();
        }
    }
    
    handleCountdownEnd() {
        // Stop the timer
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        if (this.syncIntervalId) {
            clearInterval(this.syncIntervalId);
        }
        
        // Display zeros
        this.updateDigit(this.elements.hours, '00');
        this.updateDigit(this.elements.minutes, '00');
        this.updateDigit(this.elements.seconds, '00');
        
        // Update progress rings to full
        this.updateProgressRing(this.elements.hoursProgress, 1);
        this.updateProgressRing(this.elements.minutesProgress, 1);
        this.updateProgressRing(this.elements.secondsProgress, 1);
        
        // Update status
        this.setStatus('completed', 'Completed');
        this.elements.container.classList.remove('active');
        this.elements.container.classList.add('completed');
        
        // Show completion message
        this.showCompletionMessage();
        
        this.isRunning = false;
    }
    
    showCompletionMessage() {
        // Create and show a completion popup
        const popup = document.createElement('div');
        popup.className = 'countdown-completion-popup';
        popup.innerHTML = `
            <div class="completion-content">
                <h2>🎉 Countdown Complete!</h2>
                <p>The countdown to August 16, 4:00 PM has ended!</p>
                <button onclick="this.parentElement.parentElement.remove()" class="completion-close-btn">Close</button>
            </div>
        `;
        
        // Add popup styles
        popup.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        `;
        
        const content = popup.querySelector('.completion-content');
        content.style.cssText = `
            background: var(--primary-dark);
            border: 2px solid var(--primary-accent);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 0 30px rgba(0, 215, 254, 0.5);
        `;
        
        document.body.appendChild(popup);
    }
    
    updateDigit(element, newValue) {
        if (element.textContent !== newValue) {
            element.classList.add('changing');
            setTimeout(() => {
                element.textContent = newValue;
                element.classList.remove('changing');
            }, 300);
        }
    }
    
    updateProgressRing(element, progress) {
        const circumference = this.config.progressRingCircumference;
        const offset = circumference - (progress * circumference);
        element.style.strokeDashoffset = offset;
    }
    
    formatDateTime(date) {
        return date.toLocaleString('en-US', {
            month: 'short',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        });
    }
    
    formatElapsed(milliseconds) {
        const totalSeconds = Math.floor(milliseconds / 1000);
        const days = Math.floor(totalSeconds / (24 * 3600));
        const hours = Math.floor((totalSeconds % (24 * 3600)) / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        
        if (days > 0) {
            return `${days}d ${hours}h ${minutes}m`;
        } else if (hours > 0) {
            return `${hours}h ${minutes}m ${seconds}s`;
        } else if (minutes > 0) {
            return `${minutes}m ${seconds}s`;
        } else {
            return `${seconds}s`;
        }
    }
    
    resetTimer() {
        // Confirm reset
        if (!confirm('Are you sure you want to reset the countdown? This will restart the countdown to August 16, 4:00 PM.')) {
            return;
        }
        
        this.setStatus('syncing', 'Resetting...');
        
        // Clear intervals
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        if (this.syncIntervalId) {
            clearInterval(this.syncIntervalId);
        }
        
        // Clear storage
        localStorage.removeItem(this.config.storageKey);
        
        // Remove any completion popup
        const popup = document.querySelector('.countdown-completion-popup');
        if (popup) {
            popup.remove();
        }
        
        // Reset container classes
        this.elements.container.classList.remove('completed');
        
        // Create new session
        setTimeout(() => {
            this.createNewSession();
            this.startTimer();
            this.startSyncTimer();
            this.updateDisplay();
            this.setStatus('active', 'Active');
            this.elements.container.classList.add('active');
        }, 1000);
    }
    
    syncTime() {
        const now = new Date();
        
        // Check for significant time drift
        if (this.lastSyncTime) {
            const expectedTime = new Date(this.lastSyncTime.getTime() + this.config.syncInterval);
            const drift = Math.abs(now - expectedTime);
            
            if (drift > this.config.maxDrift) {
                console.warn('Significant time drift detected:', drift + 'ms');
                this.setStatus('syncing', 'Syncing...');
                
                setTimeout(() => {
                    this.setStatus('active', 'Active');
                }, 2000);
            }
        }
        
        this.lastSyncTime = now;
        this.saveState();
    }
    
    async syncWithServer() {
        this.setStatus('syncing', 'Syncing...');
        this.elements.container.classList.add('syncing');
        
        try {
            // Simulate server sync (in a real implementation, this would be an API call)
            await new Promise(resolve => setTimeout(resolve, 1500));
            
            // Get server time (simulated)
            const serverTime = new Date();
            const localTime = new Date();
            const timeDiff = Math.abs(serverTime - localTime);
            
            if (timeDiff > 1000) {
                console.log('Time difference with server:', timeDiff + 'ms');
                // In a real implementation, you might adjust the start time here
            }
            
            this.lastSyncTime = serverTime;
            this.saveState();
            
            this.setStatus('active', 'Synced');
            setTimeout(() => {
                this.setStatus('active', 'Active');
            }, 3000);
            
        } catch (error) {
            console.error('Sync failed:', error);
            this.setStatus('error', 'Sync Failed');
            setTimeout(() => {
                this.setStatus('active', 'Active');
            }, 3000);
        } finally {
            this.elements.container.classList.remove('syncing');
        }
    }
    
    setStatus(type, text) {
        this.elements.statusText.textContent = text;
        
        // Remove all status classes
        this.elements.container.classList.remove('active', 'error', 'syncing');
        
        // Add current status class
        this.elements.container.classList.add(type);
        
        // Update status indicator color via CSS classes
        this.elements.statusIndicator.className = `status-indicator ${type}`;
    }
    
    // Public methods for external control
    pause() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }
        this.isRunning = false;
        this.setStatus('paused', 'Paused');
    }
    
    resume() {
        this.startTimer();
        this.setStatus('active', 'Active');
    }
    
    getElapsedTime() {
        if (!this.startTime) return 0;
        return new Date() - this.startTime;
    }
    
    getSessionInfo() {
        return {
            sessionId: this.sessionId,
            startTime: this.startTime,
            elapsedTime: this.getElapsedTime(),
            isRunning: this.isRunning
        };
    }
}

// Initialize the countdown timer when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Check if countdown elements exist on the page
    if (document.getElementById('rt-hours')) {
        window.realtimeCountdown = new RealtimeCountdown();
        
        // Add global access for debugging
        window.timerDebug = {
            getInfo: () => window.realtimeCountdown.getSessionInfo(),
            reset: () => window.realtimeCountdown.resetTimer(),
            sync: () => window.realtimeCountdown.syncWithServer(),
            pause: () => window.realtimeCountdown.pause(),
            resume: () => window.realtimeCountdown.resume()
        };
        
        console.log('Real-time countdown timer initialized');
        console.log('Debug commands available: window.timerDebug');
    }
});

// Handle page unload to save state
window.addEventListener('beforeunload', () => {
    if (window.realtimeCountdown) {
        window.realtimeCountdown.saveState();
    }
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = RealtimeCountdown;
}