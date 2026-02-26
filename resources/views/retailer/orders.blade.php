<x-retailer.header />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap');

    body { background: #eef2ff; }

    /* ── HERO ── */
    .orders-hero {
        width: 100%;
        background: #1f3964;
        padding: 40px 60px;
        position: relative;
        overflow: hidden;
    }
    .orders-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
          radial-gradient(ellipse 55% 120% at 100% 50%, rgba(13,148,136,0.18) 0%, transparent 65%),
          radial-gradient(ellipse 30% 80% at 0% 0%, rgba(13,148,136,0.08) 0%, transparent 55%);
        pointer-events: none;
    }
    .orders-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
          linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
          linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
    }
    .hero-inner { position: relative; z-index: 1; }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(13,148,136,0.18);
        border: 1px solid rgba(13,148,136,0.35);
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        color: #99f6e4;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .hero-badge span {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #0d9488;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%,100% { opacity:1; transform:scale(1); }
        50%      { opacity:0.6; transform:scale(1.3); }
    }

    .hero-stats {
        display: flex;
        gap: 0;
        margin-top: 28px;
        border-top: 1px solid rgba(255,255,255,0.08);
        padding-top: 20px;
        flex-wrap: wrap;
    }
    .hstat { padding: 0 28px 0 0; margin-right: 28px; border-right: 1px solid rgba(255,255,255,0.1); }
    .hstat:last-child { border-right: none; }
    .hstat-label {
        font-size: 10px; font-weight: 700;
        color: rgba(255,255,255,0.35);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }
    .hstat-value { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #fff; }
    .hstat-value.teal { color: #99f6e4; }

    /* ── SIDEBAR ── */
    .filter-card {
        border-radius: 16px;
        border: 1px solid #dde4ff;
        background: #fff;
        position: sticky;
        top: 20px;
        overflow: hidden;
    }
    .filter-title { background: linear-gradient(135deg, #102544, #4e73df); }
    .filter-btn {
        border-radius: 10px;
        border: 1px solid #dde4ff;
        background: #f8f9ff;
        color: #4e73df;
        font-size: 13px;
        transition: 0.2s;
        text-align: left;
    }
    .filter-btn:hover, .filter-btn.active {
        background: linear-gradient(135deg, #102544, #4e73df);
        color: #fff !important;
        border-color: transparent;
    }
    .filter-btn.active i, .filter-btn:hover i { color: #fff !important; }

    /* ── ORDER CARDS ── */
    .order-wrap {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        border: 1px solid #dde4ff;
        transition: 0.3s;
    }
    .order-wrap:hover { box-shadow: 0 10px 30px rgba(78,115,223,0.15); transform: translateY(-2px); }
    .order-top { background: linear-gradient(135deg, #102544, #4e73df); }
    .pkg-icon-box {
        width: 64px; height: 64px;
        background: linear-gradient(135deg, #eef2ff, #dde4ff);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* ── DATEPICKER STYLING ── */
    .datepicker {
        padding: 12px;
        border-radius: 14px !important;
        border: 1px solid #dde4ff !important;
        box-shadow: 0 10px 30px rgba(78,115,223,0.15) !important;
        font-family: 'Sora', sans-serif;
    }
    .datepicker table { width: 100%; }
    .datepicker table tr td,
    .datepicker table tr th {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        font-size: 13px;
        padding: 6px;
        text-align: center;
    }
    .datepicker table tr th {
        font-weight: 700;
        color: #102544;
        padding-bottom: 10px;
    }
    .datepicker .datepicker-switch,
    .datepicker .prev,
    .datepicker .next {
        padding: 10px 0;
        font-size: 13px;
        font-weight: 700;
        color: #4e73df;
    }
    .datepicker table tr td.active,
    .datepicker table tr td.active:hover,
    .datepicker table tr td.active.highlighted {
        background: linear-gradient(135deg, #102544, #4e73df) !important;
        border-radius: 8px;
        color: #fff !important;
        text-shadow: none;
    }
    .datepicker table tr td.today {
        background: #eef2ff !important;
        color: #4e73df !important;
        border-radius: 8px;
        font-weight: 700;
    }
    .datepicker table tr td:hover {
        background: #eef2ff;
        border-radius: 8px;
        cursor: pointer;
    }
    .datepicker .dow {
        color: #94a3b8;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding-bottom: 8px !important;
    }
    .datepicker-days .datepicker-switch {
        color: #102544 !important;
        font-size: 14px;
    }
</style>

<div class="page-content w-100" style="min-height:100vh; background:#eef2ff;">

    {{-- HERO --}}
    <div class="orders-hero">
        <div class="hero-inner">
            <div class="hero-badge"><span></span> Order History</div>
            <h1 style="font-family:'Sora',sans-serif; font-size:32px; font-weight:800; color:#fff; margin-bottom:6px; letter-spacing:-0.5px;">
                My Orders
            </h1>
            <p style="color:rgba(255,255,255,0.55); font-size:14px; margin:0;">
                Track and manage all your lab test bookings
            </p>
            <div class="hero-stats">
                <div class="hstat">
                    <div class="hstat-label">Total Orders</div>
                    <div class="hstat-value teal">{{ count($orders) }}</div>
                </div>
              
               
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">

            {{-- SIDEBAR FILTERS --}}
            <div class="col-md-3">
                <div class="filter-card shadow-sm">

                    <div class="filter-title px-4 py-3">
                        <p class="text-white fw-bold mb-0" style="font-family:'Sora',sans-serif;">
                            <i class="fas fa-filter me-2"></i>Filter Orders
                        </p>
                    </div>

                    <div class="p-3 d-flex flex-column gap-2">

                        <button class="filter-btn btn w-100 py-2 px-3 active">
                            <i class="fas fa-th-list me-2"></i> All Orders
                        </button>
                        <button class="filter-btn btn w-100 py-2 px-3">
                            <i class="fas fa-check-circle me-2 text-success"></i> Completed
                        </button>
                        <button class="filter-btn btn w-100 py-2 px-3">
                            <i class="fas fa-times-circle me-2 text-danger"></i> Cancelled
                        </button>

                        <hr class="my-1" style="border-color:#dde4ff">

                        <label class="text-muted fw-semibold" style="font-size:11px; letter-spacing:1px">FROM DATE</label>
                        <div class="input-group" id="fromDatePicker">
                            <input type="text" id="fromDate" class="form-control" placeholder="Select date" autocomplete="off"
                                   style="border-radius:10px 0 0 10px; border:1px solid #dde4ff; font-size:13px;">
                            <span class="input-group-text" style="border-radius:0 10px 10px 0; border:1px solid #dde4ff; background:#f8f9ff; cursor:pointer;">
                                <i class="fas fa-calendar text-primary"></i>
                            </span>
                        </div>

                        <label class="text-muted fw-semibold" style="font-size:11px; letter-spacing:1px">TO DATE</label>
                        <div class="input-group" id="toDatePicker">
                            <input type="text" id="toDate" class="form-control" placeholder="Select date" autocomplete="off"
                                   style="border-radius:10px 0 0 10px; border:1px solid #dde4ff; font-size:13px;">
                            <span class="input-group-text" style="border-radius:0 10px 10px 0; border:1px solid #dde4ff; background:#f8f9ff; cursor:pointer;">
                                <i class="fas fa-calendar text-primary"></i>
                            </span>
                        </div>

                        <button class="btn btn-primary w-100 rounded-pill mt-1" style="font-size:13px;">
                            <i class="fas fa-search me-1"></i> Apply Filter
                        </button>
                        <button class="btn btn-outline-secondary w-100 rounded-pill" style="font-size:13px;" id="resetBtn">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>

                    </div>
                </div>
            </div>

            {{-- ORDERS --}}
            <div class="col-md-9">

                @forelse($orders as $order)
                <div class="order-wrap shadow-sm mb-4">

                    {{-- Top Bar --}}
                    <div class="order-top px-4 py-2 d-flex justify-content-between align-items-center">
                        <small class="text-white opacity-75">
                            <i class="fas fa-hashtag me-1"></i>Order ID:
                            <strong class="text-white">{{ $order->nht_order_id }}</strong>
                        </small>
                        <small class="text-white opacity-75">
                            <i class="fas fa-cube me-1"></i>{{ count($order->packages) }} Package(s)
                        </small>
                    </div>

                    {{-- Row --}}
                    <div class="px-4 py-3 d-flex align-items-center gap-4">

                        <div class="pkg-icon-box">
                            <i class="fas fa-vials text-primary" style="font-size:26px"></i>
                        </div>

                        <div class="flex-grow-1">
                            <p class="fw-bold mb-0 text-dark" style="font-family:'Sora',sans-serif;">
                                {{ collect($order->packages)->pluck('packagename')->implode(', ') }}
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-home me-1"></i>{{ $order->packages[0]->type }}
                            </small>
                        </div>

                        <div class="text-center d-none d-md-block">
                            <small class="text-muted d-block">Booked On</small>
                            <small class="fw-semibold text-dark">
                                {{ \Carbon\Carbon::parse($order->packages[0]->created_at)->format('d M Y') }}
                            </small>
                        </div>


                        <div>
                            <a href="{{ route('retailer.vieworder',["id"=>base64_encode($order->nht_order_id)]) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>

                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3 d-block"></i>
                    <h6 class="text-muted">No orders found.</h6>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $('#fromDate, #toDate').datepicker({
        format: 'dd M yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom auto'
    });

    $('#fromDatePicker .input-group-text').on('click', () => $('#fromDate').datepicker('show'));
    $('#toDatePicker .input-group-text').on('click', () => $('#toDate').datepicker('show'));

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    document.getElementById('resetBtn').addEventListener('click', () => {
        $('#fromDate').datepicker('clearDates');
        $('#toDate').datepicker('clearDates');
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.filter-btn')[0].classList.add('active');
    });
</script>

<x-retailer.footer />