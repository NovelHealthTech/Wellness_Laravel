<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTest Pro - Online Test Booking</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            padding: 0 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .service-wrapper {
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 16px;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .service-item {
            flex: 1;
            text-align: center;
            text-decoration: none;
            color: #1a1a1a;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .service-item i {
            font-size: 30px;
            margin-bottom: 8px;
            padding: 14px;
            border-radius: 50%;
        }

        .blue i  { color: #1e88e5; background: rgba(30, 136, 229, 0.12); }
        .green i { color: #43a047; background: rgba(67, 160, 71, 0.12); }
        .purple i{ color: #8e24aa; background: rgba(142, 36, 170, 0.12); }
        .sky i   { color: #039be5; background: rgba(3, 155, 229, 0.12); }
        .red i   { color: #e53935; background: rgba(229, 57, 53, 0.12); }
        .gold i  { color: #f5b301; background: rgba(245, 179, 1, 0.15); }
        .gold span { color: #f5b301; font-weight: 700; }

        .service-item p {
            font-size: 13px;
            font-weight: 500;
            line-height: 1.2;
        }

        .service-item:hover { transform: translateY(-4px); }

        .header_image {
            height: 32px !important;
            width: 60px !important;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .service-wrapper {
                overflow-x: auto;
                gap: 18px;
            }
            .service-item { min-width: 90px; }
        }
    </style>
</head>

<body>  {{-- ✅ Fixed: <body> moved to correct position --}}

    <div class="d-flex justify-content-between shadow-sm my-2">

        <div class="p-3">
            <img class="header_image" src="{{ asset('images/retailer/nc.jpg') }}" alt="Icon">
        </div>

        <div class="header-bar d-flex justify-content-between align-items-center px-4">

            {{-- ✅ Fixed: removed all empty <li> and commented-out blocks --}}
            <div class="nav-item dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span>{{ auth()->user()->name ?? 'Account' }}</span>
                    <i class="fa-solid fa-chevron-down ms-2"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('signout') }}">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS ✅ Fixed: was completely missing — this is why dropdown wasn't working -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
</html>