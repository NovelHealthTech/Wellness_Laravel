@push('styles')
    <style>
        .overlay_text {
            position: absolute;
            bottom: 10%;
            left: 50%;
            width:100%;
            top:25%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .overlay_text {
                font-size: 0.1rem;
                bottom: 5%;
            }
            .overlay_text h1{
                font-size:1rem;

            }
            .overlay_text h5{
                font-size:0.5rem;

            }
        }

        @media (max-width: 480px) {
            .overlay_text {
                font-size: 1.5rem;
                
            }
            .package_image{
                height:86px!important;
                object-fit: cover;
            }
        }

        .package_image {
            width: 200px !important;
            object-fit: cover;
        }

        .add_image_icon {
            height: 15px;
        }

        .image_subheading {
            font-weight: bold;
        }
        @media(max-width:960px){
            .add_image_icon{
                display: none;
            }
        }
    </style>
@endpush

<div class="container" data-aos="fade-up" data-aos-delay="400">

    <!-- Header Image with Overlay Text -->
    <div class="position-relative my-5">
        <img src="{{ asset('images/website/home/packages.png') }}" class="img-fluid w-100 package_image" alt="Packages">
        <div class="overlay_text">
            <h1 class="m-0">HEALTH SURAKSHA PACKAGE</h1>
            <h5 class="m-0 w-100">
                Includes Doctor-on-call + Surgical assistance + Discounted lab test + Discounted e-pharmacy
            </h5>
        </div>
    </div>

    <div class="card">
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap ">

            <div class="card text-center p-3">
                <img class="package_image" src="{{ asset('images/website/home/package1.png') }}" alt="Package 1">
                <p class="py-3 image_subheading">Doc-ON-call</p>
            </div>

            <span><img class="add_image_icon" src="{{ asset('images/website/home/add.png') }}" alt="Add"></span>

            <div class="card text-center p-3">
                <img class="package_image" src="{{ asset('images/website/home/package2.png') }}" alt="Package 2">
                <p class="py-3 image_subheading">Surgical Assistance</p>
            </div>

            <span><img class="add_image_icon" src="{{ asset('images/website/home/add.png') }}" alt="Add"></span>

            <div class="card text-center p-3">
                <img class="package_image" src="{{ asset('images/website/home/package3.png') }}" alt="Package 3">
                <p class="py-3 image_subheading">Discounted Lab Tests</p>
            </div>

            <span><img class="add_image_icon" src="{{ asset('images/website/home/add.png') }}" alt="Add"></span>

            <div class="card text-center p-3">
                <img class="package_image" src="{{ asset('images/website/home/package4.png') }}" alt="Package 4">
                <p class="py-3 image_subheading">E-Pharmacy</p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-center py-5 gap-3 align-items-center">
            {{-- <button class="btn border border-dark px-5" style="border-radius:76px!important">₹499</button> --}}
            {{-- <x-website.button buttontext="Proceed to Pay" classname="btn btn-outline-primary py-2 px-3" /> --}}
        </div>

    </div>
    <!-- Package Icons Row -->

</div>