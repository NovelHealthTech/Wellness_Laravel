<x-retailer.header />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0f172a;
    --navy-2: #1e293b;
    --teal: #2563eb;
    --teal-l: #eff6ff;
    --teal-m: #93c5fd;
    --teal-d: #1d4ed8;
    --slate: #475569;
    --muted: #94a3b8;
    --border: #e2e8f0;
    --border-t: #bfdbfe;
    --bg: #f8fafc;
    --white: #ffffff;
    --green: #16a34a;
    --green-l: #f0fdf4;
    --font: 'Sora', sans-serif;
    --body: 'DM Sans', sans-serif;
    --shadow: 0 4px 16px rgba(15, 23, 42, 0.07), 0 1px 4px rgba(15, 23, 42, 0.04);
  }

  body {
    background: var(--bg) !important;
    font-family: var(--body);
    color: var(--navy);
    line-height: 1.6;
    align-items: stretch !important;
  }

  .page-wrap {
    width: 100%;
  }

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
      radial-gradient(ellipse 55% 120% at 100% 50%, rgba(37, 99, 235, 0.25) 0%, transparent 65%),
      radial-gradient(ellipse 30% 80% at 0% 0%, rgba(147, 197, 253, 0.12) 0%, transparent 55%);
    pointer-events: none;
  }

  .pkg-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
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
    color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
    margin-bottom: 20px;
    transition: color 0.2s;
  }

  .back-link svg {
    width: 14px;
    height: 14px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2.3;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: transform 0.2s;
  }

  .back-link:hover {
    color: var(--teal-m);
  }

  .back-link:hover svg {
    transform: translateX(-3px);
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(37, 99, 235, 0.2);
    border: 1px solid rgba(147, 197, 253, 0.4);
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
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #93c5fd;
    animation: pulse 2s infinite;
  }

  @keyframes pulse {

    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: 0.6;
      transform: scale(1.3);
    }
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
    color: rgba(255, 255, 255, 0.55);
    max-width: 520px;
    line-height: 1.65;
  }

  .hero-stats {
    display: flex;
    gap: 0;
    margin-top: 32px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 24px;
    flex-wrap: wrap;
  }

  .hstat {
    padding: 0 28px 0 0;
    margin-right: 28px;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
  }

  .hstat:last-child {
    border-right: none;
  }

  .hstat-label {
    font-family: var(--font);
    font-size: 10px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.35);
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

  .hstat-value.teal {
    color: var(--teal-m);
  }

  /* ── PACKAGES SECTION ── */
  .packages-section {
    width: 100%;
    padding: 40px 60px 80px;
  }

  .section-inner {
    max-width: 1200px;
    margin: 0 auto;
  }

  .section-label {
    font-family: var(--font);
    font-size: 11.5px;
    font-weight: 700;
    color: var(--muted);
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 24px;
  }

  .section-label strong {
    color: var(--navy);
  }

  .packages-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }

  /* ── PACKAGE CARD ── */
  .package-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow);
    transition: transform 0.22s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.22s, border-color 0.22s;
    animation: fadeUp 0.4s ease both;
    position: relative;
    overflow: hidden;
  }

  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(16px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .package-card:nth-child(1) {
    animation-delay: .04s
  }

  .package-card:nth-child(2) {
    animation-delay: .08s
  }

  .package-card:nth-child(3) {
    animation-delay: .12s
  }

  .package-card:nth-child(4) {
    animation-delay: .16s
  }

  .package-card:nth-child(5) {
    animation-delay: .20s
  }

  .package-card:nth-child(6) {
    animation-delay: .24s
  }

  .package-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--ca, #1d4ed8), var(--cb, #93c5fd));
    opacity: 0;
    transition: opacity 0.2s;
  }

  .package-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 32px rgba(37, 99, 235, 0.15);
    border-color: rgba(37, 99, 235, 0.25);
  }

  .package-card:hover::before {
    opacity: 1;
  }

  .card-top {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    margin-bottom: 14px;
  }

  .test-icon {
    width: 46px;
    height: 46px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .test-title {
    font-family: var(--font);
    font-size: 15px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 3px;
  }

  .labnote {
    font-size: 12.5px;
    color: var(--muted);
    line-height: 1.5;
  }

  hr.divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 12px 0;
  }

  .tests-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 9px;
  }

  .tests-label {
    font-family: var(--font);
    font-size: 10px;
    font-weight: 700;
    color: var(--muted);
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .tests-badge {
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 50px;
    background: var(--teal-l);
    color: var(--teal-d);
    border: 1px solid var(--border-t);
    display: flex;
    align-items: center;
    gap: 3px;
  }

  .test-features {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .test-features li {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: var(--slate);
  }

  .test-features li .chk {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: var(--teal-l);
    color: var(--teal-d);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    flex-shrink: 0;
  }

  .test-features li.extra {
    display: none;
  }

  .test-features li.extra.show {
    display: flex;
  }

  .card-foot {
    margin-top: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }

  .toggle-btn {
    background: none;
    border: none;
    font-family: var(--font);
    font-size: 12px;
    font-weight: 700;
    color: var(--teal-d);
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .toggle-btn svg {
    width: 12px;
    height: 12px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: transform 0.22s;
  }

  .toggle-btn.open svg {
    transform: rotate(180deg);
  }

  .view-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 16px;
    border: 1.5px solid var(--teal);
    color: var(--teal-d);
    background: transparent;
    font-family: var(--font);
    font-size: 12px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.18s, color 0.18s;
    cursor: pointer;
  }

  .view-btn:hover {
    background: var(--teal);
    color: var(--white);
  }

  .view-btn svg {
    width: 11px;
    height: 11px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .view-btn_exist {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 16px;
    border: 1.5px solid var(--border-t);
    color: var(--teal-d);
    background: var(--teal-l);
    font-family: var(--font);
    font-size: 12px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none;
  }

  /* ── LOCATION MODAL FORM ── */
  .location-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 32px 28px;
    animation: fadeUp 0.4s ease;
  }

  .location-header {
    text-align: center;
    margin-bottom: 24px;
  }

  .location-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 12px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
  }

  .location-header h4 {
    font-family: var(--font);
    font-weight: 700;
    margin-bottom: 5px;
  }

  .location-header p {
    font-size: 14px;
    color: var(--muted);
  }

  .input-group-modern {
    position: relative;
    margin-bottom: 20px;
  }

  .input-group-modern i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 14px;
  }

  .input-group-modern input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    border-radius: 12px;
    border: 1.5px solid var(--border);
    font-size: 14px;
    outline: none;
    transition: 0.3s;
    background: var(--bg);
    font-family: var(--body);
  }

  .input-group-modern input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
  }

  .location-btn {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    color: white;
    font-family: var(--font);
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s ease;
  }

  .location-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(37, 99, 235, 0.3);
  }

  /* ── RESPONSIVE ── */
  @media(max-width:1100px) {
    .packages-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .pkg-hero,
    .packages-section {
      padding-left: 32px;
      padding-right: 32px;
    }
  }

  @media(max-width:640px) {
    .packages-grid {
      grid-template-columns: 1fr;
    }

    .pkg-hero,
    .packages-section {
      padding-left: 18px;
      padding-right: 18px;
    }

    .pkg-hero {
      padding-top: 32px;
      padding-bottom: 28px;
    }

    .hero-stats {
      gap: 16px;
    }

    .hstat {
      border-right: none;
      padding-right: 0;
      margin-right: 0;
    }
  }
