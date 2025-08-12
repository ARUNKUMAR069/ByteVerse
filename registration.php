<?php
// Page-specific variables
$pageTitle = 'Registration | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Sign-up';
$loaderText = 'Initializing registration process...';
$currentPage = 'registration';

// Additional scripts
$additionalScripts = '
<script src="assets/js/registration.js"></script>
';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Registration Hero Section -->
<section class="min-h-[40vh] relative overflow-hidden flex items-center justify-center pt-24">
  <div class="container mx-auto px-4 py-16 relative z-10 text-center">
    <div class="grid-lines"></div>
    <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Registration">Registration</h1>
    <div class="max-w-3xl mx-auto">
      <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
        Join ByteVerse 1.0 and be part of the next evolution in hackathons. Register now to secure your spot and prepare to create, innovate, and disrupt.
      </p>
    </div>
  </div>
</section>

<!-- Registration Content Section -->
<section class="py-12 relative">
  <div class="container mx-auto px-4">
    <div class="circuit-dots"></div>
    <div class="registration-container">
      <!-- Registration Info Box -->
      <div class="registration-info">
        <h3>Registration Information</h3>
        <p>ByteVerse 1.0 will take place from April 28–30, 2025. Before registering, please note:</p>
        <ul class="info-list">
          <li>Team size must be between 3–5 members</li>
          <li><strong>Registration is 100% free — no payment required</strong></li>
          <li>Each team must have a unique team name</li>
          <li>All participants must be 18+ or have guardian consent</li>
          <li>Each participant must bring their own laptop</li>
          <li>Registration closes on April 15, 2025 or when capacity is reached</li>
        </ul>
        <p class="mt-3">Fields marked with an asterisk (*) are required.</p>
      </div>

      <!-- Step Indicator -->
      <div class="step-progress mb-8">
        <div class="steps-container flex items-center justify-between">
          <div class="step-item" data-step="1">
            <div class="step-circle active">1</div>
            <div class="step-label">Team Info</div>
          </div>
          <div class="step-line"></div>
          <div class="step-item" data-step="2">
            <div class="step-circle">2</div>
            <div class="step-label">Team Members</div>
          </div>
          <div class="step-line"></div>
          <div class="step-item" data-step="3">
            <div class="step-circle">3</div>
            <div class="step-label">Project</div>
          </div>
        </div>
      </div>

      <!-- Registration Form -->
      <form id="registration-form" class="registration-form" action="backend/api/registration.php" method="POST" novalidate>
        <div class="scanner-line"></div>

        <!-- Hidden fields managed by JS -->
        <input type="hidden" name="step" id="step" value="1">
        <input type="hidden" name="session_id" id="session_id" value="">

        <!-- Step 1: Team Information -->
        <div class="step" id="step-1" style="display: block;">
          <h2 class="section-title">Team Information</h2>

          <div class="form-grid">
            <div class="form-group full-width">
              <label for="team_name" class="input-label field-required">Team Name</label>
              <input type="text" class="cyber-input" id="team_name" name="team_name" placeholder="Enter a unique team name" required>
              <span class="form-help">Choose a creative, unique name for your team (3–20 characters)</span>
            </div>

            <div class="form-group">
              <label for="team_size" class="input-label field-required">Team Size</label>
              <div class="select-wrapper">
                <select class="cyber-input" id="team_size" name="team_size" required>
                  <option value="" disabled selected>Select team size</option>
                  <option value="3">3 Members</option>
                  <option value="4">4 Members</option>
                  <option value="5">5 Members</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="institution" class="input-label field-required">Institution/Organization</label>
              <input type="text" class="cyber-input" id="institution" name="institution" placeholder="Your college/university or organization" required>
            </div>

            <div class="form-group full-width">
              <label for="challenge_track" class="input-label field-required">Challenge Track</label>
              <div class="select-wrapper">
                <select class="cyber-input" id="challenge_track" name="challenge_track" required>
                  <option value="" disabled selected>Choose your challenge track</option>
                  <option value="ai_ml">AI/ML Solutions</option>
                  <option value="blockchain">Blockchain Innovation</option>
                  <option value="ar_vr">AR/VR Experiences</option>
                  <option value="iot">IoT & Hardware</option>
                  <option value="open_innovation">Open Innovation</option>
                </select>
              </div>
              <span class="form-help">You can change your challenge track later if needed</span>
            </div>
          </div>

          <div class="form-navigation">
            <div></div>
            <button type="button" class="form-nav-btn next-step" data-next="2">
              Next Step
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Step 2: Team Members -->
        <div class="step" id="step-2" style="display: none;">
          <h2 class="section-title">Team Leader Information</h2>

          <div class="team-member-card mb-8">
            <div class="card-header flex justify-between items-center mb-4">
              <h3 class="text-xl text-white">Team Leader (You)</h3>
              <span class="badge bg-cyan-900 text-cyan-400 py-1 px-3 rounded-full text-sm">Leader</span>
            </div>

            <div class="form-grid">
              <div class="form-group">
                <label for="leader_name" class="input-label field-required">Full Name</label>
                <input type="text" class="cyber-input" id="leader_name" name="leader_name" placeholder="Your full name" required>
              </div>

              <div class="form-group">
                <label for="leader_email" class="input-label field-required">Email Address</label>
                <input type="email" class="cyber-input" id="leader_email" name="leader_email" placeholder="Your email address" required>
              </div>

              <div class="form-group">
                <label for="leader_phone" class="input-label field-required">Phone Number</label>
                <input type="tel" class="cyber-input" id="leader_phone" name="leader_phone" placeholder="Your phone number" required>
              </div>

              <div class="form-group">
                <label for="leader_role" class="input-label field-required">Your Role in Team</label>
                <div class="select-wrapper">
                  <select class="cyber-input" id="leader_role" name="leader_role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="frontend">Frontend Developer</option>
                    <option value="backend">Backend Developer</option>
                    <option value="fullstack">Full Stack Developer</option>
                    <option value="mobile">Mobile Developer</option>
                    <option value="ui_ux">UI/UX Designer</option>
                    <option value="ml_ai">ML/AI Engineer</option>
                    <option value="devops">DevOps Engineer</option>
                    <option value="project_manager">Project Manager</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div id="additional-members"><!-- Generated based on team size --></div>

          <div class="form-navigation">
            <button type="button" class="form-nav-btn prev-step" data-prev="1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Previous
            </button>

            <button type="button" class="form-nav-btn next-step" data-next="3">
              Next Step
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Step 3: Project Details -->
        <div class="step" id="step-3" style="display: none;">
          <h2 class="section-title">Project Information</h2>

          <div class="form-grid">
            <div class="form-group full-width">
              <label for="project_title" class="input-label field-required">Project Title</label>
              <input type="text" class="cyber-input" id="project_title" name="project_title" placeholder="Working title for your project idea" required>
              <span class="form-help">You can change this later</span>
            </div>

            <div class="form-group full-width">
              <label for="project_description" class="input-label field-required">Brief Project Description</label>
              <textarea class="cyber-input h-32" id="project_description" name="project_description" placeholder="Describe your project idea in a few sentences" required></textarea>
              <span class="form-help">Outline the problem you're trying to solve and your approach (100–500 characters)</span>
            </div>

            <div class="form-group full-width">
              <label class="input-label field-required">Technologies You Plan to Use</label>
              <div class="tech-checkboxes grid grid-cols-2 md:grid-cols-3 gap-3 mt-2">
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_react" name="technologies[]" value="react">
                  <label for="tech_react" class="checkbox-label">React</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_node" name="technologies[]" value="node">
                  <label for="tech_node" class="checkbox-label">Node.js</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_python" name="technologies[]" value="python">
                  <label for="tech_python" class="checkbox-label">Python</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_firebase" name="technologies[]" value="firebase">
                  <label for="tech_firebase" class="checkbox-label">Firebase</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_flutter" name="technologies[]" value="flutter">
                  <label for="tech_flutter" class="checkbox-label">Flutter</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_ai" name="technologies[]" value="ai_ml">
                  <label for="tech_ai" class="checkbox-label">AI/ML</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_blockchain" name="technologies[]" value="blockchain">
                  <label for="tech_blockchain" class="checkbox-label">Blockchain</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_ar_vr" name="technologies[]" value="ar_vr">
                  <label for="tech_ar_vr" class="checkbox-label">AR/VR</label>
                </div>
                <div class="tech-checkbox">
                  <input type="checkbox" class="checkbox-control" id="tech_other" name="technologies[]" value="other">
                  <label for="tech_other" class="checkbox-label">Other</label>
                </div>
              </div>
              <span class="form-error group-error" style="display:none;">Please select at least one technology</span>
            </div>

            <div class="form-group full-width">
              <div class="checkbox-item">
                <input type="checkbox" class="checkbox-control" id="terms_agree" name="terms_agree" required>
                <label for="terms_agree" class="checkbox-label">I agree to the <a href="#" class="text-cyan-400 hover:underline">Terms & Conditions</a> and <a href="#" class="text-cyan-400 hover:underline">Code of Conduct</a> of ByteVerse 1.0</label>
              </div>
            </div>
          </div>

          <div class="form-navigation">
            <button type="button" class="form-nav-btn prev-step" data-prev="2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Previous
            </button>

            <button type="submit" id="submit-registration" class="cyber-button primary">
              <span>Complete Registration</span>
              <i></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Success Message (hidden by default) -->
      <div id="registration-success" class="form-success" style="display: none;">
        <div class="success-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <h3>Registration Complete!</h3>
        <p>Your team has been successfully registered for ByteVerse 1.0.</p>

        <div class="mt-6 mb-8 p-5 bg-gray-900/50 border border-cyan-900/30 rounded-lg">
          <h4 class="text-xl text-cyan-400 mb-3">Next Steps:</h4>
          <ol class="list-decimal list-inside text-left space-y-2">
            <li>Check your email for the registration confirmation (with your team’s registration code)</li>
            <li>Join our community Discord to stay updated</li>
            <li>Watch for schedule and check-in instructions closer to the event</li>
          </ol>
        </div>

        <a href="index.php" class="cyber-button">
          <span>Return to Home</span>
          <i></i>
        </a>
      </div>
    </div>
  </div>
