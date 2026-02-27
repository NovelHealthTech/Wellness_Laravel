<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Novel Healthtech</title>
  <link rel="icon" type="image/png" href="{{ asset('images/site_logo.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/retailer.css') }}"/>
  <script>
    window.addEventListener('pageshow', function (e) {
      if (e.persisted) { window.location.reload(); }
    });
  </script>
</head>

<body>

  <header class="py-2">

    <!-- LOGO -->
    <a class="logo" href="{{ route('retailer.retailerhomepage') }}">
      <div class="logo-icon">
        <img src="{{ asset('images/Dark Logo.png') }}" alt="Novel Healthtech Logo" />
      </div>
    </a>

    <!-- SEARCH -->
    <div class="search-wrap" style="visibility:hidden">
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

      {{-- <button class="icon-btn cart" data-tip="Cart">
        <svg viewBox="0 0 24 24">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
          <line x1="3" y1="6" x2="21" y2="6" />
          <path d="M16 10a4 4 0 01-8 0" />
        </svg>
        <span>Cart</span>
        <div class="badge">3</div>
      </button> --}}

      <a href="{{ route('retailer.orders') }}" class="icon-btn text-decoration-none orders" data-tip="Orders">
        <svg viewBox="0 0 24 24">
          <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
          <rect x="9" y="3" width="6" height="4" rx="1" />
          <path d="M9 12h6M9 16h4" />
        </svg>
        <span>Orders</span>
      </a>

      {{-- <button class="icon-btn wishlist" data-tip="Wishlist">
        <svg viewBox="0 0 24 24">
          <path
            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
        </svg>
        <span>Wishlist</span>
      </button> --}}

      <div class="sep"></div>

      {{-- <button class="icon-btn refunds" data-tip="Refunds">
        <svg viewBox="0 0 24 24">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
        </svg>
        <span>Refunds</span>
      </button> --}}

      {{-- <button class="icon-btn invoices" data-tip="Invoices">
        <svg viewBox="0 0 24 24">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
          <polyline points="14 2 14 8 20 8" />
          <line x1="16" y1="13" x2="8" y2="13" />
          <line x1="16" y1="17" x2="8" y2="17" />
        </svg>
        <span>Invoices</span>
      </button> --}}

      <div class="sep"></div>

      <!-- Profile -->
      <div class="profile-btn" >
        <div class="avatar">JD</div>
        <div class="profile-info">
          <span class="profile-name">John Doe</span>
        </div>
        <svg class="chevron" viewBox="0 0 24 24">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </div>

      <!-- Sign Out -->
      <a href="{{ route('signout') }}" class="signout-btn text-decoration-none" >
        <svg viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        <span>Sign Out</span>
      </a>

    </nav>
  
    <!-- Suraksha Badge -->
    <div class="suraksha-badge">
      <img src="{{ asset('images/suraksha.png') }}" alt="Suraksha Certified" />
    </div>

  </header>
  
  
  <!-- Page Loader -->
  <div id="pageLoader">
    <div class="loader"></div>
  </div>

</body>

</html>