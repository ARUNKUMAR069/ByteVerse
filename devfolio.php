<?php
$pageTitle = 'Apply with Devfolio | ByteVerse 1.0';
$currentPage = 'devfolio';
require_once 'components/header.php';
require_once 'components/navbar.php';
?>
<main class="dv-wrapper">
  <!-- HERO -->
  <header class="dv-hero">
    <div class="dv-hero-bg"></div>
    <h1 class="dv-title">Apply via Devfolio</h1>
    <p class="dv-sub">
      Submit your team for ByteVerse 1.0 using the official Devfolio application button below.
      The button activates only after event verification and on approved domains.
    </p>
    <ul class="dv-facts">
      <li>24h Hackathon</li>
      <li>₹50K Prize Pool</li>
      <li>Teams 3–5</li>
    </ul>
  </header>

  <!-- BUTTON -->
  <section class="dv-panel">
    <h2 class="dv-h2">Application</h2>
    <p class="dv-text">If the button does not load, verify the slug and domain in your Devfolio dashboard.</p>

    <div class="dv-btn-wrap theme-light" id="devfolioBtnWrap">
      <div id="devfolioApply"
           class="apply-button"
           data-hackathon-slug="byteverse-1-0"
           data-button-theme="light"
           style="height:44px;width:312px">
      </div>
      <div class="dv-skeleton" id="dvSkeleton" aria-hidden="true">
        <div class="dv-shimmer"></div>
        <span>Loading…</span>
      </div>
    </div>

    <div class="dv-theme-toggle" aria-label="Button theme switch">
      <button data-theme="light" class="active" type="button">Light</button>
      <button data-theme="dark" type="button">Dark</button>
      <button data-theme="dark-inverted" type="button">Inverted</button>
    </div>

    <div class="dv-mini-steps">
      <h3>Quick Steps</h3>
      <ol>
        <li>Confirm slug: <code>byteverse-1-0</code> in dashboard.</li>
        <li>Add approved HTTPS domain.</li>
        <li>Wait for verification.</li>
        <li>Button → Apply.</li>
      </ol>
    </div>

    <p class="dv-fallback">Button missing? <a href="https://devfolio.co/" target="_blank" rel="noopener" class="dv-link">Open Devfolio</a></p>
  </section>
</main>

<script defer async src="https://apply.devfolio.co/v2/sdk.js" id="devfolioSDK"></script>
<script>
(function(){
  const btn   = document.getElementById('devfolioApply');
  const wrap  = document.getElementById('devfolioBtnWrap');
  const skel  = document.getElementById('dvSkeleton');
  const tog   = document.querySelector('.dv-theme-toggle');
  let tries = 0;
  const poll = setInterval(()=>{
    tries++;
    if (window.Devfolio || tries > 40) {
      skel?.classList.add('hidden');
      clearInterval(poll);
    }
  },200);

  tog?.addEventListener('click', e=>{
    const b = e.target.closest('button[data-theme]');
    if(!b) return;
    tog.querySelectorAll('button').forEach(x=>x.classList.remove('active'));
    b.classList.add('active');
    const theme = b.getAttribute('data-theme');
    btn?.setAttribute('data-button-theme', theme);
    wrap?.classList.remove('theme-light','theme-dark','theme-dark-inverted');
    wrap?.classList.add('theme-'+theme);
    // Force re-render
    const clone = btn.cloneNode(true);
    btn.parentNode.replaceChild(clone, btn);
  });
})();
</script>

