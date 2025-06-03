<?php
// Page-specific variables
$pageTitle = 'Schedule | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Timeline';
$loaderText = 'Loading event schedule...';
$currentPage = 'schedule';

// Additional styles specific to the schedule page
$additionalStyles = '
/* Schedule Page Specific Styles */
.schedule-container {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
}

.schedule-day {
    margin-bottom: 3rem;
    position: relative;
}

.day-header {
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid var(--primary-accent);
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.day-header:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 215, 254, 0.15);
}

.day-header::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
    top: 0;
    left: 0;
    animation: scan 2s infinite linear;
}

@keyframes scan {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.day-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.day-date {
    font-family: "Orbitron", sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-accent);
}

.day-name {
    font-family: "Chakra Petch", sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
}

.events-grid {
    display: grid;
    grid-template-columns: 120px 1fr;
    gap: 1rem 2rem;
}

.event-time {
    grid-column: 1;
    font-family: "Chakra Petch", sans-serif;
    color: var(--primary-accent);
    text-align: right;
    padding-right: 1rem;
    border-right: 1px dashed rgba(0, 215, 254, 0.3);
    position: relative;
    font-weight: 600;
}

.event-time::after {
    content: "";
    position: absolute;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--primary-accent);
    box-shadow: 0 0 10px var(--primary-accent);
}

.event-content {
    grid-column: 2;
    background: rgba(10, 20, 40, 0.3);
    border: 1px solid rgba(0, 215, 254, 0.2);
    padding: 1.25rem;
    border-radius: 8px;
    position: relative;
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
    overflow: hidden; /* Prevent text overflow */
}

/* Event Status Indicators */
.event-status {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 4px 10px;
    border-radius: 20px;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 5;
}

.status-upcoming {
    background: rgba(0, 215, 254, 0.1);
    color: var(--primary-accent);
    border: 1px solid var(--primary-accent);
}

.status-live {
    background: rgba(255, 79, 79, 0.1);
    color: #FF5F56;
    border: 1px solid #FF5F56;
    animation: pulse-status 1.5s infinite;
}

.status-completed {
    background: rgba(39, 201, 63, 0.1);
    color: #27C93F;
    border: 1px solid #27C93F;
}

@keyframes pulse-status {
    0% { opacity: 1; }
    50% { opacity: 0.6; }
    100% { opacity: 1; }
}

.event-title {
    font-family: "Orbitron", sans-serif;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: white;
}

.event-description {
    font-family: "Rajdhani", sans-serif;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    margin-bottom: 0.75rem;
    line-height: 1.5;
}

.event-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    color: var(--primary-accent-light);
}

