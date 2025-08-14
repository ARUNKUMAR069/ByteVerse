<!-- Real-time Countdown Timer Component -->
<div class="realtime-countdown-container">
    <div class="countdown-header">
        <h3 class="countdown-title">Countdown to Aug 16, 4 PM</h3>
        <div class="countdown-status">
            <span class="status-indicator" id="timer-status"></span>
            <span class="status-text" id="status-text">Active</span>
        </div>
    </div>
    
    <div class="realtime-countdown-display">
        <div class="countdown-segment">
            <div class="countdown-digit-container">
                <div class="countdown-digit" id="rt-hours">00</div>
                <div class="countdown-progress-ring">
                    <svg class="progress-ring" width="80" height="80">
                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" id="hours-progress"></circle>
                    </svg>
                </div>
            </div>
            <div class="countdown-segment-label">Hours</div>
        </div>
        
        <div class="countdown-separator">:</div>
        
        <div class="countdown-segment">
            <div class="countdown-digit-container">
                <div class="countdown-digit" id="rt-minutes">00</div>
                <div class="countdown-progress-ring">
                    <svg class="progress-ring" width="80" height="80">
                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" id="minutes-progress"></circle>
                    </svg>
                </div>
            </div>
            <div class="countdown-segment-label">Minutes</div>
        </div>
        
        <div class="countdown-separator">:</div>
        
        <div class="countdown-segment">
            <div class="countdown-digit-container">
                <div class="countdown-digit" id="rt-seconds">00</div>
                <div class="countdown-progress-ring">
                    <svg class="progress-ring" width="80" height="80">
                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" id="seconds-progress"></circle>
                    </svg>
                </div>
            </div>
            <div class="countdown-segment-label">Seconds</div>
        </div>
    </div>
    
    <div class="countdown-info">
        <div class="info-item">
            <span class="info-label">Started:</span>
            <span class="info-value" id="start-time">--</span>
        </div>
        <div class="info-item">
            <span class="info-label">Target:</span>
            <span class="info-value" id="elapsed-time">Aug 16, 4:00 PM</span>
        </div>
        <div class="info-item">
            <span class="info-label">Session:</span>
            <span class="info-value" id="session-id">--</span>
        </div>
    </div>
    
    <div class="countdown-controls">
        <button class="control-btn" id="reset-timer" title="Reset Timer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="23 4 23 10 17 10"></polyline>
                <polyline points="1 20 1 14 7 14"></polyline>
                <path d="m3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
            </svg>
            Reset
        </button>
        <button class="control-btn" id="sync-timer" title="Sync with Server">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c2.12 0 4.07.74 5.61 1.98"></path>
                <path d="M17 3l4 4-4 4"></path>
            </svg>
            Sync
        </button>
    </div>
</div>

<!-- Include the CSS and JS files -->
<link rel="stylesheet" href="assets/css/realtime-countdown.css">
<script src="assets/js/realtime-countdown.js"></script>