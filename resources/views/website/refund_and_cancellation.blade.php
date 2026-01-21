@extends('layouts.app')

@section('content')
<x-website.header />

<div class="container my-5">
    <div class="card">

        <div class="card-body">
   <h1 class="mb-4 text-center">REFUNDS &amp; CANCELLATIONS</h1>

    <!-- Non-refundable charges -->
    <p class="mb-3">
        At our wellness portal, we strive to provide top-notch services that cater to your well-being.
        When you opt for any wellness service from our portal, a specific amount is charged, which is
        <strong>non-refundable</strong>. This policy ensures that our team can continue delivering
        exceptional services and maintain the highest standards of care.
    </p>

    <!-- Technical or unforeseen issues -->
    <p class="mb-3">
        In the unlikely event that any amount is deducted from your account, but the wellness service
        is not purchased due to technical issues or unforeseen circumstances, rest assured that the
        deducted amount will be <strong>promptly refunded</strong> in accordance with your bank's
        terms and conditions.
    </p>

    <!-- Customer satisfaction -->
    <p class="mb-3">
        We understand that your satisfaction is of utmost importance. If you face any issues with the
        service you've opted for, please contact our customer support team promptly, and we will do
        our best to address and resolve the matter efficiently.
    </p>

    <!-- Policy awareness -->
    <p class="mb-4">
        Please review and understand our refund &amp; cancellation policy before proceeding with any
        service. We value your trust and support and are committed to providing a seamless and
        enriching wellness experience.
    </p>
        </div>
    </div>
    <!-- Heading -->
 
{{-- 
    <!-- Optional Call-to-Action Button -->
    <div class="text-center mb-4">
        <a href="#" class="btn btn-primary">Click Here</a>
    </div>

    <!-- Optional YouTube Video -->
    <div class="ratio ratio-16x9 mb-5">
        <iframe src="https://www.youtube.com/embed/XHOmBV4js_E" title="YouTube video"
            allowfullscreen></iframe>
    </div> --}}
</div>

<x-website.footer />
@endsection
