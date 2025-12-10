<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />


    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.bootstrap5.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .admin_button {

            width: 38% !important;
        }

        .dt-length select.form-select {

            padding: 10px 32px;
            border: 0;
            outline: 1px solid #ebedf2;
            color: #c9c8c8;
        }
    </style>
    <style>
        /* Avatar container */
        .avatar {
            --size: 150px;
            /* change this to make avatar bigger/smaller */
            width: var(--size);
            height: var(--size);
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            display: inline-block;
            background: linear-gradient(135deg, #f0f0f0, #e6e6e6);
            border: 4px solid #fff;
            box-shadow: 0 6px 18px rgba(19, 24, 32, 0.06);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Camera button overlay */
        .avatar .camera-btn {
            position: absolute;
            right: 8px;
            bottom: 8px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-grid;
            place-items: center;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, 0.85);
            transition: transform .12s ease, background .12s ease;
        }

        .avatar .camera-btn:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        .avatar .camera-btn:hover {
            transform: translateY(-2px);
            background: rgba(0, 0, 0, 0.75);
        }

        /* hidden file input */
        .avatar input[type=file] {
            display: none;
        }

        /* small remove button shown after upload */
        .avatar .remove-btn {
            position: absolute;
            left: 8px;
            bottom: 8px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: none;
            place-items: center;
            background: rgba(255, 255, 255, 0.9);
            color: #dc3545;
            border: 1px solid rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: transform .12s ease;
        }

        .avatar .remove-btn:hover {
            transform: translateY(-2px);
            background: #fff;
        }

        .avatar.has-image .remove-btn {
            display: inline-grid;
        }

        /* Hide image when no image is uploaded */
        .avatar img.hidden {
            display: none;
        }

        /* Show placeholder text when no image */
        .avatar .placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            color: #999;
            text-align: center;
            pointer-events: none;
        }

        .avatar.has-image .placeholder {
            display: none;
        }

        /* Accessibility helper text */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        /* Center the avatar */
        .avatar-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        label {
            font-size: 13px;
        }

        .form-control {
            padding: 11px 10px !important;
        }
    </style>

  

   


</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
            </div>
        </div>
        <!-- partial:partials/_navbar.html -->
        <nav style="padding-top:0px!important; margin-top:0px!important"
            class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo" href="index.html">NovelHealthtech</a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="assets/images/faces/face1.jpg" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">David Greymaax</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user me-2 text-success"></i> Profile </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>

                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="assets/images/faces/face1.jpg" alt="profile" />
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">David Grey. H</span>
                                <span class="text-secondary text-small">
                                    {{ auth()->user()->getRoleNames()->first() ?? 'No Role' }}
                                </span>

                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admindashboard') }}" class="nav-link" href="index.html">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Package Master</span>
                            <i class="menu-arrow"></i>
                            <i class="fa fa-user-md menu-icon"></i>

                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.package.index') }}">Package Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.package.create') }}">Add Package</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.vendor.index') }}" class="nav-link">
                            <span class="menu-title">Vendor</span>
                            <i class="mdi mdi-store menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.coupon.index') }}" class="nav-link">
                            <span class="menu-title">Coupon</span>
                            <i class="mdi mdi-store menu-icon"></i>
                        </a>
                    </li>

                </ul>
            </nav>