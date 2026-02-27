<x-retailer.header />
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
                <li class="{{ $idx >= 3 ? 'extra' : '' }}">
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
                <button class="toggle-btn" >
                  <span>+{{ $total - 5 }} more</span>
                  
                    <polyline points="6 9 12 15 18 9" />
                  </svg>
                </button>
              @else
                <span></span>
              @endif

              @if(in_array($package->id, $redcliffpackageIds))
                <a href="{{ route('retailer.deletepackage') }}" class="view-btn cursor-pointer"
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

  // window.toggleTests = function (id, btn) {
  //   const extras = document.querySelectorAll(`#tl-${id} .extra`);
  //   const isOpen = btn.classList.contains('open');
  //   const total = document.querySelectorAll(`#tl-${id} li`).length;
  //   extras.forEach(li => li.classList.toggle('show', !isOpen));
  //   btn.classList.toggle('open', !isOpen);
  //   btn.querySelector('span').textContent = isOpen ? `+${total - 5} more` : 'Show less';
  // }

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