@push("styles")
    <style>
        .widget {
            background-color: #F9F9F9;
            border-radius: 23px;
            width: 50%;
            z-index: 3;
            position: relative;
            /* fluid width on most screens */
            max-width: 961px;
            /* caps width for large screens */
            margin: 0 auto;
            /* centers it horizontally */
            padding: 1.5rem;
            /* breathing room inside */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* optional */
        }

        /* List items */
        .widget li {
            font-size: 14px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Columns inside widget (for flexbox layouts) */
        .widget .col-md-2 {
            flex: 1 1 150px;
            min-width: 120px;
        }

        /* =========================
               RESPONSIVE BREAKPOINTS
               ========================= */

        /* Tablets (medium screens) */
        @media (max-width: 992px) {
            .widget {
                width: 95%;
                padding: 1.25rem;
            }

            .widget li {
                font-size: 13px;
            }
        }

        @media(min-width:1200px) {

            .widget {
                max-width: 960px !important;

            }
        }

        /* Mobile screens */
        @media (max-width: 576px) {
            .widget {
                width: 95%;
                padding: 1rem;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                /* stack vertically */
            }

            .widget h4 {
                font-size: 1rem;
            }

            .widget li {
                font-size: 13px;
            }
        }
    </style>
@endpush

<div class="widget container d-flex justify-content-around gap-3 py-3 px-3 flex-wrap" data-aos="fade-up"
    data-aos-delay="300">

    <div class="col-md-2">
        <h5 class="text_grey">About Novel</h5>
        <ul class="list-unstyled pt-3 d-flex flex-column gap-3">
            <li>
                <a href="{{ route('about') }}" class="text-secondary text-decoration-none">ABOUT US</a>

            </li>
            {{-- <li class="text_grey">Careers</li> --}}
            <a class="text-secondary text-decoration-none" href="{{ route('privacy_policy') }}" class="text_grey">PRIVACY POLICIES</a>
            {{-- <li class="text_grey">COPYRIGHT POLICIES</li> --}}
            {{-- <li class="text_grey">Gallery</li> --}}

            <a class="text-secondary text-decoration-none" href="{{ route('refund_cancellation') }}">REFUND AND CANCELLATION</a>

            <a href="{{ route('terms_and_condition') }}" class="text-secondary text-decoration-none">TERMS AND CONDITION</a>
        </ul>
    </div>

    <div class="col-md-2">
        <h5 class="text_grey">Services</h5>
        <ul class="list-unstyled d-flex flex-column gap-3">
            <li>
                <a class="text-secondary text-decoration-none" href="{{ route('loginview') }}" class="text_grey">Login</a>
            </li>
            <li>
                <a class="text-secondary text-decoration-none" href="{{ route('services') }}" class="text_grey">Our Services</a>
            </li>
            <a class="text-secondary text-decoration-none" href="{{ route('contact_us') }}">Contact Us</a>
            {{-- <li class="text_grey">Articles</li>
            <li class="text_grey">FAQ</li> --}}
        </ul>
    </div>

    <div class="col-md-2">
        <h5 class="text_grey">Doc-On-Call Time</h5>
        <ul class="list-unstyled pt-3 d-flex flex-column gap-3">
            <li class="text_grey">Monday - Saturday</li>
            <li class="text_grey">9:30 AM - 6:00 PM</li>
        </ul>
    </div>

    <div class="col-md-2 d-flex flex-column gap-3">
        <h5 class="text_grey">Contact Us</h5>
        <ul class="list-unstyled pt-3">
            <li class="text_grey">+0124-4278179</li>
            <li class="text_grey">support@novelhealthtech.com</li>
           
        </ul>
    </div>

</div>