.event-tags {
    margin-top: 1rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.event-tag {
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid rgba(0, 215, 254, 0.2);
    color: var(--primary-accent-light);
}

.event-tag.important {
    background: rgba(255, 79, 79, 0.1);
    border-color: rgba(255, 79, 79, 0.3);
    color: #FF5F56;
}

.event-tag.workshop {
    background: rgba(189, 0, 255, 0.1);
    border-color: rgba(189, 0, 255, 0.3);
    color: var(--neon-purple);
}

.event-tag.food {
    background: rgba(39, 201, 63, 0.1);
    border-color: rgba(39, 201, 63, 0.3);
    color: #27C93F;
}

.live-now {
    position: relative;
    overflow: hidden;
}

.live-now::before {
    content: "LIVE NOW";
    position: absolute;
    top: 10px;
    right: -30px;
    background: #FF5F56;
    color: white;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    padding: 0.25rem 2rem;
    transform: rotate(45deg);
    z-index: 10;
}

.live-indicator {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: "Chakra Petch", sans-serif;
    color: #FF5F56;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.live-indicator::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #FF5F56;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.3; }
    100% { opacity: 1; }
}

/* Filter Controls */
.schedule-filters {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-button {
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    padding: 0.5rem 1.25rem;
    border: 1px solid rgba(0, 215, 254, 0.3);
    background: rgba(10, 20, 40, 0.3);
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-button:hover, .filter-button.active {
    background: rgba(0, 215, 254, 0.1);
    color: var(--primary-accent);
    border-color: var(--primary-accent);
}

/* Enhanced responsive styles to prevent text clashes */
@media (max-width: 768px) {
    .events-grid {
        grid-template-columns: 1fr;
    }
    
    .event-time {
        text-align: left;
        border-right: none;
        border-bottom: 1px dashed rgba(0, 215, 254, 0.3);
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
        padding-right: 0;
    }
    
    .event-time::after {
        right: auto;
        left: 0;
        top: auto;
        bottom: -6px;
        transform: none;
    }
    
    .timeline-event::before,
    .timeline-event::after {
        font-size: 0.65rem;
        max-width: 80px;
        white-space: normal;
        text-align: center;
    }
    
    .timeline-event::before {
        top: -35px;
    }
    
    .timeline-event::after {
        bottom: -35px;
    }
    
    .event-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .event-title {
        font-size: 1.1rem;
        word-wrap: break-word;
        hyphens: auto;
    }
    
    .event-description {
        font-size: 0.9rem;
    }
    
    .event-location {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .timeline-visualization {
        height: 3px;
        margin: 2rem 0 3rem;
    }
    
    .timeline-event {
        width: 10px;
        height: 10px;
    }
    
    .timeline-event::before,
    .timeline-event::after {
        font-size: 0.6rem;
    }
    
    .current-time-indicator {
        width: 15px;
        height: 15px;
    }
    
    .cyber-tab {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .filter-button {
        font-size: 0.8rem;
        padding: 0.4rem 1rem;
    }
    
    .event-status {
        top: 5px;
        right: 5px;
        font-size: 0.65rem;
        padding: 3px 8px;
    }
}

/* Timeline Visualization */
.timeline-visualization {
    height: 5px;
    background: rgba(0, 215, 254, 0.1);
    border-radius: 10px;
    margin: 3rem 0;
    position: relative;
}

.timeline-event {
    position: absolute;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: var(--primary-accent);
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
}

.timeline-event::before {
    content: attr(data-time);
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    color: var(--primary-accent);
    white-space: nowrap;
}

.timeline-event::after {
    content: attr(data-title);
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    white-space: nowrap;
}

.timeline-event:hover {
    transform: translateY(-50%) scale(1.5);
    box-shadow: 0 0 15px var(--primary-accent);
}

.timeline-event.important {
    background: #FF5F56;
}

.timeline-event.important::before {
    color: #FF5F56;
}

.timeline-event.food {
    background: #27C93F;
}

.timeline-event.food::before {
    color: #27C93F;
}

.current-time-indicator {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    top: 50%;
    transform: translateY(-50%);
    border: 3px solid var(--primary-accent);
    z-index: 20;
    box-shadow: 0 0 15px var(--primary-accent);
}

.current-time-indicator::before {
    content: "NOW";
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    color: white;
    text-shadow: 0 0 10px var(--primary-accent);
}

/* Interactive Controls */
.event-navigation {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.cyber-tab {
    padding: 0.75rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    border: 1px solid rgba(0, 215, 254, 0.2);
    background: rgba(10, 20, 40, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    cursor: pointer;
}

.cyber-tab::before {
    content: "";
    position: absolute;
    width: 5px;
    height: 5px;
    background: var(--primary-accent);
    top: -1px;
    left: -1px;
}

.cyber-tab:hover, .cyber-tab.active {
    background: rgba(0, 215, 254, 0.1);
    color: var(--primary-accent);
    border-color: var(--primary-accent);
}

/* Small download button styles */
.download-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.9rem;
    padding: 0.5rem 1.25rem;
    background: rgba(10, 20, 40, 0.3);
    border: 1px solid rgba(0, 215, 254, 0.3);
    color: var(--primary-accent);
    transition: all 0.3s ease;
    cursor: pointer;
}

.download-button:hover {
    background: rgba(0, 215, 254, 0.1);
    border-color: var(--primary-accent);
    transform: translateY(-3px);
}

/* Responsive design */
@media (max-width: 768px) {
    .events-grid {
        grid-template-columns: 1fr;
    }
    
    .event-time {
        text-align: left;
        border-right: none;
        border-bottom: 1px dashed rgba(0, 215, 254, 0.3);
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
        padding-right: 0;
    }
    
    .event-time::after {
        right: auto;
        left: 0;
        top: auto;
        bottom: -6px;
        transform: none;
    }
    
    .timeline-event::before,
    .timeline-event::after {
        font-size: 0.65rem;
        max-width: 80px;
        white-space: normal;
        text-align: center;
    }
    
    .timeline-event::before {
        top: -35px;
    }
    
    .timeline-event::after {
        bottom: -35px;
    }
    
    .event-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .event-title {
        font-size: 1.1rem;
        word-wrap: break-word;
        hyphens: auto;
    }
    
    .event-description {
        font-size: 0.9rem;
    }
    
    .event-location {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .timeline-visualization {
        height: 3px;
        margin: 2rem 0 3rem;
    }
    
    .timeline-event {
        width: 10px;
        height: 10px;
    }
    
    .timeline-event::before,
    .timeline-event::after {
        font-size: 0.6rem;
    }
    
    .current-time-indicator {
        width: 15px;
        height: 15px;
    }
    
    .cyber-tab {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .filter-button {
        font-size: 0.8rem;
        padding: 0.4rem 1rem;
    }
    
    .event-status {
        top: 5px;
        right: 5px;
        font-size: 0.65rem;
        padding: 3px 8px;
    }
}

/* Animated scanner effect */
.scanner-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
    animation: scan-vertical 3s infinite linear;
    opacity: 0.5;
    z-index: 10;
}

@keyframes scan-vertical {
    0% { top: 0; }
    100% { top: 100%; }
}

/* Circuit board aesthetics for schedule */
.circuit-dots {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(0, 215, 254, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 75% 75%, rgba(0, 215, 254, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    z-index: -1;
    opacity: 0.3;
    pointer-events: none;
}

.event-content.featured {
    border-color: var(--neon-purple);
    background: rgba(189, 0, 255, 0.05);
}

.event-content.featured::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: linear-gradient(45deg, transparent, rgba(189, 0, 255, 0.1), transparent);
    z-index: -1;
}


/* Schedule H1 Responsive - IMPORTANT */
@media (max-width: 320px) {
    .glitch-text {
        font-size: 1.75rem !important;
        letter-spacing: 1px !important;
        line-height: 1.1 !important;
    }
    
    .max-w-3xl p {
        font-size: 0.875rem !important;
        line-height: 1.4 !important;
    }
}

@media (min-width: 321px) and (max-width: 374px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 1px !important;
    }
    
    .max-w-3xl p {
        font-size: 0.9375rem !important;
    }
}

@media (min-width: 375px) and (max-width: 424px) {
    .glitch-text {
        font-size: 2.25rem !important;
        letter-spacing: 2px !important;
    }
    
    .max-w-3xl p {
        font-size: 1rem !important;
    }
}

@media (min-width: 425px) and (max-width: 639px) {
    .glitch-text {
        font-size: 2.5rem !important;
        letter-spacing: 2px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.125rem !important;
    }
}

@media (min-width: 640px) and (max-width: 767px) {
    .glitch-text {
        font-size: 3rem !important;
        letter-spacing: 3px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.25rem !important;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .glitch-text {
        font-size: 3.5rem !important;
        letter-spacing: 3px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.375rem !important;
    }
}

@media (min-width: 1024px) {
    .glitch-text {
        font-size: 4rem !important;
        letter-spacing: 4px !important;
    }
    
    .max-w-3xl p {
        font-size: 1.5rem !important;
    }
}

/* Mobile Landscape for Schedule */
@media (max-height: 500px) and (orientation: landscape) and (max-width: 896px) {
    .glitch-text {
        font-size: 2rem !important;
        letter-spacing: 2px !important;
        margin-bottom: 1rem !important;
    }
    
    .max-w-3xl p {
        font-size: 0.875rem !important;
        margin-bottom: 2rem !important;
    }
}

/* Container padding adjustments for Schedule */
@media (max-width: 640px) {
    .container {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    .py-20 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
}

';

// Additional scripts for the schedule page
$additionalScripts = '
// Initialize tabs functionality
document.addEventListener("DOMContentLoaded", function() {
    // Existing tab functionality
    const tabButtons = document.querySelectorAll(".cyber-tab");
    const dayContainers = document.querySelectorAll(".schedule-day");
    
    // Hide all day containers except the first one
    dayContainers.forEach((container, index) => {
        if (index !== 0) {
            container.style.display = "none";
        }
    });
    
    // Activate first tab
    tabButtons[0].classList.add("active");
    
    // Add click handlers
    tabButtons.forEach(tab => {
        tab.addEventListener("click", function() {
            // Remove active class from all tabs
            tabButtons.forEach(t => t.classList.remove("active"));
            
            // Add active class to clicked tab
            this.classList.add("active");
            
            // Show corresponding day container
            const targetDay = this.getAttribute("data-day");
            
            dayContainers.forEach(container => {
                if (container.getAttribute("data-day") === targetDay) {
                    container.style.display = "block";
                } else {
                    container.style.display = "none";
                }
            });
        });
    });
    
    // Filter buttons functionality
    const filterButtons = document.querySelectorAll(".filter-button");
    const eventContainers = document.querySelectorAll(".event-content");
    
    filterButtons.forEach(button => {
        button.addEventListener("click", function() {
            const filterCategory = this.getAttribute("data-filter");
            
            // Toggle active class
            if (filterCategory === "all") {
                filterButtons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
            } else {
                document.querySelector("[data-filter=\'all\']").classList.remove("active");
                this.classList.toggle("active");
            }
            
            // Check if any filter is active
            const activeFilters = Array.from(filterButtons).filter(btn => 
                btn.classList.contains("active") && btn.getAttribute("data-filter") !== "all"
            );
            
            // If no specific filters are active, activate "All" filter
            if (activeFilters.length === 0) {
                document.querySelector("[data-filter=\'all\']").classList.add("active");
            }
            
            // Apply filters to events
            if (filterCategory === "all" || activeFilters.length === 0) {
                eventContainers.forEach(event => {
                    event.style.display = "block";
                });
            } else {
                // Get all active filter categories
                const activeCategories = activeFilters.map(filter => 
                    filter.getAttribute("data-filter")
                );
                
                // Show events that match any of the active categories
                eventContainers.forEach(event => {
                    const eventCategories = Array.from(event.querySelectorAll(".event-tag"))
                        .map(tag => tag.getAttribute("data-category"));
                    
                    // Check if event has any of the active filter categories
                    const hasMatchingCategory = activeCategories.some(category => 
                        eventCategories.includes(category)
                    );
                    
                    event.style.display = hasMatchingCategory ? "block" : "none";
                });
            }
        });
    });
    
    // Add animation for events as they come into view
    const eventObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-in");
                eventObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    
    document.querySelectorAll(".event-content").forEach(event => {
        eventObserver.observe(event);
    });
    
    // Determine event status (upcoming, live, completed)
    updateEventStatus();
});

// Add custom CSS animation for elements coming into view
document.addEventListener("DOMContentLoaded", function() {
    const style = document.createElement("style");
    style.innerHTML = `
        .event-content {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .event-content.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    document.head.appendChild(style);
    
    // Simulate the current time indicator based on current time
    updateCurrentTimeIndicator();
});

// Function to update the current time indicator
function updateCurrentTimeIndicator() {
    const indicator = document.querySelector(".current-time-indicator");
    if (!indicator) return;
    
    // This is a simulation - in reality, you would calculate position
    // based on current time relative to event schedule timeframe
    const timeline = document.querySelector(".timeline-visualization");
    if (timeline) {
        const timelineWidth = timeline.offsetWidth;
        
        // Get the current hour (0-23)
        const currentHour = new Date().getHours();
        const currentMinute = new Date().getMinutes();
        
        // Calculate position as percentage of day (assuming 8am-10pm schedule)
        const startHour = 8; // 8am
        const endHour = 22;  // 10pm
        
        // Current time as decimal hours
        const currentTimeDecimal = currentHour + (currentMinute / 60);
        
        // Calculate position as percentage
        let position = ((currentTimeDecimal - startHour) / (endHour - startHour)) * 100;
        
        // Constrain to timeline
        position = Math.max(0, Math.min(position, 100));
        
        // Set position
        indicator.style.left = `${position}%`;
    }
}

// Function to update event status based on current time
function updateEventStatus() {
    const now = new Date();
    const events = document.querySelectorAll(".event-content");
    
    // Get current year (assuming current year for the events if not specified)
    const currentYear = now.getFullYear();
    
    // Get month indexes (0-based)
    const augustIndex = 7; // August is month 7 (0-based)
    
    events.forEach(event => {
        // Get the parent for the time element
        const timeElement = event.closest(".events-grid").querySelector(".event-time");
        if (!timeElement) return;
        
        // Get the time text (format: "HH:MM - HH:MM")
        const timeText = timeElement.textContent.trim();
        
        // Extract time parts
        const timeParts = timeText.split(" - ");
        if (timeParts.length !== 2) return;
        
        // Get day container to determine the date
        const dayContainer = event.closest(".schedule-day");
        if (!dayContainer) return;
        
        const dayHeader = dayContainer.querySelector(".day-date");
        if (!dayHeader) return;
        
        // Extract date from the header (format: "August 23 - Day 1" or "August 24 - Day 2")
        const dateText = dayHeader.textContent.trim();
        const dateMatch = dateText.match(/August (\d+)/);
        if (!dateMatch) return;
        
        const day = parseInt(dateMatch[1], 10);
        const month = augustIndex;
        
        // Parse event times
        const startTimeParts = timeParts[0].split(":");
        const endTimeParts = timeParts[1].split(":");
        
        let startHour = parseInt(startTimeParts[0], 10);
        const startMinute = parseInt(startTimeParts[1] || "0", 10);
        
        let endHour = parseInt(endTimeParts[0], 10);
        const endMinute = parseInt(endTimeParts[1] || "0", 10);
        
        // Handle day transition for events that continue after midnight
        let endDay = day;
        if (endHour < startHour) {
            endDay = day + 1;
        }
        
        // Create Date objects for the event start and end times
        const eventStart = new Date(currentYear, month, day, startHour, startMinute);
        const eventEnd = new Date(currentYear, month, endDay, endHour, endMinute);
        
        // Remove any existing status elements
        const existingStatus = event.querySelector(".event-status");
        if (existingStatus) {
            existingStatus.remove();
        }
        
        // Remove existing live-now class if it exists
        event.classList.remove("live-now");
        
        // Remove existing live indicator if it exists
        const existingLiveIndicator = event.querySelector(".live-indicator");
        if (existingLiveIndicator) {
            existingLiveIndicator.remove();
        }
        
        // Create status element
        const statusElement = document.createElement("div");
        statusElement.className = "event-status";
        
        // Determine status based on current time
        if (now < eventStart) {
            statusElement.textContent = "Upcoming";
            statusElement.classList.add("status-upcoming");
        } else if (now >= eventStart && now <= eventEnd) {
            statusElement.textContent = "Live Now";
            statusElement.classList.add("status-live");
        } else {
            statusElement.textContent = "Completed";
            statusElement.classList.add("status-completed");
        }
        
        // Add status element to event
        event.appendChild(statusElement);
    });
}
';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Schedule Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Schedule">Schedule</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-white leading-relaxed">
                Explore the ByteVerse 1.0 event timeline. From registration and inaugural ceremony to the final project showcase, join us for two intensive days of innovation, coding, and collaboration.
            </p>
        </div>
        
        <!-- Schedule Finder -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <a href="#day1" class="cyber-button secondary-sm">
                <span>August 23 - Day 1</span>
                <i></i>
            </a>
            <a href="#day2" class="cyber-button secondary-sm">
                <span>August 24 - Day 2</span>
                <i></i>
            </a>
        </div>
    </div>
</section>

<!-- Schedule Interactive Controls -->
<section class="py-6 relative">
    <div class="container mx-auto px-4">
        <div class="event-navigation">
            <div class="flex gap-2 flex-wrap">
                <button class="cyber-tab active" data-day="day1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Day 1: Registration & Development
                </button>
                <button class="cyber-tab" data-day="day2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Day 2: Finals & Showcase
                </button>
            </div>
        </div>
        
        <!-- Event Filters -->
        <div class="schedule-filters">
            <button class="filter-button active" data-filter="all">All Events</button>
            <button class="filter-button" data-filter="round">Competition Rounds</button>
            <button class="filter-button" data-filter="activity">Activities</button>
            <button class="filter-button" data-filter="important">Main Events</button>
            <button class="filter-button" data-filter="food">Food & Breaks</button>
        </div>
        
        <!-- Timeline visualization removed as requested -->
    </div>
</section>

<!-- Schedule Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        <div class="schedule-container">
            <!-- Day 1 Schedule -->
            <div id="day1" class="schedule-day" data-day="day1">
                <div class="day-header">
                    <div class="day-title">
                        <div class="day-date">August 23 - Day 1</div>
                        <div class="day-name">Registration, Inauguration & Ideation Pitch</div>
                    </div>
                    <div class="scanner-line"></div>
                </div>
                
                <div class="events-grid">
                    <!-- Event 1 -->
                    <div class="event-time">09:00 - 12:00</div>
                    <div id="event-registration" class="event-content">
                        <h3 class="event-title">Registration + Attendance & ID Card Distribution</h3>
                        <p class="event-description">Teams arrive, collect their ByteVerse badges, ID cards, and register for the hackathon. Volunteers will be available at counters to assist with the registration process.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Main Lobby/Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Important</span>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="event-time">12:00 - 14:00</div>
                    <div id="event-inauguration" class="event-content featured">
                        <h3 class="event-title">Inauguration Ceremony</h3>
                        <p class="event-description">Official opening of ByteVerse 1.0 with chief guests, dignitaries, and all teams seated. Introduction to the hackathon, rules explanation, and motivational keynotes.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Auditorium
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                            <span class="event-tag" data-category="activity">Keynote</span>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="event-time">14:00 - 17:00</div>
                    <div id="event-round1" class="event-content">
                        <h3 class="event-title">Round 1: Ideation Pitch & Tech Stack Evaluation (PPT)</h3>
                        <p class="event-description">Teams present their project ideas and planned technology stack through PowerPoint presentations. Judges will evaluate based on innovation, feasibility, and technical merit.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Labs/Classrooms
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 4 -->
                    <div class="event-time">17:00 - 17:30</div>
                    <div id="event-tea-break" class="event-content">
                        <h3 class="event-title">Tea Break</h3>
                        <p class="event-description">Refresh with light snacks and beverages before moving into the prototype development phase.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Cafeteria Area
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 5 -->
                    <div class="event-time">17:30 - 21:00</div>
                    <div id="event-round2-1" class="event-content">
                        <h3 class="event-title">Round 2 - Phase 1: Prototype Development (Coding Begins)</h3>
                        <p class="event-description">Coding begins! Teams start developing their prototypes with development environments set up and technical volunteers available to assist with any issues.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Labs/Coding Rooms
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 6 -->
                    <div class="event-time">21:00 - 22:00</div>
                    <div id="event-dinner1" class="event-content">
                        <h3 class="event-title">Dinner</h3>
                        <p class="event-description">Organized batch-wise for smooth flow. Nutritious meal to sustain participants through the late-night coding session.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Mess/Cafeteria
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 7 -->
                    <div class="event-time">22:00 - 01:00</div>
                    <div id="event-round2-2" class="event-content">
                        <h3 class="event-title">Round 2 - Phase 2: Continued Development</h3>
                        <p class="event-description">Late-night development continues with energy drinks and snacks available. Teams push forward with their prototype implementation.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Same venues
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 8 -->
                    <div class="event-time">01:00 - 02:00</div>
                    <div id="event-round2-judging" class="event-content">
                        <h3 class="event-title">Round 2 Judgement By Jury Panel</h3>
                        <p class="event-description">Evaluation based on working prototype/code and progress. The jury panel will assess the current state of development.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Jury Rooms
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Judging</span>
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 9 -->
                    <div class="event-time">02:00 - 03:00</div>
                    <div id="event-fun" class="event-content">
                        <h3 class="event-title">Fun Activities (DJ Night) OR Bedtime for participants</h3>
                        <p class="event-description">Participants can choose to join DJ night and other fun activities, or they can rest in the chill zone and sleeping area.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Open Lawn/Recreation Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="activity">Activity</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Day 2 Schedule -->
            <div id="day2" class="schedule-day" data-day="day2">
                <div class="day-header">
                    <div class="day-title">
                        <div class="day-date">August 24 - Day 2</div>
                        <div class="day-name">Finals & Showcase</div>
                    </div>
                    <div class="scanner-line"></div>
                </div>
                
                <div class="events-grid">
                    <!-- Event 1 -->
                    <div class="event-time">03:00 - 07:00</div>
                    <div id="event-round3-1" class="event-content">
                        <h3 class="event-title">Round 3 - Phase 1: Final Dev & PPT Prep</h3>
                        <p class="event-description">Teams finalize their product and start building their pitch deck for the final presentation.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Same labs
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="event-time">07:00 - 08:00</div>
                    <div id="event-breakfast" class="event-content">
                        <h3 class="event-title">Breakfast</h3>
                        <p class="event-description">Healthy breakfast options and hydration to energize participants for the final stretch.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Cafeteria
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="event-time">08:00 - 11:00</div>
                    <div id="event-round3-2" class="event-content">
                        <h3 class="event-title">Round 3 - Phase 2: Final Dev Touches + PPT Finishing</h3>
                        <p class="event-description">Teams polish their tech solution and refine their presentation for the final evaluation.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Same venues
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 4 -->
                    <div class="event-time">11:00 - 12:00</div>
                    <div class="event-content featured">
                        <h3 class="event-title">Final Evaluation by Panel (Shortlisting Top 20 Teams)</h3>
                        <p class="event-description">Expert judges select the top 20 teams from 100 participants based on their completed solutions and presentations.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Jury Rooms
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Judging</span>
                            <span class="event-tag" data-category="round">Competition</span>
                        </div>
                    </div>
                    
                    <!-- Event 5 -->
                    <div class="event-time">12:00 - 14:00</div>
                    <div id="event-final" class="event-content featured">
                        <h3 class="event-title">Final Presentations by Top 20 Teams + Result Declaration</h3>
                        <p class="event-description">The shortlisted teams present their solutions to all participants and judges. Each team gets 3-4 minutes to showcase their work, followed by the announcement of winners by 1 PM.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Auditorium
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                            <span class="event-tag" data-category="round">Finals</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include terminal and footer -->
<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>
