<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BuddyBuddy Header</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }



    :root {
      --bg: #f5f6fa;
      --surface: #ffffff;
      --border: #e4e7ec;
      --text: #111827;
      --sub: #6b7280;
      --accent: #2563eb;
      --accent-bg: #eff4ff;
      --danger: #dc2626;
      --danger-bg: #fef2f2;
      --amber: #d97706;
      --amber-bg: #fffbeb;
      --green: #059669;
      --purple: #7c3aed;
      --pink: #db2777;
      --radius: 10px;
      --font: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      background: var(--bg);
      min-height: 100vh;
      font-family: var(--font);
      display: flex;
      flex-direction: column;
      align-items: center;

    }

    /* ── HEADER ──────────────────────────────────────── */
    header {
      width: 100%;
      max-width: 1400px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 14px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 4px 16px rgba(0, 0, 0, 0.04);
      animation: fadeIn 0.4s ease both;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ── LOGO ────────────────────────────────────────── */
    .logo {
      display: flex;
      align-items: center;
      gap: 11px;
      text-decoration: none;
      flex-shrink: 0;
    }

    .logo-icon {
      width: 42px;
      height: 42px;
      background: var(--accent);
      border-radius: var(--radius);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      color: white;
    }

    .logo-icon svg {
      width: 22px;
      height: 22px;
      stroke: #fff;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .logo-text {
      display: flex;
      flex-direction: column;
      line-height: 1;
    }

    .logo-name {
      font-size: 18px;
      font-weight: 800;
      color: var(--text);
      letter-spacing: -0.4px;
    }

    .logo-sub {
      font-size: 10.5px;
      font-weight: 500;
      color: var(--sub);
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-top: 3px;
    }

    /* ── SEARCH ──────────────────────────────────────── */
    .search-wrap {
      flex: 1;
      max-width: 340px;
      margin: 0 28px;
      position: relative;
    }

    .search-wrap input {
      width: 100%;
      height: 40px;
      border: 1.5px solid var(--border);
      border-radius: 8px;
      background: var(--bg);
      padding: 0 16px 0 40px;
      font-family: var(--font);
      font-size: 13.5px;
      color: var(--text);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .search-wrap input::placeholder {
      color: var(--sub);
    }

    .search-wrap input:focus {
      border-color: var(--accent);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .search-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--sub);
      pointer-events: none;
      display: flex;
    }

    .search-icon svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    /* ── NAV ─────────────────────────────────────────── */
    .nav {
      display: flex;
      align-items: center;
      gap: 2px;
    }

    .sep {
      width: 1px;
      height: 28px;
      background: var(--border);
      margin: 0 8px;
    }

    /* ── ICON BTN ─────────────────────────────────────── */
    .icon-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 3px;
      width: 56px;
      height: 54px;
      border-radius: 10px;
      border: none;
      background: transparent;
      cursor: pointer;
      color: var(--sub);
      font-family: var(--font);
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 0.2px;
      text-transform: uppercase;
      position: relative;
      transition: background 0.18s, color 0.18s;
      text-decoration: none;
    }

    .icon-btn svg {
      width: 19px;
      height: 19px;
      stroke: currentColor;
      fill: none;
      stroke-width: 1.9;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .icon-btn:hover svg {
      transform: scale(1.15) translateY(-1px);
    }

    .icon-btn.cart:hover {
      background: var(--amber-bg);
      color: var(--amber);
    }

    .icon-btn.orders:hover {
      background: var(--accent-bg);
      color: var(--accent);
    }

    .icon-btn.wishlist:hover {
      background: #fdf2f8;
      color: var(--pink);
    }

    .icon-btn.refunds:hover {
      background: #f5f3ff;
      color: var(--purple);
    }

    .icon-btn.invoices:hover {
      background: #ecfdf5;
      color: var(--green);
    }

    .badge {
      position: absolute;
      top: 8px;
      right: 8px;
      width: 16px;
      height: 16px;
      background: var(--amber);
      color: #fff;
      font-size: 9px;
      font-weight: 700;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #fff;
    }

    /* ── PROFILE ─────────────────────────────────────── */
    .profile-btn {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 5px 12px 5px 5px;
      border: 1.5px solid var(--border);
      border-radius: 50px;
      background: #fff;
      cursor: pointer;
      margin-left: 6px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .profile-btn:hover {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--accent);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .profile-info {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .profile-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--text);
    }

    .profile-tier {
      font-size: 10.5px;
      font-weight: 500;
      color: var(--accent);
    }

    .chevron {
      width: 13px;
      height: 13px;
      stroke: var(--sub);
      fill: none;
      stroke-width: 2.2;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.2s;
    }

    .profile-btn:hover .chevron {
      transform: rotate(180deg);
    }

    /* ── SIGNOUT ─────────────────────────────────────── */
    .signout-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      height: 36px;
      padding: 0 14px;
      border: 1.5px solid #fecaca;
      border-radius: 8px;
      background: transparent;
      cursor: pointer;
      color: var(--danger);
      font-family: var(--font);
      font-size: 12.5px;
      font-weight: 600;
      margin-left: 6px;
      transition: background 0.18s, border-color 0.18s;
    }

    .signout-btn:hover {
      background: var(--danger-bg);
      border-color: var(--danger);
    }

    .signout-btn svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    /* ── TOOLTIP ─────────────────────────────────────── */
    [data-tip] {
      position: relative;
    }

    [data-tip]::after {
      content: attr(data-tip);
      position: absolute;
      bottom: -34px;
      left: 50%;
      transform: translateX(-50%) translateY(4px);
      background: var(--text);
      color: #fff;
      font-size: 10.5px;
      font-family: var(--font);
      font-weight: 500;
      white-space: nowrap;
      padding: 4px 9px;
      border-radius: 6px;
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.15s, transform 0.15s;
      z-index: 100;
    }

    [data-tip]:hover::after {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }

    /* ── RESPONSIVE ──────────────────────────────────── */
    @media (max-width: 960px) {
      .search-wrap {
        display: none;
      }

      .profile-info {
        display: none;
      }
    }

    @media (max-width: 640px) {
      .icon-btn span {
        display: none;
      }

      .icon-btn {
        width: 44px;
      }

      .signout-btn span {
        display: none;
      }

      .signout-btn {
        padding: 0 10px;
      }
    }

    /* ======= Full Screen Blur Background ======= */
    #pageLoader {
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    /* Hide class */
    #pageLoader.hidden {
      opacity: 0;
      visibility: hidden;
    }

    /* ======= Your Loader Animation ======= */
    .loader {
      width: 70px;
      aspect-ratio: 1;
      background:
        radial-gradient(farthest-side, #ffa516 90%, #0000) center/16px 16px,
        radial-gradient(farthest-side, green 90%, #0000) bottom/12px 12px;
      background-repeat: no-repeat;
      animation: l17 1s infinite linear;
      position: relative;
    }

    .loader::before {
      content: "";
      position: absolute;
      width: 8px;
      aspect-ratio: 1;
      inset: auto 0 16px;
      margin: auto;
      background: #ccc;
      border-radius: 50%;
      transform-origin: 50% calc(100% + 10px);
      animation: l17 0.5s infinite linear;
    }

    @keyframes l17 {
      100% {
        transform: rotate(1turn);
      }
    }

    /* ===== Sticky Header ===== */
    /* ── HERO BANNER ─────────────────────────────────── */
    .appt-hero {
      width: 100%;
      background: #1f3964;
      padding: 52px 60px 48px;
      position: relative;
      overflow: hidden;
    }

    .appt-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 55% 130% at 100% 50%, rgba(13, 148, 136, 0.16) 0%, transparent 65%),
        radial-gradient(ellipse 30% 70% at 0% 0%, rgba(13, 148, 136, 0.07) 0%, transparent 55%);
      pointer-events: none;
    }

    .appt-hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
      background-size: 32px 32px;
      pointer-events: none;
    }

    .hero-inner {
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 5px 14px;
      background: rgba(13, 148, 136, 0.18);
      border: 1px solid rgba(13, 148, 136, 0.35);
      border-radius: 50px;
      font-family: var(--font);
      font-size: 11px;
      font-weight: 700;
      color: var(--teal-m);
      letter-spacing: 0.9px;
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .hero-badge .dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--teal);
      animation: blink 2s infinite;
    }

    @keyframes blink {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: 0.5;
        transform: scale(1.3);
      }
    }

    .appt-hero h1 {
      font-family: var(--font);
      font-size: clamp(26px, 3vw, 38px);
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.8px;
      line-height: 1.15;
      margin-bottom: 10px;
    }

    .appt-hero h1 span {
      color: var(--teal-m);
    }

    .appt-hero p {
      font-size: 15px;
      color: rgba(255, 255, 255, 0.5);
      max-width: 480px;
      line-height: 1.65;
    }

    .cursor-pointer {
      cursor: pointer;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            window.location.reload();
        }
    });
