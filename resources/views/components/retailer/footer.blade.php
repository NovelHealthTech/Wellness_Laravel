
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

/* ===== Sticky Footer Layout ===== */
html, body { height: 100%; }
body {
    display: flex;
    flex-direction: column;
    font-family: 'Plus Jakarta Sans', sans-serif;
    margin: 0;
}
.page-content { flex: 1 0 auto; }

/* ==========================================
   FOOTER
========================================== */
.site-footer {
    flex-shrink: 0;
    background-color: #243665;
    color: #ffffff;
    position: relative;
    overflow: hidden;
}

/* Force ALL text white */
.site-footer * {
    color: #ffffff !important;
}

/* Top animated line */
.site-footer::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #2563eb, #38bdf8, #06b6d4, #2563eb);
    background-size: 200% auto;
    animation: shimmer 3s linear infinite;
}
@keyframes shimmer {
    to { background-position: 200% center; }
}

/* Glow orbs */
.footer-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    pointer-events: none;
    opacity: 0.1;
}
.footer-orb-1 {
    width: 400px; height: 400px;
    background: #2563eb;
    top: -100px; right: -80px;
}
.footer-orb-2 {
    width: 300px; height: 300px;
    background: #06b6d4;
    bottom: 0; left: -60px;
}

/* Main content */
.footer-main {
    padding: 65px 0 50px;
    position: relative;
    z-index: 1;
}

/* Brand */
.footer-brand-name {
    font-size: 1.5rem;
    font-weight: 700;
}
.footer-tagline {
    font-size: 0.9rem;
    margin-top: 8px;
}

/* Divider */
.brand-divider {
    width: 40px;
    height: 3px;
    background: #ffffff;
    border-radius: 2px;
    margin: 18px 0;
}

/* Social Icons */
.footer-socials { display: flex; gap: 10px; }

.social-icon {
    width: 38px; 
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    transition: 0.3s;
}


/* Column Titles */
.footer-col-title {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 18px;
}

/* Links */
.footer-nav { list-style: none; padding: 0; margin: 0; }
.footer-nav li { margin-bottom: 10px; }
.footer-nav a {
    text-decoration: none;
    transition: 0.3s;
}
.footer-nav a:hover {
    padding-left: 6px;
}

/* Info Rows */
.footer-info-row {
    display: flex;
    gap: 10px;
    font-size: 0.9rem;
    margin-bottom: 12px;
}

/* Divider */
.footer-hr {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.3);
    margin: 0;
}

/* Bottom bar */
.footer-bottom {
    padding: 20px 0;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

/* Responsive */
@media(max-width:768px){
    .footer-bottom{
        flex-direction: column;
        text-align:center;
    }
}
</style>



<footer class="site-footer">

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
        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://in.linkedin.com/company/novel-healthtech-solutions-pvt-ltd" target="_blank" class="social-icon">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="mailto:support@novelhealthtech.com" class="social-icon">
            <i class="fas fa-envelope"></i>
        </a>
    </div>
</div>

<!-- COMPANY -->
<div class="col-6 col-lg-2 col-md-3">
    <p class="footer-col-title">Company</p>
    <ul class="footer-nav">
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
        <li><a href="{{ route('refund_cancellation') }}">Refund & Cancellation</a></li>
        <li><a href="{{ route('terms_and_condition') }}">Terms & Conditions</a></li>
    </ul>
</div>

<!-- QUICK LINKS -->
<div class="col-6 col-lg-2 col-md-3">
    <p class="footer-col-title">Quick Links</p>
    <ul class="footer-nav">
        <li><a href="{{ route('loginview') }}">Login</a></li>
        <li><a href="{{ route('services') }}">Our Services</a></li>
        <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
    </ul>
</div>

<!-- DOC-ON-CALL -->
<div class="col-6 col-lg-2 col-md-6">
    <p class="footer-col-title">Doc-On-Call</p>
    <div class="footer-info-row"><i class="fas fa-calendar-week"></i> Monday – Saturday</div>
    <div class="footer-info-row"><i class="fas fa-clock"></i> 9:30 AM – 6:00 PM</div>
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

<hr class="footer-hr">

<div class="container">
<div class="footer-bottom">
    <p class="text-center w-100">© 2023 Novel HealthTech Solutions Private Limited. All rights reserved.</p>
    <p class="text-center w-100">Content & images are copyright protected. Unauthorized use is prohibited and punishable by law.</p>
</div>
</div>

</footer>
