<x-retailer.header />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy:     #0f172a;
    --navy-2:   #1e293b;
    --blue:     #2563eb;
    --blue-l:   #eff6ff;
    --blue-m:   #93c5fd;
    --blue-d:   #1d4ed8;
    --border:   #e2e8f0;
    --border-b: #bfdbfe;
    --bg:       #f0f5fb;
    --slate:    #475569;
    --muted:    #94a3b8;
    --white:    #ffffff;
    --red:      #c61d29;
    --red-2:    #ef4444;
    --font:     'Sora', sans-serif;
    --body:     'DM Sans', sans-serif;
    --shadow:   0 4px 20px rgba(37,99,235,0.07);
  }

  body {
    background: var(--bg) !important;
    font-family: var(--body);
    color: var(--navy);
    align-items: stretch !important;
  }

  /* ── HERO (allpackages style) ── */
  .doc-hero {
    width: 100%;
    background: #1f3964;
    padding: 48px 0 44px;
    position: relative;
    overflow: hidden;
  }

  .doc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background:
      radial-gradient(ellipse 55% 120% at 100% 50%, rgba(37,99,235,0.25) 0%, transparent 65%),
      radial-gradient(ellipse 30% 80%  at 0%   0%, rgba(147,197,253,0.12) 0%, transparent 55%);
    pointer-events: none;
  }

  .doc-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background-image:
      linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
  }

  .doc-hero .container {
    position: relative;
    z-index: 1;
  }

  .hero-inner {
    position: relative;
    z-index: 1;
  }

  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font);
    font-size: 12.5px;
    font-weight: 600;
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    margin-bottom: 20px;
    transition: color 0.2s;
  }

  .back-link svg {
    width: 14px; height: 14px;
    stroke: currentColor; fill: none;
    stroke-width: 2.3;
    stroke-linecap: round; stroke-linejoin: round;
    transition: transform 0.2s;
  }

  .back-link:hover        { color: var(--blue-m); }
  .back-link:hover svg    { transform: translateX(-3px); }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(37,99,235,0.2);
    border: 1px solid rgba(147,197,253,0.4);
    border-radius: 50px;
    font-family: var(--font);
    font-size: 11px;
    font-weight: 700;
    color: var(--blue-m);
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 16px;
  }

  .hero-badge span {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--blue-m);
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0%,100% { opacity:1; transform:scale(1);   }
    50%      { opacity:.6; transform:scale(1.3); }
  }

  .doc-hero h1 {
    font-family: var(--font);
    font-size: clamp(24px, 3vw, 38px) !important;
    font-weight: 800 !important;
    color: var(--white) !important;
    letter-spacing: -0.8px !important;
    line-height: 1.15 !important;
    margin-bottom: 12px !important;
  }

  .doc-hero p {
    font-size: 15px !important;
    color: rgba(255,255,255,0.55) !important;
    max-width: 520px;
    line-height: 1.65 !important;
    margin-bottom: 0 !important;
  }

  .hero-stats {
    display: flex;
    gap: 0;
    margin-top: 32px;
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-top: 24px;
    flex-wrap: wrap;
  }

  .hstat {
    padding: 0 28px 0 0;
    margin-right: 28px;
    border-right: 1px solid rgba(255,255,255,0.1);
  }

  .hstat:last-child { border-right: none; }

  .hstat-label {
    font-family: var(--font);
    font-size: 10px;
    font-weight: 700;
    color: rgba(255,255,255,0.35);
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 4px;
  }

  .hstat-value {
    font-family: var(--font);
    font-size: 18px;
    font-weight: 700;
    color: var(--white);
  }

  .hstat-value.blue { color: var(--blue-m); }

  /* ── FEATURES STRIP ── */
  .features-strip {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    padding: 24px 28px;
    position: relative;
    z-index: 2;
  }

  .feature-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
    padding: 8px;
  }

  .feature-icon-wrap {
    width: 56px; height: 56px;
    border-radius: 14px;
    background: var(--blue-l);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    border: 1.5px solid var(--border-b);
  }

  .feature-item p {
    font-size: 12.5px !important;
    font-weight: 600 !important;
    color: #374151 !important;
    margin: 0 !important;
    line-height: 1.4 !important;
  }

  /* ── MAIN CARD ── */
  .main-card {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    padding: 32px;
    margin-bottom: 24px;
  }

  .section-heading {
    font-size: 19px !important;
    font-weight: 700 !important;
    color: #3d7cc9 !important;
    letter-spacing: -0.4px !important;
    margin-bottom: 18px !important;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .section-heading::before {
    content: '';
    display: inline-block;
    width: 4px; height: 22px;
    background: #3d7cc9;
    border-radius: 4px;
    flex-shrink: 0;
  }

  /* ── PROCESS LIST ── */
  .process-list {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .process-list li {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 16px;
    background: #f8faff;
    border: 1px solid var(--border-b);
    border-radius: 10px;
    font-size: 14px;
    color: #374151;
    line-height: 1.6;
    transition: background 0.2s, border-color 0.2s;
  }

  .process-list li:hover {
    background: var(--blue-l);
    border-color: var(--blue-m);
  }

  .step-num {
    width: 28px; height: 28px;
    border-radius: 8px;
    background: #3d7cc9;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
  }

  /* ── PURCHASE CARD ── */
  .purchase-card {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 8px 32px rgba(37,99,235,0.10);
    overflow: hidden;
    position: sticky;
    top: 90px;
  }

  .purchase-card-header {
    background: linear-gradient(135deg, #1e4fa3, #3d7cc9);
    padding: 24px;
    text-align: center;
    color: #fff;
  }

  .purchase-card-header h3 {
    color: #fff !important;
    font-size: 20px !important;
    font-weight: 700 !important;
    margin-bottom: 4px !important;
  }

  .card-price {
    font-size: 38px;
    font-weight: 800;
    letter-spacing: -1px;
    color: #fff;
  }

  .card-price span { font-size: 16px; font-weight: 500; opacity: 0.8; }

  .purchase-card-body { padding: 24px; }

  .btn-purchase {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, var(--red), var(--red-2));
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(198,29,41,0.35);
    transition: transform 0.18s, box-shadow 0.18s;
    margin-bottom: 20px;
  }

  .btn-purchase:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(198,29,41,0.45);
    color: #fff;
  }

  /* ── NOTES LIST ── */
  .notes-list {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .notes-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13.5px;
    color: #374151;
    line-height: 1.55;
  }

  .notes-list .dot {
    width: 20px; height: 20px;
    border-radius: 6px;
    background: var(--blue-l);
    border: 1.5px solid var(--border-b);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
    font-size: 11px;
    color: #3d7cc9;
  }

  /* ── TOLL FREE ── */
  .toll-free {
    background: linear-gradient(135deg, var(--red), var(--red-2));
    border-radius: 10px;
    padding: 14px 18px;
    color: #fff;
    text-align: center;
    margin-top: 16px;
  }

  .toll-free .tf-label {
    font-size: 11px;
    font-weight: 600;
    opacity: 0.85;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 4px;
  }

  .toll-free a {
    color: #fff !important;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.5px;
    text-decoration: none;
    display: block;
  }

  .toll-free .tf-time { font-size: 11.5px; opacity: 0.8; margin-top: 2px; }

  /* ── TRUST BADGES ── */
  .trust-row { display: flex; gap: 8px; margin-top: 16px; }

  .trust-badge {
    flex: 1;
    background: #f8faff;
    border: 1px solid var(--border-b);
    border-radius: 8px;
    padding: 8px 6px;
    text-align: center;
    font-size: 11px;
    font-weight: 600;
    color: #3d7cc9;
  }

  @media (max-width: 992px) {
    /* container handles responsive padding */
  }

  @media (max-width: 768px) {
    .doc-hero          { padding-top: 32px; padding-bottom: 28px; }
    .doc-hero h1       { font-size: 26px !important; }
    .features-strip    { margin-top: 0; }
    .purchase-card     { position: static; margin-top: 24px; }
    .trust-row         { flex-wrap: wrap; }
    .hero-stats        { gap: 16px; }
    .hstat             { border-right: none; padding-right: 0; margin-right: 0; }
  }
</style>

<!-- ── HERO ── -->
<div class="doc-hero">
  <div class="container">
    <div class="hero-inner">
    <div>
      <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Home
      </a>

      <div class="hero-badge"><span></span> Online Health Service</div>

      <h1>Doctor On Call</h1>
      <p>Best Online Consultation Service — MBBS doctors, multilingual support, and instant prescriptions.</p>

      <div class="hero-stats">
        <div class="hstat">
          <div class="hstat-label">Price</div>
          <div class="hstat-value blue">Rs. 499</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Consultations</div>
          <div class="hstat-value">5 / Year</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Call Type</div>
          <div class="hstat-value">Voice &amp; Video</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Prescription</div>
          <div class="hstat-value blue">Instant PDF</div>
        </div>
      </div>
    </div>
    </div><!-- /.hero-inner -->
  </div><!-- /.container -->
</div><!-- /.doc-hero -->
<div class="container mt-4">
  <div class="features-strip">
    <div class="row g-3 justify-content-center text-center">
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">🩺</div>
          <p>MBBS Qualified Doctors</p>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">🌐</div>
          <p>Multilingual Support</p>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">📹</div>
          <p>Voice &amp; Video Calls</p>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">📋</div>
          <p>Instant Prescription PDF</p>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">💬</div>
          <p>WhatsApp Report Upload</p>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="feature-item">
          <div class="feature-icon-wrap">🔁</div>
          <p>5 Consultations / Year</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── MAIN CONTENT ── -->
<div class="container mt-4 mb-5">
  <div class="row g-4">

    <!-- LEFT — Process -->
    <div class="col-md-7">
      <div class="main-card">
        <div class="section-heading">Process &amp; TAT for Doc-On-Call Services</div>
        <ul class="process-list">
          <li><span class="step-num">1</span> Customer will call from their registered mobile number on the Toll-free number 1800…</li>
          <li><span class="step-num">2</span> IVR system will automatically patch the call with the CRM of assigned language based on the registered mobile number.</li>
          <li><span class="step-num">3</span> CRM will validate the details of the customer and understand customer's requirement.</li>
          <li><span class="step-num">4</span> CRM will then schedule the appointment with the preferred language doctor and take verbal confirmation from the customer.</li>
          <li><span class="step-num">5</span> TAT for consultation with the doctor is minimum 30 min depending on the availability of the doctor's slot.</li>
          <li><span class="step-num">6</span> Reminder message will be shared with the customer 5 min prior to scheduled consultation.</li>
          <li><span class="step-num">7</span> Post consultation the prescription will be shared immediately or maximum within 10 minutes.</li>
          <li><span class="step-num">8</span> Call back will be arranged from our CRM team within 24 hrs for each and every missed/dropped calls.</li>
        </ul>
      </div>
    </div>

    <!-- RIGHT — Purchase -->
    <div class="col-md-5">
      <div class="purchase-card">

        <div class="purchase-card-header">
          <h3>Doctor On Call Package</h3>
          <div class="card-price"><span>Rs. </span>499</div>
          <div style="font-size:13px; opacity:0.8; margin-top:4px;">One-time · 5 Consultations/year</div>
        </div>

        <div class="purchase-card-body">

          <form action="#" method="POST">
            @csrf
            <button type="submit" class="btn-purchase">
              🛒 Purchase Now Only @ Rs. 499
            </button>
          </form>

          <div class="need-help">To Avail the Services and benefits of the package.</div>
          <div class="need-help">
            Call this Toll-free Number
            <a href="tel:18001200260" style="color:#3d7cc9; font-weight:700;"> 18001200260</a>
            [10am-6pm]
          </div>

          <div class="section-heading mt-3" style="font-size:16px !important; margin-bottom:14px !important;">Notes</div>

          <ul class="notes-list">
            <li><span class="dot">✓</span> Upto 5 free Online Consultations in a year.</li>
            <li><span class="dot">✓</span> GP Consultations provided through Inhouse team of Qualified MBBS Doctors.</li>
            <li><span class="dot">✓</span> Multilingual Team of Doctors and Customer Relationship Managers.</li>
            <li><span class="dot">✓</span> Voice and Video Calls.</li>
            <li><span class="dot">✓</span> Facility of uploading Test reports through Whatsapp.</li>
            <li><span class="dot">✓</span> Immediate Prescription sharing in PDF format after each consultation.</li>
          </ul>

          <div class="trust-row">
            <div class="trust-badge">🔒 Secure Payment</div>
            <div class="trust-badge">✅ Instant Access</div>
            <div class="trust-badge">🏆 Trusted</div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<x-retailer.footer />