</style>

<div class="page-wrap">

  <!-- ── HERO ── -->
  <div class="pkg-hero">
    <div class="hero-inner">
      <div>
        <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
          <svg viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6" />
          </svg>
          Back to Home
        </a>
        <div class="hero-badge"><span></span> All Packages</div>
        <h1>Health Test Packages</h1>
        <p>Premium lab packages — certified &amp; trusted by leading diagnostics.</p>
        <div class="hero-stats">
          <div class="hstat">
            <div class="hstat-label">Packages</div>
            <div class="hstat-value teal">{{ count($allpackages) }}</div>
          </div>
          <div class="hstat">
            <div class="hstat-label">Labs</div>
            <div class="hstat-value">3 Partners</div>
          </div>
          <div class="hstat">
            <div class="hstat-label">Collection</div>
            <div class="hstat-value">Home / Centre</div>
          </div>
          <div class="hstat">
            <div class="hstat-label">Reports</div>
            <div class="hstat-value teal">24–48 hrs</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ── PACKAGES ── -->
  <div class="packages-section">
    <div class="section-inner">

      <div class="section-label">All Packages — <strong>{{ count($allpackages) }} available</strong></div>

      <div class="packages-grid">
        @php
          $sets = [
            ['bg' => '#eff6ff', 'color' => '#2563eb', 'icon' => 'bi-clipboard-pulse', 'ca' => '#2563eb', 'cb' => '#60a5fa'],
            ['bg' => '#e0f2fe', 'color' => '#0284c7', 'icon' => 'bi-heart-pulse', 'ca' => '#0284c7', 'cb' => '#38bdf8'],
            ['bg' => '#ede9fe', 'color' => '#7c3aed', 'icon' => 'bi-droplet-half', 'ca' => '#7c3aed', 'cb' => '#818cf8'],
            ['bg' => '#dbeafe', 'color' => '#1d4ed8', 'icon' => 'bi-activity', 'ca' => '#1d4ed8', 'cb' => '#93c5fd'],
            ['bg' => '#f0f9ff', 'color' => '#0369a1', 'icon' => 'bi-lungs', 'ca' => '#0369a1', 'cb' => '#7dd3fc'],
            ['bg' => '#eef2ff', 'color' => '#4338ca', 'icon' => 'bi-capsule', 'ca' => '#4338ca', 'cb' => '#a5b4fc'],
          ];
        @endphp

        @foreach($allpackages as $i => $package)
          @php
            $tests = json_decode($package->description, true)['tests'] ?? [];
            $total = count($tests);
            $s = $sets[$i % count($sets)];
          @endphp

          <div class="package-card" style="--ca:{{ $s['ca'] }};--cb:{{ $s['cb'] }};">

            <div class="card-top">
              <div class="test-icon" style="background:{{ $s['bg'] }};color:{{ $s['color'] }};">
                <i class="bi {{ $s['icon'] }}"></i>
              </div>
              <div>
                <div class="test-title">{{ $package->packagename }}</div>
                <div class="labnote">{{ $package->short_description ?? 'Comprehensive health screening' }}</div>
              </div>
            </div>

            <hr class="divider">

            <div class="tests-header">
              <span class="tests-label">Includes Tests</span>
              @if($total > 0)
                <span class="tests-badge"><i class="bi bi-check2-circle"></i> {{ $total }} tests</span>
              @endif
            </div>

            <ul class="test-features" id="tl-{{ $package->id }}">
              @foreach($tests as $idx => $test)
                <li class="{{ $idx >= 5 ? 'extra' : '' }}">
                  <span class="chk"><i class="bi bi-check2"></i></span>
                  {{ $test }}
                </li>
              @endforeach
            </ul>

            @if($total === 0)
              <p class="labnote" style="font-style:italic;margin-top:6px;">Test details coming soon.</p>
            @endif

            <div class="card-foot">
              @if($total > 5)
                <button class="toggle-btn" onclick="toggleTests({{ $package->id }}, this)">
                  <span>+{{ $total - 5 }} more</span>
                  <svg viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                  </svg>
                </button>
              @else
                <span></span>
              @endif

              @if(in_array($package->id, $redcliffpackageIds))
                <a href="{{ route('retailer.deletepackage') }}" class="view-btn_exist cursor-pointer"
                  data-package_id="{{ $package->id }}" onclick="deletepackage(this,event)">
                  <i class="fa-solid fa-trash" style="color: rgb(231, 26, 26);"></i> In Redcliff Cart
                </a>
              @elseif(in_array($package->id, $srlpackageIds))
                <a class="view-btn_exist">
                  <i class="fa-solid fa-trash" style="color: rgb(231, 26, 26);"></i> In SRL Cart
                </a>
              @else
                <a href="{{ route('retailer.individual_package', ["id" => $package->id]) }}"
                  class="view-btn cursor-pointer">
                  View Details
                  <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                  </svg>
                </a>
              @endif
            </div>

          </div>
        @endforeach
      </div>

    </div>
  </div>

