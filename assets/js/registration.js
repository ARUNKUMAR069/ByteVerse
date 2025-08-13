// Minimal, payment-free multi-step controller for ByteVerse registration
(function () {
  // Get the base URL for API requests - more reliable approach
  const getApiUrl = () => {
    // Get the current base URL (protocol + host)
    const baseUrl = window.location.protocol + '//' + window.location.host;
    
    // Check if we're in the /new2/ path context
    const pathName = window.location.pathname;
    const inNew2Context = pathName.includes('/new2/');
    
    // Build the complete path
    if (inNew2Context) {
      return baseUrl + '/new2/backend/api/registration.php';
    } else {
      return baseUrl + '/backend/api/registration.php';
    }
  };

  const API_URL = getApiUrl();
  console.log('Using API URL:', API_URL);

  const form = document.getElementById('registration-form');
  const successBox = document.getElementById('registration-success');

  // Check if elements exist to prevent null reference errors
  if (!form) {
    console.error('Registration form not found');
    return;
  }
  
  if (!successBox) {
    console.error('Success box not found');
  }

  const stepField = document.getElementById('step');
  const sessionField = document.getElementById('session_id');

  const steps = [...document.querySelectorAll('.step')];
  const stepItems = [...document.querySelectorAll('.step-item .step-circle')];

  let currentStep = 1;
  let sessionId = '';

  // Helpers
  const setStep = (n) => {
    currentStep = n;
    steps.forEach((s, i) => (s.style.display = i === (n - 1) ? 'block' : 'none'));
    stepItems.forEach((el, idx) => {
      if (idx < n) el.classList.add('active'); else el.classList.remove('active');
    });
    if (stepField) stepField.value = String(n);
  };

  const showError = (input) => input.classList.add('input-error');
  const clearErrors = () => form.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));

  const postFormData = async (fd) => {
    try {
      console.log(`Sending request to: ${API_URL}`);
      console.log('Form data being sent:', Object.fromEntries(fd.entries()));
      
      // Use XMLHttpRequest instead of fetch for better error handling
      return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        
        xhr.open('POST', API_URL, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        // Add debug listener to track redirects
        xhr.onreadystatechange = function() {
          if (xhr.readyState > 2) {
            console.log(`XHR state ${xhr.readyState}, status: ${xhr.status}, response URL: ${xhr.responseURL || 'N/A'}`);
            if (xhr.responseURL && xhr.responseURL !== API_URL) {
              console.warn(`Request redirected from ${API_URL} to ${xhr.responseURL}`);
            }
          }
        };
        
        xhr.onload = function() {
          if (this.status >= 200 && this.status < 300) {
            try {
              const data = JSON.parse(this.responseText);
              console.log('Server response:', data);
              resolve(data);
            } catch (e) {
              console.error('Error parsing response:', e);
              console.log('Raw response:', this.responseText);
              reject({ success: false, message: 'Server returned an invalid response.' });
            }
          } else {
            console.error('Server error response:', this.status, this.statusText);
            reject({ success: false, message: `Server error: ${this.status} ${this.statusText}` });
          }
        };
        
        xhr.onerror = function() {
          console.error('Network error occurred');
          reject({ success: false, message: 'Network error. Please check your connection and try again.' });
        };
        
        xhr.ontimeout = function() {
          console.error('Request timed out');
          reject({ success: false, message: 'Request timed out. Please try again.' });
        };
        
        xhr.timeout = 30000; // 30 seconds timeout
        xhr.send(fd);
      });
    } catch (e) {
      console.error('Form submission error:', e);
      return { success: false, message: 'Network connection error. Please check your internet connection and try again.' };
    }
  };

  const getTeamSize = () => {
    const sizeEl = document.getElementById('team_size');
    return sizeEl && sizeEl.value ? parseInt(sizeEl.value, 10) : 0;
  };

  const genAdditionalMembers = (size) => {
    const wrap = document.getElementById('additional-members');
    if (!wrap) return;
    
    wrap.innerHTML = '';
    if (!size || size < 2) return;
    
    for (let i = 2; i <= size; i++) {
      const idx = i;
      const block = document.createElement('div');
      block.className = 'team-member-card mb-6';
      block.innerHTML = `
        <div class="card-header flex justify-between items-center mb-4">
          <h3 class="text-lg text-white">Member ${idx}</h3>
          <span class="badge bg-gray-800 text-gray-300 py-1 px-3 rounded-full text-sm">Optional</span>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="input-label" for="member${idx}_name">Full Name</label>
            <input type="text" class="cyber-input" id="member${idx}_name" name="member${idx}_name" placeholder="Full name">
          </div>
          <div class="form-group">
            <label class="input-label" for="member${idx}_email">Email</label>
            <input type="email" class="cyber-input" id="member${idx}_email" name="member${idx}_email" placeholder="Email address">
          </div>
          <div class="form-group">
            <label class="input-label" for="member${idx}_phone">Phone</label>
            <input type="tel" class="cyber-input" id="member${idx}_phone" name="member${idx}_phone" placeholder="Phone number">
          </div>
          <div class="form-group">
            <label class="input-label" for="member${idx}_role">Role</label>
            <div class="select-wrapper">
              <select class="cyber-input" id="member${idx}_role" name="member${idx}_role">
                <option value="" selected>Choose role (optional)</option>
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
      `;
      wrap.appendChild(block);
    }
  };

  // Step buttons
  document.querySelectorAll('.next-step').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault();
      clearErrors();

      const goTo = parseInt(btn.dataset.next, 10);
      if (isNaN(goTo)) {
        console.error('Invalid next step value');
        return;
      }

      try {
        if (currentStep === 1) {
          // Validate step 1
          const team_name = document.getElementById('team_name');
          const team_size = document.getElementById('team_size');
          const institution = document.getElementById('institution');
          const challenge_track = document.getElementById('challenge_track');

          let ok = true;
          [team_name, team_size, institution, challenge_track].forEach(inp => {
            if (!inp || !inp.value) { 
              if (inp) showError(inp);
              ok = false; 
            }
          });
          if (!ok) return;

          // Save step 1
          const fd = new FormData();
          fd.append('step', '1');
          fd.append('team_name', team_name.value.trim());
          fd.append('team_size', team_size.value);
          fd.append('institution', institution.value.trim());
          fd.append('challenge_track', challenge_track.value);

          try {
            const resp = await postFormData(fd);
            if (!resp || !resp.success) { 
              alert(resp?.message || 'Failed to save team information. Please try again.');
              return; 
            }

            sessionId = resp.data?.session_id || '';
            if (sessionField) sessionField.value = sessionId;

            // Generate members UI and move next
            genAdditionalMembers(getTeamSize());
            setStep(goTo);
          } catch (err) {
            console.error('Step 1 error:', err);
            alert(err.message || 'An error occurred. Please try again.');
          }
        }
        else if (currentStep === 2) {
          // Validate leader fields
          const leader_name = document.getElementById('leader_name');
          const leader_email = document.getElementById('leader_email');
          const leader_phone = document.getElementById('leader_phone');
          const leader_role = document.getElementById('leader_role');

          let ok = true;
          [leader_name, leader_email, leader_phone, leader_role].forEach(inp => {
            if (!inp || !inp.value) { 
              if (inp) showError(inp);
              ok = false; 
            }
          });
          if (!ok) return;

          // Save step 2
          const fd = new FormData(form);
          fd.set('step', '2');
          fd.set('session_id', sessionId);

          try {
            const resp = await postFormData(fd);
            if (!resp || !resp.success) { 
              alert(resp?.message || 'Failed to save team members. Please try again.');
              return; 
            }
            setStep(goTo);
          } catch (err) {
            console.error('Step 2 error:', err);
            alert(err.message || 'An error occurred. Please try again.');
          }
        }
      } catch (e) {
        console.error('Next step error:', e);
        alert('An unexpected error occurred. Please try again.');
      }
    });
  });

  document.querySelectorAll('.prev-step').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const backTo = parseInt(btn.dataset.prev, 10);
      if (!isNaN(backTo)) {
        setStep(backTo);
      }
    });
  });

  // Final submit
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();

    try {
      // Validate step 3
      const title = document.getElementById('project_title');
      const desc = document.getElementById('project_description');
      const techs = [...document.querySelectorAll('input[name="technologies[]"]:checked')];
      const terms = document.getElementById('terms_agree');

      let ok = true;
      if (!title || !title.value.trim()) { 
        if (title) showError(title); 
        ok = false; 
      }
      if (!desc || !desc.value.trim()) { 
        if (desc) showError(desc); 
        ok = false; 
      }
      
      if (!techs || techs.length === 0) {
        const g = document.querySelector('.group-error');
        if (g) g.style.display = 'block';
        ok = false;
      } else {
        const g = document.querySelector('.group-error');
        if (g) g.style.display = 'none';
      }
      
      if (!terms || !terms.checked) { 
        ok = false; 
        alert('Please agree to the Terms & Conditions and Code of Conduct.'); 
      }

      if (!ok) return;

      // Save step 3
      const fd3 = new FormData(form);
      fd3.set('step', '3');
      fd3.set('session_id', sessionId);

      try {
        let resp = await postFormData(fd3);
        if (!resp || !resp.success) { 
          alert(resp?.message || 'Failed to save project details. Please try again.');
          return; 
        }

        // Finalize (step 4)
        const fd4 = new FormData();
        fd4.append('step', '4');
        fd4.append('session_id', sessionId);

        resp = await postFormData(fd4);
        if (!resp || !resp.success) { 
          alert(resp?.message || 'Failed to complete registration. Please try again.');
          return; 
        }

        // Success UI
        form.style.display = 'none';
        if (successBox) successBox.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } catch (err) {
        console.error('Final submission error:', err);
        alert(err.message || 'An error occurred during final submission. Please try again.');
      }
    } catch (e) {
      console.error('Form submission error:', e);
      alert('An unexpected error occurred during form submission. Please try again.');
    }
  });

  // If user changes team size after saving step 1 (before moving next)
  const teamSizeSelect = document.getElementById('team_size');
  if (teamSizeSelect) {
    teamSizeSelect.addEventListener('change', () => {
      if (currentStep === 2) {
        genAdditionalMembers(getTeamSize());
      }
    });
  }

  // Initialize
  setStep(1);
  
  // Debug info
  console.log('ByteVerse Registration Form initialized');
  console.log('Current environment:', window.location.hostname);
  console.log('Current pathname:', window.location.pathname);
})();