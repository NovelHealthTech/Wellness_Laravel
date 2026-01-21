@extends('layouts.app')

@section('content')

    <x-website.header />

    <div class="container py-5" style="max-width: 1200px;">
        <div class="card">

            <div class="card-body p-5">

                {{-- Heading --}}
                <h1 class="elementor-heading-title mb-4" style="font-size: 2.5rem; font-weight: 700; color: #1a1a1a;">
                    PRIVACY POLICY</h1>

                <p style="font-size: 1.1rem; line-height: 1.8;">
                    Welcome to <strong>Wellness by Novel HealthTech</strong>.
                </p>

                <p style="font-size: 1.1rem; line-height: 1.8;">
                    At <strong>Wellness by Novel HealthTech</strong>, we are committed to protecting your privacy. This
                    Privacy Policy explains how we collect, use, and safeguard your personal information when you use our
                    platform.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: Information We Collect --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">Information We
                    Collect</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We collect information from our users, including corporate clients and their employees. For employees,
                    we gather details such as name, date of birth, gender, contact information, employment details, and
                    health information. We only collect this information when the employee is associated with a wellness
                    program or policy on our platform. For corporate clients, we collect information such as company name,
                    address, and contact information.
                </p>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We may also collect information about your usage of our platform, including device type, IP address, and
                    browsing history. We employ cookies and other tracking technologies to collect this information.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: How We Collect Information --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">How We Collect
                    Information</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We collect information directly from our corporate clients and their employees when they sign up for a
                    wellness program or policy on our platform.
                </p>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    <strong>Purpose of Data Collection:</strong> We collect this information to provide wellness services to
                    our corporate clients and their employees. We may also utilize this information to communicate with our
                    clients and employees regarding our products and services.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: Data Sharing --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">Data Sharing</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We only share data with the relevant parties involved in the wellness program or policy, which may
                    include the insurance company, the employer (our corporate client), brokers, and third-party
                    administrators (TPAs). We do not disclose your personal information to any other third parties without
                    your consent.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: Additional Wellness Services --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">Additional Wellness
                    Services</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We may collaborate with wellness providers to offer supplementary services to our users. If you choose
                    to opt-in for these services, we may share your personal information with the wellness provider.
                    However, we will only share your information with your explicit consent.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: Data Security --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">Data Security</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We take data security very seriously. We have implemented robust measures, including TLS encryption and
                    a reliable firewall setup, to protect your data. Your data is stored within secure servers provided by
                    Wellness by Novel HealthTech, and regular backups are performed on our internal servers.
                </p>

                <hr style="margin: 2rem 0; border-top: 2px solid #e0e0e0;">

                {{-- Section: User Rights --}}
                <h2 style="font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">User Rights</h2>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    You have the right to access and update your personal information. However, if the information you wish
                    to change is policy-related, you may not be able to modify it unless the change has not been endorsed in
                    the policy.
                </p>

                <p style="font-size: 1.05rem; line-height: 1.7;">
                    If you have any questions or concerns about our privacy policy, please contact us at
                    <a href="mailto:support@novelhealthtech.com"
                        style="color: #007bff; text-decoration: none;">support@novelhealthtech.com</a>.
                </p>

                <p style="font-size: 1.05rem; line-height: 1.7;">
                    We are committed to keeping your information safe and secure, and we will only use it for the purposes
                    outlined in this policy.
                </p>


            </div>



        </div>


    </div>

    <x-website.footer />

@endsection