<style>
.dv-wrapper{max-width:920px;margin:0 auto;padding:2.5rem 1.25rem 4rem;font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;color:#e9faff}
.dv-hero{position:relative;border:1px solid #0d4f63;border-radius:26px;padding:2.6rem 2rem 2.8rem;margin-bottom:2.2rem;background:#041d27;overflow:hidden}
.dv-hero:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 18% 22%,rgba(0,193,255,.35),transparent 65%)}
.dv-title{margin:0 0 .9rem;font-size:clamp(2.1rem,4.1vw,3rem);line-height:1.12;font-weight:800;background:linear-gradient(90deg,#8fe9ff,#fff);-webkit-background-clip:text;color:transparent}
.dv-sub{margin:0 0 1.1rem;font-size:1.02rem;line-height:1.55;max-width:62ch;color:#c8e9f4}
.dv-facts{list-style:none;padding:0;margin:0;display:flex;flex-wrap:wrap;gap:.6rem;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;font-weight:600}
.dv-facts li{background:rgba(0,170,210,.18);border:1px solid rgba(0,200,255,.35);padding:.5rem .85rem;border-radius:999px;color:#d8faff}

.dv-panel{background:#072c39;border:1px solid #0d5065;border-radius:22px;padding:1.9rem 1.6rem;position:relative;overflow:hidden}
.dv-panel:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 16% 20%,rgba(0,190,255,.25),transparent 60%)}
.dv-panel>*{position:relative}
.dv-h2{margin:0 0 .85rem;font-size:1.45rem;font-weight:700;background:linear-gradient(90deg,#83def5,#fff);-webkit-background-clip:text;color:transparent}
.dv-text{margin:0 0 1.1rem;font-size:.95rem;line-height:1.55;color:#d2f2fc;max-width:60ch}

.dv-btn-wrap{position:relative;display:flex;align-items:center;justify-content:center;min-height:70px;padding:1.1rem 1.2rem;border-radius:16px;background:#083846;border:1px solid #0d5a70;width:100%;max-width:380px}
.dv-skeleton{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.55rem;position:absolute;inset:0;background:#08323e;border-radius:inherit;font-size:.68rem;color:#b9dce6;letter-spacing:.08em}
.dv-skeleton.hidden{display:none}
.dv-shimmer{width:150px;height:12px;border-radius:6px;overflow:hidden;position:relative;background:#0d5c73}
.dv-shimmer:before{content:"";position:absolute;inset:0;background:linear-gradient(110deg,#0d5c73 0%,#1292b6 50%,#0d5c73 100%);animation:sh 1.35s linear infinite;background-size:200% 100%}
@keyframes sh{to{background-position:-200% 0}}

.dv-theme-toggle{display:flex;gap:.55rem;margin:1rem 0 .2rem}
.dv-theme-toggle button{background:#0b4050;border:1px solid #116b86;color:#c7f6ff;font-size:.62rem;font-weight:600;padding:.5rem .85rem;border-radius:8px;cursor:pointer;letter-spacing:.15em;transition:.25s;text-transform:uppercase}
.dv-theme-toggle button.active,
.dv-theme-toggle button:hover{background:#0c92b8;color:#fff;border-color:#2bd7ff}

.dv-mini-steps{margin:1.4rem 0 .6rem;max-width:560px}
.dv-mini-steps h3{margin:0 0 .55rem;font-size:.85rem;letter-spacing:.14em;text-transform:uppercase;font-weight:700;color:#8eeeff}
.dv-mini-steps ol{margin:0;padding-left:1.1rem;display:grid;gap:.4rem}
.dv-mini-steps li{font-size:.78rem;line-height:1.35;color:#d1edf7}
.dv-mini-steps code{background:#063040;padding:.15rem .4rem;border-radius:5px;font-size:.7rem;color:#8fe8ff}

.dv-fallback{font-size:.7rem;margin-top:.5rem;color:#8fb9c7}
.dv-link{color:#6be1ff;font-weight:600;text-decoration:none}
.dv-link:hover{text-decoration:underline}

.theme-dark #devfolioApply{filter:brightness(.9)}
.theme-dark-inverted #devfolioApply{filter:invert(1) hue-rotate(180deg)}

@media (max-width:600px){
  .dv-hero{padding:2.2rem 1.2rem 2.4rem}
  .dv-title{font-size:2.15rem}
  .dv-btn-wrap{max-width:100%}
  .dv-panel{padding:1.6rem 1.15rem}
}
</style>

<?php require_once 'components/footer.php'; ?>