<x-retailer.header />



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
        <input type="hidden" name="redcliffdate"   id="hiddenDate">
        <input type="hidden" name="redcliffslot"   id="hiddenSlot">
        <input type="hidden" name="latitude"        value="{{ $latitude }}">
        <input type="hidden" name="longitude"       value="{{ $longitude }}">
        <input type="hidden" name="redcliffpincode" value="{{ $pincode }}">

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
  const grid  = document.getElementById('slotsGrid');
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