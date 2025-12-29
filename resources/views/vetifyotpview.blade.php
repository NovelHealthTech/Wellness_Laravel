<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; height: 100vh; background: #f5f7fa; }
        .otp-container { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .otp-card { background: #ffffff; padding: 30px 35px; border-radius: 12px; width: 100%; max-width: 380px; text-align: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08); }
        .otp-card h2 { margin-bottom: 8px; font-weight: 600; }
        .otp-card p { font-size: 14px; color: #6b7280; margin-bottom: 25px; }
        .otp-inputs { display: flex; justify-content: space-between; margin-bottom: 25px; }
        .otp-inputs input { width: 55px; height: 55px; font-size: 22px; text-align: center; border: 1px solid #d1d5db; border-radius: 8px; outline: none; }
        .otp-inputs input:focus { border-color: #2563eb; }
        .verify-btn { width: 100%; padding: 12px; background: #2563eb; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer;  }
        .verify-btn:hover { background: #1e40af; }
    </style>
</head>

<body>

    <div class="otp-container">
        <div class="otp-card">
            <h2>Verify OTP</h2>
            <p>Enter the 4-digit OTP sent to your mobile number</p>

            <form id="otpForm" action="{{ route('verifyotp') }}" method="post">
                @csrf
                <input type="hidden" name="number" value="{{ $number }}" />
                <input type="hidden" name="email" value="{{ $email }}" />
                <div class="otp-inputs">
                    <input name="otp[]" type="number" maxlength="1" required>
                    <input name="otp[]" type="number" maxlength="1" required>
                    <input name="otp[]" type="number" maxlength="1" required>
                    <input name="otp[]" type="number" maxlength="1" required>
                </div>
                <button type="submit" class="verify-btn">Verify</button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const inputs = document.querySelectorAll('.otp-inputs input');
        const form = document.getElementById('otpForm');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                // Move to next input if a number is entered
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                
            });

            // Allow backspace to move to previous input
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        @if(session('status') === 'failure')
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

        @if(session('status') === 'success')
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>

</body>
</html>