</section>

<script src="assets/js/registration.js"></script>

<?php
// Include footer
require_once('components/footer.php');
?>

<style>
/* Registration H1 Responsive - IMPORTANT */
@media (max-width: 320px) {
  .glitch-text { font-size: 1.75rem !important; letter-spacing: 1px !important; line-height: 1.1 !important; }
  .max-w-3xl p { font-size: 0.875rem !important; line-height: 1.4 !important; }
}
@media (min-width: 321px) and (max-width: 374px) {
  .glitch-text { font-size: 2rem !important; letter-spacing: 1px !important; }
  .max-w-3xl p { font-size: 0.9375rem !important; }
}
@media (min-width: 375px) and (max-width: 424px) {
  .glitch-text { font-size: 2.25rem !important; letter-spacing: 2px !important; }
  .max-w-3xl p { font-size: 1rem !important; }
}
@media (min-width: 425px) and (max-width: 639px) {
  .glitch-text { font-size: 2.5rem !important; letter-spacing: 2px !important; }
  .max-w-3xl p { font-size: 1.125rem !important; }
}
@media (min-width: 640px) and (max-width: 767px) {
  .glitch-text { font-size: 3rem !important; letter-spacing: 3px !important; }
  .max-w-3xl p { font-size: 1.25rem !important; }
}
@media (min-width: 768px) and (max-width: 1023px) {
  .glitch-text { font-size: 3.5rem !important; letter-spacing: 3px !important; }
  .max-w-3xl p { font-size: 1.375rem !important; }
}
@media (min-width: 1024px) {
  .glitch-text { font-size: 4rem !important; letter-spacing: 4px !important; }
  .max-w-3xl p { font-size: 1.5rem !important; }
}
/* Mobile Landscape for Registration */
@media (max-height: 500px) and (orientation: landscape) and (max-width: 896px) {
  .glitch-text { font-size: 2rem !important; letter-spacing: 2px !important; margin-bottom: 1rem !important; }
  .max-w-3xl p { font-size: 0.875rem !important; margin-bottom: 2rem !important; }
}
/* Container padding adjustments for Registration */
@media (max-width: 640px) {
  .container { padding-left: 1rem !important; padding-right: 1rem !important; }
  .py-16 { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
}

/* Simple invalid state styles */
.cyber-input:invalid { outline: 1px solid rgba(34,197,94,0.0); }
.cyber-input.input-error { outline: 1px solid #ef4444; }
.form-error { color: #f87171; font-size: .9rem; }
.step-circle.active { background: #06b6d4; color: #0b1220; }
</style>
