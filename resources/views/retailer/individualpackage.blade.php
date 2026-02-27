<x-retailer.header />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0f172a;
    --navy-2: #1e293b;
    --teal: #0d9488;
    --teal-l: #f0fdfa;
    --teal-m: #99f6e4;
    --teal-d: #0f766e;
    --slate: #475569;
    --muted: #94a3b8;
    --border: #e2e8f0;
    --border-t: #ccfbf1;
    --bg: #f8fafc;
    --white: #ffffff;
    --amber: #d97706;
    --amber-l: #fefce8;
    --red: #dc2626;
    --red-l: #fef2f2;
    --green: #16a34a;
    --green-l: #f0fdf4;
    --font: 'Sora', sans-serif;
    --body: 'DM Sans', sans-serif;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.04);
    --shadow: 0 4px 16px rgba(15, 23, 42, 0.07), 0 1px 4px rgba(15, 23, 42, 0.04);
    --shadow-lg: 0 12px 40px rgba(15, 23, 42, 0.10), 0 4px 12px rgba(15, 23, 42, 0.05);
  }

  body {
    background: var(--bg) !important;
    font-family: var(--body);
    color: var(--navy);
    line-height: 1.6;
    align-items: stretch !important;
  }

  .page-wrap { width: 100%; }

  /* ── HERO ── */
  .pkg-hero {
    width: 100%;
    background: #1f3964;
    padding: 48px 60px 44px;
    position: relative;
    overflow: hidden;
  }
  .pkg-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 55% 120% at 100% 50%, rgba(13,148,136,0.18) 0%, transparent 65%),
      radial-gradient(ellipse 30% 80% at 0% 0%, rgba(13,148,136,0.08) 0%, transparent 55%);
    pointer-events: none;
  }
  .pkg-hero::after {
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
    letter-spacing: 0.3px;
    transition: color 0.2s;
  }
  .back-link svg {
    width: 14px; height: 14px;
    stroke: currentColor; fill: none;
    stroke-width: 2.3;
    stroke-linecap: round; stroke-linejoin: round;
    transition: transform 0.2s;
  }
  .back-link:hover { color: var(--teal-m); }
  .back-link:hover svg { transform: translateX(-3px); }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(13,148,136,0.18);
    border: 1px solid rgba(13,148,136,0.35);
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
    background: var(--teal);
    animation: pulse 2s infinite;
  }
  @keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.6; transform: scale(1.3); }
  }
  .pkg-hero h1 {
    font-family: var(--font);
    font-size: clamp(24px, 3vw, 38px);
    font-weight: 800;
    color: var(--white);
    letter-spacing: -0.8px;
    line-height: 1.15;
    margin-bottom: 12px;
  }
  .pkg-hero p {
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
  .content-area {
    width: 100%;
    padding: 40px 60px 80px;
  }
  .content-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 28px;
    align-items: start;
  }
  @media (max-width: 1100px) {
    .content-inner { grid-template-columns: 1fr; }
    .pkg-hero, .content-area { padding-left: 32px; padding-right: 32px; }
    .purchase-card { position: static !important; }
  }
  @media (max-width: 640px) {
    .pkg-hero, .content-area { padding-left: 18px; padding-right: 18px; }
    .pkg-hero { padding-top: 32px; padding-bottom: 28px; }
    .hero-stats { gap: 16px; }
    .hstat { border-right: none; padding-right: 0; margin-right: 0; }
  }

  /* ── CARD BASE ── */
  .card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
  }
  .card + .card { margin-top: 20px; }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .card:nth-child(2) { animation-delay: 0.08s; }
  .card:nth-child(3) { animation-delay: 0.14s; }

  .card-head {
    padding: 22px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .card-head-title {
    font-family: var(--font);
    font-size: 15px;
    font-weight: 700;
    color: var(--navy-2);
    letter-spacing: -0.2px;
  }
  .card-body { padding: 24px 28px; }

  .count-badge {
    font-family: var(--font);
    font-size: 11px;
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 50px;
    background: var(--teal-l);
    color: var(--teal-d);
    border: 1px solid var(--border-t);
  }

  /* ── TESTS ── */
  .tests-list { list-style: none; padding: 0; margin: 0; }
  .test-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.15s, padding 0.15s;
    border-radius: 6px;
  }
  .test-row:last-child { border-bottom: none; }
  .test-row:hover { background: var(--teal-l); padding-left: 10px; padding-right: 10px; margin: 0 -10px; }
  .test-check {
    width: 20px; height: 20px;
    border-radius: 50%;
    background: var(--green-l);
    color: var(--green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    flex-shrink: 0;
  }
  .test-name { font-size: 14px; color: var(--navy-2); font-weight: 400; flex: 1; }
  .test-row.extra { display: none; }
  .test-row.extra.show { display: flex; }
  .toggle-tests-btn {
    width: 100%;
    margin-top: 16px;
    padding: 12px;
    background: var(--bg);
    border: 1.5px dashed var(--border);
    border-radius: 10px;
    font-family: var(--font);
    font-size: 13px;
    font-weight: 700;
    color: var(--teal-d);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    transition: background 0.18s, border-color 0.18s;
  }
  .toggle-tests-btn:hover { background: var(--teal-l); border-color: var(--teal); }
  .toggle-tests-btn svg {
    width: 14px; height: 14px;
    stroke: currentColor; fill: none;
    stroke-width: 2.5;
    stroke-linecap: round; stroke-linejoin: round;
    transition: transform 0.25s;
  }
  .toggle-tests-btn.open svg { transform: rotate(180deg); }

  .about-text { font-size: 14.5px; color: var(--slate); line-height: 1.75; }

  /* ── PURCHASE CARD ── */
  .purchase-card { position: sticky; top: 24px; }
  .purchase-card .card-head {
    background: var(--navy-2);
    border-bottom: 1px solid rgba(255,255,255,0.07);
  }
  .purchase-card .card-head-title { color: var(--white); }

  /* ── VENDORS LIST ── */
  .vendors-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 20px 22px;
  }

  .vendor-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 16px 18px;
    border: 2px solid var(--border);
    border-radius: 12px;
    background: var(--white);
    text-decoration: none;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
    position: relative;
    overflow: hidden;
  }
  .vendor-option::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--teal);
    opacity: 0;
    transition: opacity 0.2s;
  }
  .vendor-option:hover {
    border-color: var(--teal);
    box-shadow: 0 4px 16px rgba(13,148,136,0.14);
    transform: translateY(-2px);
  }
  .vendor-option:hover::before { opacity: 1; }
  .vendor-option.in-cart { border-color: var(--teal); background: var(--teal-l); }
  .vendor-option.in-cart::before { opacity: 1; }

  .vendor-info {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
  }
  .vendor-avatar {
    width: 42px; height: 42px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--teal-d), var(--teal));
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font);
    font-size: 17px;
    font-weight: 800;
    color: var(--white);
    flex-shrink: 0;
    letter-spacing: -0.5px;
  }
  .vendor-avatar.srl     { background: linear-gradient(135deg, #0369a1, #0ea5e9); }
  .vendor-avatar.redcliff{ background: linear-gradient(135deg, #be123c, #f43f5e); }
  .vendor-avatar.tata    { background: linear-gradient(135deg, #7c2d12, #ea580c); }

  .vendor-details { display: flex; flex-direction: column; gap: 3px; }
  .vendor-name {
    font-family: var(--font);
    font-size: 13.5px;
    font-weight: 700;
    color: var(--navy-2);
  }
  .vendor-tag { font-size: 11px; color: var(--muted); font-weight: 400; }

  .vendor-right {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
  }
  .price-tag {
    font-family: var(--font);
    font-size: 20px;
    font-weight: 800;
    color: var(--teal-d);
    letter-spacing: -0.5px;
  }
  .in-cart-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 11px;
    background: var(--teal-l);
    border: 1px solid var(--border-t);
    border-radius: 50px;
    font-family: var(--font);
    font-size: 11.5px;
    font-weight: 700;
    color: var(--teal-d);
  }
  .remove-btn {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: var(--red-l);
    color: var(--red);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.15s;
    flex-shrink: 0;
  }
  .remove-btn:hover { background: #fecaca; }

  /* ── AVAILABILITY BOX ── */
  .avail-box {
    background: var(--bg);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .avail-box-title {
    font-family: var(--font);
    font-size: 12px;
    font-weight: 700;
    color: var(--slate);
    letter-spacing: 0.4px;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .avail-box-title i { color: var(--teal); font-size: 13px; }

  .avail-inputs {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .avail-inputs .form-control {
    border-radius: 8px !important;
    border: 1.5px solid var(--border);
    font-size: 13px;
    padding: 9px 12px;
    color: var(--navy-2);
    transition: border-color 0.2s, box-shadow 0.2s;
    width: 100%;
  }
  .avail-inputs .form-control:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
    outline: none;
  }
  .avail-inputs .form-control::placeholder { color: var(--muted); }

  .avail-submit-btn {
    width: 100%;
    padding: 10px 16px;
    background: var(--teal);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-family: var(--font);
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    transition: background 0.2s, transform 0.15s;
    letter-spacing: 0.2px;
  }
  .avail-submit-btn:hover {
    background: var(--teal-d);
    transform: translateY(-1px);
  }
  .avail-submit-btn:active { transform: translateY(0); }
  .avail-submit-btn.loading { opacity: 0.7; pointer-events: none; }

  .avail-error {
    font-size: 12px;
    color: var(--red);
    font-weight: 500;
    display: none;
  }
  .avail-error.show { display: block; }

  .avail-result {
    font-size: 12.5px;
    font-weight: 600;
    padding: 9px 12px;
    border-radius: 8px;
    display: none;
  }
  .avail-result.show { display: block; }
  .avail-result.success {
    background: var(--green-l);
    color: var(--green);
    border: 1px solid #bbf7d0;
  }
  .avail-result.unavailable {
    background: var(--red-l);
    color: var(--red);
    border: 1px solid #fecaca;
  }

  /* ── TRUST STRIP ── */
  .trust-strip {
    padding: 16px 22px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 9px;
  }
  .trust-item {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 12.5px;
    color: var(--slate);
    font-weight: 500;
  }
  .trust-icon {
    width: 22px; height: 22px;
    border-radius: 6px;
    background: var(--green-l);
    color: var(--green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    flex-shrink: 0;
  }
</style>

@php
  $description = json_decode($package->description);
  $tests = $description->tests ?? [];
@endphp

<div class="page-wrap">

  <!-- HERO -->
  <div class="pkg-hero">
    <div class="hero-inner">

      <a href="{{ route('retailer.allpackages') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        All Packages
      </a>

      <div class="hero-badge"><span></span> Active Package</div>

      <h1>{{ $package->packagename }}</h1>
      <p>{{ $package->short_description ?? 'A comprehensive health screening package curated from certified laboratories.' }}</p>

      <div class="hero-stats">
        <div class="hstat">
          <div class="hstat-label">Tests Included</div>
          <div class="hstat-value teal">{{ count($tests) }}</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Lab Partners</div>
          <div class="hstat-value">
            {{ collect(['srl','redcliff','tata1mg'])->filter(fn($k) => isset($data[$k]))->count() }}
          </div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Collection</div>
          <div class="hstat-value">Home / Centre</div>
        </div>
        {{-- <div class="hstat">
          <div class="hstat-label">Status</div>
          <div class="hstat-value teal">Available</div>
        </div> --}}
      </div>

    </div>
  </div>

  <!-- CONTENT -->
  <div class="content-area">
    <div class="content-inner">

      <!-- LEFT -->
      <div class="left-col">

        <!-- Tests Card -->
        <div class="card">
          <div class="card-head">
            <span class="card-head-title">Tests Included</span>
            <span class="count-badge">{{ count($tests) }} tests</span>
          </div>
          <div class="card-body">
            <ul class="tests-list" id="tl-{{ $package->id }}">
              @foreach($tests as $idx => $test)
                <li class="test-row {{ $idx >= 8 ? 'extra' : '' }}">
                  <span class="test-check"><i class="bi bi-check2"></i></span>
                  <span class="test-name">{{ $test }}</span>
                </li>
              @endforeach
            </ul>
            @if(count($tests) > 8)
              <button class="toggle-tests-btn" id="tb-{{ $package->id }}"
                onclick="toggleTests({{ $package->id }}, this)">
                <span class="btn-text">Show all {{ count($tests) }} tests</span>
                <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
            @endif
          </div>
        </div>

        <!-- About Card -->
        @if(!empty($package->full_description))
          <div class="card">
            <div class="card-head">
              <span class="card-head-title">About This Package</span>
            </div>
            <div class="card-body">
              <p class="about-text">{{ $package->full_description }}</p>
            </div>
          </div>
        @endif

      </div>

      <!-- RIGHT -->
      <div class="right-col">
        <div class="card purchase-card">

          <div class="card-head">
            <div class="card-head-title">Available Lab Partners</div>
          </div>

          <div class="vendors-list">

            {{-- REDCLIFFE --}}
            @if(isset($data['redcliff']))
              @php $inRed = in_array($package->id, $recliffcartpackages_ids); @endphp

              {{-- Vendor Row --}}
              <a href="{{ route('retailer.redcliffcart') }}"
                class="vendor-option vendor_cart {{ $inRed ? 'in-cart' : '' }}"
                data-package_id="{{ $package->id }}"
                data-vendor_id="{{ $data['redcliff']['vendor_id'] }}">

                <div class="vendor-info">
                  <div class="vendor-avatar redcliff">R</div>
                  <div class="vendor-details">
                    <span class="vendor-name">Redcliffe Labs</span>
                    <span class="vendor-tag">ISO Certified</span>
                  </div>
                </div>

                <div class="vendor-right">
                  @if($inRed)
                    <span class="in-cart-chip">
                      <i class="bi bi-check2-circle"></i> Added
                    </span>
                    <button class="remove-btn delete_icon"
                      data-package_id="{{ $package->id }}"
                      data-vendor_id="{{ $data['redcliff']['vendor_id'] }}"
                      onclick="event.preventDefault(); event.stopPropagation();">
                      <i class="bi bi-trash3"></i>
                    </button>
                  @else
                    <span class="price-tag">₹{{ $data['redcliff']['price'] }}</span>
                    <span class="in-cart-chip" style="background:#eff6ff; border-color:#bfdbfe; color:#1d4ed8;">
                      <i class="bi bi-cart-plus"></i> Add
                    </span>
                  @endif
                </div>
              </a>

              {{-- Check Availability Box --}}
              {{-- <div class="avail-box">
                <div class="avail-box-title">
                  <i class="bi bi-geo-alt-fill"></i>
                  Check Home Collection Availability
                </div>

                <div class="avail-inputs">
                  <input
                    id="redclifflocality"
                    class="form-control"
                    placeholder="Enter locality"
                     type="text"
                   
                  />
                  <input
                    id="redcliffcity"
                    class="form-control"
                    placeholder="Enter city"
                    type="text",
                  />
                </div>

                <span class="avail-error" id="avail_error">Please fill in both pincode and city.</span>
                <div class="avail-result" id="avail_result"></div>

                <button
                  class="avail-submit-btn"
                  id="avail_check_btn"
                  onclick="redcliff_check_availability(event)">
                  <i class="bi bi-search"></i>
                  Check Availability
                </button>
              </div> --}}

            @endif

            {{-- SRL (commented) --}}
            {{-- @if(isset($data['srl'])) ... @endif --}}

            {{-- TATA 1MG (commented) --}}
            {{-- @if(isset($data['tata1mg'])) ... @endif --}}

          </div>

          <!-- Trust Strip -->
          <div class="trust-strip">
            <div class="trust-item">
              <span class="trust-icon"><i class="bi bi-shield-check"></i></span>
              Secure &amp; encrypted payment
            </div>
            <div class="trust-item">
              <span class="trust-icon"><i class="bi bi-house-check"></i></span>
              Home sample collection available
            </div>
            <div class="trust-item">
              <span class="trust-icon"><i class="bi bi-clock"></i></span>
              Reports within 24–48 hours
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

</div><!-- /.page-wrap -->

@if(isset($redcliffcartitems))
  <x-retailer.recliffcart :redcliffcartitems="$redcliffcartitems" />
@endif

@if(isset($srlcartitems))
  <x-retailer.srlcart :srlcartitems="$srlcartitems" />
@endif

<x-retailer.footer />

<script>
  /* ── Toggle tests ── */
  function toggleTests(id, btn) {
    const extras = document.querySelectorAll(`#tl-${id} .extra`);
    const isOpen  = btn.classList.contains('open');
    const total   = document.querySelectorAll(`#tl-${id} li`).length;
    extras.forEach(li => li.classList.toggle('show', !isOpen));
    btn.classList.toggle('open', !isOpen);
    btn.querySelector('.btn-text').textContent = isOpen
      ? `Show all ${total} tests`
      : 'Show less';
  }

  /* ── Check Redcliffe Availability ── */
  async function redcliff_check_availability(event) {
    event.preventDefault();

    const pincodeInput = document.querySelector('#redclifflocality');
    const cityInput    = document.querySelector('#redcliffcity');
    const errorEl      = document.querySelector('#avail_error');
    const resultEl     = document.querySelector('#avail_result');
    const btn          = document.querySelector('#avail_check_btn');

    const pincode = pincodeInput.value.trim();
    const city    = cityInput.value.trim();

    // Reset UI
    errorEl.classList.remove('show');
    resultEl.classList.remove('show', 'success', 'unavailable');
    resultEl.textContent = '';

    // Validate both fields
    if (!pincode && !city) {
      errorEl.textContent = 'Please enter both pincode and city.';
      errorEl.classList.add('show');
      return;
    }
    if (!pincode) {
      errorEl.textContent = 'Please enter the pincode.';
      errorEl.classList.add('show');
      pincodeInput.focus();
      return;
    }
    if (!city) {
      errorEl.textContent = 'Please enter the city.';
      errorEl.classList.add('show');
      cityInput.focus();
      return;
    }

    // Loading state
    btn.classList.add('loading');
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Checking...';

    try {
      const response = await fetch("{{ route('retailer.check_redcliff_availability') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
          pincode: pincode,
          city:    city,
        }),
      });

      const data = await response.json();

      if (response.ok && data.available) {
        resultEl.textContent = '✓ Home collection is available in your area!';
        resultEl.classList.add('show', 'success');
      } else {
        const msg = data.message ?? 'Home collection is not available in this area.';
        resultEl.textContent = '✕ ' + msg;
        resultEl.classList.add('show', 'unavailable');
      }

    } catch (err) {
      console.error('Availability check error:', err);
      resultEl.textContent = 'Something went wrong. Please try again.';
      resultEl.classList.add('show', 'unavailable');
    } finally {
      btn.classList.remove('loading');
      btn.innerHTML = '<i class="bi bi-search"></i> Check Availability';
    }
  }

  /* ── Vendor cart AJAX ── */
  document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('click', async function (e) {
      const vendorCart = e.target.closest('.vendor_cart');
      if (!vendorCart) return;
      e.preventDefault();

      const action     = vendorCart.href;
      const package_id = vendorCart.dataset.package_id;
      const vendor_id  = vendorCart.dataset.vendor_id;

      try {
        const res  = await fetch(action, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          },
          body: JSON.stringify({ package_id, vendor_id }),
        });

        const data = await res.json();

        if (res.ok && data.status === 'success' && data.vendor === 'redcliff') {
          const count = data.redcliffcart.length;
          document.querySelector('.redcliff_cart')?.classList.remove('display_none');
          const badge = document.querySelector('.cart_badge_redcliff');
          if (badge) badge.innerText = count;
          if (typeof successalert === 'function') successalert(data);
          setTimeout(() => { window.location.href = "{{ route('retailer.redcliffcartview') }}"; }, 1000);
        }
        else if (res.ok && data.status === 'success' && data.vendor === 'srl') {
          const count = data.srlcartitems.length;
          document.querySelector('.srl_cart')?.classList.remove('display_none');
          const badge = document.querySelector('.cart_badge_srl');
          if (badge) badge.innerText = count;
          if (typeof successalert === 'function') successalert(data);
          setTimeout(() => { window.location.href = "{{ route('retailer.allpackages') }}"; }, 1000);
        }
        else {
          console.error('Cart error:', data);
        }
      } catch (err) {
        console.error('Fetch error:', err);
      }
    });

  });
</script>