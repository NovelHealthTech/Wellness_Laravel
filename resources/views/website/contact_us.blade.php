@extends('layouts.app')

@section('content')

<x-website.header />

<div class="container py-5">

    {{-- Elementor Heading Styles --}}
    <style>
        .elementor-heading-title {
            padding: 0;
            margin: 0;
            line-height: 1;
        }
    </style>

    <h1 class="elementor-heading-title">Contact</h1>

    {{-- Dummy Form --}}
    <form id="dummyForm" class="mt-4">
        @csrf

        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>

        <div class="mb-3">
            <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>

    <h2 class="mt-5">Have Any Queries?</h2>

    <p>
        If you have any queries or would like to know more about our services,
        please don't hesitate to contact us. Our team is always ready to assist you
        and provide the information you need.
    </p>

    {{-- Divider Styles --}}
    <style>
        .elementor-widget-divider {
            --divider-border-width: 1px;
            --divider-border-style: solid;
            --divider-color: #2c2c2c;
        }
        .elementor-divider-separator {
            border-top: 1px solid #2c2c2c;
            margin: 30px 0;
        }
    </style>

    <div class="elementor-divider-separator"></div>

    {{-- Contact Info --}}
    <h4>📞 +0124-4278179</h4>
    <h4>✉️ support@novelhealthtech.com</h4>
    <h4>
        📍 D-101, 2nd Floor, Phase V, Udyog Vihar, Sector 19, Gurugram,
        Haryana 122016
    </h4>

    {{-- Google Map --}}
    <style>
        .elementor-widget-google_maps iframe {
            width: 100%;
            height: 300px;
            border: 0;
            margin-top: 20px;
        }
    </style>

    <iframe
        src="https://maps.google.com/maps?q=104%2C%20Phase%20V%2C%20Udyog%20Vihar%2C%20Sector%2019%2C%20Gurugram%2C%20Haryana&t=m&z=14&output=embed"
        aria-label="Gurugram Office Location">
    </iframe>

</div>

<x-website.footer />

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('dummyForm').addEventListener('submit', function(e){
    e.preventDefault(); // prevent actual form submission

    Swal.fire({
        icon: 'success',
        title: 'Form Submitted!',
        text: 'We will reach you out shortly.',
        confirmButtonText: 'OK'
    }).then(() => {
        // Redirect to home route after clicking OK
        window.location.href = "{{ route('home') }}";
    });
});
</script>

@endsection