</div>

@isset($redcliffcartitems)
  <x-retailer.recliffcart :redcliffcartitems="$redcliffcartitems" />
@endisset

@isset($srlcartitems)
  <x-retailer.srlcart :srlcartitems="$srlcartitems" />
@endisset

{{-- <x-retailer.modal title="Please Enter your pincode" link="{{ route('retailer.checkavailability') }}" /> --}}
<x-retailer.footer />

<script>

  async function deletepackage(element, event) {
    event.preventDefault();

    const href = element.href;
    const package_id = element.dataset.package_id;

    // SweetAlert confirmation
    const result = await Swal.fire({
      title: 'Remove Package?',
      text: 'Are you sure you want to remove this package from cart?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#1d4ed8',
      cancelButtonColor: '#dc2626',
      confirmButtonText: 'Yes, Remove it!',
      cancelButtonText: 'Cancel',
    });

    if (!result.isConfirmed) return; // stop if user clicks Cancel

    const response = await fetch(href, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({
        id: package_id,
      })
    });

    const data = await response.json();

    if (data.success) {
      // Optional: show success alert before redirecting
      await Swal.fire({
        title: 'Removed!',
        text: 'Package has been removed from cart.',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false,
      });
      window.location.href = data.redirect;
    } else {
      Swal.fire({
        title: 'Error!',
        text: 'Something went wrong. Please try again.',
        icon: 'error',
        confirmButtonColor: '#1d4ed8',
      });
    }
  }

  window.toggleTests = function (id, btn) {
    const extras = document.querySelectorAll(`#tl-${id} .extra`);
    const isOpen = btn.classList.contains('open');
    const total = document.querySelectorAll(`#tl-${id} li`).length;
    extras.forEach(li => li.classList.toggle('show', !isOpen));
    btn.classList.toggle('open', !isOpen);
    btn.querySelector('span').textContent = isOpen ? `+${total - 5} more` : 'Show less';
  }

  function open_pin_code_modal(element) {
    $(".retailermodal").modal("show");
    const retailer_modal_form = document.querySelector(".retailer_modal_form");
    const package_id = element.dataset.package_id;
    retailer_modal_form.innerHTML = `
      <div class="location-card">
        <div class="location-header">
          <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
          <h4>Set Your Delivery Location</h4>
          <p>Enter your details to check availability</p>
        </div>
        <div class="input-group-modern">
          <i class="fas fa-map-pin"></i>
          <input type="text" id="pincode" name="pincode" placeholder="Pincode" maxlength="6" required>
        </div>
        <div class="input-group-modern">
          <i class="fas fa-location-dot"></i>
          <input type="text" id="locality" name="locality" placeholder="Locality" required>
        </div>
        <div class="input-group-modern">
          <i class="fas fa-city"></i>
          <input type="text" id="city" name="city" placeholder="City" required>
        </div>
        <button data-package_id="${package_id}" type="button" class="location-btn checkavailability_button">
          Check Availability
        </button>
      </div>
    `;
  }

  document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", async function (e) {
      if (e.target.classList.contains('checkavailability_button')) {
        const package_id = e.target.dataset.package_id;
        const button = e.target;
        button.disabled = true;
        button.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Checking...`;

        const url = document.querySelector(".retailer_modal_form").action;

        const response = await fetch(url, {
          method: "POST",
          headers: {
            'Content-Type': "application/json",
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content"),
          },
          body: JSON.stringify({
            pincode: document.querySelector("#pincode").value,
            location: document.querySelector("#locality").value,
            city: document.querySelector("#city").value,
            package_id: package_id,
          })
        });

        const data = await response.json();

        if (data.status) {
          window.location.href = data.redirect;
        } else {
          alert("Something went wrong");
          button.disabled = false;
          button.innerHTML = "Check Availability";
        }
      }
    });
  });
</script>