<x-retailer.header />
@php
    $total = collect($redcliffcartitems)->sum('price');
    $count = count($redcliffcartitems);
@endphp

<div class="page-wrap">

    <!-- ── HERO ── -->
    <div class="pkg-hero">
        <div class="hero-inner">

            <a href="{{ route('retailer.allpackages') }}" class="back-link">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                All Packages
            </a>

            <div class="hero-badge">
                <span></span> Redcliffe Labs
            </div>

            <h1>Your Redcliffe Cart</h1>
            <p>Review your selected packages before proceeding to checkout.</p>

            <div class="hero-stats">
                <div class="hstat">
                    <div class="hstat-label">Items</div>
                    <div class="hstat-value red">{{ $count }}</div>
                </div>
                <div class="hstat">
                    <div class="hstat-label">Total Amount</div>
                    <div class="hstat-value">₹{{ number_format($total) }}</div>
                </div>
                <div class="hstat">
                    <div class="hstat-label">Collection</div>
                    <div class="hstat-value">Home / Centre</div>
                </div>
                <div class="hstat">
                    <div class="hstat-label">Lab</div>
                    <div class="hstat-value red">Redcliffe</div>
                </div>
            </div>

        </div>
    </div>

    <!-- ── CONTENT ── -->
    <div class="content-area">

        @if($count > 0)
                <div class="summary-grid">

                    <!-- LEFT: Cart Items -->
                    <div>
                        <div class="card">
                            <div class="card-head">
                                <span class="card-head-title">Cart Items</span>
                                <div style="display:flex;gap:10px;align-items:center;">
                                    <span class="count-badge">{{ $count }} items</span>
                                    <button class="clear-btn" onclick="clearCart()">
                                        <i class="bi bi-trash3"></i> Clear All
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>Tests</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($redcliffcartitems as $item)
                                            @php
                                                $desc = json_decode($item->package->description ?? '{}');
                                                $testCount = count($desc->tests ?? []);
                                            @endphp
                                            <tr class="cart-item" id="cart-row-{{ $item->id }}">
                                                <td>
                                                    <div class="item-info">
                                                        <div class="item-avatar">R</div>
                                                        <div>
                                                            <div class="item-name">{{ $item->package->packagename ?? 'Package' }}
                                                            </div>
                                                            <div class="item-sub">Redcliffe Labs · ISO Certified</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        style="font-family:var(--font);font-size:13px;font-weight:600;color:var(--teal-d);">
                                                        {{ $testCount }} tests
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="price-tag">₹{{ number_format($item->price) }}</span>
                                                </td>
                                                <td>
                                                    <button class="remove-btn" onclick="removeItem({{ $item->id }}, this)">
                                                        <i class="fa-solid fa-trash" style="color: rgb(231, 26, 26);"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <a href="{{ route('retailer.allpackages') }}"
                                    class="btn btn-outline-primary ms-3 mt-3 px-4 rounded-pill fw-semibold">
                                    + Add More Packages
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Summary -->
                    <div>
                        <div class="summary-card">
                            <div class="card-head dark">
                                <div class="card-head-title">Order Summary</div>
                            </div>


                            <div class="summary-row total">
                                <span>Total</span>
                                <span class="val">₹{{ number_format($total) }}</span>
                            </div>

                            <!-- Book Your Tests Form -->
                            <div style="padding: 16px 22px;">
                                <p
                                    style="font-family:var(--font);font-size:13px;font-weight:700;color:var(--navy-2);margin-bottom:14px;">
                                    Book Your Tests</p>

                                <div class="mb-3 form-group">
                                    <label class="form-label"
                                        style="font-size:12px;font-weight:600;color:var(--slate);">Locality</label>
                                    <input type="text" id="houseNo" class="form-control input-field"
                                        placeholder="Enter locality" required>
                                    <span class="error" style="color:var(--red);font-size:12px;"></span>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label"
                                        style="font-size:12px;font-weight:600;color:var(--slate);">City</label>
                                    <input type="text" id="city" class="form-control input-field" placeholder="Enter city"
                                        required>
                                    <span class="error" style="color:var(--red);font-size:12px;"></span>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label"
                                        style="font-size:12px;font-weight:600;color:var(--slate);">Pincode</label>
                                    <input type="text" id="pincode" class="form-control input-field" placeholder="Enter pincode"
                                        pattern="[0-9]{6}" maxlength="6" required>
                                    <span class="error" style="color:var(--red);font-size:12px;"></span>
                                </div>

                                <button id="redcliffsubmit" type="button" class="checkout-btn" style="margin:0;width:100%;">
                                    <i class="bi bi-geo-alt"></i> Check Availability
                                </button>
                            </div>

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

                <!-- Modal -->
                <div class="modal fade" id="succesmodal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content" style="border-radius:16px;">
                            <div class="modal-header"
                                style="background:#f0f7ff;border-radius:16px 16px 0 0;padding:20px 24px;border-bottom:2px solid #e3f2fd;">
                                <h5 class="modal-title" style="font-weight:600;color:#2c5282;">
                                    <i class="bi bi-geo-alt-fill me-2" style="color:#4a90e2;"></i>Select Your Location
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div id="succesmodalbody" class="modal-body" style="padding:24px;max-height:500px;overflow-y:auto;">
                                <div class="loader-container"
                                    style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px 20px;">
                                    <div class="spinner-border" role="status" style="width:3rem;height:3rem;color:#4a90e2;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p style="margin-top:16px;color:#64748b;font-size:0.95rem;">Searching for locations...</p>
                                </div>
                            </div>
                            <div class="modal-footer" style="background:#f8f9fa;border-radius:0 0 16px 16px;padding:16px 24px;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i>Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        @else

        <!-- Empty State -->
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-cart-x"></i></div>
                    <h3>Your Redcliffe cart is empty</h3>
                    <p>Browse our packages and add tests to your cart.</p>
                    <a href="{{ route('retailer.allpackages') }}" class="browse-btn">
                        <i class="bi bi-grid"></i> Browse Packages
                    </a>
                </div>
            </div>
        </div>

    @endif

