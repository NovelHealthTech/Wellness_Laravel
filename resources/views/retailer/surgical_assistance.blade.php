<x-retailer.header />

@php
  $cities = ["Bangalore", "Chennai", "Hyderabad", "Agra", "Ahmedabad", "Bhopal", "Bhubaneswar", "Chandigarh", "Coimbatore", "Dehradun", "Delhi", "Faridabad", "Ghaziabad", "Gurgaon", "Guwahati", "Gwalior", "Indore", "Jaipur", "Jammu", "Kanpur", "Kochi", "Kolkata", "Kozhikode", "Lucknow", "Ludhiana", "Madurai", "Meerut", "Mumbai", "Mysore", "Nagpur", "Nashik", "Noida", "Patna", "Pune", "Raipur", "Ranchi", "Siliguri", "Surat", "Thiruvananthapuram", "Vadodara", "Vijayawada", "Visakhapatnam"];

  $diseases = ["Abortion", "ACL Tear", "Adenoidectomy", "Anal Fissure", "Anal Fistula", "Appendicitis", "Arthroscopy", "Breast Lift", "Carpal Tunnel Syndrome", "Cataract Surgery", "Circumcision", "Clitoral Hoodoplasty", "Cystoscopy", "Deep Vein Thrombosis", "Deviated Nasal Septum", "Diabetic Foot Ulcer", "ENT Others", "Erectile Dysfunction", "Female Genital Problems", "Female Infertility", "Female Urinary Problems", "Gallstones", "Gynecomastia", "Hair Transplant", "Hernia", "Hip Replacement", "Hydrocele", "Hymenoplasty", "Hysterectomy", "Hysteroscopy", "Irregular Periods", "IUI", "IVF", "Kidney Stone", "Knee Replacement", "Labiaplasty", "Laser Vaginal Rejuvenation", "Laser Vaginal Tightening", "Lasik Surgery", "Lichen Sclerosus", "Lipoma", "Liposuction", "Male Infertility", "Male Urinary Tract Infection", "Mastoidectomy", "Medical Termination Of Pregnancy", "Menstrual Disorders", "Microlaryngeal", "Myringotomy", "Ovarian Cyst", "Pain During Intercourse", "Pap Smear", "PCOS PCOD", "Pelvic Pain", "Phimosis", "Piles", "Pilonidal Sinus", "Preconception Care", "Pregnancy Care", "Prostate Enlargement", "Rectal Prolapse", "Rhinoplasty", "Ruptured Eardrum", "Sebaceous Cyst", "Septoplasty", "Sinusitis", "Spider Veins", "Stress Urinary Incontinence", "Tongue base reduction", "Tonsillitis", "Turbinate Reduction", "Umbilical Hernia", "Urethral Stricture", "Urinary Incontinence", "Urinary Tract Infection", "Uterine Fibroid", "Uvulopalatopharyngoplasty", "Vaginal Cyst", "Vaginal Discharge", "Vaginal Dryness", "Vaginal Recurrent Infection", "Vaginoplasty", "Varicocele", "Varicose Veins"];

  $benefits = [
    ['icon' => 'bi-person-badge',       'bold' => 'Quality Surgeons',           'text' => 'Full time registered surgeons with 8–20 years of experience'],
    ['icon' => 'bi-percent',            'bold' => '100% Discount / Waiver',     'text' => 'On non-payables & consumables not covered under insurance'],
    ['icon' => 'bi-cpu',               'bold' => 'Advanced Medical Equipment', 'text' => 'State-of-the-art technology for every procedure'],
    ['icon' => 'bi-clipboard2-pulse',   'bold' => 'Pre-booked Diagnostics',     'text' => 'All diagnostic tests arranged before your surgery'],
    ['icon' => 'bi-wallet2',            'bold' => 'No Pre/Post Expenditure',    'text' => 'All consultations are completely free of charge'],
    ['icon' => 'bi-clock-history',      'bold' => 'No Waiting Involved',        'text' => 'We handle your entire admission & discharge process'],
    ['icon' => 'bi-car-front',          'bold' => 'Free Pick & Drop + Meals',   'text' => 'Complimentary transport and meal arrangements'],
    ['icon' => 'bi-bank',              'bold' => 'Interest-Free Loan',         'text' => 'Easy EMI options with zero interest financing'],
  ];
