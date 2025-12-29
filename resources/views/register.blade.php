<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        * { box-sizing: border-box; font-family: "Segoe UI", Arial, sans-serif; }
        body { margin: 0; background: #f5f5f5; }
        .clearfix { clear: both; }
        .w-720px { max-width: 720px; width: 95%; margin: auto; }
        .top-links { padding: 20px; text-align: right; font-size: 14px; }
        .top-links a { color: #555; text-decoration: none; margin: 0 4px; }
        .top-links a:hover { color: #007bff; }
        .login-form { background: #fff; margin-top: 20px; margin-bottom: 40px; border-radius: 10px; box-shadow: 0 12px 30px rgba(0, 0, 0, .08); }
        .form-body { padding: 20px; overflow: hidden; }
        .col-sm-6 { width: 50%; float: left; padding: 0 10px; }
        .form-group { margin-bottom: 15px; }
        label { font-size: 14px; margin-bottom: 6px; display: block; color: #333; font-weight: 500; }
        .form-control { width: 100%; height: 40px; padding: 8px 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; }
        .form-control:focus { outline: none; border-color: #007bff; }
        .input-group { display: flex; align-items: stretch; }
        .input-group-addon { background: #eee; padding: 8px 12px; border: 1px solid #ccc; border-right: none; display: flex; align-items: center; border-radius: 5px 0 0 5px; }
        .input-group .form-control { border-radius: 0; }
        .input-group .form-control:last-child { border-radius: 0 5px 5px 0; }
        .eye { cursor: pointer; background: #eee; border: 1px solid #ccc; border-left: none; border-radius: 0 5px 5px 0; user-select: none; }
        .eye:hover { background: #ddd; }
        .form-footer { padding: 20px; border-top: 1px solid #eee; }
        .btn { height: 44px; font-weight: 600; border-radius: 6px; cursor: pointer; font-size: 14px; transition: all 0.3s ease; }
        .btn-block { width: 100%; }
        .btn-primary { background: #007bff; border: none; color: #fff; }
        .btn-primary:hover { background: #0056b3; }
        .text-danger { font-size: 12px; color: #dc3545; margin-top: 4px; display: block; }
        @media (max-width: 768px) {
            .col-sm-6 { width: 100%; padding: 0; }
            .top-links { text-align: center; font-size: 12px; }
            .top-links a { display: inline-block; margin: 5px 2px; }
        }
    </style>
</head>

<body>

    <!-- Top links -->
    <div class="top-links">
        <a href="#contact">Contact us</a> |
        <a href="#about">About us</a> |
        <a href="#privacy">Privacy Policy</a> |
        <a href="#terms">Terms & conditions</a> |
        <a href="#faq">FAQs</a> |
        <a href="#refund">Refund & Cancellation</a>
    </div>

    <!-- Registration Card -->
    <div class="login-form w-720px">
        <form method="POST" action="{{ route('signup') }}" id="registrationForm">
            @csrf
            <div class="form-body">

                <!-- First Name -->
                <div class="col-sm-6 form-group">
                    <label for="first_name">First Name <span style="color:red;">*</span></label>
                    <input type="text" id="first_name" name="firstname" class="form-control"
                        value="{{ old('firstname') }}" required>
                    @error('firstname')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="col-sm-6 form-group">
                    <label for="lastname">Last Name <span style="color:red;">*</span></label>
                    <input type="text" id="last_name" name="lastname" class="form-control"
                        value="{{ old('lastname') }}" required>
                    @error('lastname')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-sm-6 form-group">
                    <label for="email">Email ID <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mobile -->
                <div class="col-sm-6 form-group">
                    <label for="mobile">Mobile <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="tel" id="ph_number" name="mobile" class="form-control"
                            pattern="[0-9]{10}" maxlength="10" value="{{ old('mobile') }}" required>
                    </div>
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-sm-6 form-group">
                    <label for="password">Password <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" id="txtPassword" name="password" class="form-control" minlength="6" required>
                        <span class="input-group-addon eye" id="toggle_pwd">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-sm-6 form-group">
                    <label for="password_confirmation">Confirm Password <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" id="txtPassword2" name="password_confirmation" class="form-control" minlength="6" required>
                        <span class="input-group-addon eye" id="toggle_pwd2">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                </div>

                <!-- DOB -->
                <div class="col-sm-6 form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob') }}">
                    @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="col-sm-6 form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-sm-6 form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div class="col-sm-6 form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}">
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- State -->
                <div class="col-sm-6 form-group">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" class="form-control" value="{{ old('state') }}">
                    @error('state')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Pincode -->
                <div class="col-sm-6 form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" id="pincode" name="pincode" class="form-control" pattern="[0-9]{6}" maxlength="6" value="{{ old('pincode') }}">
                    @error('pincode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Password toggle
        $("#toggle_pwd").click(function () {
            const passwordField = $("#txtPassword");
            const type = passwordField.attr("type") === "password" ? "text" : "password";
            passwordField.attr("type", type);
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
        });
        $("#toggle_pwd2").click(function () {
            const passwordField = $("#txtPassword2");
            const type = passwordField.attr("type") === "password" ? "text" : "password";
            passwordField.attr("type", type);
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
        });

        // Confirm password check
        $("#registrationForm").on("submit", function (e) {
            const password = $("#txtPassword").val();
            const confirmPassword = $("#txtPassword2").val();
            if (password !== confirmPassword) {
                e.preventDefault();
                alert("Passwords do not match!");
                return false;
            }
        });

        // SweetAlert for session messages
        @if(session('status') =='failure')
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>

</body>
</html>
