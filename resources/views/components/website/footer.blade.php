@push("styles")
    <style>
        .footer-title {
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            padding: 0 3rem;
            /* adds left/right breathing space inside the whole section */
        }

        .footer-title::before,
        .footer-title::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ccc;
        }

        .footer-title::before {
            margin-right: 1.5em;
            /* space between left line and text */
        }

        .footer-title::after {
            margin-left: 1.5em;
            /* space between text and right line */
        }

        .footer-title h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
            color: white;
        }

        .social_links {
            height: 48px !important;
            width: 48px !important;
        }

        .footer {
            margin-top: -11%;
            position: relative;
            z-index: -1;
            padding-top: 13%;
            padding-bottom:5%;
        
        }
    </style>

@endpush
<x-website.footerwidget />
<div class="bluegradient  footer" data-aos="fade-up" data-aos-duration="300">

    <div class="footer-title container">
        <h2>Novel Healthtech</h2>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="">
            <img class="social_links" src="{{ asset('images/website/footer/facebook.png') }}" alt="">
        </a>
        <a href="">
            <img class="social_links" src="{{ asset('images/website/footer/linkedin (1).png') }}" alt="">
        </a>
        <a href="">
            <img class="social_links" src="{{ asset('images/website/footer/youtube.png') }}" alt="">
        </a>

    </div>
    <h5 style="font-weight:400" class="text-center text-white  my-3">Copyright © 2023 Novel HealthTech Solutions Private
        Limited</h5>
    <p class="text-center text-white mx-5">
        The content and images used on this site are copyright protected and copyrights vests with the respective
        owners. The usage of the content and images on this website is intended to promote the works and no endorsement
        of the artist shall be implied. Unauthorized use is prohibited and punishable by law.
    </p>
</div>