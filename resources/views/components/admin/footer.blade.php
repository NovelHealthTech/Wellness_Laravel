<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!-- End custom js for this page -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if(session('error')){

    <script>
        Swal.fire({

            toast: true,
            position: 'top-end',
            icon: 'failure',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,

        });
    </script>
    }
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js">
</script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.bootstrap5.min.js">
</script>

<script>
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarContainer = document.getElementById('avatarContainer');
    const removeBtn = document.getElementById('removeBtn');

    // Handle file selection
    avatarInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (event) {
                avatarPreview.src = event.target.result;
                avatarPreview.classList.remove('hidden');
                avatarContainer.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle remove button
    removeBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Clear the image
        avatarPreview.src = '';
        avatarPreview.classList.add('hidden');

        // Reset the file input
        avatarInput.value = '';

        // Remove the has-image class to hide remove button
        avatarContainer.classList.remove('has-image');
    });
</script>

<script>

    function showAlertsuccess(response) {

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: "success", // 'success' or 'error'
            title: response.message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }

</script>






<!-- End custom js for this page -->
</body>

</html>