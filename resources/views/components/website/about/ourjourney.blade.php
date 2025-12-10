@push("styles")
<style>

    /* EXECUTIVE IMAGE */
    .executive_image {
        position: relative;
        height: 265px !important;
        width: 250px;
        object-fit: cover;
        top: -13%; /* slight upward overflow */
    }

    /* BACKGROUND SECTION */
    .our_journey {
        background: url("{{ asset('images/website/about/ourjourney.png') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 40px 20px; /* spacing inside */
        border-radius: 10px;
    }

</style>
@endpush

<div class="container our_journey">
    <h3 class="text_grey mb-4">Our Journey</h3>

    <div class="row align-items-start">

        <!-- LEFT COLUMN -->
        <div class="col-md-7">
            <p>
                Dr. Piyush Kumar Srivastava is a dynamic and results-driven professional with over 20 years of
                experience in the Health Insurance, Insurance Broking, and Wellness sectors. He is currently the
                Chief Executive Officer (CEO) of Novel Healthtech Solutions Pvt Ltd, a leading healthtech company
                that pioneers innovative online health consultation solutions and is committed to delivering
                excellence in healthcare services.
            </p>

            <h5 class="text_grey mt-4">Early Life and Education</h5>

            <p>
                Dr. Srivastava was born and raised in Lucknow, Uttar Pradesh, where he developed a strong passion
                for technology and innovation from an early age. He completed his schooling at Army Public School
                in Lucknow before pursuing his Bachelor of Ayurvedic Medicine and Surgery (BAMS) from Nagpur
                University. Dr. Srivastava further enhanced his academic credentials with an MBA followed by a PG
                Diploma in Hospital and Healthcare Management from Lucknow University. His strong academic
                foundation has been pivotal in shaping his career trajectory.
            </p>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-md-5 d-flex flex-column align-items-center">

            <img src="{{ asset('images/website/about/executivenew.png') }}"
                 alt="Dr. Piyush Srivastava"
                 class="executive_image img-fluid mb-3">

            <h2 style="opacity: 60%" class="text-center text_grey">Dr. Piyush Srivastava</h2>
            <h4 style="opacity:70%" class="text-center text-muted">Chief Executive Officer</h4>
        </div>
    </div>
    <div>
        <p class="text-center">Read More</p>
    </div>
</div>
