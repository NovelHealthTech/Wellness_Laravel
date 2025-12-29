<x-retailer.header />
<style>
    /* Full screen coverage */
.service-section {
    min-height: calc(100vh - 120px); /* header/footer safe */
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f9fafb;
}

/* Grid layout */
.service-wrapper {
    width: 100%;
    max-width: 1100px;
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 28px;
}

/* Card */
.service-item {
    background: #ffffff;
    border-radius: 20px;
    padding: 36px 20px;
    text-align: center;
    text-decoration: none;
    color: #1f2937;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}

/* Icon sizing (controlled) */
.service-item i {
    font-size: clamp(26px, 3vw, 34px);
    margin-bottom: 16px;
    display: block;
    transition: transform 0.3s ease;
}

/* Text sizing (professional scale) */
.service-item p {
    font-size: clamp(13px, 1.2vw, 15px);
    font-weight: 600;
    line-height: 1.4;
    letter-spacing: 0.2px;
}

.service-item p span {
    font-size: 12px;
    font-weight: 700;
    display: block;
    margin-top: 2px;
}

/* Hover effects (subtle & premium) */
.service-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.12);
}

.service-item:hover i {
    transform: scale(1.15);
}

/* GOLD card – premium without new color */
.service-item.gold {
    background: linear-gradient(145deg, #ffffff, #f1f1f1);
    border: 1px solid rgba(0,0,0,0.06);
}

/* Mobile optimization */
@media (max-width: 768px) {
    .service-wrapper {
        gap: 18px;
    }

    .service-item {
        padding: 28px 16px;
    }
}

</style>
<section class="service-section">
    <div class="service-wrapper">

        <a href="#" class="service-item">
            <i class="fa-solid fa-user-doctor"></i>
            <p>Talk to Doctor</p>
        </a>

        <a href="#" class="service-item">
            <i class="fa-solid fa-pills"></i>
            <p>Medicine</p>
        </a>

        <a href="{{ route('retailer.allpackages') }}" class="service-item">
            <i class="fa-solid fa-flask"></i>
            <p>Lab Tests & Packages</p>
        </a>

        <a href="#" class="service-item">
            <i class="fa-solid fa-calendar-check"></i>
            <p>Book Appointment</p>
        </a>

        <a href="#" class="service-item">
            <i class="fa-solid fa-hospital"></i>
            <p>Surgery</p>
        </a>

        <a href="#" class="service-item gold">
            <i class="fa-solid fa-crown"></i>
            <p>MediBuddy <span>Gold</span></p>
        </a>

    </div>
</section>

<x-retailer.footer />
