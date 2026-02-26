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
        --red: #dc2626;
        --red-l: #fef2f2;
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
            radial-gradient(ellipse 55% 120% at 100% 50%, rgba(244, 63, 94, 0.15) 0%, transparent 65%),
            radial-gradient(ellipse 30% 80% at 0% 0%, rgba(190, 18, 60, 0.08) 0%, transparent 55%);
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
        color: #fda4af;
    }

    .back-link:hover svg {
        transform: translateX(-3px);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(244, 63, 94, 0.15);
        border: 1px solid rgba(244, 63, 94, 0.3);
        border-radius: 50px;
        font-family: var(--font);
        font-size: 11px;
        font-weight: 700;
        color: #fda4af;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .hero-badge span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f43f5e;
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
        margin-top: 32px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding-top: 24px;
        flex-wrap: wrap;
        gap: 0;
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

    .hstat-value.red {
        color: #fda4af;
    }

    /* ── CONTENT ── */
    .content-area {
        width: 100%;
        padding: 40px 60px 80px;
    }

    .content-inner {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* ── CARD ── */
    .card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: fadeUp 0.4s ease both;
        margin-bottom: 20px;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card:nth-child(2) {
        animation-delay: 0.08s;
    }

    .card:nth-child(3) {
        animation-delay: 0.14s;
    }

    .card-head {
        padding: 22px 28px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .card-head.dark {
        background: var(--navy-2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }

    .card-head-title {
        font-family: var(--font);
        font-size: 15px;
        font-weight: 700;
        color: var(--navy-2);
        letter-spacing: -0.2px;
    }

    .card-head.dark .card-head-title {
        color: var(--white);
    }

    .card-body {
        padding: 0;
    }

    .count-badge {
        font-family: var(--font);
        font-size: 11px;
        font-weight: 700;
        padding: 4px 11px;
        border-radius: 50px;
        background: #fef2f2;
        color: var(--red);
        border: 1px solid #fecaca;
    }

    /* ── CART ITEMS TABLE ── */
    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table thead tr {
        background: var(--bg);
        border-bottom: 1px solid var(--border);
    }

    .cart-table th {
        padding: 12px 24px;
        font-family: var(--font);
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        text-align: left;
    }

    .cart-table th:last-child {
        text-align: right;
    }

    .cart-item {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s;
        animation: fadeUp 0.3s ease both;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item:hover {
        background: #fdf2f4;
    }

    .cart-item td {
        padding: 18px 24px;
        vertical-align: middle;
    }

    .cart-item td:last-child {
        text-align: right;
    }

    .item-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .item-avatar {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #be123c, #f43f5e);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font);
        font-size: 18px;
        font-weight: 800;
        color: var(--white);
        flex-shrink: 0;
    }

    .item-name {
        font-family: var(--font);
        font-size: 14px;
        font-weight: 700;
        color: var(--navy-2);
        margin-bottom: 3px;
    }

    .item-sub {
        font-size: 12px;
        color: var(--muted);
    }

    .price-tag {
        font-family: var(--font);
        font-size: 18px;
        font-weight: 800;
        color: var(--teal-d);
        letter-spacing: -0.5px;
    }

    .remove-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: var(--red-l);
        color: var(--red);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s;
    }

    .remove-btn:hover {
        background: #fecaca;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        padding: 60px 24px;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #fef2f2;
        color: var(--red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 20px;
    }

    .empty-state h3 {
        font-family: var(--font);
        font-size: 18px;
        font-weight: 700;
        color: var(--navy-2);
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: var(--muted);
    }

    .browse-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 20px;
        padding: 12px 24px;
        background: var(--navy-2);
        color: var(--white);
        border-radius: 10px;
        font-family: var(--font);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s, transform 0.2s;
    }

    .browse-btn:hover {
        background: var(--navy);
        transform: translateY(-1px);
        color: var(--white);
    }

    /* ── SUMMARY CARD ── */
    .summary-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 28px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .pkg-hero,
        .content-area {
            padding-left: 24px;
            padding-right: 24px;
        }
    }

    @media (max-width: 640px) {

        .pkg-hero,
        .content-area {
            padding-left: 18px;
            padding-right: 18px;
        }

        .pkg-hero {
            padding-top: 32px;
            padding-bottom: 28px;
        }

        .cart-table th,
        .cart-item td {
            padding: 14px 16px;
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

    .summary-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        position: sticky;
        top: 24px;
        animation: fadeUp 0.4s ease both;
        animation-delay: 0.1s;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 22px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
        color: var(--slate);
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-row.total {
        font-family: var(--font);
        font-weight: 700;
        font-size: 16px;
        color: var(--navy-2);
        background: var(--bg);
    }

    .summary-row .val {
        font-family: var(--font);
        font-weight: 700;
        color: var(--navy-2);
    }

    .summary-row.total .val {
        color: var(--teal-d);
        font-size: 20px;
    }

    .checkout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: calc(100% - 44px);
        margin: 18px 22px;
        padding: 15px;
        background: linear-gradient(135deg, #be123c, #f43f5e);
        color: var(--white);
        border: none;
        border-radius: 12px;
        font-family: var(--font);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
    }

    .checkout-btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        color: var(--white);
    }

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
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: var(--green-l);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        flex-shrink: 0;
    }

    /* ── CHECKOUT ACTIONS ── */
    .clear-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--red-l);
        color: var(--red);
        border: 1px solid #fecaca;
        border-radius: 8px;
        font-family: var(--font);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.15s;
    }

    .clear-btn:hover {
        background: #fecaca;
    }
</style>

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
