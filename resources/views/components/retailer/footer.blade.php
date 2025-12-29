<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navMenu');
        nav.classList.toggle('active');
    }

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                document.getElementById('navMenu').classList.remove('active');
            }
        });
    });

    document.addEventListener('click', (e) => {
        const nav = document.getElementById('navMenu');
        const btn = document.querySelector('.mobile-menu-btn');
        if (!nav.contains(e.target) && !btn.contains(e.target)) {
            nav.classList.remove('active');
        }
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function successalert(data) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }



</script>
@if(session("status") == "failure")
    <script>

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: "{{ session('message') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

    </script>
@endif


</body>

</html>