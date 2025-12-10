<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $description ?? '' }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
  
    <style>
        body {
            font-family: 'Poppins', 'sans-serif';
            overflow-x:hidden;
        }

        .inactive {
            color: #707070;
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            font-weight: 400;
        }
        .bluecolor{
            color:#2E3964;
        }

        .active {

            color: #2E3964 !important;
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            font-weight: 600 !important;
        }

        .loginsignup_header {
            border: 2px solid #707070 !important;
            color: #707070 !important;
        }

        h1 {
            font-size: 3rem;
        }

        h2 {

            font-size: 2.5rem;
        }



        .text_grey {

            color: #707070 !important;
        }

        p {
            font-size:15px;
            color: grey !important;
            margin-bottom: 0 !important;
            
        }
        li{
            font-size:15px!important;
        }

        .bluegradient {
            background-color: #243665;

        }
    </style>
    <style>
        .loading-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading-wrapper.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading svg polyline {
            fill: none;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .loading svg polyline#back {
            stroke: #ff4d5033;
        }

        .loading svg polyline#front,
        .loading svg polyline#front2 {
            stroke: #00ffff;
            stroke-dasharray: 48, 144;
            stroke-dashoffset: 192;
            animation: dash_682 2s linear infinite;
        }

        .loading svg polyline#front2 {
            animation-delay: 1s;
        }

        @keyframes dash_682 {
            72.5% {
                opacity: 0;
            }

            to {
                stroke-dashoffset: 0;
            }
        }
    </style>

    @stack("styles")

    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

    <div class="loading-wrapper" id="page-loader">
        <div class="loading">
            <svg height="48px" width="64px">
                <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
                <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
                <polyline id="front2" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
            </svg>
        </div>
    </div>


    <div class="">
        @yield('content')
    </div>


    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- #region -->
    {{-- <script>
        window.addEventListener("load", function () {
            // Minimum loader display time in milliseconds
            const minTime = 1000;
            const loader = document.getElementById("page-loader");

            // Calculate elapsed time since DOM started loading
            const startTime = performance.timing.navigationStart;
            const elapsed = Date.now() - startTime;

            const remainingTime = Math.max(minTime - elapsed, 0);

            setTimeout(() => {
                loader.classList.add("hidden");
            }, remainingTime);
        });
    </script> --}}


    <script>
window.addEventListener("load", function () {
    const minTime = 1000;
    const loader = document.getElementById("page-loader");

    const startTime = performance.timing.navigationStart;
    const elapsed = Date.now() - startTime;
    const remainingTime = Math.max(minTime - elapsed, 0);

    setTimeout(() => {
        loader.classList.add("hidden");

        // 🔥 VERY IMPORTANT: refresh AOS *after* loader hides
        setTimeout(() => {
            AOS.refresh();
        }, 300);
    }, remainingTime);
});
</script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack("scripts")

</body>

</html>