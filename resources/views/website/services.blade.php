@extends('layouts.app')
@section('content')

    @push("styles")
        <style>
            .serices_image {
                height: 300px !important;
            }

            .servies_background {
                background-color: #E6E6E6;
            }

            .main_servicediv {
                margin-bottom: 10rem;
                background-color: white !important;

            }

            .col-md-4 {
                position: relative;
                /* parent relative for absolute child */
            }

            .serices_image {
                position: absolute !important;
                top: -99px;
                right: 2px;
                height: 443px !important;
                z-index: 10;
            }

            .serivice_div_margin {
                margin: 13% 0%;
            }
            
            .service_div_margin_alternate{
                margin:10% 0%;
            }

            .serivice_div_margin p {

                color: black !important;
            }
        </style>


    @endpush
    <x-website.header />
    <div class="main_servicediv">
        <x-website.home.packages />
    </div>

    <div class="container servies_background">
        <div class="row p-3">
            <div class="col-md-7 px-5 py-3">
                <h4 class="bluecolor">DOC-ON-CALL</h4>
                <p style="color:black!important;font-weight:500">TELECONSULTATIONS</p>

                <ul>
                    <li> GP Consultations are provided through our Inhouse team of Experienced Doctors.</li>
                    <li> Multilingual Voice and Video Consultations</li>
                    <li>Facility of uploading Test reports through WhatsApp</li>
                    <li> Immediate Prescription sharing in PDF format after consultation</li>
                </ul>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <img class="img-fluid serices_image" src="{{ asset('images/website/services/phone1.png') }}" alt="">
            </div>

        </div>
    </div>
    
     <div class="container  service_div_margin_alternate">
        <div class="row p-3">


            <img src="{{ asset('images/website/services/services.png') }}" alt="">
           


        </div>
    </div>
    <div class="container servies_background serivice_div_margin">
        <div class="row p-3">
            <div class="col-md-4 d-flex justify-content-end">
                <img class="img-fluid serices_image" src="{{ asset('images/website/services/phone1.png') }}" alt="">
            </div>
            <div class="col-md-7 px-5 py-3">
                <h4 class="bluecolor">SURGICAL Assistance</h4>
                <p>TELECONSULTATIONS</p>

                <ul>
                    <li>Complete Waiver on Non Payable items such as consumables on hospital bills.</li>
                    <li>Free home pickup and drop-off.</li>
                    <li>Co-Payment Waiver up to 100% irrespective of the insurer.</li>
                    <li>Free Room Upgradation (Depending on availability) </li>
                    <li>Zero Deposit at the Network Hospital</li>
                    <li>Access to specialists in the listed domains</li>
                    <li> Dedicated Relationship manager for coordination in the hospitals</li>
                    <li>Hassle-free Cashless treatments</li>
                </ul>
            </div>


        </div>
    </div>

    <div class="container servies_background service_div_margin_alternate">
        <div class="row p-3">

            <div class="col-md-7 px-5 py-3">
                <h4 class="bluecolor">Discounted LAB TEST</h4>
                <p>TELECONSULTATIONS</p>

                <ul>
                    <li>Home sample collection facility</li>
                    <li>Tie-ups with Top Diagnostic centers across India</li>
                    <li>Customized Health Checkup packages for all age groups helping in early diagnosis of age related
                        diseases.</li>
                    <li> Discounts up to 70% on Diagnostic packages and up to 20% on Individual tests</li>
                </ul>
            </div>

            <div class="col-md-4 d-flex justify-content-end">
                <img class="img-fluid serices_image" src="{{ asset('images/website/services/phone1.png') }}" alt="">
            </div>

        </div>
    </div>

    <div class="container  serivice_div_margin">
        <div class="row p-3">
            <div class="col-md-4 d-flex justify-content-end">
                <img class="img-fluid serices_image" src="{{ asset('images/website/services/phone1.png') }}" alt="">
            </div>
            <div class="col-md-7 px-5 py-3">
                <h4 class="bluecolor">Discounted E-PHARMACY</h4>


                <ul>
                    <li> Convenience of door step delivery of medicines</li>
                    <li> Discounts up to 15% on prescribed medicines</li>
                    <li>Approx. 32K Pin code serviceable locations across India</li>

                </ul>
            </div>

        </div>
    </div>


    


    <x-website.footer />



@endsection