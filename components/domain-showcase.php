<section id="domain-showcase" class="domain-showcase-section py-20 relative overflow-hidden">
    <div class="cyber-grid-bg"></div>
    
    <div class="container mx-auto px-4">
        <h2 class="section-title text-center mb-5" style="text-align: center;">Challenge Domains</h2>
        <p class="section-subtitle text-center mb-16 text-gray-300 max-w-3xl mx-auto">
            Solve real-world problems in these cutting-edge domains and build innovative solutions that matter.
        </p>
        
        <!-- Highlighted Note -->
        <!-- <div class="mb-10 max-w-2xl mx-auto">
            <div style="background:rgba(34,197,94,0.12);border:1.5px solid #22c55e;padding:1rem 1.5rem;border-radius:0.75rem;text-align:center;font-weight:600;color:#22c55e;">
                <span>Note:</span> Problem statements will be released one week before the hackathon.
            </div>
        </div> -->
        
        <div class="domains-container">
            <!-- Domain Cards -->
            <div class="domain-card">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="domain-title">Agriculture</h3>
                <p class="domain-preview">Revolutionize farming with sustainable technology solutions</p>
                <div class="domain-tag">Sustainable</div>
            </div>
            
            <div class="domain-card">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                </div>
                <h3 class="domain-title">Healthcare</h3>
                <p class="domain-preview">Build tech innovations to improve healthcare accessibility</p>
                <div class="domain-tag">Critical</div>
            </div>
            
            <div class="domain-card">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                </div>
                <h3 class="domain-title">IoT & XR Tech</h3>
                <p class="domain-preview">Connect digital and physical worlds through immersive technology</p>
                <div class="domain-tag">Immersive</div>
            </div>
            
            <div class="domain-card">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <h3 class="domain-title">Cyber Security</h3>
                <p class="domain-preview">Build the next generation of digital defense systems</p>
                <div class="domain-tag">Critical</div>
            </div>
            
            <div class="domain-card">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <h3 class="domain-title">Open Innovation</h3>
                <p class="domain-preview">Push technological boundaries with your unique ideas</p>
                <div class="domain-tag">Freestyle</div>
            </div>
        </div>
    </div>

 
</section>

<style>
/* Disable popup functionality for domain cards */
.domain-card {
    cursor: default !important;
    pointer-events: auto !important;
}

/* Remove any click indicators */
.domain-card:hover {
    cursor: default !important;
}

/* Ensure no JavaScript click events are triggered */
.domain-card[data-domain] {
    pointer-events: none;
}
.domain-card > * {
    pointer-events: auto;
}

/* Hide modal completely */
.domain-modal {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}
</style>

<script>
// Disable any existing click handlers for domain cards
document.addEventListener('DOMContentLoaded', function() {
    const domainCards = document.querySelectorAll('.domain-card');
    
    domainCards.forEach(card => {
        // Remove any existing event listeners
        card.onclick = null;
        card.removeAttribute('data-domain');
        
        // Prevent any new click events
        card.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }, true);
    });
    
    // Hide modal if it exists
    const modal = document.getElementById('domain-modal');
    if (modal) {
        modal.style.display = 'none';
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
        modal.style.pointerEvents = 'none';
    }
});
</script>