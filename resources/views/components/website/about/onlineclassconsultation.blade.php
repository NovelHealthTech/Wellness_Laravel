@push("styles")
    <style>
        .journey-card {
            border: none;
            padding: 0;
            background: #243665;
            /* top blue part */
            border-radius: 25px;
            text-align: center;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 300px;
            /* total card height */
            overflow: hidden;
            border: 1px solid grey;
        }

        /* Blue section (image container) */
        .journey-card-img-container {
            background: #243665;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 180px;
            /* fixed height for uniformity */
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .journey-card img {
            height: 100px;
            width: 100px;
            object-fit: cover;
            border-radius: 50%;
            z-index: 1;
        }

        .journey-card-title {
            background-color: white;
            /* bottom text block */
            color: #243665;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            padding: 15px 10px;
            margin-top: auto;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 120px;
            /* equal height for text block */
        }

        .journey-card-title p {
            margin: 2px 0;
        }

        .mobile_pic {
            position: relative;
            top: -5%;
            height: 85%;
        }

        .onlineclassconsultation {

            background-image: url("{{ asset('images/website/about/onlineclassbg.png') }}");
            background-position: center;
        }
    </style>
@endpush
<div class="onlineclassconsultation">
    <div class="container">
        <h3 class="text_grey text-center py-5">Best in class online consultations</h3>

        <div class="row g-3 ">
            <!-- LEFT SIDE: Cards -->
            <div class="col-md-7">
                <div class="row g-5 justify-content-center">
                    <div class="col-md-4">
                        <div class="journey-card">
                            <div class="journey-card-img-container">
                                <img src="{{ asset('images/website/about/doctor-consultation.png') }}" alt="Doctor">
                            </div>
                            <div class="journey-card-title">
                                <p>Inhouse team of</p>
                                <p>multilingual doctors and</p>
                                <p>relationship managers.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="journey-card">
                            <div class="journey-card-img-container">
                                <img src="{{ asset('images/website/about/clock2.png') }}" alt="Clock">
                            </div>
                            <div class="journey-card-title">
                                <p>Experienced doctors</p>
                                <p>respond in 10 minutes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 justify-content-center mt-3">
                    <div class="col-md-4">
                        <div class="journey-card">
                            <div class="journey-card-img-container">
                                <img src="{{ asset('images/website/about/experiment.png') }}" alt="Experiment">
                            </div>
                            <div class="journey-card-title">
                                <p>Tie Up with</p>
                                <p>Leading Healthcare</p>
                                <p>brands & labs</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="journey-card">
                            <div class="journey-card-img-container">
                                <img src="{{ asset('images/website/about/location (3).png') }}" alt="Location">
                            </div>
                            <div class="journey-card-title">
                                <p>Private & confidential</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Phone Mockup -->
            <div class="col-md-4 ">
                <img class="mobile_pic" src="{{ asset('images/website/about/phone mockup-01-01 (1).png') }}"
                    alt="Phone Mockup" class="img-fluid">
            </div>
        </div>
    </div>
</div>