</div>

</div>

<x-retailer.footer />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) window.location.reload();
    });

    document.getElementById("redcliffsubmit").addEventListener("click", async function (e) {
        e.preventDefault();

        let hasError = false;
        const inputs = document.querySelectorAll(".input-field");

        inputs.forEach((data) => {
            const parent = data.closest(".form-group");
            if (parent) {
                const errorDiv = parent.querySelector(".error");
                if (errorDiv) errorDiv.innerText = "";
            }
            if (data.value.trim() === "") {
                hasError = true;
                const inputdiv = data.closest(".form-group");
                if (inputdiv) {
                    const errordiv = inputdiv.querySelector(".error");
                    if (errordiv) errordiv.innerText = "Please fill the required details";
                }
            }
        });

        if (hasError) return;

        try {
            const houseNo = document.getElementById("houseNo").value.trim();
            const city = document.getElementById("city").value.trim();
            const pincode = document.getElementById("pincode").value.trim();

            $("#succesmodalbody").html(`
        <div class="loader-container">
          <div class="spinner-border spinner-border-custom" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <p class="loader-text">Searching for locations...</p>
        </div>
      `);
            $("#succesmodal").modal("show");

            const headers = {
                "key": "pW2woxd83m29ihJUlIRM9oxKnylbPt4a",
                "Accept": "application/json"
            };

            // Helper to call API with a given query
            async function searchLocation(query) {
                const url = `https://api.redcliffelabs.com/api/partner/v2/get-partner-location-2-eloc/?place_query=${encodeURIComponent(query)}`;
                const res = await fetch(url, { method: "GET", headers });
                const data = await res.json();
                return (data.status === "Success" && data.data && data.data.length > 0) ? data.data : null;
            }

            // ✅ Priority: locality → pincode → city
            let locations = await searchLocation(houseNo)
                ?? await searchLocation(pincode)
                ?? await searchLocation(city);

            $("#succesmodalbody").empty();

            if (locations && locations.length > 0) {
                locations.forEach((location, index) => {
                    $("#succesmodalbody").append(`
            <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div class="flex-grow-1">
                            <h6 class="card-title fw-semibold mb-1 text-dark">
                                <i class="bi bi-pin-map-fill text-danger me-2"></i>${location.placeName}
                            </h6>
                            <p class="card-text text-muted small mb-0">
                                <i class="bi bi-geo-alt me-1 text-secondary"></i>${location.placeAddress}
                            </p>
                        </div>
                        <a href="/select-location/${location.eloc}?pincode=${pincode}"
                            class="btn btn-dark btn-sm rounded-pill px-3 flex-shrink-0 align-self-center">
                            <i class="bi bi-check-circle me-1"></i>Select
                        </a>
                    </div>
                </div>
            </div>
        `);
                });
            } else {
                $("#succesmodalbody").html(`
        <div class="text-center py-5">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 72px; height: 72px;">
                <i class="bi bi-search fs-2 text-muted"></i>
            </div>
            <h6 class="fw-semibold text-dark mb-1">No Locations Found</h6>
            <p class="text-muted small mb-0">Try a different locality, pincode or city.</p>
        </div>
    `);
            }
        } catch (error) {
            $("#succesmodalbody").html(`
        <div class="empty-state">
          <i class="bi bi-exclamation-triangle text-danger"></i>
          <p class="text-danger">Something went wrong. Please try again.</p>
        </div>
      `);
        }
    });
</script>
<script>
    // Push a state so the back button is interceptable
    history.pushState(null, null, location.href);

    window.addEventListener('popstate', function () {
        // Change this route to wherever you want the back button to go
        window.location.href = "{{ route('retailer.allpackages') }}";
    });
</script>