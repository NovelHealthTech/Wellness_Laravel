<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login Page</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Container holding the login card and background layers */
        .login-container {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* BACKGROUND #1: Doctor image, blurred, aligned left, full height */
        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/website/login/doctor.png') }}');
            background-repeat: no-repeat;
            background-position: left center;
            background-size: auto 100%;
            filter: blur(6px);
            z-index: -2;
        }

        /* BACKGROUND #2: Overlay layer above image but behind content */
        .login-container::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/website/login/doctor_background.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: -1;
        }

        /* Left image inside the card */
        .doctor_image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        /* Remove padding for left column */
        .left-col {
            padding: 0;
            height: 100%;
            overflow: hidden;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        /* Right column content styling */
        .right-col {
            padding: 1.5rem;
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;
        }

        /* Inner login card box */
        .inner-box {
            width: 100%;
            max-width: 900px;
            height: 85vh;
            margin: auto;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Rounded corners on desktop */
        .rounded-custom {
            border-radius: 30px !important;
        }

        .toppart {
            border-bottom: 1px solid rgb(90, 88, 88);
            flex-shrink: 0;
        }

        .grey_color {
            color: #707070;
        }

        .loginnow {
            background-color: #243665;
            border: none;
        }

        .loginnow:hover {
            background-color: #1a2847;
        }

        .donthaveaccouunt {
            font-size: 14px !important;
        }

        .loginform {
            padding-bottom: 2rem;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid grey;
            border-radius: 0;
            background: transparent;
            outline: none;
            padding: 0.5rem 0.25rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom-color: #243665;
        }

        .tab-button {
            border-right: 1px solid rgb(121, 117, 117);
            background-color: white;
            border: none;
            transition: all 0.3s;
        }

        .tab-button:hover {
            background-color: #f8f9fa;
        }

        .tab-button:last-child {
            border-right: none;
        }

        /* Ensure row height fits content */
        .full-height-row {
            height: 100%;
            overflow: hidden;
        }

        .mb-3 {
            margin-bottom: 0.75rem !important;
        }

        .py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }

        h5 {
            font-size: 1.1rem;
            margin-bottom: 1rem !important;
        }

        h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem !important;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {

            .login-container {
                padding: 10px;
            }

            .inner-box {
                max-width: 100%;
                height: 95vh;
                border-radius: 20px !important;
            }

            .doctor_image {
                min-height: 200px;
                max-height: 200px;
                border: none;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .left-col {
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
                height: auto;
            }

            .right-col {
                padding: 1rem;
            }

            .toppart {
                flex-direction: row !important;
            }

            .tab-button {
                border-right: 1px solid rgb(121, 117, 117) !important;
                border-bottom: none !important;
                padding: 0.5rem !important;
            }

            .tab-button:last-child {
                border-right: none !important;
            }

            h5 {
                font-size: 0.95rem;
                margin-bottom: 0.75rem !important;
            }

            h4 {
                font-size: 1rem;
                margin-bottom: 0.75rem !important;
            }

            .form-control {
                padding: 0.4rem 0.25rem;
                font-size: 14px;
            }

            .py-3 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }

            .mb-3 {
                margin-bottom: 0.5rem !important;
            }

            .loginform {
                padding-bottom: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .right-col {
                padding: 0.75rem;
            }

            h5 {
                font-size: 0.9rem;
            }

            h4 {
                font-size: 0.95rem;
            }

            .donthaveaccouunt {
                font-size: 12px !important;
            }

            .form-control {
                font-size: 13px;
            }

            .loginnow {
                padding: 0.5rem !important;
                font-size: 14px;
            }

            .loginform {
                padding-bottom: 1rem;
            }
        }

        /* Scrollbar styling for right column */
        .right-col::-webkit-scrollbar {
            width: 6px;
        }

        .right-col::-webkit-scrollbar-track {
            background: transparent;
        }

        .right-col::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .right-col::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        .active_border {
            border-bottom: 2px solid grey;
        }

        .tab-button:focus,
        .tab-button:active,
        .tab-button:focus-visible {
            box-shadow: none !important;
            outline: none !important;
        }

        /* Right side column wrapper */
        .right-side-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .already_account_text {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="bg-light bg-opacity-75 rounded shadow border inner-box rounded-custom">
            <div class="row g-0 full-height-row">
                <!-- LEFT IMAGE -->
                <div class="col-md-6 left-col">
                    <img class="doctor_image" src="{{ asset('images/website/login/doctor.png') }}" alt="Doctor Image">
                </div>

                <!-- RIGHT CONTENT -->
                <div class="col-md-6 right-side-wrapper">
                    <div class="d-flex justify-content-between toppart">
                        <button class="btn w-50 grey_color py-3 tab-button " style="border-right:1px solid grey;">
                            Signup
                        </button>

                        <button class="btn w-50 grey_color py-3 tab-button active_border">
                            Login
                        </button>
                    </div>

                    <div class="right-col">

                        <form action="{{ route('login.post') }}" method="post">
                            <!-- LOGIN FORM -->
                            @csrf
                            <div class="loginform tab-content" id="login-tab">
                                <div class="mb-3">
                                    <input type="email"name="email"  class="form-control" id="email" placeholder="Enter email">
                                </div>
                                <div class="mb-3">
                                    <input name="password" type="password" class="form-control" id="password"
                                        placeholder="Your Password" autocomplete="off">
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <p style="color:grey;font-size:12px" class="mb-0">Forget Password ?</p>
                                </div>
                                <div class="d-flex align-items-center py-2 grey_color" style="font-size:13px">
                                    <input type="checkbox" id="agree" class="me-2" autocomplete="off">
                                    <label for="agree" class="mb-0">Login with OTP instead of password</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 loginnow my-3">LOGIN NOW</button>

                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="w-50 d-flex align-items-center">
                                        <span>Or</span>
                                        <hr class="ms-2" style="width:200px">
                                    </div>
                                </div>
                                <div class="d-flex my-3 justify-content-center">
                                    <div class="border border-danger w-50 text-center py-2 px-2">
                                        Sign up with google
                                    </div>
                                </div>
                                <div class="my-3 d-flex justify-content-center">
                                    <p>Don't have an account?<span style="font-weight:bold"> sign up</span></p>
                                </div>
                            </div>


                        </form>


                        <!-- SIGNUP FORM -->
                        <div class="loginform tab-content d-none" id="signup-tab">
                            <h4 class="grey_color">Create Your Account</h4>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Number">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Pin Code">
                            </div>

                            <div class="mb-3">
                                <input type="date" class="form-control" placeholder="Date of birth">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Full Address">
                            </div>


                            <button type="button" class="btn btn-primary w-100 loginnow my-3">SEND OTP</button>
                            <div class="d-flex justify-content-end">
                                <div class="w-50 d-flex justify-content-center align-items-center">
                                    <span>OR</span>
                                    <hr style="width:200px;margin-left:10px">

                                </div>
                            </div>


                            <div class="border border-danger d-flex justify-content-center py-2">
                                Sign up with google
                            </div>
                            <p class="my-3  already_account_text" style="font-weight:bold">
                                Already have an account ? <span style="font-weight:bold">Log In</span>
                            </p>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabButtons = document.querySelectorAll('.tab-button');
            const loginTab = document.getElementById('login-tab');
            const signupTab = document.getElementById('signup-tab');

            document.addEventListener("click", function (e) {
                if (e.target.classList.contains('tab-button')) {
                    // Remove active from all
                    tabButtons.forEach(btn => btn.classList.remove('active_border'));
                    // Add active to clicked
                    e.target.classList.add('active_border');

                    // Show correct tab
                    if (e.target.textContent.trim() === "Login") {
                        loginTab.classList.remove('d-none');
                        signupTab.classList.add('d-none');
                    } else {
                        signupTab.classList.remove('d-none');
                        loginTab.classList.add('d-none');
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>