<x-retailer.header />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

  :root {
    --navy:#0f172a; --teal:#0d9488; --teal-l:#f0fdfa; --teal-m:#99f6e4;
    --teal-d:#0f766e; --slate:#475569; --muted:#94a3b8; --border:#e2e8f0;
    --bg:#f8fafc; --white:#ffffff;
    --font:'Sora',sans-serif; --body:'DM Sans',sans-serif;
    --shadow:0 4px 16px rgba(15,23,42,.07),0 1px 4px rgba(15,23,42,.04);
  }
  body { background:var(--bg)!important; font-family:var(--body); color:var(--navy); }

  /* ── HERO (same as packages page) ── */
  .pkg-hero {
    background:#1f3964; padding:48px 60px 44px;
    position:relative; overflow:hidden;
  }
  .pkg-hero::before {
    content:''; position:absolute; inset:0;
    background:radial-gradient(ellipse 55% 120% at 100% 50%,rgba(13,148,136,.18) 0%,transparent 65%),
               radial-gradient(ellipse 30% 80% at 0% 0%,rgba(13,148,136,.08) 0%,transparent 55%);
    pointer-events:none;
  }
  .pkg-hero::after {
    content:''; position:absolute; inset:0;
    background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                     linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
    background-size:32px 32px; pointer-events:none;
  }
  .hero-inner { max-width:1200px; margin:0 auto; position:relative; z-index:1; }
  .back-link {
    display:inline-flex; align-items:center; gap:6px;
    font-family:var(--font); font-size:12.5px; font-weight:600;
    color:rgba(255,255,255,.5); text-decoration:none; margin-bottom:20px; transition:.2s;
  }
  .back-link svg { width:14px; height:14px; stroke:currentColor; fill:none; stroke-width:2.3; stroke-linecap:round; stroke-linejoin:round; transition:.2s; }
  .back-link:hover { color:var(--teal-m); }
  .back-link:hover svg { transform:translateX(-3px); }
  .hero-badge {
    display:inline-flex; align-items:center; gap:6px;
    padding:5px 12px; background:rgba(13,148,136,.18); border:1px solid rgba(13,148,136,.35);
    border-radius:50px; font-family:var(--font); font-size:11px; font-weight:700;
    color:var(--teal-m); letter-spacing:.8px; text-transform:uppercase; margin-bottom:16px;
  }
  .hero-badge span { width:6px; height:6px; border-radius:50%; background:var(--teal); animation:pulse 2s infinite; }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }
  .pkg-hero h1 { font-family:var(--font); font-size:clamp(24px,3vw,38px); font-weight:800; color:var(--white); letter-spacing:-.8px; line-height:1.15; margin-bottom:12px; }
  .pkg-hero p { font-size:15px; color:rgba(255,255,255,.55); max-width:520px; }
  .hero-stats { display:flex; gap:0; margin-top:32px; border-top:1px solid rgba(255,255,255,.08); padding-top:24px; flex-wrap:wrap; }
  .hstat { padding:0 28px 0 0; margin-right:28px; border-right:1px solid rgba(255,255,255,.1); }
  .hstat:last-child { border-right:none; }
  .hstat-label { font-family:var(--font); font-size:10px; font-weight:700; color:rgba(255,255,255,.35); letter-spacing:1px; text-transform:uppercase; margin-bottom:4px; }
  .hstat-value { font-family:var(--font); font-size:18px; font-weight:700; color:var(--white); }
  .hstat-value.teal { color:var(--teal-m); }

  /* ── CONTENT SECTION ── */
  .content-section { padding:40px 60px 80px; }
  .section-inner { max-width:1200px; margin:0 auto; }
  .section-label { font-family:var(--font); font-size:11.5px; font-weight:700; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:24px; }
  .section-label strong { color:var(--navy); }

  /* ── DATE PICKER CARD ── */
  .picker-card {
    background:var(--white); border:1px solid var(--border); border-radius:16px;
    padding:28px 24px; box-shadow:var(--shadow); margin-bottom:24px;
  }
  .picker-card h2 { font-family:var(--font); font-size:15px; font-weight:700; color:var(--navy); margin-bottom:18px; }

  .date-scroll-wrap { position:relative; }
  .scroll-btn {
    position:absolute; top:50%; transform:translateY(-50%); z-index:10;
    background:var(--white); border:1px solid var(--border); width:34px; height:34px;
    border-radius:50%; display:flex; align-items:center; justify-content:center;
    cursor:pointer; box-shadow:var(--shadow); transition:.2s;
  }
  .scroll-btn:hover { background:var(--teal-l); border-color:var(--teal); }
  .scroll-btn-left { left:-14px; } .scroll-btn-right { right:-14px; }
  .scroll-btn i { color:var(--teal-d); font-size:13px; }

  .dates-row {
    display:flex; gap:10px; overflow-x:auto; scroll-behavior:smooth;
    padding:6px 4px; scrollbar-width:none;
  }
  .dates-row::-webkit-scrollbar { display:none; }

  .date-card {
    min-width:100px; flex-shrink:0; border:2px solid var(--border); border-radius:12px;
    padding:12px 10px; text-align:center; cursor:pointer; transition:.25s;
    background:var(--bg); user-select:none;
  }
  .date-card:hover { border-color:var(--teal); transform:translateY(-3px); box-shadow:0 6px 18px rgba(13,148,136,.12); }
  .date-card.selected { background:linear-gradient(135deg,var(--teal-d),var(--teal)); border-color:var(--teal); box-shadow:0 6px 20px rgba(13,148,136,.3); }
  .date-card.selected .dc-num, .date-card.selected .dc-day { color:var(--white)!important; }
  .dc-label { font-family:var(--font); font-size:10px; font-weight:600; color:var(--muted); text-transform:uppercase; letter-spacing:.6px; margin-bottom:4px; }
  .dc-num { font-family:var(--font); font-size:22px; font-weight:800; color:var(--navy); }
  .dc-day { font-size:12px; color:var(--muted); font-weight:500; margin-top:2px; }

  .info-pill {
    display:inline-flex; align-items:center; gap:6px; margin-top:16px;
    background:var(--teal-l); border:1px solid #ccfbf1; color:var(--teal-d);
    padding:7px 14px; border-radius:50px; font-size:13px; font-weight:500;
  }

  /* ── TIME SLOTS CARD ── */
  .slots-card {
    background:var(--white); border:1px solid var(--border); border-radius:16px;
    padding:28px 24px; box-shadow:var(--shadow); display:none;
  }
  .slots-card.show { display:block; animation:fadeUp .35s ease; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

  .slots-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
  .slots-header h2 { font-family:var(--font); font-size:15px; font-weight:700; color:var(--navy); margin:0; }
  .slots-badge { font-family:var(--font); font-size:11px; font-weight:700; padding:4px 12px; border-radius:50px; background:var(--teal-l); color:var(--teal-d); border:1px solid #ccfbf1; }

  #slotsGrid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:10px; }

  .slot-btn {
    padding:10px 8px; border-radius:10px; border:2px solid var(--border);
    background:var(--bg); font-family:var(--font); font-size:12.5px; font-weight:600;
    color:var(--slate); cursor:pointer; text-align:center; transition:.2s; line-height:1.4;
  }
  .slot-btn:hover { border-color:var(--teal); color:var(--teal-d); background:var(--teal-l); }
  .slot-btn.active { background:var(--teal); border-color:var(--teal); color:var(--white); box-shadow:0 4px 12px rgba(13,148,136,.3); }
  .slot-btn.full { border-color:#fca5a5; color:#dc2626; background:#fef2f2; cursor:not-allowed; }

  .empty-slots { text-align:center; padding:40px 20px; color:var(--muted); }
  .empty-slots i { font-size:2.5rem; display:block; margin-bottom:10px; color:#cbd5e1; }

  .loader-wrap { display:flex; flex-direction:column; align-items:center; padding:40px; color:var(--muted); }
  .loader-wrap .spinner-border { color:var(--teal); width:2.5rem; height:2.5rem; margin-bottom:12px; }

  /* ── CONFIRM FOOTER ── */
  .confirm-footer {
    margin-top:24px; padding:20px 24px; background:var(--white);
    border:1px solid var(--border); border-radius:16px; box-shadow:var(--shadow);
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;
  }
  .confirm-info { font-size:14px; color:var(--slate); }
  .confirm-info strong { color:var(--navy); font-family:var(--font); }
  .confirm-btn {
    display:inline-flex; align-items:center; gap:7px;
    padding:12px 28px; border:none; border-radius:50px;
    background:linear-gradient(135deg,var(--teal-d),var(--teal));
    color:var(--white); font-family:var(--font); font-size:13px; font-weight:700;
    cursor:pointer; transition:.2s; box-shadow:0 4px 14px rgba(13,148,136,.3);
  }
  .confirm-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(13,148,136,.35); }
  .confirm-btn:disabled { opacity:.5; cursor:not-allowed; transform:none; }

  @media(max-width:768px) {
    .pkg-hero, .content-section { padding-left:18px; padding-right:18px; }
    .pkg-hero { padding-top:32px; padding-bottom:28px; }
    .hstat { border-right:none; padding-right:0; margin-right:0; }
    #slotsGrid { grid-template-columns:repeat(auto-fill,minmax(120px,1fr)); }
  }
</style>

<div class="page-wrap">

  <!-- HERO -->
  <div class="pkg-hero">
    <div class="hero-inner">
      <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Home
      </a>
      <div class="hero-badge"><span></span> Book Collection</div>
      <h1>Schedule Your Sample Collection</h1>
      <p>Pick a date and time slot that works best for you — we'll handle the rest.</p>
      <div class="hero-stats">
        <div class="hstat"><div class="hstat-label">Collection Mode</div><div class="hstat-value teal">Home Visit</div></div>
        <div class="hstat"><div class="hstat-label">Pincode</div><div class="hstat-value">{{ $pincode }}</div></div>
        <div class="hstat"><div class="hstat-label">Reports</div><div class="hstat-value teal">24–48 hrs</div></div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content-section">
    <div class="section-inner">
      <div class="section-label">Step 1 — <strong>Select a date</strong></div>

      <!-- Date Picker -->
      <div class="picker-card">
        <div class="date-scroll-wrap">
          <button class="scroll-btn scroll-btn-left" onclick="scrollDates(-1)"><i class="bi bi-chevron-left"></i></button>
          <div class="dates-row" id="datesRow"></div>
          <button class="scroll-btn scroll-btn-right" onclick="scrollDates(1)"><i class="bi bi-chevron-right"></i></button>
        </div>
        <div class="info-pill"><i class="bi bi-info-circle-fill"></i> Showing next 30 available days</div>
      </div>

      <div class="section-label" style="margin-top:32px;">Step 2 — <strong>Choose a time slot</strong></div>

      <!-- Time Slots -->
      <div class="slots-card show" id="slotsCard">
        <div class="slots-header">
          <h2><i class="bi bi-clock-fill me-2" style="color:var(--teal)"></i>Available Slots</h2>
          <span class="slots-badge" id="slotCountBadge">Loading…</span>
        </div>
        <div id="slotsGrid">
          <div class="loader-wrap">
            <div class="spinner-border" role="status"></div>
            <span>Fetching slots…</span>
          </div>
        </div>
      </div>

      <!-- Confirm Footer -->
      <form id="slotForm" action="{{ route('retailer.redclifftimeslotsubmit') }}" method="POST">
        @csrf
        <input type="hidden" name="redcliffdate"     id="hiddenDate">
        <input type="hidden" name="redcliffslot"     id="hiddenSlot">
        <input type="hidden" name="latitude"          value="{{ $latitude }}">
        <input type="hidden" name="longitude"         value="{{ $longitude }}">
        <input type="hidden" name="redcliffpincode"   value="{{ $pincode }}">

        <div class="confirm-footer" id="confirmFooter" style="display:none;">
          <div class="confirm-info">
            <strong id="confirmText">No slot selected</strong><br>
            <span style="font-size:13px;color:var(--muted);">Please confirm your booking below.</span>
          </div>
          <button type="submit" class="confirm-btn" id="confirmBtn">
            <i class="bi bi-calendar-check"></i> Confirm Booking
          </button>
        </div>
      </form>

    </div>
  </div>

</div>

<x-retailer.footer />

<script>
const MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const DAYS   = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
const LAT    = @json($latitude);
const LNG    = @json($longitude);
const CSRF   = document.querySelector('meta[name="csrf-token"]').content;

let selectedDate = '', selectedSlotId = '', selectedSlotLabel = '';

// Build date cards
(function buildDates(){
  const row = document.getElementById('datesRow');
  const today = new Date();
  let html = '';
  for(let i = 0; i < 30; i++){
    const d = new Date(today); d.setDate(today.getDate() + i);
    const iso = d.toISOString().split('T')[0];
    html += `<div class="date-card" data-date="${iso}" onclick="pickDate(this,'${iso}')">
      <div class="dc-label">${MONTHS[d.getMonth()]}</div>
      <div class="dc-num">${d.getDate()}</div>
      <div class="dc-day">${DAYS[d.getDay()]}</div>
    </div>`;
  }
  row.innerHTML = html;
  // Auto-select first card
  pickDate(row.firstElementChild, row.firstElementChild.dataset.date);
})();

function scrollDates(dir){
  document.getElementById('datesRow').scrollBy({left: dir * 320, behavior:'smooth'});
}

async function pickDate(el, date){
  document.querySelectorAll('.date-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  selectedDate = date;
  document.getElementById('hiddenDate').value = date;
  selectedSlotId = ''; selectedSlotLabel = '';
  updateConfirm();
  await loadSlots(date);
}

async function loadSlots(date){
  const grid = document.getElementById('slotsGrid');
  const badge = document.getElementById('slotCountBadge');
  grid.innerHTML = `<div class="loader-wrap"><div class="spinner-border" role="status"></div><span>Fetching slots…</span></div>`;
  badge.textContent = 'Loading…';

  try {
    const res  = await fetch("{{ route('retailer.redcliffdate.post') }}", {
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN': CSRF},
      body: JSON.stringify({date, latitude: LAT, longitude: LNG})
    });
    const data = await res.json();
    const slots = data.results || [];
    badge.textContent = slots.length ? `${slots.length} slots` : 'No slots';

    if(!slots.length){
      grid.innerHTML = `<div class="empty-slots"><i class="bi bi-calendar-x"></i>No slots available for this date.</div>`;
      return;
    }
    grid.innerHTML = slots.map(s => `
      <button type="button" class="slot-btn" data-id="${s.id}"
        data-label="${s.format_12_hrs.start_time} – ${s.format_12_hrs.end_time}"
        onclick="pickSlot(this)">
        ${s.format_12_hrs.start_time}<br><span style="font-size:11px;opacity:.7">to ${s.format_12_hrs.end_time}</span>
      </button>`).join('');
  } catch(e){
    badge.textContent = 'Error';
    grid.innerHTML = `<div class="empty-slots"><i class="bi bi-exclamation-triangle"></i>Could not load slots. Please retry.</div>`;
  }
}

function pickSlot(el){
  document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  selectedSlotId    = el.dataset.id;
  selectedSlotLabel = el.dataset.label;
  document.getElementById('hiddenSlot').value = selectedSlotId;
  updateConfirm();
}

function updateConfirm(){
  const footer = document.getElementById('confirmFooter');
  const text   = document.getElementById('confirmText');
  if(selectedDate && selectedSlotId){
    footer.style.display = 'flex';
    text.textContent = `${selectedDate}  ·  ${selectedSlotLabel}`;
  } else {
    footer.style.display = 'none';
  }
}

document.getElementById('slotForm').addEventListener('submit', function(e){
  if(!selectedSlotId){ e.preventDefault(); alert('Please select a time slot first.'); }
});
</script>