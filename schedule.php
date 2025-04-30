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
    color: var(--text-dim);
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
}

.event-content:hover {
    border-color: var(--primary-accent);
    box-shadow: 0 5px 15px rgba(0, 215, 254, 0.1);
    transform: translateX(5px);
}

.event-title {
    font-family: "Orbitron", sans-serif;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: white;
}

.event-description {
    font-family: "Rajdhani", sans-serif;
    color: var(--text-dim);
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
    color: var(--text-dim);
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-button:hover, .filter-button.active {
    background: rgba(0, 215, 254, 0.1);
    color: var(--primary-accent);
    border-color: var(--primary-accent);
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
    color: var(--text-dim);
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
    color: var(--text-dim);
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
        font-size: 0.7rem;
    }
    
    .event-navigation {
        flex-direction: column;
        gap: 1rem;
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
';

// Additional scripts for the schedule page
$additionalScripts = '
// Initialize tabs functionality
document.addEventListener("DOMContentLoaded", function() {
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
    
    // Timeline visualization functionality
    const timelineEvents = document.querySelectorAll(".timeline-event");
    
    timelineEvents.forEach(event => {
        event.addEventListener("click", function() {
            const eventId = this.getAttribute("data-event-id");
            const targetEvent = document.getElementById(eventId);
            
            if (targetEvent) {
                // Scroll to event
                targetEvent.scrollIntoView({ behavior: "smooth" });
                
                // Highlight event
                targetEvent.classList.add("highlighted");
                setTimeout(() => {
                    targetEvent.classList.remove("highlighted");
                }, 2000);
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
    
    // Add download calendar functionality
    document.getElementById("download-calendar").addEventListener("click", function() {
        // In a real implementation, this would generate and download an .ics file
        alert("Calendar download functionality would be implemented here to generate an .ics file with all ByteVerse events.");
    });
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
    
    // Simulate the current time indicator position based on current time
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
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Explore the ByteVerse 1.0 event timeline. From the opening ceremony to the final projects showcase, navigate through three action-packed days of innovation, learning, and collaboration.
            </p>
        </div>
        
        <!-- Schedule Finder -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <a href="#day1" class="cyber-button secondary-sm">
                <span>April 28 - Day 1</span>
                <i></i>
            </a>
            <a href="#day2" class="cyber-button secondary-sm">
                <span>April 29 - Day 2</span>
                <i></i>
            </a>
            <a href="#day3" class="cyber-button secondary-sm">
                <span>April 30 - Day 3</span>
                <i></i>
            </a>
        </div>
    </div>
</section>

<!-- Schedule Interactive Controls -->
<section class="py-6 relative">
    <div class="container mx-auto px-4">
        <div class="event-navigation">
            <div class="flex gap-2">
                <button class="cyber-tab active" data-day="day1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Day 1: Kick-off
                </button>
                <button class="cyber-tab" data-day="day2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Day 2: Build
                </button>
                <button class="cyber-tab" data-day="day3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Day 3: Showcase
                </button>
            </div>
            
            <button id="download-calendar" class="download-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Add to Calendar
            </button>
        </div>
        
        <!-- Event Filters -->
        <div class="schedule-filters">
            <button class="filter-button active" data-filter="all">All Events</button>
            <button class="filter-button" data-filter="workshop">Workshops</button>
            <button class="filter-button" data-filter="activity">Activities</button>
            <button class="filter-button" data-filter="important">Main Events</button>
            <button class="filter-button" data-filter="food">Food & Breaks</button>
        </div>
        
        <!-- Timeline Visualization -->
        <div class="timeline-visualization">
            <div class="timeline-event" style="left: 10%;" data-time="09:00" data-title="Registration" data-event-id="event-registration"></div>
            <div class="timeline-event important" style="left: 20%;" data-time="10:30" data-title="Opening" data-event-id="event-opening"></div>
            <div class="timeline-event" style="left: 30%;" data-time="12:00" data-title="Team Formation" data-event-id="event-team-formation"></div>
            <div class="timeline-event food" style="left: 40%;" data-time="13:00" data-title="Lunch" data-event-id="event-lunch1"></div>
            <div class="timeline-event" style="left: 55%;" data-time="15:00" data-title="Workshops" data-event-id="event-workshops"></div>
            <div class="timeline-event food" style="left: 70%;" data-time="18:00" data-title="Dinner" data-event-id="event-dinner1"></div>
            <div class="timeline-event" style="left: 85%;" data-time="20:00" data-title="Networking" data-event-id="event-networking"></div>
            
            <!-- Current time indicator (would be dynamically positioned in real implementation) -->
            <div class="current-time-indicator" style="left: 30%;"></div>
        </div>
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
                        <div class="day-date">April 28, 2025</div>
                        <div class="day-name">Monday - DAY 1</div>
                    </div>
                    <div class="scanner-line"></div>
                </div>
                
                <div class="events-grid">
                    <!-- Event 1 -->
                    <div class="event-time">09:00 - 10:30</div>
                    <div id="event-registration" class="event-content">
                        <h3 class="event-title">Registration & Check-in</h3>
                        <p class="event-description">Participants arrive, collect their ByteVerse badges, swag bags, and set up their gear. Coffee and light refreshments will be available.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Main Lobby, Tech Building
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Important</span>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="event-time">10:30 - 12:00</div>
                    <div id="event-opening" class="event-content featured">
                        <h3 class="event-title">Opening Ceremony</h3>
                        <p class="event-description">Welcome address, introduction to the ByteVerse hackathon, mentor presentations, and announcement of this year's challenges and prizes.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Main Auditorium
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                            <span class="event-tag" data-category="activity">Keynote</span>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="event-time">12:00 - 13:00</div>
                    <div id="event-team-formation" class="event-content">
                        <h3 class="event-title">Team Formation & Ideation</h3>
                        <p class="event-description">Solo participants can find team members, and all teams begin brainstorming their hackathon projects. Mentors will be available to help with idea validation.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="activity">Activity</span>
                        </div>
                    </div>
                    
                    <!-- Event 4 -->
                    <div class="event-time">13:00 - 14:00</div>
                    <div id="event-lunch1" class="event-content">
                        <h3 class="event-title">Lunch Break</h3>
                        <p class="event-description">Catered lunch with vegetarian, vegan, and gluten-free options available. Network with other participants and mentors during this time.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 5 -->
                    <div class="event-time">14:00 - 15:00</div>
                    <div class="event-content live-now">
                        <h3 class="event-title">Hackathon Begins</h3>
                        <p class="event-description">Official start of the coding marathon! Teams start working on their projects. The 48-hour countdown begins now.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                        <div class="live-indicator">Happening now</div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                        </div>
                    </div>
                    
                    <!-- Event 6 -->
                    <div class="event-time">15:00 - 17:00</div>
                    <div id="event-workshops" class="event-content">
                        <h3 class="event-title">Tech Workshops (Parallel Sessions)</h3>
                        <p class="event-description">Concurrent workshops on AI/ML, Web3, Mobile Development, and Cloud Computing. Choose the one that best suits your project needs.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Workshop Rooms A, B, C, D
                        </div>
                        <div class="event-tags">
                            <span class="event-tag workshop" data-category="workshop">Workshop</span>
                        </div>
                    </div>
                    
                    <!-- Event 7 -->
                    <div class="event-time">18:00 - 19:00</div>
                    <div id="event-dinner1" class="event-content">
                        <h3 class="event-title">Dinner</h3>
                        <p class="event-description">Catered dinner with a variety of options. Take a break and refuel for the long night ahead.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 8 -->
                    <div class="event-time">20:00 - 22:00</div>
                    <div id="event-networking" class="event-content">
                        <h3 class="event-title">Networking Mixer & Game Night</h3>
                        <p class="event-description">Take a break from coding to network with industry professionals, play tech-themed games, and win small prizes. Refreshments will be served.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Lounge Area
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="activity">Activity</span>
                        </div>
                    </div>
                    
                    <!-- Event 9 -->
                    <div class="event-time">22:00 - 08:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Late-Night Hacking</h3>
                        <p class="event-description">Coding continues through the night. Quiet rooms available for those who need rest. Energy drinks, snacks, and support staff available 24/7.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Day 2 Schedule -->
            <div id="day2" class="schedule-day" data-day="day2">
                <div class="day-header">
                    <div class="day-title">
                        <div class="day-date">April 29, 2025</div>
                        <div class="day-name">Tuesday - DAY 2</div>
                    </div>
                    <div class="scanner-line"></div>
                </div>
                
                <div class="events-grid">
                    <!-- Event 1 -->
                    <div class="event-time">08:00 - 09:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Breakfast</h3>
                        <p class="event-description">Start your day with a hearty breakfast. Coffee, tea, and energizing options available.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="event-time">09:00 - 10:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Progress Check-in</h3>
                        <p class="event-description">Teams provide a brief update on their progress. Mentors available for guidance and feedback.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Team Pods, Innovation Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="important">Check-in</span>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="event-time">10:00 - 12:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Advanced Technical Workshops</h3>
                        <p class="event-description">Deep-dive sessions on advanced topics like GPU Optimization, Blockchain Development, and Cybersecurity Implementation.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Workshop Rooms A, B, C
                        </div>
                        <div class="event-tags">
                            <span class="event-tag workshop" data-category="workshop">Workshop</span>
                        </div>
                    </div>
                    
                    <!-- Event 4 -->
                    <div class="event-time">12:00 - 13:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Lunch Break</h3>
                        <p class="event-description">Catered lunch. Take a break, refresh, and connect with other participants.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 5 -->
                    <div class="event-time">14:00 - 16:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Sponsor Tech Talks</h3>
                        <p class="event-description">Industry leaders share insights on emerging technologies and career opportunities in tech. Great networking opportunity.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Conference Room
                        </div>
                        <div class="event-tags">
                            <span class="event-tag" data-category="activity">Talk</span>
                        </div>
                    </div>
                    
                    <!-- Event 6 -->
                    <div class="event-time">16:00 - 17:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Mid-Hackathon Review</h3>
                        <p class="event-description">Halfway point check-in. Teams can request specific help from mentors or discuss challenges they're facing.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Check-in</span>
                        </div>
                    </div>
                    
                    <!-- Event 7 -->
                    <div class="event-time">18:00 - 19:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Dinner</h3>
                        <p class="event-description">Catered dinner with international cuisine options. Take a break and recharge.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 8 -->
                    <div class="event-time">20:00 - 21:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Pitch Workshop</h3>
                        <p class="event-description">Learn how to effectively present your project in preparation for final demonstrations. Presentation tips and strategies.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Workshop Room A
                        </div>
                        <div class="event-tags">
                            <span class="event-tag workshop" data-category="workshop">Workshop</span>
                        </div>
                    </div>
                    
                    <!-- Event 9 -->
                    <div class="event-time">21:00 - 08:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Overnight Hacking</h3>
                        <p class="event-description">Continue working on your projects through the night. Support staff, snacks, and resting areas available.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Day 3 Schedule -->
            <div id="day3" class="schedule-day" data-day="day3">
                <div class="day-header">
                    <div class="day-title">
                        <div class="day-date">April 30, 2025</div>
                        <div class="day-name">Wednesday - DAY 3</div>
                    </div>
                    <div class="scanner-line"></div>
                </div>
                
                <div class="events-grid">
                    <!-- Event 1 -->
                    <div class="event-time">08:00 - 09:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Breakfast</h3>
                        <p class="event-description">Final day breakfast. Fuel up for the last push before project submission.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="event-time">09:00 - 11:30</div>
                    <div class="event-content">
                        <h3 class="event-title">Final Sprint</h3>
                        <p class="event-description">Last hours of development. Mentors will circulate to help teams polish their projects and prepare for submission.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="event-time">11:30 - 12:00</div>
                    <div class="event-content featured">
                        <h3 class="event-title">Code Freeze</h3>
                        <p class="event-description">All development stops. Teams must submit their projects to the ByteVerse platform by this deadline.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Hackathon Floor, Innovation Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Deadline</span>
                        </div>
                    </div>
                    
                    <!-- Event 4 -->
                    <div class="event-time">12:00 - 13:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Lunch & Presentation Prep</h3>
                        <p class="event-description">Lunch served while teams prepare their presentations and demos for the judges.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dining Hall
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                        </div>
                    </div>
                    
                    <!-- Event 5 -->
                    <div class="event-time">13:30 - 16:30</div>
                    <div class="event-content featured">
                        <h3 class="event-title">Project Presentations</h3>
                        <p class="event-description">Teams present their projects to judges and other participants. Each team has 5 minutes to present and 2 minutes for Q&A.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Main Auditorium
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                        </div>
                    </div>
                    
                    <!-- Event 6 -->
                    <div class="event-time">16:30 - 17:30</div>
                    <div class="event-content">
                        <h3 class="event-title">Judging Deliberation</h3>
                        <p class="event-description">Judges deliberate while participants network and explore other teams' projects.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Innovation Hall
                        </div>
                    </div>
                    
                    <!-- Event 7 -->
                    <div class="event-time">17:30 - 19:00</div>
                    <div class="event-content featured">
                        <h3 class="event-title">Awards Ceremony & Closing</h3>
                        <p class="event-description">Announcement of winners, prize distribution, and closing remarks. Celebrate the achievements of all participants!</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Main Auditorium
                        </div>
                        <div class="event-tags">
                            <span class="event-tag important" data-category="important">Main Event</span>
                        </div>
                    </div>
                    
                    <!-- Event 8 -->
                    <div class="event-time">19:00 - 21:00</div>
                    <div class="event-content">
                        <h3 class="event-title">Celebration Party</h3>
                        <p class="event-description">Wind down with food, music, and celebration. Network with sponsors, judges, and fellow hackers.</p>
                        <div class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Rooftop Lounge
                        </div>
                        <div class="event-tags">
                            <span class="event-tag food" data-category="food">Food</span>
                            <span class="event-tag" data-category="activity">Activity</span>
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
