// Minimal, payment-free multi-step controller for ByteVerse registration
(function () {
  const API_URL = 'backend/api/registration.php';

  const form = document.getElementById('registration-form');
  const successBox = document.getElementById('registration-success');

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
    stepField.value = String(n);
  };

  const showError = (input) => input.classList.add('input-error');
  const clearErrors = () => form.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));

  const postFormData = async (fd) => {
    // Use the API_URL constant instead of hardcoding the URL
    const res = await fetch(API_URL, { method: 'POST', body: fd });
    let data;
    try {
      data = await res.json();
    } catch (e) {
      return { success: false, message: 'Server returned an invalid response.' };
    }
    return data;
  };

  const getTeamSize = () => {
    const v = document.getElementById('team_size').value;
    return v ? parseInt(v, 10) : 0;
  };

  const genAdditionalMembers = (size) => {
    const wrap = document.getElementById('additional-members');
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

      if (currentStep === 1) {
        // Validate step 1
        const team_name = document.getElementById('team_name');
        const team_size = document.getElementById('team_size');
        const institution = document.getElementById('institution');
        const challenge_track = document.getElementById('challenge_track');

        let ok = true;
        [team_name, team_size, institution, challenge_track].forEach(inp => {
          if (!inp.value) { showError(inp); ok = false; }
        });
        if (!ok) return;

        // Save step 1
        const fd = new FormData();
        fd.set('step', '1');
        fd.set('team_name', team_name.value.trim());
        fd.set('team_size', team_size.value);
        fd.set('institution', institution.value.trim());
        fd.set('challenge_track', challenge_track.value);

        const resp = await postFormData(fd);
        if (!resp.success) { alert(resp.message || 'Failed to save team info'); return; }

        sessionId = resp.data?.session_id || '';
        sessionField.value = sessionId;

        // Generate members UI and move next
        genAdditionalMembers(getTeamSize());
        setStep(goTo);
      }

      else if (currentStep === 2) {
        // Validate leader fields
        const leader_name = document.getElementById('leader_name');
        const leader_email = document.getElementById('leader_email');
        const leader_phone = document.getElementById('leader_phone');
        const leader_role = document.getElementById('leader_role');

        let ok = true;
        [leader_name, leader_email, leader_phone, leader_role].forEach(inp => {
          if (!inp.value) { showError(inp); ok = false; }
        });
        if (!ok) return;

        // Save step 2
        const fd = new FormData(form);
        fd.set('step', '2');
        fd.set('session_id', sessionId);

        const resp = await postFormData(fd);
        if (!resp.success) { alert(resp.message || 'Failed to save team members'); return; }

        setStep(goTo);
      }
    });
  });

  document.querySelectorAll('.prev-step').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const backTo = parseInt(btn.dataset.prev, 10);
      setStep(backTo);
    });
  });

  // Final submit
  const submitBtn = document.getElementById('submit-registration');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();

    // Validate step 3
    const title = document.getElementById('project_title');
    const desc = document.getElementById('project_description');
    const techs = [...document.querySelectorAll('input[name="technologies[]"]:checked')];
    const terms = document.getElementById('terms_agree');

    let ok = true;
    if (!title.value.trim()) { showError(title); ok = false; }
    if (!desc.value.trim()) { showError(desc); ok = false; }
    if (techs.length === 0) {
      const g = document.querySelector('.group-error');
      if (g) g.style.display = 'block';
      ok = false;
    } else {
      const g = document.querySelector('.group-error');
      if (g) g.style.display = 'none';
    }
    if (!terms.checked) { ok = false; alert('Please agree to the Terms & Conditions and Code of Conduct.'); }

    if (!ok) return;

    // Save step 3
    const fd3 = new FormData(form);
    fd3.set('step', '3');
    fd3.set('session_id', sessionId);

    let resp = await postFormData(fd3);
    if (!resp.success) { alert(resp.message || 'Failed to save project details'); return; }

    // Finalize (step 4)
    const fd4 = new FormData();
    fd4.set('step', '4');
    fd4.set('session_id', sessionId);

    resp = await postFormData(fd4);
    if (!resp.success) { alert(resp.message || 'Failed to complete registration'); return; }

    // Success UI
    form.style.display = 'none';
    successBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // If user changes team size after saving step 1 (before moving next)
  const teamSizeSelect = document.getElementById('team_size');
  teamSizeSelect?.addEventListener('change', () => {
    if (currentStep === 2) {
      genAdditionalMembers(getTeamSize());
    }
  });

  // Initialize
  setStep(1);
})();