@endphp

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy:     #0f172a;
    --navy-2:   #1e293b;
    --teal:     #0d9488;
    --teal-l:   #f0fdfa;
    --teal-m:   #99f6e4;
    --teal-d:   #0f766e;
    --border:   #e2e8f0;
    --border-t: #ccfbf1;
    --bg:       #f8fafc;
    --slate:    #475569;
    --muted:    #94a3b8;
    --white:    #ffffff;
    --green:    #16a34a;
    --green-l:  #f0fdf4;
    --red:      #dc2626;
    --font:     'Sora', sans-serif;
    --body:     'DM Sans', sans-serif;
    --shadow:   0 4px 16px rgba(15,23,42,0.07), 0 1px 4px rgba(15,23,42,0.04);
  }

  body {
    background: var(--bg) !important;
    font-family: var(--body);
    color: var(--navy);
    align-items: stretch !important;
  }

  .page-wrap { width: 100%; }

  /* ── HERO (matches allpackages style) ── */
  .appt-hero {
    width: 100%;
    background: #1f3964;
    padding: 48px 60px 44px;
    position: relative;
    overflow: hidden;
  }

  .appt-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 55% 120% at 100% 50%, rgba(13,148,136,0.22) 0%, transparent 65%),
      radial-gradient(ellipse 30% 80%  at 0%   0%, rgba(153,246,228,0.10) 0%, transparent 55%);
    pointer-events: none;
  }

  .appt-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
  }

  .hero-inner {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
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

  .back-link:hover          { color: var(--teal-m); }
  .back-link:hover svg      { transform: translateX(-3px); }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(13,148,136,0.18);
    border: 1px solid rgba(153,246,228,0.4);
    border-radius: 50px;
    font-family: var(--font);
    font-size: 11px;
    font-weight: 700;
    color: var(--teal-m);
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 16px;
  }

  .hero-badge span {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--teal-m);
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0%,100% { opacity:1; transform:scale(1);   }
    50%      { opacity:.6; transform:scale(1.3); }
  }

  .appt-hero h1 {
    font-family: var(--font);
    font-size: clamp(24px, 3vw, 38px);
    font-weight: 800;
    color: var(--white);
    letter-spacing: -0.8px;
    line-height: 1.15;
    margin-bottom: 12px;
  }

  .appt-hero h1 span { color: var(--teal-m); }

  .appt-hero p {
    font-size: 15px;
    color: rgba(255,255,255,0.55);
    max-width: 520px;
    line-height: 1.65;
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

  .hstat-value.teal { color: var(--teal-m); }

  /* ── CONTENT ── */
  .content-wrap {
    width: 100%;
    padding: 44px 60px 80px;
  }

  .content-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 28px;
    align-items: start;
  }

  /* ── CARD ── */
  .card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
  }

  @keyframes fadeUp {
    from { opacity:0; transform:translateY(14px); }
    to   { opacity:1; transform:translateY(0);    }
  }

  .card:nth-child(2) { animation-delay: 0.09s; }

  .card-head {
    padding: 20px 28px;
    border-bottom: 1px solid var(--border);
    background: var(--white);
  }

  .card-head.dark {
    background: var(--navy-2);
    border-bottom: 1px solid rgba(255,255,255,0.07);
  }

  .card-head-title {
    font-family: var(--font);
    font-size: 15px;
    font-weight: 700;
    color: var(--navy-2);
    letter-spacing: -0.2px;
    margin: 0;
  }

  .card-head.dark .card-head-title { color: var(--white); }

  .card-head-sub { font-size: 12.5px; color: var(--muted); margin-top: 3px; }
  .card-head.dark .card-head-sub   { color: rgba(255,255,255,0.4); }

  .card-body { padding: 28px; }

  /* ── FORM ── */
  .field { display:flex; flex-direction:column; gap:6px; }

  .field label {
    font-family: var(--font);
    font-size: 11.5px;
    font-weight: 700;
    color: var(--slate);
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .field input,
  .field select {
    height: 46px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 0 14px;
    font-family: var(--body);
    font-size: 14px;
    color: var(--navy);
    background: var(--bg);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    appearance: none;
    -webkit-appearance: none;
  }

  .field select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 38px;
  }

  .field input:focus,
  .field select:focus {
    border-color: var(--teal);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(13,148,136,0.10);
  }

  .field input::placeholder { color: var(--muted); }

  .field .err {
    font-size: 12px;
    color: var(--red);
    font-weight: 500;
    min-height: 16px;
  }

  .submit-btn {
    width: 100%;
    height: 50px;
    margin-top: 8px;
    background: linear-gradient(135deg, var(--teal-d), var(--teal));
    color: var(--white);
    font-family: var(--font);
    font-size: 14.5px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    letter-spacing: 0.2px;
    box-shadow: 0 4px 14px rgba(13,148,136,0.30);
    transition: transform 0.18s, box-shadow 0.18s, opacity 0.18s;
  }

  .submit-btn:hover  { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(13,148,136,0.38); }
  .submit-btn:active { transform: translateY(0); opacity: 0.9; }

  .submit-btn svg {
    width: 16px; height: 16px;
    stroke: currentColor; fill: none;
    stroke-width: 2.3;
    stroke-linecap: round; stroke-linejoin: round;
  }

  /* ── BENEFITS ── */
  .benefits-list { display:flex; flex-direction:column; gap:0; }

  .benefit-row {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #f1f5f9;
    animation: fadeUp 0.4s ease both;
    transition: background 0.15s, padding 0.15s;
    border-radius: 8px;
  }

  .benefit-row:last-child { border-bottom: none; }

  .benefit-row:hover {
    background: var(--teal-l);
    padding-left: 12px;
    padding-right: 12px;
    margin: 0 -12px;
  }

  .benefit-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: var(--teal-l);
    border: 1px solid var(--border-t);
    color: var(--teal-d);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
    margin-top: 2px;
    transition: background 0.15s;
  }

  .benefit-row:hover .benefit-icon { background: rgba(13,148,136,0.15); }

  .benefit-content { flex: 1; }

  .benefit-title {
    font-family: var(--font);
    font-size: 13.5px;
    font-weight: 700;
    color: var(--navy-2);
    margin-bottom: 3px;
  }

  .benefit-desc { font-size: 13px; color: var(--muted); line-height: 1.5; }

  /* ── RESPONSIVE ── */
  @media (max-width: 1060px) {
    .content-grid          { grid-template-columns: 1fr; }
    .appt-hero,
    .content-wrap          { padding-left: 32px; padding-right: 32px; }
  }

  @media (max-width: 640px) {
    .appt-hero,
    .content-wrap          { padding-left: 18px; padding-right: 18px; }
    .appt-hero             { padding-top: 32px; padding-bottom: 28px; }
    .hero-stats            { gap: 16px; }
    .hstat                 { border-right: none; padding-right: 0; margin-right: 0; }
    .card-body             { padding: 20px; }
  }
