<x-retailer.header />



<div class="page-wrap w-100">

  <!-- HERO -->
  <div class="pkg-hero">
    <div class="hero-inner">
      <a href="{{ route('retailer.retailerhomepage') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Back to Home
      </a>
      <div class="hero-badge"><span></span> Booking</div>
      <h1>Customer Booking Details</h1>
      <p>Add complete details for each customer. Every customer has their own full form.</p>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content-section">
    <div class="content-inner">
      {{-- action="{{ route('retailer.red_cliffe_order_placed') }}" --}}
      <form id="bookingForm" method="POST">
        @csrf
        <input type="hidden" name="customer_latitude"  value="{{ $latitude }}">
        <input type="hidden" name="customer_longitude" value="{{ $longitude }}">
        <input type="hidden" name="collection_slot_id" value="{{ $collection_slot_id }}">

        <div class="lr-grid">

          <!-- LEFT: Patient Forms -->
          <div>
            <div class="section-label">Customers — <strong id="countLabel">1 added</strong></div>

            <button type="button" class="add-btn" onclick="addPatient()">
              <i class="bi bi-plus-circle-fill"></i> Add Another Customer
            </button>

            <div id="patientsWrap" style="margin-top:20px;"></div>
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
const BOOKING_DATE    = "{{ date('Y-m-d') }}";
const COLLECTION_DATE = "{{ $collection_date }}";
const PINCODE         = "{{ $pincode }}";
const BASE_PRICE      = {{ $price }};

/* ─── Field name order must match DOM order of inputs/selects/textareas ─── */
const FIELD_NAMES = [
  'name', 'age', 'gender',
  'phone', 'whatsapp',
  'booking_date', 'collection_date',
  'pincode', 'landmark',
  'address'
];

/* ─── Build a fresh blank card ─── */
function buildCard() {
  const div = document.createElement('div');
  div.className = 'patient-card';
  div.innerHTML = `
    <div class="patient-header">
      <div class="patient-title">
        <div class="num-badge card-num"></div>
        <span class="card-label"></span>
      </div>
      <div class="remove-btn-wrap"></div>
    </div>

    <div class="card-section"><i class="bi bi-person-fill"></i> Personal Info</div>
    <div class="form-row three" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Full Name *</label>
        <input type="text" placeholder="Patient name" required>
      </div>
      <div class="form-group">
        <label>Age *</label>
        <input type="number" placeholder="Age" min="1" max="120" required>
      </div>
      <div class="form-group">
        <label>Gender *</label>
        <select required>
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
        <input type="tel" placeholder="10-digit number" required>
      </div>
      <div class="form-group">
        <label>WhatsApp Number *</label>
        <input type="tel" placeholder="WhatsApp number" required>
      </div>
    </div>

    <div class="card-section"><i class="bi bi-calendar3"></i> Booking Dates</div>
    <div class="form-row" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Booking Date</label>
        <input type="date" value="${BOOKING_DATE}" readonly>
      </div>
      <div class="form-group">
        <label>Collection Date</label>
        <input type="date" value="${COLLECTION_DATE}" readonly>
      </div>
    </div>

    <div class="card-section"><i class="bi bi-geo-alt-fill"></i> Address</div>
    <div class="form-row" style="margin-bottom:14px;">
      <div class="form-group">
        <label>Pincode</label>
        <input type="text" value="${PINCODE}" readonly>
      </div>
      <div class="form-group">
        <label>Landmark *</label>
        <input type="text" placeholder="Nearest landmark" required>
      </div>
    </div>
    <div class="form-group" style="margin-bottom:4px;">
      <label>Full Address *</label>
      <textarea rows="3" placeholder="House no, street, area…" required></textarea>
    </div>`;
  return div;
}

/* ─── Re-number ALL cards after every add / remove ─── */
function renumberCards() {
  const cards = document.querySelectorAll('#patientsWrap .patient-card');
  const total  = cards.length;

  cards.forEach((card, idx) => {
    const position = idx + 1; // 1-based

    /* 1. Update visible number and title */
    card.querySelector('.card-num').textContent   = position;
    card.querySelector('.card-label').textContent = `Customer ${position}`;

    /* 2. Remove button logic:
          - Position 1 → clear the wrap completely (NO button at all)
          - Position 2+ → inject button if not already there            */
    const wrap = card.querySelector('.remove-btn-wrap');
    if (position === 1) {
      wrap.innerHTML = ''; // completely empty — no button
    } else {
      if (!wrap.querySelector('.remove-btn')) {
        const btn = document.createElement('button');
        btn.type      = 'button';
        btn.className = 'remove-btn';
        btn.innerHTML = '<i class="bi bi-trash3"></i> Remove';
        btn.addEventListener('click', function () {
          card.remove();
          renumberCards();
        });
        wrap.appendChild(btn);
      }
    }

    /* 3. Re-index name attributes in DOM order */
    card.querySelectorAll('input, select, textarea').forEach((el, fi) => {
      if (fi < FIELD_NAMES.length) {
        el.name = `patients[${position}][${FIELD_NAMES[fi]}]`;
      }
    });
  });

  /* 4. Update sidebar */
  document.getElementById('countLabel').textContent  = `${total} added`;
  document.getElementById('sumPatients').textContent = total;
  document.getElementById('sumAmount').textContent   =
    '₹' + (BASE_PRICE * total).toLocaleString('en-IN');
}

/* ─── Public: add a new patient card ─── */
function addPatient() {
  document.getElementById('patientsWrap').appendChild(buildCard());
  renumberCards();
}

/* ─── Form validation ─── */
document.getElementById('bookingForm').addEventListener('submit', function (e) {
  let ok = true;
  this.querySelectorAll('[required]').forEach(el => {
    el.classList.remove('err');
    if (!el.value.trim()) { el.classList.add('err'); ok = false; }
  });
  if (!ok) {
    e.preventDefault();
    alert('Please fill all required fields for every customer.');
  }
});

/* ─── Init ─── */
addPatient();
</script>