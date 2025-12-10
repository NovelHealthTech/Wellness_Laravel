@push('styles')
    <style>
        .novel {
            background-image: url("images/website/about/novel.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 40px 0;
            color: #444;
        }

        .novel-stats h1 {
            font-size: 2.5rem;
            margin-bottom: 0;
        }

        .novel-stats p {
            margin-top: 5px;
            font-size: 1rem;
        }

        .novel-stats>div {
            flex: 1;
        }

        .online_consultation {
            background-image: url("images/website/about/online.png");
            background-size: cover;
            background-color: #499594;
            background-position: center;
            background-repeat: no-repeat;
            padding: 40px 0;
            color: #444;
            padding: 6rem 6rem !important;

        }
    </style>
@endpush

<div class="novel">
    <h1 class="text-center my-3 text_grey">We are Novel Healthtech</h1>

    <div class="container">
        <p class="text-center">
            "Novel Health Tech Solutions aims to meet all B2B healthcare and wellness needs in one place.
            We strive to provide you with the best healthcare services at the tip of your fingertips..."
        </p>

        <div class="d-flex justify-content-between text-center novel-stats mt-4">
            <div>
                <h1 class="text_grey counter" data-target="20">0</h1>
                <p>MBBS Doctors</p>
            </div>

            <div>
                <h1 class="text_grey counter" data-target="1000">0</h1>
                <p>E-Clinics</p>
            </div>

            <div>
                <h1 class="text_grey counter" data-target="4500000">0</h1>
                <p>Users / Consultations</p>
            </div>
        </div>
    </div>

    <div class="online_consultation mt-5">
        <h4 class="text-white text-center">Online Consultation with General Physicians</h4>
        <h5 class="text-center text-white">Multi-lingual doctors | Instant Prescription | Voice & Video call</h5>
        <h5 class="text-center text-white">9:30 Am - 6 PM</h5>
    </div>

</div>



@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    let count = +counter.innerText.replace(/[^\d]/g, ''); // Remove formatting

                    const speed = 200; // Increase for slower animation
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 20);
                    } else {
                        // Format final number
                        if (target >= 1000000) {
                            counter.innerText = (target / 1000000).toFixed(1) + "M+";
                        } else if (target >= 1000) {
                            counter.innerText = (target / 1000).toFixed(0) + "K+";
                        } else {
                            counter.innerText = target + "+";
                        }
                    }
                };

                updateCount();
            });
        });
    </script>
@endpush