<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTest Pro - Online Test Booking</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef7 100%);
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

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: translateY(-2px);
        }

        nav {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-item {
            color: #667eea;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .nav-item.active {
            background: rgba(102, 126, 234, 0.15);
        }

        .cart-badge {
            position: absolute;
            top: 6px;
            right: 12px;
            background: #ff4757;
            color: white;
            border-radius: 10px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .cta-button {
            background: #667eea;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .cta-button:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .mobile-menu-btn {
            display: none;
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Package Cards Section */
        .packages-section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #718096;
        }

        .package-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            height: 100%;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .package-card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .package-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .bg-gradient-1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .bg-gradient-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .bg-gradient-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .bg-gradient-5 {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .bg-gradient-6 {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        }

        .package-card h5 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .package-card p {
            color: #718096;
            font-size: 0.95rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .view-tests-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-tests-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                padding: 0 20px;
            }

            .header-container {
                flex-wrap: wrap;
                gap: 15px;
            }

            .logo img {
                max-width: 150px !important;
            }

            .mobile-menu-btn {
                display: block;
            }

            nav {
                width: 100%;
                flex-direction: column;
                background: white;
                border-radius: 12px;
                padding: 10px;
                gap: 8px;
                max-height: 0;
                overflow: hidden;
                opacity: 0;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            nav.active {
                max-height: 500px;
                opacity: 1;
                margin-top: 10px;
            }

            .nav-item {
                width: 100%;
                padding: 12px 20px;
                font-size: 15px;
                justify-content: flex-start;
            }

            .cta-button {
                width: 100%;
                padding: 12px;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .package-card h5 {
                font-size: 1.2rem;
            }
        }
    </style>


    <style>
        /* Page Header */
        .page-header {
            background: white;
            padding: 40px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #718096;
            font-size: 1.1rem;
        }

        .back-btn {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            background: #667eea;
            color: white;
            transform: translateX(-5px);
        }

        /* Tabs Styling */
        .labs-tabs-section {
            padding: 0 0 60px 0;
        }

        .nav-tabs {
            border: none;
            gap: 15px;
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            color: #667eea;
            font-weight: 600;
            padding: 18px 35px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-tabs .nav-link:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-color: transparent;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .nav-tabs .nav-link i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        /* Test Cards */
        .test-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .test-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            transition: transform 0.4s ease;
        }

        .test-card.redcliff::before {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
        }

        .test-card.srl::before {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .test-card.tata1mg::before {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .test-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }

        .test-card:hover::before {
            transform: scaleX(1);
        }

        .test-card::before {
            transform: scaleX(0);
        }

        .lab-badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .badge-redcliff {
            background: linear-gradient(135deg, #ffe5e5, #ffd4d4);
            color: #d63031;
        }

        .badge-srl {
            background: linear-gradient(135deg, #e5f3ff, #d4ebff);
            color: #0984e3;
        }

        .badge-tata1mg {
            background: linear-gradient(135deg, #e5ffe5, #d4ffd4);
            color: #00b894;
        }

        .test-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .icon-redcliff {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
        }

        .icon-srl {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .icon-tata1mg {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .test-card h5 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
        }

        .test-card p {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .test-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 2px solid #f7fafc;
            margin-bottom: 20px;
        }

        .parameters-count {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .test-price {
            text-align: right;
        }

        .test-price .current-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #667eea;
        }

        .test-price .old-price {
            font-size: 1rem;
            color: #a0aec0;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .discount-badge {
            background: #48bb78;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-left: 10px;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .test-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .test-features li {
            padding: 8px 0;
            color: #4a5568;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .test-features li i {
            color: #48bb78;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .nav-tabs .nav-link {
                padding: 14px 24px;
                font-size: 0.9rem;
            }

            .test-card {
                padding: 20px;
            }

            .test-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .test-price {
                text-align: left;
            }
        }



        .button_color {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
    </style>




</head>


<header>
    <div class="header-container">
        <div class="logo">
            <img style="max-width: 200px; height: 60px;" src="{{ asset('images/retailer/novel_tech.png') }}" alt="Logo">
        </div>

        <button class="mobile-menu-btn" onclick="toggleMenu()">☰</button>

        <nav id="navMenu">
            <a href="#home" class="nav-item active">
                <span class="icon">🏠</span>
                <span>Home</span>
            </a>
            <a href="#cart" class="nav-item">
                <span class="icon">🛒</span>
                <span>Cart</span>
                <span class="cart-badge">3</span>
            </a>
            <a href="#orders" class="nav-item">
                <span class="icon">📦</span>
                <span>Orders & Payment</span>
            </a>
            <a href="#invoice" class="nav-item">
                <span class="icon">🧾</span>
                <span>Invoice</span>
            </a>
            <a href="#profile" class="nav-item">
                <span class="icon">👤</span>
                <span>Profile</span>
            </a>
            <a href="#logout" class="nav-item">
                <span class="icon">🚪</span>
                <span>Logout</span>
            </a>
        </nav>

        <button class="cta-button">Book Test</button>
    </div>
</header>

<body>