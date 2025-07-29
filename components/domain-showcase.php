
<section id="domain-showcase" class="domain-showcase-section py-20 relative overflow-hidden">
    <div class="cyber-grid-bg"></div>
    
    <div class="container mx-auto px-4">
        <h2 class="section-title text-center mb-5" style="text-align: center;
">Challenge Domains</h2>
        <p class="section-subtitle text-center mb-16 text-gray-300 max-w-3xl mx-auto">
            Solve real-world problems in these cutting-edge domains and build innovative solutions that matter.
        </p>
        
        <div class="domains-container">
            <!-- Domain Cards -->
            <div class="domain-card" data-domain="agriculture">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="domain-title">Agriculture</h3>
                <p class="domain-preview">Revolutionize farming with sustainable technology solutions</p>
                <div class="domain-hover-content">
                    <h4 class="problem-title">Problem Statements</h4>
                    <ul class="problem-list">
                        <li>Precision farming with IoT sensors for resource optimization</li>
                        <li>AI-powered crop disease detection and prevention</li>
                        <li>Blockchain for transparent agricultural supply chains</li>
                    </ul>
                    <a href="challenges.php?domain=agriculture" class="domain-link">View Challenges</a>
                </div>
                <div class="domain-tag">Sustainable</div>
            </div>
            
            <div class="domain-card" data-domain="healthcare">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                </div>
                <h3 class="domain-title">Healthcare</h3>
                <p class="domain-preview">Build tech innovations to improve healthcare accessibility</p>
                <div class="domain-hover-content">
                    <h4 class="problem-title">Problem Statements</h4>
                    <ul class="problem-list">
                        <li>Remote patient monitoring and telemedicine platforms</li>
                        <li>ML-based early disease detection algorithms</li>
                        <li>Healthcare data security and privacy solutions</li>
                    </ul>
                    <a href="challenges.php?domain=healthcare" class="domain-link">View Challenges</a>
                </div>
                <div class="domain-tag">Critical</div>
            </div>
            
            <div class="domain-card" data-domain="iot-xr">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                </div>
                <h3 class="domain-title">IoT & XR Tech</h3>
                <p class="domain-preview">Connect digital and physical worlds through immersive technology</p>
                <div class="domain-hover-content">
                    <h4 class="problem-title">Problem Statements</h4>
                    <ul class="problem-list">
                        <li>Smart city infrastructure optimization with IoT</li>
                        <li>AR/VR solutions for education and training</li>
                        <li>Mixed reality interfaces for industrial applications</li>
                    </ul>
                    <a href="challenges.php?domain=iot-xr" class="domain-link">View Challenges</a>
                </div>
                <div class="domain-tag">Immersive</div>
            </div>
            
            <div class="domain-card" data-domain="cybersecurity">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <h3 class="domain-title">Cyber Security</h3>
                <p class="domain-preview">Build the next generation of digital defense systems</p>
                <div class="domain-hover-content">
                    <h4 class="problem-title">Problem Statements</h4>
                    <ul class="problem-list">
                        <li>AI-powered threat detection and response</li>
                        <li>Zero-trust architecture implementation</li>
                        <li>Secure authentication for decentralized applications</li>
                    </ul>
                    <a href="challenges.php?domain=cybersecurity" class="domain-link">View Challenges</a>
                </div>
                <div class="domain-tag">Critical</div>
            </div>
            
            <div class="domain-card" data-domain="open">
                <div class="domain-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <h3 class="domain-title">Open Innovation</h3>
                <p class="domain-preview">Push technological boundaries with your unique ideas</p>
                <div class="domain-hover-content">
                    <h4 class="problem-title">Problem Statements</h4>
                    <ul class="problem-list">
                        <li>Sustainable energy innovations</li>
                        <li>Solutions for digital inclusion and accessibility</li>
                        <li>Novel applications of emerging technologies</li>
                    </ul>
                    <a href="challenges.php?domain=open" class="domain-link">View Challenges</a>
                </div>
                <div class="domain-tag">Freestyle</div>
            </div>
        </div>
    </div>

    <!-- Domain Detail Modal -->
    <div id="domain-modal" class="domain-modal">
        <div class="domain-modal-content">
            <div class="domain-modal-header">
                <h3 id="modal-title" class="modal-title">Domain Title</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="domain-modal-body">
                <div id="modal-description" class="modal-description">Domain description goes here</div>
                <div class="modal-problems">
                    <h4>Problem Statements</h4>
                    <ul id="modal-problems" class="modal-problem-list">
                        <!-- Problems will be inserted via JS -->
                    </ul>
                </div>
            </div>
            <div class="domain-modal-footer">
                <a id="modal-link" href="#" class="cyber-button primary">
                    <span>View All Challenges</span>
                    <i></i>
                </a>
            </div>
        </div>
    </div>
</section>