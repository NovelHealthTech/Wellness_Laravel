@push("styles")
    <style>
        .onliineconsuly_images {
            width: 50px;
        }


        .whyconsultonlinebg {
            background: url('{{ asset('images/website/about/whyconsultusbg.png') }}');
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endpush


<div class="whyconsultonlinebg">
    <h3 class="text-center">Why Consult Online?</h3>
    <div class="row p-5">
        <div class="col-md-6">
            <div class="d-flex align-items-center gap-3">
                <img class="img-fluid onliineconsuly_images" src="{{ asset('images/website/about/access.png') }}"
                    alt="Access Icon">
                <div>
                    <span class="fw-semibold">Easy Access</span>
                    <div>
                        <p>Experience hassle-free and convenient healthcare </p>
                        <p>with easy access from anywhere, anytime.</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center gap-3">
                <img class="img-fluid onliineconsuly_images" src="{{ asset('images/website/about/prescription.png') }}"
                    alt="Access Icon">
                <div>
                    <span class="fw-semibold">Immediate Prescription</span>
                    <div>
                        <p>Get immediate access to prescription saving you time
                        </p>
                        <p>and hassle in obtaining the necessary treatment.</p>

                    </div>
                </div>
            </div>
        </div>

        <div class=" row mt-5">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <img class="img-fluid onliineconsuly_images"
                        src="{{ asset('images/website/about/prescription.png') }}" alt="Access Icon">
                    <div>
                        <span class="fw-semibold">Experienced Doctors</span>
                        <div>
                            <p>Access quality medical advice from the comfort of
                            </p>
                            <p>your own home from experienced and qualified doctors.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <img class="img-fluid onliineconsuly_images"
                        src="{{ asset('images/website/about/queue (1) (2).png') }}" alt="Access Icon">
                    <div>
                        <span class="fw-semibold">No waiting in Queues</span>
                        <div>
                            <p>Skip the long waiting queues and receive prompt
                            </p>
                            <p>medical attention</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <img class="img-fluid onliineconsuly_images" src="{{ asset('images/website/about/save-time.png') }}"
                        alt="Access Icon">
                    <div>
                        <span class="fw-semibold">Saving Time & Energy</span>
                        <div>
                            <p>Save valuable time and energy by eliminating the need
                            </p>
                            <p>for travel and allowing you to focus on your health.</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <img class="img-fluid onliineconsuly_images"
                        src="{{ asset('images/website/about/coronavirus.png') }}" alt="Access Icon">
                    <div>
                        <span class="fw-semibold">No Contagion Exposure</span>
                        <div>
                            <p>Safe and secure way to receive medical advice
                            </p>
                            <p>without the risk of contagion exposure.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>