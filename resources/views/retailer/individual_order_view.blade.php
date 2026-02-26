<x-retailer.header />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

  :root {
    --navy:#0f172a; --navy-2:#1e293b; --teal:#2563eb; --teal-l:#eff6ff; --teal-m:#93c5fd;
    --teal-d:#1d4ed8; --slate:#475569; --muted:#94a3b8; --border:#e2e8f0;
    --bg:#f8fafc; --white:#ffffff; --red:#ef4444; --red-l:#fef2f2;
    --green:#1d4ed8; --green-l:#eff6ff;
    --font:'Sora',sans-serif; --body:'DM Sans',sans-serif;
    --shadow:0 4px 16px rgba(15,23,42,.07),0 1px 4px rgba(15,23,42,.04);
  }
  body { background:var(--bg)!important; font-family:var(--body); color:var(--navy); }

  /* ── HERO ── */
  .pkg-hero { background:#1f3964; padding:48px 60px 44px; position:relative; overflow:hidden; }
  .pkg-hero::before { content:''; position:absolute; inset:0; pointer-events:none;
    background:radial-gradient(ellipse 55% 120% at 100% 50%,rgba(37,99,235,.18) 0%,transparent 65%),
               radial-gradient(ellipse 30% 80% at 0% 0%,rgba(147,197,253,.10) 0%,transparent 55%); }
  .pkg-hero::after { content:''; position:absolute; inset:0; pointer-events:none;
    background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                     linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
    background-size:32px 32px; }
  .hero-inner { max-width:1200px; margin:0 auto; position:relative; z-index:1; }

  .back-link { display:inline-flex; align-items:center; gap:6px; font-family:var(--font); font-size:12.5px; font-weight:600; color:rgba(255,255,255,.5); text-decoration:none; margin-bottom:20px; transition:.2s; }
  .back-link svg { width:14px; height:14px; stroke:currentColor; fill:none; stroke-width:2.3; stroke-linecap:round; stroke-linejoin:round; transition:.2s; }
  .back-link:hover { color:var(--teal-m); }
  .back-link:hover svg { transform:translateX(-3px); }

  .hero-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; background:rgba(37,99,235,.18); border:1px solid rgba(147,197,253,.35); border-radius:50px; font-family:var(--font); font-size:11px; font-weight:700; color:var(--teal-m); letter-spacing:.8px; text-transform:uppercase; margin-bottom:16px; }
  .hero-badge span { width:6px; height:6px; border-radius:50%; background:#93c5fd; animation:pulse 2s infinite; }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }

  .pkg-hero h1 { font-family:var(--font); font-size:clamp(22px,3vw,36px); font-weight:800; color:var(--white); letter-spacing:-.8px; line-height:1.15; margin-bottom:12px; }
  .pkg-hero p { font-size:15px; color:rgba(255,255,255,.55); max-width:520px; }

  .hero-stats { display:flex; gap:0; margin-top:32px; border-top:1px solid rgba(255,255,255,.08); padding-top:24px; flex-wrap:wrap; }
  .hstat { padding:0 28px 0 0; margin-right:28px; border-right:1px solid rgba(255,255,255,.1); }
  .hstat:last-child { border-right:none; }
  .hstat-label { font-family:var(--font); font-size:10px; font-weight:700; color:rgba(255,255,255,.35); letter-spacing:1px; text-transform:uppercase; margin-bottom:4px; }
  .hstat-value { font-family:var(--font); font-size:18px; font-weight:700; color:var(--white); }
  .hstat-value.accent { color:var(--teal-m); }

  /* ── HERO ACTIONS ── */
  .hero-actions { display:flex; gap:10px; margin-top:24px; flex-wrap:wrap; }
  .btn-invoice {
    display:inline-flex; align-items:center; gap:7px;
    padding:11px 22px; border-radius:50px;
    background:rgba(255,255,255,.12); border:1.5px solid rgba(255,255,255,.25);
    color:var(--white); font-family:var(--font); font-size:13px; font-weight:700;
    cursor:pointer; text-decoration:none; transition:.2s;
  }
  .btn-invoice:hover { background:rgba(255,255,255,.2); color:var(--white); }
  .btn-cancel {
    display:inline-flex; align-items:center; gap:7px;
    padding:11px 22px; border-radius:50px;
    background:rgba(239,68,68,.15); border:1.5px solid rgba(239,68,68,.35);
    color:#fca5a5; font-family:var(--font); font-size:13px; font-weight:700;
    cursor:pointer; transition:.2s;
  }
  .btn-cancel:hover { background:rgba(239,68,68,.25); }

  /* ── STATUS BADGE ── */
  .status-badge {
    display:inline-flex; align-items:center; gap:6px;
    padding:5px 14px; border-radius:50px;
    font-family:var(--font); font-size:12px; font-weight:700;
  }
  .status-badge.pending { background:rgba(245,158,11,.15); border:1px solid rgba(245,158,11,.3); color:#fcd34d; }
  .status-badge.confirmed { background:rgba(37,99,235,.15); border:1px solid rgba(147,197,253,.3); color:#93c5fd; }
  .status-badge.cancelled { background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.3); color:#fca5a5; }

  /* ── LAYOUT ── */
  .content-section { padding:40px 60px 80px; }
  .content-inner { max-width:1200px; margin:0 auto; }
  .lr-grid { display:grid; grid-template-columns:1fr 360px; gap:28px; align-items:start; }

  /* ── CARD BASE ── */
  .card { background:var(--white); border:1px solid var(--border); border-radius:16px; box-shadow:var(--shadow); overflow:hidden; margin-bottom:20px; animation:fadeUp .35s ease both; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
  .card:nth-child(2) { animation-delay:.07s; }
  .card:nth-child(3) { animation-delay:.13s; }

  .card-head { padding:20px 26px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:12px; }
  .card-head.dark { background:linear-gradient(135deg,#1e3a8a,#1d4ed8); border-bottom:1px solid rgba(255,255,255,.08); }
  .card-head-title { font-family:var(--font); font-size:14px; font-weight:700; color:var(--navy-2); }
  .card-head.dark .card-head-title { color:var(--white); }
  .card-head-badge { font-family:var(--font); font-size:11px; font-weight:700; padding:3px 10px; border-radius:50px; background:var(--teal-l); color:var(--teal-d); border:1px solid var(--border); }
  .card-body { padding:24px 26px; }

  /* ── CUSTOMER CARD ── */
  .customer-avatar {
    width:52px; height:52px; border-radius:14px;
    background:linear-gradient(135deg,var(--teal-d),var(--teal));
    display:flex; align-items:center; justify-content:center;
    font-family:var(--font); font-size:20px; font-weight:800; color:var(--white); flex-shrink:0;
  }

  .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
  .info-grid.three { grid-template-columns:1fr 1fr 1fr; }

  .info-item { display:flex; flex-direction:column; gap:4px; }
  .info-label { font-family:var(--font); font-size:10px; font-weight:700; color:var(--muted); letter-spacing:.8px; text-transform:uppercase; }
  .info-value { font-size:14px; font-weight:500; color:var(--navy-2); }

  .divider { border:none; border-top:1px solid var(--border); margin:20px 0; }

  .section-sub { font-family:var(--font); font-size:10.5px; font-weight:700; color:var(--teal-d); text-transform:uppercase; letter-spacing:.8px; margin:0 0 14px; display:flex; align-items:center; gap:8px; }
  .section-sub::after { content:''; flex:1; height:1px; background:var(--border); }

  /* ── TIMELINE ── */
  .timeline { display:flex; flex-direction:column; gap:0; }
  .tl-item { display:flex; gap:16px; padding-bottom:20px; position:relative; }
  .tl-item:last-child { padding-bottom:0; }
  .tl-item:last-child .tl-line { display:none; }
  .tl-dot-wrap { display:flex; flex-direction:column; align-items:center; flex-shrink:0; }
  .tl-dot { width:36px; height:36px; border-radius:10px; background:var(--teal-l); color:var(--teal-d); display:flex; align-items:center; justify-content:center; font-size:14px; border:1.5px solid var(--border); }
  .tl-dot.done { background:var(--teal); color:var(--white); border-color:var(--teal); }
  .tl-line { width:2px; flex:1; background:var(--border); margin-top:6px; min-height:20px; }
  .tl-content { padding-top:6px; }
  .tl-title { font-family:var(--font); font-size:13px; font-weight:700; color:var(--navy-2); margin-bottom:3px; }
  .tl-sub { font-size:12px; color:var(--muted); }

  /* ── PACKAGES LIST ── */
  .pkg-item { display:flex; align-items:center; gap:12px; padding:14px 0; border-bottom:1px solid #f1f5f9; }
  .pkg-item:last-child { border-bottom:none; }
  .pkg-icon { width:40px; height:40px; border-radius:10px; background:var(--teal-l); color:var(--teal-d); display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
  .pkg-name { font-family:var(--font); font-size:13.5px; font-weight:700; color:var(--navy-2); margin-bottom:2px; }
  .pkg-type { font-size:11.5px; color:var(--muted); }

  /* ── TESTS ACCORDION ── */
  .tests-toggle { background:none; border:none; font-family:var(--font); font-size:11.5px; font-weight:700; color:var(--teal-d); cursor:pointer; padding:0; display:flex; align-items:center; gap:5px; margin-top:4px; }
  .tests-toggle svg { width:11px; height:11px; stroke:currentColor; fill:none; stroke-width:2.5; transition:.2s; }
  .tests-toggle.open svg { transform:rotate(180deg); }
  .tests-mini { display:none; margin-top:10px; padding:10px 12px; background:var(--bg); border-radius:10px; border:1px solid var(--border); }
  .tests-mini.show { display:flex; flex-wrap:wrap; gap:6px; }
  .test-chip { font-size:11px; padding:3px 10px; border-radius:50px; background:var(--teal-l); color:var(--teal-d); border:1px solid var(--border); font-weight:500; }

  /* ── RIGHT PANEL ── */
  .right-panel { position:sticky; top:24px; display:flex; flex-direction:column; gap:20px; }

  .summary-row { display:flex; justify-content:space-between; align-items:center; padding:13px 22px; border-bottom:1px solid var(--border); font-size:14px; color:var(--slate); }
  .summary-row:last-child { border-bottom:none; }
  .summary-row .val { font-family:var(--font); font-weight:700; color:var(--navy-2); }
  .summary-row.total { background:var(--bg); font-family:var(--font); font-weight:700; font-size:15px; color:var(--navy-2); }
  .summary-row.total .val { color:var(--teal-d); font-size:22px; }

  .action-btn {
    display:flex; align-items:center; justify-content:center; gap:8px;
    width:calc(100% - 40px); margin:0 20px; padding:13px;
    border:none; border-radius:12px; font-family:var(--font); font-size:13px; font-weight:700;
    cursor:pointer; transition:.2s; text-decoration:none;
  }
  .action-btn.blue { background:linear-gradient(135deg,var(--teal-d),var(--teal)); color:var(--white); box-shadow:0 4px 14px rgba(37,99,235,.3); margin-bottom:10px; }
  .action-btn.blue:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(37,99,235,.35); color:var(--white); }
  .action-btn.danger { background:var(--red-l); color:var(--red); border:1.5px solid #fca5a5; margin-bottom:18px; }
  .action-btn.danger:hover { background:#fecaca; }

  .trust-strip { padding:14px 20px 18px; border-top:1px solid var(--border); display:flex; flex-direction:column; gap:8px; }
  .trust-item { display:flex; align-items:center; gap:9px; font-size:12.5px; color:var(--slate); font-weight:500; }
  .trust-icon { width:22px; height:22px; border-radius:6px; background:var(--green-l); color:var(--green); display:flex; align-items:center; justify-content:center; font-size:11px; flex-shrink:0; }

  /* ── CANCEL MODAL ── */
  .modal-icon { width:56px; height:56px; border-radius:50%; background:var(--red-l); color:var(--red); display:flex; align-items:center; justify-content:center; font-size:22px; margin:0 auto 14px; }

  @media(max-width:960px) {
    .lr-grid { grid-template-columns:1fr; }
    .right-panel { position:static; }
    .content-section, .pkg-hero { padding-left:24px; padding-right:24px; }
  }
  @media(max-width:640px) {
    .content-section, .pkg-hero { padding-left:18px; padding-right:18px; }
    .pkg-hero { padding-top:32px; padding-bottom:28px; }
    .info-grid, .info-grid.three { grid-template-columns:1fr 1fr; }
    .hero-stats { gap:16px; }
    .hstat { border-right:none; padding-right:0; margin-right:0; }
  }
</style>

<div class="page-wrap w-100">

  <!-- ── HERO ── -->
  <div class="pkg-hero">
    <div class="hero-inner">

      <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Back to Home
      </a>

      <div class="hero-badge"><span></span> Order Details</div>

      {{-- <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:10px;">
        <h1 style="margin:0;">Order #{{ $customers->first()->id ?? 'N/A' }}</h1>
        @php $firstStatus = $customers->first()->status ?? 0; @endphp
        @if($firstStatus == 0)
          <span class="status-badge pending"><i class="bi bi-clock-fill"></i> Pending</span>
        @elseif($firstStatus == 1)
          <span class="status-badge confirmed"><i class="bi bi-check-circle-fill"></i> Confirmed</span>
        @else
          <span class="status-badge cancelled"><i class="bi bi-x-circle-fill"></i> Cancelled</span>
        @endif
      </div> --}}

      <p>Booked on {{ \Carbon\Carbon::parse($customers->first()->created_at ?? now())->format('d M Y, h:i A') }}</p>

      <div class="hero-stats">
        <div class="hstat">
          <div class="hstat-label">Patients</div>
          <div class="hstat-value accent">{{ $customers->count() }}</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Packages</div>
          <div class="hstat-value accent">{{ $packages->count() }}</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Collection Date</div>
          <div class="hstat-value">{{ \Carbon\Carbon::parse($customers->first()->collection_date ?? now())->format('d M Y') }}</div>
        </div>
        <div class="hstat">
          <div class="hstat-label">Pincode</div>
          <div class="hstat-value">{{ $customers->first()->pincode ?? 'N/A' }}</div>
        </div>
      </div>

     

    </div>
  </div>

  <!-- ── CONTENT ── -->
  <div class="content-section">
    <div class="content-inner">
      <div class="lr-grid">

        <!-- ══ LEFT ══ -->
        <div>

          <!-- Patients -->
          @foreach($customers as $i => $customer)
          <div class="card" style="animation-delay:{{ $i * 0.07 }}s;">
            <div class="card-head">
              <div style="display:flex;align-items:center;gap:12px;">
                <div class="customer-avatar">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</div>
                <div>
                  <div class="card-head-title">{{ $customer->customer_name }}</div>
                  <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                    Patient {{ $i + 1 }} · {{ ucfirst($customer->customer_gender) }} · Age {{ $customer->customer_age }}
                  </div>
                </div>
              </div>
              {{-- @if($customer->status == 0)
                <span class="status-badge pending" style="font-size:11px;"><i class="bi bi-clock-fill"></i> Pending</span>
              @elseif($customer->status == 1)
                <span class="status-badge confirmed" style="font-size:11px;"><i class="bi bi-check-circle-fill"></i> Confirmed</span>
              @else
                <span class="status-badge cancelled" style="font-size:11px;"><i class="bi bi-x-circle-fill"></i> Cancelled</span>
              @endif --}}
            </div>
            <div class="card-body">

              <div class="section-sub"><i class="bi bi-person-lines-fill"></i> Contact Info</div>
              <div class="info-grid" style="margin-bottom:20px;">
                <div class="info-item">
                  <span class="info-label">Phone</span>
                  <span class="info-value"><i class="bi bi-telephone-fill me-1" style="color:var(--teal-d);font-size:11px;"></i>{{ $customer->customer_phonenumber }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">WhatsApp</span>
                  <span class="info-value"><i class="bi bi-whatsapp me-1" style="color:#25d366;font-size:11px;"></i>{{ $customer->customer_whatsappnumber }}</span>
                </div>
              </div>

              <div class="section-sub"><i class="bi bi-calendar3"></i> Booking Info</div>
              <div class="info-grid three" style="margin-bottom:20px;">
                <div class="info-item">
                  <span class="info-label">Booking Date</span>
                  <span class="info-value">{{ \Carbon\Carbon::parse($customer->booking_date)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Collection Date</span>
                  <span class="info-value">{{ \Carbon\Carbon::parse($customer->collection_date)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Payment</span>
                  <span class="info-value">
                    @if($customer->is_credit)
                      <span style="color:#16a34a;font-weight:700;font-size:12px;"><i class="bi bi-check-circle-fill me-1"></i>Credit</span>
                    @elseif($customer->is_payment)
                      <span style="color:var(--teal-d);font-weight:700;font-size:12px;"><i class="bi bi-check-circle-fill me-1"></i>Paid</span>
                    @else
                      <span style="color:#d97706;font-weight:700;font-size:12px;"><i class="bi bi-clock-fill me-1"></i>Pending</span>
                    @endif
                  </span>
                </div>
              </div>

              <div class="section-sub"><i class="bi bi-geo-alt-fill"></i> Address</div>
              <div class="info-grid" style="margin-bottom:4px;">
                <div class="info-item">
                  <span class="info-label">Pincode</span>
                  <span class="info-value">{{ $customer->pincode }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Landmark</span>
                  <span class="info-value">{{ $customer->customer_landmark }}</span>
                </div>
              </div>
              <div class="info-item" style="margin-top:12px;">
                <span class="info-label">Full Address</span>
                <span class="info-value" style="line-height:1.6;">{{ $customer->customer_address }}</span>
              </div>

            </div>
          </div>
          @endforeach

          <!-- Order Timeline -->
          {{-- <div class="card">
            <div class="card-head">
              <div class="card-head-title"><i class="bi bi-activity me-2" style="color:var(--teal);"></i>Order Timeline</div>
            </div>
            <div class="card-body">
              <div class="timeline">
                @php $first = $customers->first(); @endphp
                <div class="tl-item">
                  <div class="tl-dot-wrap">
                    <div class="tl-dot done"><i class="bi bi-check2"></i></div>
                    <div class="tl-line"></div>
                  </div>
                  <div class="tl-content">
                    <div class="tl-title">Order Placed</div>
                    <div class="tl-sub">{{ \Carbon\Carbon::parse($first->created_at)->format('d M Y, h:i A') }}</div>
                  </div>
                </div>
                <div class="tl-item">
                  <div class="tl-dot-wrap">
                    <div class="tl-dot {{ $first->phleboassigned ? 'done' : '' }}"><i class="bi bi-person-badge"></i></div>
                    <div class="tl-line"></div>
                  </div>
                  <div class="tl-content">
                    <div class="tl-title">Phlebotomist Assigned</div>
                    <div class="tl-sub">{{ $first->phleboassigned ? \Carbon\Carbon::parse($first->phleboassigned)->format('d M Y, h:i A') : 'Awaiting assignment' }}</div>
                  </div>
                </div>
                <div class="tl-item">
                  <div class="tl-dot-wrap">
                    <div class="tl-dot {{ $first->pickup ? 'done' : '' }}"><i class="bi bi-box-arrow-up-right"></i></div>
                    <div class="tl-line"></div>
                  </div>
                  <div class="tl-content">
                    <div class="tl-title">Sample Picked Up</div>
                    <div class="tl-sub">{{ $first->pickup ? \Carbon\Carbon::parse($first->pickup)->format('d M Y, h:i A') : 'Pending' }}</div>
                  </div>
                </div>
                <div class="tl-item">
                  <div class="tl-dot-wrap">
                    <div class="tl-dot {{ $first->samplesync ? 'done' : '' }}"><i class="bi bi-arrow-repeat"></i></div>
                    <div class="tl-line"></div>
                  </div>
                  <div class="tl-content">
                    <div class="tl-title">Sample Synced</div>
                    <div class="tl-sub">{{ $first->samplesync ? \Carbon\Carbon::parse($first->samplesync)->format('d M Y, h:i A') : 'Pending' }}</div>
                  </div>
                </div>
                <div class="tl-item">
                  <div class="tl-dot-wrap">
                    <div class="tl-dot {{ $first->consolidatereport ? 'done' : '' }}"><i class="bi bi-file-earmark-check"></i></div>
                  </div>
                  <div class="tl-content">
                    <div class="tl-title">Report Ready</div>
                    <div class="tl-sub">{{ $first->consolidatereport ? \Carbon\Carbon::parse($first->consolidatereport)->format('d M Y, h:i A') : 'Pending' }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

        </div>

        <!-- ══ RIGHT ══ -->
        <div class="right-panel">

          <!-- Packages -->
          <div class="card">
            <div class="card-head">
              <div class="card-head-title"><i class="bi bi-clipboard2-pulse me-2" style="color:var(--teal);"></i>Packages</div>
              <span class="card-head-badge">{{ $packages->count() }}</span>
            </div>
            <div class="card-body" style="padding-top:8px;padding-bottom:8px;">
              @foreach($packages as $pkg)
                @php
                  $desc = json_decode($pkg->description, true);
                  $tests = $desc['tests'] ?? [];
                  $testCount = count($tests);
                @endphp
                <div class="pkg-item">
                  <div class="pkg-icon"><i class="bi bi-clipboard-pulse"></i></div>
                  <div style="flex:1;">
                    <div class="pkg-name">{{ $pkg->packagename }}</div>
                    <div class="pkg-type">{{ $pkg->type ?? 'Home collection' }} · {{ $testCount }} tests</div>
                    @if($testCount > 0)
                      <button class="tests-toggle" onclick="toggleTests(this)">
                        View tests
                        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                      </button>
                      <div class="tests-mini">
                        @foreach($tests as $t)
                          <span class="test-chip">{{ $t }}</span>
                        @endforeach
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Summary & Actions -->
          <div class="card">
            <div class="card-head dark">
              <div class="card-head-title">Order Summary</div>
            </div>
            <div class="summary-row">
              <span>Patients</span>
              <span class="val">{{ $customers->count() }}</span>
            </div>
            <div class="summary-row">
              <span>Packages</span>
              <span class="val">{{ $packages->count() }}</span>
            </div>
            <div class="summary-row">
              <span>Collection Date</span>
              <span class="val" style="font-size:13px;">{{ \Carbon\Carbon::parse($customers->first()->collection_date ?? now())->format('d M Y') }}</span>
            </div>
            <div class="summary-row">
              <span>Payment</span>
              <span class="val" style="font-size:13px;">
                @if($customers->first()->is_credit)
                  <span style="color:#16a34a;">Credit</span>
                @elseif($customers->first()->is_payment)
                  <span style="color:var(--teal-d);">Paid</span>
                @else
                  <span style="color:#d97706;">Pending</span>
                @endif
              </span>
            </div>

            <div style="height:16px;"></div>

            <a href="{{ route('invoice',["id"=>base64_encode($nht_order_id)]) }}" class="action-btn blue">
              <i class="bi bi-download"></i> Download Invoice
            </a>
            <button class="action-btn danger" onclick="document.getElementById('cancelModal').classList.add('show-modal')">
              <i class="bi bi-x-circle"></i> Cancel Order
            </button>

            <div class="trust-strip">
              <div class="trust-item"><span class="trust-icon"><i class="bi bi-shield-check"></i></span> Secure booking</div>
              <div class="trust-item"><span class="trust-icon"><i class="bi bi-house-check"></i></span> Home sample collection</div>
              <div class="trust-item"><span class="trust-icon"><i class="bi bi-clock"></i></span> Reports in 24–48 hrs</div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

</div>

<!-- ── CANCEL MODAL ── -->
<div id="cancelModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,.6);backdrop-filter:blur(4px);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:var(--white);border-radius:20px;padding:36px 32px;max-width:420px;width:90%;text-align:center;animation:fadeUp .3s ease;">
    <div class="modal-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
    <h3 style="font-family:var(--font);font-weight:800;font-size:18px;color:var(--navy-2);margin-bottom:8px;">Cancel this order?</h3>
    <p style="font-size:14px;color:var(--muted);margin-bottom:28px;">This action cannot be undone. All {{ $customers->count() }} patient(s) in this order will be cancelled.</p>
    <div style="display:flex;gap:12px;justify-content:center;">
      <button onclick="document.getElementById('cancelModal').classList.remove('show-modal')"
              style="padding:11px 24px;border-radius:50px;border:1.5px solid var(--border);background:var(--white);font-family:var(--font);font-size:13px;font-weight:700;color:var(--slate);cursor:pointer;">
        Keep Order
      </button>
      <form action="" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
                style="padding:11px 24px;border-radius:50px;border:none;background:linear-gradient(135deg,#be123c,#ef4444);color:var(--white);font-family:var(--font);font-size:13px;font-weight:700;cursor:pointer;">
          Yes, Cancel
        </button>
      </form>
    </div>
  </div>
</div>

<x-retailer.footer />

<style>
  #cancelModal.show-modal { display:flex !important; }
</style>

<script>
  function toggleTests(btn) {
    const mini = btn.nextElementSibling;
    mini.classList.toggle('show');
    btn.classList.toggle('open');
    btn.childNodes[0].textContent = mini.classList.contains('show') ? 'Hide tests ' : 'View tests ';
  }
</script>