</script>
</head>

<body>

  <header>

    <!-- LOGO -->
    <a class="logo" href="{{ route('retailer.retailerhomepage') }}">
      <div class="logo-icon">
        N
        {{-- <img class="image_logo" src="{{ asset('images/retailer/nc.jpg') }}" /> --}}
      </div>
      <a class="text-decoration-none d-flex flex-column" href="{{route('retailer.retailerhomepage')}}"
        class="logo-text">
        <span class="logo-name">Novel Healthtech</span>
        <span class="logo-sub">Package Marketplace</span>
      </a>
    </a>

    <!-- SEARCH -->
    <div class="search-wrap">
      <span class="search-icon">
        <svg viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
      </span>
      <input type="text" placeholder="Search packages, deals…" />
    </div>

    <!-- NAV -->
    <nav class="nav">

      <button class="icon-btn cart" data-tip="Cart">
        <svg viewBox="0 0 24 24">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
          <line x1="3" y1="6" x2="21" y2="6" />
          <path d="M16 10a4 4 0 01-8 0" />
        </svg>
        <span>Cart</span>
        <div class="badge">3</div>
      </button>

      <button class="icon-btn orders" data-tip="Orders">
        <svg viewBox="0 0 24 24">
          <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
          <rect x="9" y="3" width="6" height="4" rx="1" />
          <path d="M9 12h6M9 16h4" />
        </svg>
        <span>Orders</span>
      </button>

      <button class="icon-btn wishlist" data-tip="Wishlist">
        <svg viewBox="0 0 24 24">
          <path
            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
        </svg>
        <span>Wishlist</span>
      </button>

      <div class="sep"></div>

      <button class="icon-btn refunds" data-tip="Refunds">
        <svg viewBox="0 0 24 24">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
        </svg>
        <span>Refunds</span>
      </button>

      <button class="icon-btn invoices" data-tip="Invoices">
        <svg viewBox="0 0 24 24">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
          <polyline points="14 2 14 8 20 8" />
          <line x1="16" y1="13" x2="8" y2="13" />
          <line x1="16" y1="17" x2="8" y2="17" />
        </svg>
        <span>Invoices</span>
      </button>

      <div class="sep"></div>

      <!-- Profile -->
      <div class="profile-btn" data-tip="Profile">
        <div class="avatar">JD</div>
        <div class="profile-info">
          <span class="profile-name">John Doe</span>
          <span class="profile-tier">Pro Member</span>
        </div>
        <svg class="chevron" viewBox="0 0 24 24">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </div>

      <!-- Sign Out -->
      <button class="signout-btn" data-tip="Sign Out">
        <svg viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        <span>Sign Out</span>
      </button>

    </nav>
  </header>
  <!-- ======= Page Loader ======= -->
  <div id="pageLoader">
    <div class="loader"></div>
  </div>
 
</body>

</html>