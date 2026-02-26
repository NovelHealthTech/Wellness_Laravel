<x-retailer.header />

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* ================= HERO ================= */
    .hero-section {
        background: linear-gradient(135deg, #102544, #4e73df);
        color: white;
    }

    .hero-section p {
        color: #e9ecef;
    }

    .hero-img {
        max-height: 380px;
    }

    /* ================= CAROUSEL ================= */
    .carousel-item img {
        height: 500px;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        padding: 25px;
        border-radius: 20px;
    }

    /* Attractive Carousel Buttons */
    .custom-carousel-btn {
        width: 90px;
        opacity: 1 !important;
    }

    .custom-arrow {
        background: white;
        width: 37px;
        height: 37px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
    }

    .custom-arrow i {
        font-size: 24px;
        color: #0d6efd;
    }

    .custom-carousel-btn:hover .custom-arrow {
        background: #0d6efd;
        transform: scale(1.15);
    }

    .custom-carousel-btn:hover .custom-arrow i {
        color: white;
    }

    /* ================= SERVICES ================= */
    .service-card {
        transition: all 0.3s ease;
        border-radius: 20px;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        font-size: 45px;
        color: #0d6efd;
    }

    /* ================= WHY US ================= */
    .why-box {
        border-radius: 20px;
        transition: 0.3s;
    }

    .why-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .why-icon {
        font-size: 45px;
        color: #0d6efd;
    }
</style>

<style>
    h1 {
        font-size: 40px !important;


    }

    p {
        font-size: 15px !important;
    }

    a {
        font-size: 12px !important;
    }
</style>

<div class="page-content">

    <!-- ================= HERO SECTION ================= -->
    <section class="hero-section py-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="fw-bold display-5 mb-3">
                        Your Trusted Digital Healthcare Partner
                    </h1>
                    <p class="mb-4 ">
                        Book doctor consultations, order medicines, schedule lab tests,
                        and get surgical assistance — all from one secure platform.
                    </p>
                    <div class="d-flex gap-3">

                        <a onclick="scrolltoservices(); return false;" class="btn btn-outline-light btn-lg px-4">
                            Explore Services
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1584515933487-779824d29309"
                        class="img-fluid hero-img rounded-4 shadow">
                </div>
            </div>
        </div>
    </section>
    <!-- ================= CAROUSEL ================= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div id="healthCarousel" class="carousel slide rounded-4 overflow-hidden shadow-lg" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="{{ asset("images/retailer/doctors.jpg") }}" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3 class="fw-bold">Consult Certified Doctors Online</h3>
                            <p>24/7 video consultations with trusted specialists.</p>
                            <a href="{{ route('retailer.doc_on_call') }}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset("images/retailer/medicine.jpg") }}" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3 class="fw-bold">Order Medicines Easily</h3>
                            <p>Upload prescription & get medicines delivered at home.</p>
                            <a href="{{ route('retailer.epharmacy') }}" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/retailer/lab_test.jpg') }}" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3 class="fw-bold">Book Lab Tests Instantly</h3>
                            <p>Home sample collection & fast digital reports.</p>
                            <a href="{{ route('retailer.allpackages') }}" class="btn btn-primary">Book Test</a>
                        </div>
                    </div>

                </div>

                <!-- Attractive Controls -->
                <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#healthCarousel"
                    data-bs-slide="prev">
                    <span class="custom-arrow">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </button>

                <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#healthCarousel"
                    data-bs-slide="next">
                    <span class="custom-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </button>

            </div>
        </div>
    </section>

    <!-- ================= SERVICES ================= -->
    <section class="py-5" id="services_row">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Healthcare Services</h2>

            <div class="row g-4">

                <div class="col-lg-3 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="service-icon mb-3">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h5 class="fw-bold">Doc-On-Call</h5>
                        <p class="text-muted small">
                            24/7 Online Consultation with certified specialists.
                        </p>
                        <a href="{{ route('retailer.doc_on_call') }}" class="btn btn-primary w-100">Pay & Book</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="service-icon mb-3">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h5 class="fw-bold">E-Pharmacy</h5>
                        <p class="text-muted small">
                            Genuine medicines delivered to your doorstep.
                        </p>
                        <a href="{{ route('retailer.epharmacy') }}" class="btn btn-outline-primary w-100">Visit
                            Store</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="service-icon mb-3">
                            <i class="fas fa-vials"></i>
                        </div>
                        <h5 class="fw-bold">Lab Tests</h5>
                        <p class="text-muted small">
                            NABL certified labs with home collection service.
                        </p>
                        <a href="{{ route('retailer.allpackages') }}" class="btn btn-primary w-100">Book Test</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="service-icon mb-3">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <h5 class="fw-bold">Surgical Assistance</h5>
                        <p class="text-muted small">
                            Affordable surgeries with dedicated care support.
                        </p>
                        <a href="{{ route('retailer.surgical_assistance') }}"
                            class="btn btn-outline-primary w-100">Learn More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= WHY CHOOSE US ================= -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Why Choose Us?</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm why-box">
                        <div class="why-icon mb-3">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h5 class="fw-bold">Trusted Doctors</h5>
                        <p class="text-muted small">
                            Verified & experienced healthcare professionals.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm why-box">
                        <div class="why-icon mb-3">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <h5 class="fw-bold">Affordable Pricing</h5>
                        <p class="text-muted small">
                            Transparent billing with best price guarantee.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm why-box">
                        <div class="why-icon mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold">Secure Platform</h5>
                        <p class="text-muted small">
                            Encrypted & secure healthcare data protection.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
 
@isset($redcliffcartitems)
  <x-retailer.recliffcart :redcliffcartitems="$redcliffcartitems" />
@endisset

@isset($srlcartitems)
  <x-retailer.srlcart :srlcartitems="$srlcartitems" />
@endisset

<x-retailer.footer />

@if(session('success'))
    <script>
        successalert(@json(session('success')));
    </script>
@endif

<script>
    function scrolltoservices() {
        console.log("sfsdfsd");
        const serviceRow = document.querySelector("#services_row");
        if (serviceRow) {
            serviceRow.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    }
    history.pushState(null, null, location.href);

  window.addEventListener('popstate', function () {
    // Change this route to wherever you want the back button to go
    window.location.href = "{{ route('home') }}";
  });
</script>
