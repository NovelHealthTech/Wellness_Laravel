<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Login — Novel Healthtech</title>

    <link rel="icon" type="image/png" href="{{ asset('images/site_logo.png') }}" sizes="32x32">

    <style>
        :root {
            --navy: #243665;
            --navy-dark: #1a2847;
            --navy-deep: #0f1e3d;
            --teal: #0d9488;
            --teal-l: #f0fdfa;
            --white: #ffffff;
            --muted: #94a3b8;
            --font: 'Sora', sans-serif;
            --body: 'DM Sans', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--body);
            background: white;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── BACKGROUND ── */
        .page-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
        }
        .page-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/website/login/doctor.png') }}');
            background-repeat: no-repeat;
            background-position: left center;
            background-size: auto 100%;
            filter: blur(6px);
            z-index: -2;
        }
        .page-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/website/login/doctor_background.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: -1;
        }

        /* ── MAIN CARD ── */
        .main-card {
            position: relative;
            z-index: 1;
            width: 95vw;
            max-width: 1040px;
            height: 88vh;
            max-height: 700px;
            display: grid;
            grid-template-columns: 1fr 420px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(117, 76, 76, 0.06);
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: #144d74;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 44px 36px;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            width: 420px; height: 420px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.05);
            top: -110px; right: -130px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13,148,136,0.12) 0%, transparent 70%);
            bottom: 60px; left: -60px;
        }

        .brand-logo { display: flex; align-items: center; gap: 11px; position: relative; z-index: 1; }
        .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--teal), #0f766e);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 14px rgba(13,148,136,0.4);
            flex-shrink: 0;
        }
        .brand-name { font-family: var(--font); font-size: 17px; font-weight: 800; color: var(--white); letter-spacing: -0.3px; line-height: 1.1; }
        .brand-name span { color: #5eead4; }
        .brand-tagline { font-size: 10.5px; color: rgba(255,255,255,0.4); margin-top: 2px; }

        .product-copy { position: relative; z-index: 1; }
        .product-eyebrow {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(13,148,136,0.15); border: 1px solid rgba(13,148,136,0.3);
            border-radius: 50px; padding: 4px 12px;
            font-family: var(--font); font-size: 10px; font-weight: 700; color: #5eead4;
            letter-spacing: 1px; text-transform: uppercase; margin-bottom: 18px;
        }
        .product-eyebrow .dot { width: 5px; height: 5px; border-radius: 50%; background: var(--teal); animation: blink 2s infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

        .product-headline { font-family: var(--font); font-size: clamp(22px, 2.6vw, 32px); font-weight: 800; color: var(--white); line-height: 1.2; letter-spacing: -0.7px; margin-bottom: 14px; }
        .product-headline em { font-style: normal; color: #5eead4; }
        .product-desc { font-size: 13.5px; color: rgba(255,255,255,0.48); line-height: 1.65; max-width: 360px; margin-bottom: 28px; }

        .features { display: flex; flex-direction: column; gap: 11px; }
        .feature-item { display: flex; align-items: flex-start; gap: 12px; }
        .feature-icon { width: 34px; height: 34px; border-radius: 9px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; margin-top: 1px; }
        .feature-text { font-size: 13px; color: rgba(255,255,255,0.65); line-height: 1.5; }
        .feature-text strong { color: var(--white); font-weight: 700; display: block; }

        .vendors { position: relative; z-index: 1; }
        .vendors-label { font-size: 10px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 10px; }
        .vendor-pills { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .vendor-pill { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 7px; padding: 5px 11px; font-family: var(--font); font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.7); white-space: nowrap; }
        .vendor-pill.srl  { border-color: rgba(59,130,246,0.3);  color: #93c5fd; }
        .vendor-pill.red  { border-color: rgba(239,68,68,0.3);   color: #fca5a5; }
        .vendor-pill.tata { border-color: rgba(251,191,36,0.3);  color: #fde68a; }

        .trust-bar { position: relative; z-index: 1; display: flex; align-items: center; gap: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.08); }
        .trust-stat .num { font-family: var(--font); font-size: 17px; font-weight: 800; color: var(--white); }
        .trust-stat .lbl { font-size: 10.5px; color: rgba(255,255,255,0.35); margin-top: 1px; }
        .trust-divider { width: 1px; height: 28px; background: rgba(255,255,255,0.1); }

        /* ── RIGHT PANEL ── */
        .right-panel { background: var(--white); display: flex; flex-direction: column; overflow: hidden; }

        .auth-tabs { display: grid; grid-template-columns: 1fr 1fr; border-bottom: 1px solid #e2e8f0; flex-shrink: 0; }
        .auth-tab {
            padding: 17px 16px; background: none; border: none;
            font-family: var(--font); font-size: 13px; font-weight: 700; color: #94a3b8;
            cursor: pointer; transition: all 0.2s; border-bottom: 2px solid transparent;
        }
        .auth-tab.active { color: var(--navy); border-bottom-color: var(--navy); background: #fafbff; }
        .auth-tab:hover:not(.active) { color: #475569; background: #f8fafc; }

        .form-scroll { flex: 1; overflow-y: auto; padding: 28px 34px; }
        .form-scroll::-webkit-scrollbar { width: 4px; }
        .form-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

        .form-heading h4 { font-family: var(--font); font-size: 19px; font-weight: 800; color: var(--navy); letter-spacing: -0.4px; }
        .form-heading p { font-size: 13px; color: #64748b; margin-top: 4px; }
        .form-heading p a { color: var(--teal); font-weight: 600; text-decoration: none; }

        .access-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;
            padding: 7px 12px; font-size: 12px; color: #166534; font-weight: 600; margin: 14px 0 22px;
        }

        /* ── SHARED FIELD STYLES ── */
        .field { margin-bottom: 15px; }
        .field label {
            display: block; font-family: var(--font); font-size: 10px; font-weight: 700;
            color: #475569; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 6px;
        }
        .field input,
        .field select {
            width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-family: var(--body); font-size: 14px; color: var(--navy); background: #f8fafc;
            outline: none; transition: all 0.2s; height: 42px;
        }
        .field input:focus,
        .field select:focus { border-color: var(--navy); background: var(--white); box-shadow: 0 0 0 4px rgba(36,54,101,0.08); }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        /* input-group style (for icon prefix + eye toggle) */
        .input-wrap { display: flex; align-items: stretch; }
        .input-prefix {
            background: #f1f5f9; border: 1.5px solid #e2e8f0; border-right: none;
            border-radius: 10px 0 0 10px; padding: 0 12px;
            display: flex; align-items: center; color: #64748b; font-size: 13px; flex-shrink: 0;
        }
        .input-wrap input {
            border-radius: 0; border-left: none; flex: 1;
        }
        .input-wrap input:focus { border-color: var(--navy); box-shadow: none; }
        .input-wrap input:focus ~ .input-eye,
        .input-wrap input:focus + .input-eye { border-color: var(--navy); }
        .input-eye {
            background: #f1f5f9; border: 1.5px solid #e2e8f0; border-left: none;
            border-radius: 0 10px 10px 0; padding: 0 12px;
            display: flex; align-items: center; cursor: pointer; color: #64748b;
            transition: background 0.2s;
        }
        .input-eye:hover { background: #e2e8f0; }

        .text-danger { font-size: 11.5px; color: #dc3545; margin-top: 4px; display: block; }

        .forgot-link { text-align: right; margin-top: -8px; margin-bottom: 12px; }
        .forgot-link a { font-size: 12px; color: #64748b; text-decoration: none; }

        .otp-check { display: flex; align-items: center; gap: 8px; margin-bottom: 18px; }
        .otp-check input[type="checkbox"] { width: 15px; height: 15px; accent-color: var(--navy); cursor: pointer; }
        .otp-check label { font-size: 13px; color: #475569; cursor: pointer; }

        .submit-btn {
            width: 100%; padding: 13px;
            background:rgb(39, 77, 134);
            color: var(--white); border: none; border-radius: 11px;
            font-family: var(--font); font-size: 14px; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(36,54,101,0.35);
        }
        .submit-btn:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(36,54,101,0.4); }

        .divider { display: flex; align-items: center; gap: 12px; margin: 16px 0; }
        .divider hr { flex: 1; border: none; border-top: 1px solid #e2e8f0; }
        .divider span { font-size: 12px; color: #94a3b8; }

        .bottom-link { text-align: center; font-size: 13px; color: #64748b; }
        .bottom-link a { color: var(--navy); font-weight: 700; text-decoration: none; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            body { overflow-y: auto; align-items: flex-start; }
            .main-card { grid-template-columns: 1fr; height: auto; max-height: none; min-height: 100vh; border-radius: 0; width: 100%; }
            .left-panel { padding: 28px 24px; }
            .trust-bar { display: none; }
            .form-scroll { padding: 24px 20px; }
            .field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <div class="page-bg"></div>

    <div class="main-card">

        <!-- ══ LEFT: Novel Healthtech Showcase ══ -->
        <div class="left-panel">

            <div class="brand-logo">
                <div class="brand-icon">🏥</div>
                <div>
                    <div class="brand-name">Novel <span>Healthtech</span></div>
                    <div class="brand-tagline">Accessible Healthcare for Everyone</div>
                </div>
            </div>

            <div class="product-copy">
                <div class="product-eyebrow"><span class="dot"></span> All-in-one Healthcare Platform</div>
                <h2 class="product-headline">Healthcare that comes<br><em>to your doorstep.</em></h2>
                <p class="product-desc">From doctor consultations to lab tests and medicines — Novel Healthtech brings everything under one roof, powered by India's most trusted healthcare partners.</p>
                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">👨‍⚕️</div>
                        <div class="feature-text"><strong>Doctor on Call</strong>Consult qualified doctors anytime, from anywhere</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🧪</div>
                        <div class="feature-text"><strong>Lab Tests at Home</strong>Book via SRL, Redcliffe & Tata 1mg — sample collected at your door</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💊</div>
                        <div class="feature-text"><strong>E-Pharmacy</strong>Order genuine medicines online with fast home delivery</div>
                    </div>
                </div>
            </div>

            <div class="vendors">
                <div class="vendors-label">Our Lab Partners</div>
                <div class="vendor-pills">
                    <span class="vendor-pill srl">🔬 SRL Diagnostics</span>
                    <span class="vendor-pill red">🧬 Redcliffe Labs</span>
                    <span class="vendor-pill tata">⭐ Tata 1mg</span>
                </div>
            </div>


        </div>

        <!-- ══ RIGHT: Auth Forms ══ -->
        <div class="right-panel">

            <div class="auth-tabs">
                <button class="auth-tab active" data-tab="login">Login</button>
                <button class="auth-tab" data-tab="signup">Sign Up</button>
            </div>

            <div class="form-scroll">

                <!-- ══ LOGIN TAB ══ -->
                <div id="login-tab">
                    <div class="form-heading">
                        <h4>Welcome back 👋</h4>
                        <p>Don't have an account? <a href="#" class="tab-switch" data-tab="signup">Sign up free</a></p>
                    </div>
                    <div class="access-badge">✅ Login to access your Novel Healthtech dashboard</div>

                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="field">
                            <label>Email Address</label>
                            <div class="input-wrap">
                                <span class="input-prefix"><i class="fa fa-envelope-o"></i></span>
                                <input type="email" name="loginemail" id="email" placeholder="you@example.com" required>
                            </div>
                            @error("loginemail")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <div class="input-wrap">
                                <span class="input-prefix"><i class="fa fa-key"></i></span>
                                <input type="password" name="loginpassword" id="txtPasswordLogin" placeholder="Your password" autocomplete="off" required>
                                <span class="input-eye" id="toggle_login_pwd"><i class="fa fa-eye"></i></span>
                            </div>
                            @error("loginpassword")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="forgot-link"><a href="#">Forgot password?</a></div>
                        
                        <button type="submit" class="submit-btn">LOGIN NOW</button>
                    </form>

                    <div class="divider"><hr><span>or</span><hr></div>
                    <div class="bottom-link">New here? <a href="#" class="tab-switch" data-tab="signup">Create your account →</a></div>
                </div>

                <!-- ══ SIGNUP TAB ══ -->
                <div id="signup-tab" class="d-none">
                    <div class="form-heading">
                        <h4>Create your account ✨</h4>
                        <p>Already registered? <a href="#" class="tab-switch" data-tab="login">Login here</a></p>
                    </div>
                    <div class="access-badge">🏥 Sign up to access all Novel Healthtech services</div>

                    <form method="POST" action="{{ route('signup') }}" id="registrationForm">
                        @csrf

                        <!-- First & Last Name -->
                        <div class="field-row">
                            <div class="field">
                                <label>First Name <span style="color:red">*</span></label>
                                <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Rahul" required>
                                @error('firstname')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label>Last Name <span style="color:red">*</span></label>
                                <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Sharma" required>
                                @error('lastname')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="field">
                            <label>Email ID <span style="color:red">*</span></label>
                            <div class="input-wrap">
                                <span class="input-prefix"><i class="fa fa-envelope-o"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            </div>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <!-- Mobile -->
                        <div class="field">
                            <label>Mobile <span style="color:red">*</span></label>
                            <div class="input-wrap">
                                <span class="input-prefix">+91</span>
                                <input type="tel" name="mobile" id="ph_number" pattern="[0-9]{10}" maxlength="10" value="{{ old('mobile') }}" placeholder="10-digit number" required>
                            </div>
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label>Password <span style="color:red">*</span></label>
                            <div class="input-wrap">
                                <span class="input-prefix"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" id="txtPassword" placeholder="Min 6 characters" minlength="6" required>
                                <span class="input-eye" id="toggle_pwd"><i class="fa fa-eye"></i></span>
                            </div>
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="field">
                            <label>Confirm Password <span style="color:red">*</span></label>
                            <div class="input-wrap">
                                <span class="input-prefix"><i class="fa fa-key"></i></span>
                                <input type="password" name="password_confirmation" id="txtPassword2" placeholder="Re-enter password" minlength="6" required>
                                <span class="input-eye" id="toggle_pwd2"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>

                        <!-- DOB & Gender -->
                        <div class="field-row">
                            <div class="field">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob') }}">
                                @error('dob')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label>Gender</label>
                                <select name="gender">
                                    <option value="">Select</option>
                                    <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="field">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="House no, street, area…">
                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <!-- City & State -->
                        <div class="field-row">
                            <div class="field">
                                <label>City</label>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="Delhi">
                                @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label>State</label>
                                <input type="text" name="state" value="{{ old('state') }}" placeholder="Delhi">
                                @error('state')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Pincode -->
                        <div class="field">
                            <label>Pincode</label>
                            <input type="text" name="pincode" pattern="[0-9]{6}" maxlength="6" value="{{ old('pincode') }}" placeholder="6-digit pincode">
                            @error('pincode')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <button type="submit" class="submit-btn">REGISTER NOW</button>
                    </form>

                    <div class="divider"><hr><span>or</span><hr></div>
                    <div class="bottom-link">Already have an account? <a href="#" class="tab-switch" data-tab="login">Login →</a></div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ── Tab switching ──
        const tabs      = document.querySelectorAll('.auth-tab');
        const loginTab  = document.getElementById('login-tab');
        const signupTab = document.getElementById('signup-tab');

        function switchTab(name) {
            tabs.forEach(t => t.classList.toggle('active', t.dataset.tab === name));
            loginTab.classList.toggle('d-none',  name !== 'login');
            signupTab.classList.toggle('d-none', name !== 'signup');
        }

        tabs.forEach(tab => tab.addEventListener('click', () => switchTab(tab.dataset.tab)));
        document.querySelectorAll('.tab-switch').forEach(link => {
            link.addEventListener('click', e => { e.preventDefault(); switchTab(link.dataset.tab); });
        });

        // ── Password toggles ──
        $("#toggle_login_pwd").click(function () {
            const f = $("#txtPasswordLogin");
            f.attr("type", f.attr("type") === "password" ? "text" : "password");
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
        });
        $("#toggle_pwd").click(function () 
        {
            const f = $("#txtPassword");
            f.attr("type", f.attr("type") === "password" ? "text" : "password");
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
        });
        $("#toggle_pwd2").click(function () {
            const f = $("#txtPassword2");
            f.attr("type", f.attr("type") === "password" ? "text" : "password");
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
        });

        // ── Confirm password check ──
        $("#registrationForm").on("submit", function (e) {
            if ($("#txtPassword").val() !== $("#txtPassword2").val()) {
                e.preventDefault();
                Swal.fire({ icon: 'error', title: 'Passwords do not match!', confirmButtonColor: '#243665' });
                return false;
            }
        });


        // ── SweetAlert for session messages ──
        @if(session('status') == 'failure')
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: "{{ session('message') }}",
                showConfirmButton: false, timer: 3000, timerProgressBar: true
            });
        @endif

        // ── If validation errors exist, auto-open signup tab ──
        // @if($errors->any())
        //     switchTab('signup');
        // @endif
    </script>
<script>
  // Push a state so the back button is interceptable
  history.pushState(null, null, location.href);

  window.addEventListener('popstate', function () {
    // Change this route to wherever you want the back button to go
    window.location.href = "{{ route('home') }}";
  });
</script>
</body>
</html>