</style>

<div class="page-wrap">

  {{-- ── HERO ── --}}
  <div class="appt-hero">
    <div class="hero-inner">
      <div>
        <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
          <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
          Back to Home
        </a>

        <div class="hero-badge"><span></span> Pristyn Care</div>

        <h1>Book Your <span>Appointment</span></h1>
        <p>Expert surgeons, zero waiting, and complete care — from consultation to recovery.</p>

      </div>
    </div>
  </div>
  {{-- ── CONTENT ── --}}
  <div class="content-wrap">
    <div class="content-grid">

      {{-- LEFT: Benefits --}}
      <div class="card" style="animation-delay:0.10s;">
        <div class="card-head dark">
          <div class="card-head-title">Why Choose Pristyn Care?</div>
          <div class="card-head-sub">Simplifying surgery for you and your loved ones</div>
        </div>
        <div class="card-body">
          <div class="benefits-list">
            @foreach($benefits as $i => $b)
              <div class="benefit-row" style="animation-delay:{{ $i * 0.05 + 0.15 }}s;">
                <div class="benefit-icon">
                  <i class="bi {{ $b['icon'] }}"></i>
                </div>
                <div class="benefit-content">
                  <div class="benefit-title">{{ $b['bold'] }}</div>
                  <div class="benefit-desc">{{ $b['text'] }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- RIGHT: Form --}}
      <div class="card" style="animation-delay:0.05s; position:sticky; top:24px;">
        <div class="card-head">
          <div class="card-head-title">Fill Appointment Details</div>
          <div class="card-head-sub">All fields marked * are required</div>
        </div>
        
        <div class="card-body">
          <form action="{{ route('retailer.surgical_assistance_form_submit') }}" method="POST">
            @csrf
            <div style="display:flex; flex-direction:column; gap:18px;">
              {{-- Patient Name --}}
              <div class="field">
                <label>Patient Name *</label>
                <input type="text" name="patient_name" placeholder="Enter full name"
                  value="{{ old('patient_name') }}" required>
                @error('patient_name')
                  <span class="err">{{ $message }}</span>
                @enderror
              </div>

              {{-- Mobile --}}
              <div class="field">
                <label>Mobile Number *</label>
                <input type="tel" name="mobile_number" placeholder="10-digit mobile number"
                  maxlength="10" value="{{ old('mobile_number') }}" required>
                @error('mobile_number')
                  <span class="err">{{ $message }}</span>
                @enderror
              </div>

              {{-- City --}}
              <div class="field">
                <label>City *</label>
                <select name="city" required>
                  <option value="">Select your city</option>
                  @foreach($cities as $city)
                    <option value="{{ $city }}" {{ old('city') === $city ? 'selected' : '' }}>
                      {{ $city }}
                    </option>
                  @endforeach
                </select>
                @error('city')
                  <span class="err">{{ $message }}</span>
                @enderror
              </div>

              {{-- Disease --}}
              <div class="field">
                <label>Condition / Procedure *</label>
                <select name="disease" required>
                  <option value="">Select condition</option>
                  @foreach($diseases as $d)
                    <option value="{{ $d }}" {{ old('disease') === $d ? 'selected' : '' }}>
                      {{ $d }}
                    </option>
                  @endforeach
                </select>
                @error('disease')
                  <span class="err">{{ $message }}</span>
                @enderror
              </div>

              {{-- Submit --}}
              <button type="submit" class="submit-btn" onclick="show_loader()">
                <svg viewBox="0 0 24 24">
                  <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                </svg>
                Book Appointment
              </button>

            </div>
          </form>

        </div>
      </div>

    </div>
  </div>

</div>

<x-retailer.footer />