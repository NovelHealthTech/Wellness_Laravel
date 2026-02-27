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

  /* HERO */
  .pkg-hero { background:#1f3964; padding:48px 60px 44px; position:relative; overflow:hidden; }
  .pkg-hero::before { content:''; position:absolute; inset:0; pointer-events:none;
    background:radial-gradient(ellipse 55% 120% at 100% 50%,rgba(37,99,235,.18) 0%,transparent 65%),
               radial-gradient(ellipse 30% 80% at 0% 0%,rgba(147,197,253,.10) 0%,transparent 55%); }
  .pkg-hero::after { content:''; position:absolute; inset:0; pointer-events:none;
    background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
    background-size:32px 32px; }
  .hero-inner { max-width:1200px; margin:0 auto; position:relative; z-index:1; }
  .back-link { display:inline-flex; align-items:center; gap:6px; font-family:var(--font); font-size:12.5px; font-weight:600; color:rgba(255,255,255,.5); text-decoration:none; margin-bottom:20px; transition:.2s; }
  .back-link svg { width:14px; height:14px; stroke:currentColor; fill:none; stroke-width:2.3; stroke-linecap:round; stroke-linejoin:round; transition:.2s; }
  .back-link:hover { color:var(--teal-m); } .back-link:hover svg { transform:translateX(-3px); }
  .hero-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; background:rgba(37,99,235,.18); border:1px solid rgba(147,197,253,.35); border-radius:50px; font-family:var(--font); font-size:11px; font-weight:700; color:var(--teal-m); letter-spacing:.8px; text-transform:uppercase; margin-bottom:16px; }
  .hero-badge span { width:6px; height:6px; border-radius:50%; background:#93c5fd; animation:pulse 2s infinite; }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }
  .pkg-hero h1 { font-family:var(--font); font-size:clamp(24px,3vw,38px); font-weight:800; color:var(--white); letter-spacing:-.8px; line-height:1.15; margin-bottom:12px; }
  .pkg-hero p { font-size:15px; color:rgba(255,255,255,.55); max-width:520px; }

  /* LAYOUT */
  .content-section { padding:40px 60px 80px; }
  .content-inner { max-width:1200px; margin:0 auto; }
  .lr-grid { display:grid; grid-template-columns:1fr 360px; gap:28px; align-items:start; }

  .section-label { font-family:var(--font); font-size:11.5px; font-weight:700; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
  .section-label strong { color:var(--navy); }

  /* PATIENT CARD */
  .patient-card { background:var(--white); border:1px solid var(--border); border-radius:16px; padding:28px; box-shadow:var(--shadow); margin-bottom:20px; animation:fadeUp .3s ease; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
  .patient-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:22px; padding-bottom:16px; border-bottom:1px solid var(--border); }
  .patient-title { font-family:var(--font); font-size:14px; font-weight:700; color:var(--navy); display:flex; align-items:center; gap:10px; }
  .num-badge { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,var(--teal-d),var(--teal)); color:var(--white); font-size:13px; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0; }
  .remove-btn { background:none; border:1.5px solid #fca5a5; color:var(--red); border-radius:50px; padding:6px 14px; font-family:var(--font); font-size:11.5px; font-weight:700; cursor:pointer; transition:.2s; display:flex; align-items:center; gap:5px; }
  .remove-btn:hover { background:var(--red-l); }
  .card-section { font-family:var(--font); font-size:10.5px; font-weight:700; color:var(--teal-d); text-transform:uppercase; letter-spacing:.8px; margin:18px 0 12px; display:flex; align-items:center; gap:8px; }
  .card-section::after { content:''; flex:1; height:1px; background:var(--border); }
  .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
  .form-row.three { grid-template-columns:1fr 1fr 1fr; }
  .form-group { display:flex; flex-direction:column; gap:5px; }
  .form-group label { font-family:var(--font); font-size:10.5px; font-weight:700; color:var(--slate); letter-spacing:.4px; text-transform:uppercase; }
  .form-group input, .form-group select, .form-group textarea { padding:10px 13px; border:1.5px solid var(--border); border-radius:10px; font-family:var(--body); font-size:14px; color:var(--navy); background:var(--bg); outline:none; transition:.2s; width:100%; }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color:var(--teal); box-shadow:0 0 0 4px rgba(37,99,235,.1); background:var(--white); }
  .form-group input.err, .form-group select.err, .form-group textarea.err { border-color:var(--red); }
  .form-group input[readonly] { background:#f1f5f9; color:var(--muted); cursor:not-allowed; }

  .add-btn { display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:14px; border:2px dashed var(--teal); background:var(--teal-l); color:var(--teal-d); border-radius:14px; font-family:var(--font); font-size:13px; font-weight:700; cursor:pointer; transition:.2s; }
  .add-btn:hover { background:var(--teal); color:var(--white); border-style:solid; }

  /* RIGHT PANEL */
  .right-panel { position:sticky; top:24px; display:flex; flex-direction:column; gap:20px; }

  .summary-card { background:var(--white); border:1px solid var(--border); border-radius:16px; box-shadow:var(--shadow); overflow:hidden; }
  .card-head { padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
  .card-head.dark { background:linear-gradient(135deg,#1e3a8a,#1d4ed8); border-bottom:1px solid rgba(255,255,255,.07); }
  .card-head-title { font-family:var(--font); font-size:14px; font-weight:700; color:var(--navy-2); }
  .card-head.dark .card-head-title { color:var(--white); }
  .card-head-badge { font-family:var(--font); font-size:11px; font-weight:700; padding:3px 10px; border-radius:50px; background:var(--teal-l); color:var(--teal-d); border:1px solid var(--border); }

  .tests-list { padding:8px 0; max-height:240px; overflow-y:auto; }
  .tests-list::-webkit-scrollbar { width:4px; }
  .tests-list::-webkit-scrollbar-thumb { background:var(--border); border-radius:4px; }

  .test-item { display:flex; align-items:center; gap:10px; padding:10px 20px; border-bottom:1px solid #f1f5f9; transition:.15s; }
  .test-item:last-child { border-bottom:none; }
  .test-item:hover { background:var(--teal-l); }
  .test-dot { width:7px; height:7px; border-radius:50%; background:var(--teal); flex-shrink:0; }
  .test-name { font-size:13px; color:var(--slate); line-height:1.4; flex:1; }
  .test-price { font-family:var(--font); font-weight:700; color:var(--teal-d); font-size:13px; white-space:nowrap; background:var(--teal-l); padding:3px 9px; border-radius:6px; border:1px solid var(--border); }

  .summary-row { display:flex; justify-content:space-between; align-items:center; padding:13px 22px; border-bottom:1px solid var(--border); font-size:14px; color:var(--slate); }
  .summary-row:last-child { border-bottom:none; }
  .summary-row .val { font-family:var(--font); font-weight:700; color:var(--navy-2); }
  .summary-row.total { background:var(--bg); font-family:var(--font); font-weight:700; font-size:15px; color:var(--navy-2); }
  .summary-row.total .val { color:var(--teal-d); font-size:22px; }

  .confirm-btn { display:flex; align-items:center; justify-content:center; gap:8px; width:calc(100% - 40px); margin:18px 20px; padding:14px; background:linear-gradient(135deg,var(--teal-d),var(--teal)); color:var(--white); border:none; border-radius:12px; font-family:var(--font); font-size:14px; font-weight:700; cursor:pointer; box-shadow:0 4px 14px rgba(37,99,235,.3); transition:.2s; }
  .confirm-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(37,99,235,.35); }

  .trust-strip { padding:14px 20px 18px; border-top:1px solid var(--border); display:flex; flex-direction:column; gap:8px; }
  .trust-item { display:flex; align-items:center; gap:9px; font-size:12.5px; color:var(--slate); font-weight:500; }
  .trust-icon { width:22px; height:22px; border-radius:6px; background:var(--green-l); color:var(--green); display:flex; align-items:center; justify-content:center; font-size:11px; flex-shrink:0; }

  @media(max-width:960px) {
    .lr-grid { grid-template-columns:1fr; }
    .right-panel { position:static; }
    .content-section { padding-left:24px; padding-right:24px; }
    .pkg-hero { padding-left:24px; padding-right:24px; }
  }
  @media(max-width:640px) {
    .pkg-hero, .content-section { padding-left:18px; padding-right:18px; }
    .form-row, .form-row.three { grid-template-columns:1fr; }
  }
</style>

<div class="page-wrap w-100">

  <!-- HERO -->
  <div class="pkg-hero">
    <div class="hero-inner">
      <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Back to Home
      </a>
      <div class="hero-badge"><span></span> Booking</div>
      <h1>Cutomer Booking Details</h1>
      <p>Add complete details for each customer. Every cutomer has their own full form.</p>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content-section">
    <div class="content-inner">
  {{-- action="{{ route('retailer.red_cliffe_order_placed') }}" --}}
      <form id="bookingForm" method="POST" >
        @csrf
        <input type="hidden" name="customer_latitude"  value="{{ $latitude }}">
        <input type="hidden" name="customer_longitude" value="{{ $longitude }}">
        <input type="hidden" name="collection_slot_id" value="{{ $collection_slot_id }}">

        <div class="lr-grid">

          <!-- LEFT: Patient Forms -->
          <div>
            <div class="section-label">Customers — <strong id="countLabel">1 added</strong></div>
            <div id="patientsWrap"></div>
            <button type="button" class="add-btn" onclick="addPatient()">
              <i class="bi bi-plus-circle-fill"></i> Add Another Customer
            </button>
          </div>

          <!-- RIGHT: Tests + Price -->
          <div class="right-panel">

            @php
              $packages=$redcliffcart_items;
              $package_count = count($redcliffcart_items);
              $price = $redcliffcart_items->sum("price");
            @endphp

            <!-- Packages Included -->
            <div class="summary-card">
              <div class="card-head">
                <div class="card-head-title"><i class="bi bi-clipboard2-pulse me-2" style="color:var(--teal)"></i>Packages included</div>
                <span class="card-head-badge">{{ $package_count }} Packages</span>
              </div>
              <div class="tests-list">
                @forelse($packages as $item)
                  <div class="test-item">
                    <div class="test-dot"></div>
                    <span class="test-name">{{ $item->package->packagename }}</span>
                    <span class="test-price">₹{{ number_format($item->price) }}</span>
                  </div>
                @empty
                  <div class="test-item"><span class="test-name" style="color:var(--muted);">No tests listed.</span></div>
                @endforelse
              </div>
            </div>

            <!-- Price Summary -->
            <div class="summary-card">
              <div class="card-head dark">
                <div class="card-head-title">Price Summary</div>
              </div>
              <div class="summary-row"><span>Price per patient</span><span class="val">₹{{ number_format($price) }}</span></div>
              <div class="summary-row"><span>No. of Patients</span><span class="val" id="sumPatients">1</span></div>
              <div class="summary-row total"><span>Total Amount</span><span class="val" id="sumAmount">₹{{ number_format($price) }}</span></div>

              <button type="submit" class="confirm-btn">
                <i class="bi bi-check-circle-fill"></i> Proceed to pay
              </button>

              <div class="trust-strip">
                <div class="trust-item"><span class="trust-icon"><i class="bi bi-shield-check"></i></span> Secure booking</div>
                <div class="trust-item"><span class="trust-icon"><i class="bi bi-house-check"></i></span> Home sample collection</div>
                <div class="trust-item"><span class="trust-icon"><i class="bi bi-clock"></i></span> Reports in 24–48 hrs</div>
              </div>
            </div>

          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<x-retailer.footer />

<script>
let count = 0;

const BOOKING_DATE    = "{{ date('Y-m-d') }}";
const COLLECTION_DATE = "{{ $collection_date }}";
const PINCODE         = "{{ $pincode }}";
const BASE_PRICE      = {{ $price }};

function addPatient() {
  count++;
  const n = count;
  const div = document.createElement('div');
  div.className = 'patient-card';
  div.id = `p-${n}`;
  div.innerHTML = `
    <div class="patient-header">
      <div class="patient-title">
        <div class="num-badge">${n}</div> Customer ${n}
      </div>
      ${n > 1 ? `<button type="button" class="remove-btn" onclick="removePatient(${n})"><i class="bi bi-trash3"></i> Remove</button>` : ''}
    </div>

    <div class="card-section"><i class="bi bi-person-fill"></i> Personal Info</div>
    <div class="form-row three" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Full Name *</label>
        <input type="text" name="patients[${n}][name]" placeholder="Patient name" required>
      </div>
      <div class="form-group">
        <label>Age *</label>
        <input type="number" name="patients[${n}][age]" placeholder="Age" min="1" max="120" required>
      </div>
      <div class="form-group">
        <label>Gender *</label>
        <select name="patients[${n}][gender]" required>
          <option value="">Select</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
    </div>

    <div class="card-section"><i class="bi bi-telephone-fill"></i> Contact Info</div>
    <div class="form-row" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Phone Number *</label>
        <input type="tel" name="patients[${n}][phone]" placeholder="10-digit number" required>
      </div>
      <div class="form-group">
        <label>WhatsApp Number *</label>
        <input type="tel" name="patients[${n}][whatsapp]" placeholder="WhatsApp number" required>
      </div>
    </div>

    <div class="card-section"><i class="bi bi-calendar3"></i> Booking Dates</div>
    <div class="form-row" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Booking Date</label>
        <input type="date" name="patients[${n}][booking_date]" value="${BOOKING_DATE}" readonly>
      </div>
      <div class="form-group">
        <label>Collection Date</label>
        <input type="date" name="patients[${n}][collection_date]" value="${COLLECTION_DATE}" readonly>
      </div>
    </div>

    <div class="card-section"><i class="bi bi-geo-alt-fill"></i> Address</div>
    <div class="form-row" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Pincode</label>
        <input type="text" name="patients[${n}][pincode]" value="${PINCODE}" readonly>
      </div>
      <div class="form-group">
        <label>Landmark *</label>
        <input type="text" name="patients[${n}][landmark]" placeholder="Nearest landmark" required>
      </div>
    </div>
    <div class="form-group" style="margin-bottom:4px;">
      <label>Full Address *</label>
      <textarea name="patients[${n}][address]" rows="3" placeholder="House no, street, area…" required></textarea>
    </div>`;

  document.getElementById('patientsWrap').appendChild(div);
  updateCount();
}

function removePatient(n) {
  document.getElementById(`p-${n}`)?.remove();
  updateCount();
}

function updateCount() {
  const n = document.querySelectorAll('.patient-card').length;
  document.getElementById('countLabel').textContent  = `${n} added`;
  document.getElementById('sumPatients').textContent = n;
  document.getElementById('sumAmount').textContent   = '₹' + (BASE_PRICE * n).toLocaleString('en-IN');
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
  let ok = true;
  this.querySelectorAll('[required]').forEach(el => {
    el.classList.remove('err');
    if (!el.value.trim()) { el.classList.add('err'); ok = false; }
  });
  if (!ok) { e.preventDefault(); alert('Please fill all required fields for every patient.'); }
});

addPatient();
</script>