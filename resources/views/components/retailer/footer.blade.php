<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Novel HealthTech — Footer</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #f5f6fa;
    }

    .page-content {
      flex: 1 0 auto;
    }

    .site-footer {
      flex-shrink: 0;
      background-color: #243665;
      color: #fff;
      position: relative;
      overflow: hidden;
    }

    .site-footer,
    .site-footer p,
    .site-footer li,
    .site-footer span,
    .site-footer i,
    .site-footer small {
      color: #fff;
    }

    .site-footer::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #2563eb, #38bdf8, #06b6d4, #2563eb);
      background-size: 200% auto;
      animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
      to {
        background-position: 200% center;
      }
    }

    .footer-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(90px);
      pointer-events: none;
      opacity: 0.10;
    }

    .footer-orb-1 {
      width: 400px;
      height: 400px;
      background: #2563eb;
      top: -100px;
      right: -80px;
    }

    .footer-orb-2 {
      width: 300px;
      height: 300px;
      background: #06b6d4;
      bottom: 0;
      left: -60px;
    }

    .footer-main {
      padding: 65px 0 50px;
      position: relative;
      z-index: 1;
    }

    .footer-brand-name {
      font-size: 1.45rem;
      font-weight: 700;
      color: #fff;
      letter-spacing: -0.3px;
    }

    .footer-brand-name span {
      color: #38bdf8;
    }

    .footer-tagline {
      font-size: 0.875rem;
      color: rgba(255, 255, 255, 0.75);
      margin-top: 8px;
      line-height: 1.6;
    }

    .brand-divider {
      width: 40px;
      height: 3px;
      background: rgba(255, 255, 255, 0.4);
      border-radius: 2px;
      margin: 18px 0;
    }

    .footer-socials {
      display: flex;
      gap: 10px;
    }

    .social-icon {
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #fff;
      font-size: 0.9rem;
      text-decoration: none;
      transition: background 0.25s, border-color 0.25s, transform 0.25s;
    }

    .social-icon:hover {
      background: rgba(255, 255, 255, 0.25);
      border-color: rgba(255, 255, 255, 0.55);
      transform: translateY(-3px);
      color: #fff;
    }

    .footer-col-title {
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: rgba(255, 255, 255, 0.55);
      margin-bottom: 18px;
    }

    .footer-nav {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-nav li {
      margin-bottom: 10px;
    }

    .footer-nav a {
      color: rgba(255, 255, 255, 0.80);
      text-decoration: none;
      font-size: 0.875rem;
      font-weight: 400;
      transition: color 0.2s, padding-left 0.2s;
      display: inline-block;
    }

    .footer-nav a:hover {
      color: #38bdf8;
      padding-left: 6px;
    }

    .footer-info-row {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.875rem;
      color: rgba(255, 255, 255, 0.80);
      margin-bottom: 12px;
      line-height: 1.5;
    }

    .footer-info-row i {
      color: #38bdf8;
      margin-top: 3px;
      flex-shrink: 0;
      width: 14px;
    }

    .footer-info-row a {
      color: rgba(255, 255, 255, 0.80);
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-info-row a:hover {
      color: #38bdf8;
    }

    .footer-hr {
      border: none;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      margin: 0;
      position: relative;
      z-index: 1;
    }

    .footer-bottom {
      padding: 22px 0;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 6px;
      position: relative;
      z-index: 1;
    }

    .footer-bottom p {
      font-size: 0.78rem;
      color: rgba(255, 255, 255, 0.50);
      margin: 0;
    }

    @media (max-width: 768px) {
      .footer-bottom {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <div class="page-content">
    <!-- Page content goes here -->
  </div>

  <footer class="site-footer w-100">

    <div class="footer-orb footer-orb-1"></div>
    <div class="footer-orb footer-orb-2"></div>

    <div class="footer-main">
      <div class="container">
        <div class="row g-4">

          <!-- BRAND -->
          <div class="col-12 col-lg-3 col-md-6">
            <div class="footer-brand-name">Novel <span>Healthtech</span></div>
            <p class="footer-tagline">Empowering healthcare<br>through technology</p>
            <div class="brand-divider"></div>
            <div class="footer-socials">
              <a href="https://in.linkedin.com/company/novel-healthtech-solutions-pvt-ltd" target="_blank"
                class="social-icon" aria-label="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="https://www.facebook.com/novelhealthtech" target="_blank" class="social-icon"
                aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
            </div>
          </div>

          <!-- COMPANY -->
          <div class="col-6 col-lg-2 col-md-3">
            <p class="footer-col-title">Company</p>
            <ul class="footer-nav">
              <li><a href="/about">About Us</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>
              <li><a href="/refund-cancellation">Refund &amp; Cancellation</a></li>
              <li><a href="/terms-and-conditions">Terms &amp; Conditions</a></li>
            </ul>
          </div>

          <!-- QUICK LINKS -->
          <div class="col-6 col-lg-2 col-md-3">
            <p class="footer-col-title">Quick Links</p>
            <ul class="footer-nav">
              <li><a href="{{ route('loginview') }}">Login</a></li>
              <li><a href="/services">Our Services</a></li>
              <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
            </ul>
          </div>

          <!-- DOC-ON-CALL -->
          <div class="col-6 col-lg-2 col-md-6">
            <p class="footer-col-title">Doc-On-Call</p>
            <div class="footer-info-row">
              <i class="fas fa-calendar-week"></i>
              <span>Monday – Saturday</span>
            </div>
            <div class="footer-info-row">
              <i class="fas fa-clock"></i>
              <span>9:30 AM – 6:00 PM</span>
            </div>
          </div>

          <!-- CONTACT -->
          <div class="col-6 col-lg-3 col-md-6">
            <p class="footer-col-title">Get In Touch</p>
            <div class="footer-info-row">
              <i class="fas fa-phone"></i>
              <a href="tel:+01244278179">+0124-4278179</a>
            </div>
            <div class="footer-info-row">
              <i class="fas fa-envelope"></i>
              <a href="mailto:support@novelhealthtech.com">support@novelhealthtech.com</a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <hr class="footer-hr" />

    <div class="container">
      <div class="footer-bottom">
        <p class="text-center w-100">© 2025 Novel HealthTech Solutions Private Limited. All rights reserved.</p>
        <p class="text-center w-100">Content &amp; images are copyright protected. Unauthorized use is prohibited and
          punishable by law.</p>
      </div>
    </div>

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    function successalert(data) {
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: data.message ?? 'Your request was completed successfully.',
        confirmButtonText: 'Continue',
        confirmButtonColor: '#0d9488',
        background: '#ffffff',
        color: '#0f172a',
        iconColor: '#16a34a',
        padding: '2rem',
        customClass: {
          title: 'swal-custom-title',
          popup: 'swal-custom-popup',
          confirmButton: 'swal-custom-btn',
        },
        showClass: {
          popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp animate__faster'
        },
        timer: 3000,
        timerProgressBar: true,
      });
    }

    window.addEventListener("load", function () {
      const loader = document.getElementById("pageLoader");
      setTimeout(() => {
        loader.classList.add("hidden");
      }, 500);
    });

    document.addEventListener('DOMContentLoaded', function () {
      console.log("sdfdssd");

      function scrolltoservices() {
        console.log("sfsdfsd");
        const serviceRow = document.querySelector("#services_row");
        if (serviceRow) {
          serviceRow.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>