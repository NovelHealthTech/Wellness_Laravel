<x-retailer.header />

<style>
  body { background: #f0f5fb; }

  /* ── HERO ── */
  .doc-hero {
    background: linear-gradient(135deg, #1e4fa3 0%, #3d7cc9 60%, #60a5e8 100%);
    padding: 52px 0 70px;
    position: relative;
    overflow: hidden;
  }

  .doc-hero::after {
    content: '';
    position: absolute;
    bottom: -2px; left: 0; right: 0;
    height: 50px;
    background: #f0f5fb;
    clip-path: ellipse(55% 100% at 50% 100%);
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 16px;
  }

  .doc-hero h1 {
    color: #fff !important;
    font-size: 40px !important;
    font-weight: 800 !important;
    letter-spacing: -1px !important;
    margin-bottom: 10px;
  }

  .doc-hero p {
    color: rgba(255,255,255,0.82) !important;
    font-size: 16px !important;
    margin-bottom: 24px;
  }

  .price-tag {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.15);
    border: 1.5px solid rgba(255,255,255,0.35);
    border-radius: 12px;
    padding: 10px 22px;
    color: #fff;
  }

  .price-tag .price-label {
    font-size: 13px;
    font-weight: 500;
    opacity: 0.8;
  }

  .price-tag .price-amount {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -0.5px;
  }

  /* ── FEATURES STRIP ── */
  .features-strip {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e4e7ec;
    box-shadow: 0 4px 20px rgba(37,99,235,0.07);
    padding: 24px 28px;
    margin-top: -30px;
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
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    border: 1.5px solid #dbeafe;
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
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e4e7ec;
    box-shadow: 0 4px 20px rgba(37,99,235,0.07);
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
    width: 4px;
    height: 22px;
    background: #3d7cc9;
    border-radius: 4px;
    flex-shrink: 0;
  }

  /* ── PROCESS LIST ── */
  .process-list {
    list-style: none;
    padding: 0;
    margin: 0;
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
    border: 1px solid #dbeafe;
    border-radius: 10px;
    font-size: 14px;
    color: #374151;
    line-height: 1.6;
    transition: background 0.2s, border-color 0.2s;
  }

  .process-list li:hover {
    background: #eff6ff;
    border-color: #93c5fd;
  }

  .step-num {
    width: 28px;
    height: 28px;
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
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e4e7ec;
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

  .card-price span {
    font-size: 16px;
    font-weight: 500;
    opacity: 0.8;
  }

  .purchase-card-body { padding: 24px; }

  .btn-purchase {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #c61d29, #ef4444);
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
    padding: 0;
    margin: 0;
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
    width: 20px;
    height: 20px;
    border-radius: 6px;
    background: #eff6ff;
    border: 1.5px solid #dbeafe;
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
    background: linear-gradient(135deg, #c61d29, #ef4444);
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

  .toll-free .tf-time {
    font-size: 11.5px;
    opacity: 0.8;
    margin-top: 2px;
  }

  /* ── TRUST BADGES ── */
  .trust-row {
    display: flex;
    gap: 8px;
    margin-top: 16px;
  }

  .trust-badge {
    flex: 1;
    background: #f8faff;
    border: 1px solid #dbeafe;
    border-radius: 8px;
    padding: 8px 6px;
    text-align: center;
    font-size: 11px;
    font-weight: 600;
    color: #3d7cc9;
  }

  @media (max-width: 768px) {
    .doc-hero h1 { font-size: 28px !important; }
    .features-strip { margin-top: 16px; }
    .purchase-card { position: static; margin-top: 24px; }
    .trust-row { flex-wrap: wrap; }
  }
</style>

<!-- ── HERO ── -->
<div class="doc-hero">
  <div class="container">
    <div class="hero-badge">🩺 Online Health Service</div>
    <h1>Doctor On Call</h1>
    <p>Best Online Consultation Service</p>
    <div class="price-tag">
      <div>
        <div class="price-label">One-time price</div>
        <div class="price-amount">Rs. 499</div>
      </div>
    </div>
  </div>
</div>

<!-- ── FEATURES STRIP ── -->


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
            <a href="tel:18001200260" style="color:#fff; font-weight:700;"> 18001200260</a>
            [10-6pm]
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