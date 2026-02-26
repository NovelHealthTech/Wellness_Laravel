@extends('layouts.app')

@section('content')

<x-website.header />

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --navy: #2c4a7c;
        --navy-2: #3a5a8a;
        --navy-deep: #1e3a5f;
        --teal: #0d9488;
        --blue-mid: #4a7fb5;
        --blue-light: #f5f8ff;
        --blue-border: #dbeafe;
        --white: #ffffff;
        --slate: #475569;
        --muted: #94a3b8;
        --border: #e2e8f0;
        --font: 'Sora', sans-serif;
        --body: 'DM Sans', sans-serif;
        --shadow: 0 4px 24px rgba(44,74,124,.07), 0 1px 4px rgba(44,74,124,.04);
    }

    body { font-family: var(--body); }

    /* ── HERO ── */
    .contact-hero {
        background: linear-gradient(135deg, #2c4a7c 0%, #3a6491 50%, #4a7fb5 100%);
        padding: 72px 0 64px;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 50% 100% at 100% 50%, rgba(255,255,255,.06) 0%, transparent 60%),
            radial-gradient(ellipse 30% 70% at 0% 0%, rgba(255,255,255,.04) 0%, transparent 55%);
    }
    .contact-hero::after {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
        background-size: 36px 36px;
    }
    .hero-inner { position: relative; z-index: 1; text-align: center; }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25);
        border-radius: 50px; padding: 5px 14px;
        font-family: var(--font); font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,.85); letter-spacing: .8px; text-transform: uppercase; margin-bottom: 20px;
    }
    .hero-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,.7); animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }
    .contact-hero h1 {
        font-family: var(--font); font-size: clamp(32px,5vw,52px); font-weight: 800;
        color: var(--white); letter-spacing: -1px; line-height: 1.1; margin-bottom: 16px;
    }
    .contact-hero h1 span { color: #60a5fa; }
    .contact-hero p { font-size: 16px; color: rgba(255,255,255,.55); max-width: 480px; margin: 0 auto; }

    /* ── LAYOUT ── */
    .contact-section { background: #f8fafc; padding: 64px 0 80px; }
    .contact-grid { display: grid; grid-template-columns: 1fr 400px; gap: 32px; align-items: start; }

    /* ── FORM CARD ── */
    .form-card {
        background: var(--white); border-radius: 20px;
        box-shadow: var(--shadow); border: 1px solid var(--border);
        overflow: hidden;
    }
    .form-card-head {
        background: linear-gradient(135deg, #2c4a7c 0%, #3a6491 100%);
        padding: 28px 32px;
    }
    .form-card-head h3 {
        font-family: var(--font); font-size: 18px; font-weight: 800;
        color: var(--white); margin: 0 0 4px;
    }
    .form-card-head p { font-size: 13.5px; color: rgba(255,255,255,.5); margin: 0; }
    .form-card-body { padding: 32px; }

    .f-group { margin-bottom: 18px; }
    .f-group label {
        display: block; font-family: var(--font); font-size: 10.5px; font-weight: 700;
        color: var(--slate); letter-spacing: .5px; text-transform: uppercase; margin-bottom: 7px;
    }
    .f-group input,
    .f-group textarea {
        width: 100%; padding: 11px 15px;
        border: 1.5px solid var(--border); border-radius: 11px;
        font-family: var(--body); font-size: 14px; color: var(--navy-deep);
        background: #f8fafc; outline: none; transition: all .2s; resize: none;
    }
    .f-group input:focus,
    .f-group textarea:focus {
        border-color: var(--blue-mid);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(29,78,216,.08);
    }
    .send-btn {
        width: 100%; padding: 14px;
        background: linear-gradient(135deg, #2c4a7c 0%, #4a7fb5 100%);
        color: var(--white); border: none; border-radius: 12px;
        font-family: var(--font); font-size: 14px; font-weight: 700;
        cursor: pointer; transition: all .2s;
        box-shadow: 0 4px 16px rgba(44,74,124,.25);
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .send-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(44,74,124,.3); }

    /* ── RIGHT PANEL ── */
    .right-panel { display: flex; flex-direction: column; gap: 20px; }

    /* Contact Info Card */
    .info-card {
        background: var(--white); border-radius: 20px;
        border: 1px solid var(--border); box-shadow: var(--shadow); overflow: hidden;
    }
    .info-card-head {
        background: linear-gradient(135deg, #2c4a7c, #3a6491);
        padding: 22px 26px;
    }
    .info-card-head h4 {
        font-family: var(--font); font-size: 15px; font-weight: 800;
        color: var(--white); margin: 0;
    }
    .info-item {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 18px 24px; border-bottom: 1px solid #f1f5f9;
        transition: background .15s;
    }
    .info-item:last-child { border-bottom: none; }
    .info-item:hover { background: var(--blue-light); }
    .info-icon {
        width: 38px; height: 38px; border-radius: 10px;
        background: var(--blue-light); border: 1px solid var(--blue-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; flex-shrink: 0;
    }
    .info-label { font-family: var(--font); font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px; }
    .info-value { font-size: 13.5px; color: var(--navy); font-weight: 500; line-height: 1.5; }

    /* Map Card */
    .map-card {
        background: var(--white); border-radius: 20px;
        border: 1px solid var(--border); box-shadow: var(--shadow); overflow: hidden;
    }
    .map-card-head { padding: 18px 22px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
    .map-card-head span { font-family: var(--font); font-size: 13px; font-weight: 700; color: var(--navy); }
    .map-card iframe { width: 100%; height: 220px; border: 0; display: block; }

    /* About text */
    .about-block {
        background: linear-gradient(135deg, #2c4a7c, #4a7fb5);
        border-radius: 20px; padding: 28px 30px;
        border: 1px solid rgba(255,255,255,.1);
    }
    .about-block h2 {
        font-family: var(--font); font-size: 18px; font-weight: 800;
        color: var(--white); margin-bottom: 10px;
    }
    .about-block p { font-size: 13.5px; color: rgba(255,255,255,.5); line-height: 1.7; margin: 0; }

    @media (max-width: 900px) {
        .contact-grid { grid-template-columns: 1fr; }
        .contact-section { padding: 40px 0 60px; }
    }
</style>

{{-- HERO --}}
<div class="contact-hero">
    <div class="container">
        <div class="hero-inner">
            <div class="hero-badge"><span class="dot"></span> Get in Touch</div>
            <h1>Contact <span>Novel Healthtech</span></h1>
            <p>Have a question about our services? We're here to help — reach out anytime.</p>
        </div>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="contact-section">
    <div class="container">
        <div class="contact-grid">

            {{-- LEFT: Form --}}
            <div>
                <div class="form-card">
                    <div class="form-card-head">
                        <h3>Send us a Message</h3>
                        <p>We'll get back to you within 24 hours</p>
                    </div>
                    <div class="form-card-body">
                        <form id="dummyForm">
                            @csrf
                            <div class="f-group">
                                <label>Your Name</label>
                                <input type="text" name="name" placeholder="Rahul Sharma" required>
                            </div>
                            <div class="f-group">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="you@example.com" required>
                            </div>
                            <div class="f-group">
                                <label>Your Message</label>
                                <textarea name="message" rows="5" placeholder="Write your message here…" required></textarea>
                            </div>
                            <button type="submit" class="send-btn">
                                ✉️ Send Message
                            </button>
                        </form>
                    </div>
                </div>

                {{-- About block below form --}}
                <div class="about-block mt-4">
                    <h2>Have Any Queries?</h2>
                    <p>If you have any queries or would like to know more about our services, please don't hesitate to contact us. Our team is always ready to assist you and provide the information you need.</p>
                </div>
            </div>

            {{-- RIGHT: Info + Map --}}
            <div class="right-panel">

                <div class="info-card">
                    <div class="info-card-head">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">📞</div>
                        <div>
                            <div class="info-label">Phone</div>
                            <div class="info-value">+0124-4278179</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">✉️</div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">support@novelhealthtech.com</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">📍</div>
                        <div>
                            <div class="info-label">Address</div>
                            <div class="info-value">D-101, 2nd Floor, Phase V, Udyog Vihar, Sector 19, Gurugram, Haryana 122016</div>
                        </div>
                    </div>
                </div>

                <div class="map-card">
                    <div class="map-card-head">
                        <span>📍</span>
                        <span>Our Office Location</span>
                    </div>
                    <iframe
                        src="https://maps.google.com/maps?q=104%2C%20Phase%20V%2C%20Udyog%20Vihar%2C%20Sector%2019%2C%20Gurugram%2C%20Haryana&t=m&z=14&output=embed"
                        aria-label="Gurugram Office Location">
                    </iframe>
                </div>

            </div>
        </div>
    </div>
</div>

<x-website.footer />

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('dummyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        icon: 'success',
        title: 'Message Sent!',
        text: 'We will reach you out shortly.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#243665'
    }).then(() => {
        window.location.href = "{{ route('home') }}";
    });
});
</script>

@endsection