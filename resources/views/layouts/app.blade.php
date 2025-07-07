<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:SITE_NAME" content="Future Taikun" />
    <meta property="og:title" content="Future Taikun" />
    <meta property="og:description" content="FutureTaikun | Fundraising Platform  for Startups" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo01.png') }}">
    <title>@yield('title', 'Future Taikun - Connecting Entrepreneurs & Investors')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('/fontawesome/all.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> --}}
    <!-- Font Awesome CDN (Full version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        main.flex-fill {
            flex: 1 0 auto;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;

            transition: margin-left 0.5s;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .btn:hover {
            background: #37B2C2;
        }

        .btn-primary {
            background: #2EA9B9;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background: rgb(181, 39, 53);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            padding: 15px 20px;

        }

        .form-control:focus {
            border-color: #dee2e6;
            box-shadow: 0 0 0 0.0;
        }

        .form-select:focus {
            border-color: #dee2e6;
            box-shadow: 0 0 0 0.0;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        /* Navbar styling */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            position: relative;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand img {
            max-width: 200px;
            height: auto;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-links a {
            color: black;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar-links a:hover {
            color: #2EA9B9;
        }

        .navbar-links i {
            margin-right: 5px;
        }

        .navbar-toggler {
            background-color: #2EA9B9;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar-toggler:focus {
            outline: none;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            /* Start off-screen to the left */
            background-color: #2c3e50;
            overflow-x: hidden;
            transition: left 0.5s;
            padding-top: 60px;
            z-index: 1001;
            display: none;
            /* Hidden by default */
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            color: white;
            cursor: pointer;
        }

        .content {
            padding: 16px;
            transition: margin-left 0.5s;
        }

        .sidebar.open {
            left: 0;
            /* Slide in from the left */
            display: block;
            /* Show sidebar when open */
        }

        .content.open {
            margin-left: 250px;
            /* Adjust content margin */
        }

        @media (max-width: 991px) {
            .navbar-links {
                display: none;
                /* Hide links on mobile */
            }

            .navbar-toggler {
                display: block;
                /* Show toggle button on mobile */
            }

            .sidebar {
                display: block;
                /* Enable sidebar on mobile */
            }
        }

        @media (min-width: 992px) {
            .navbar-toggler {
                display: none;
                /* Hide toggle button on desktop */
            }

            .navbar-links {
                display: flex;
                /* Show links on desktop */
            }
        }

        @media (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }

        .role-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
        }

        .role-card:hover {
            transform: translateY(-5px);
        }

        .role-card.selected {
            border-color: #667eea;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        }

        .otp-input {
            font-size: 24px;
            text-align: center;
            font-weight: bold;
        }

        /* Remove container margin for full-width content */
        .main-container {
            padding-left: 0;
            padding-right: 0;
        }

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .custom-toast {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 10px;
            overflow: hidden;
            animation: slideInRight 0.4s ease-out;
        }

        .custom-toast.success {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .custom-toast.error {
            background: linear-gradient(135deg, #f44336, #da190b);
            color: white;
        }

        .custom-toast.info {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
        }

        .custom-toast .toast-header {
            background: transparent;
            border: none;
            color: inherit;
            font-weight: 600;
        }

        .custom-toast .toast-body {
            padding: 15px 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .custom-toast .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .custom-toast .btn-close:hover {
            opacity: 1;
        }

        /* Progress bar for auto-hide */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            transition: width linear;
        }

        .toast-progress.success {
            background: rgba(255, 255, 255, 0.4);
        }

        .toast-progress.error {
            background: rgba(255, 255, 255, 0.4);
        }

        .toast-progress.info {
            background: rgba(255, 255, 255, 0.4);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .toast-hide {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .toast-container {
                left: 20px;
                right: 20px;
                max-width: none;
            }

            .custom-toast {
                margin-bottom: 8px;
            }
        }

        /* footer code   */

        .footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            margin-top: auto;
        }

        .footer-content {
            padding: 15px 0 !important;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 8px !important;
        }


        .social-link-facebook {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #2EA9B9;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-link-facebook:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            color: white;
        }

        .social-link-youtube {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #2EA9B9;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-link-youtube:hover {
            background-color: #FF0000;
            transform: translateY(-2px);
            color: white;
        }

        .social-link-instagram {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #2EA9B9;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-link-instagram:hover {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            transform: translateY(-2px);
            color: white;
        }

        .social-link-linkedin {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #2EA9B9;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-link-linkedin:hover {
            background: #0077B5;
            transform: translateY(-2px);
            color: white;
        }

        .social-link-twitter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #2EA9B9;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-link-twitter:hover {
            background: #1DA1F2;
            transform: translateY(-2px);
            color: white;
        }


        .social-link i {
            line-height: 1;
        }

        .footer-text p {
            margin-bottom: 0;
            line-height: 1.3;
        }

        /* Responsive design */
        @media (max-width: 576px) {
            .social-links {
                gap: 10px;
            }

            .social-link {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
        }

        #footer {
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 576px) {
            #footer {
                display: block;
            }
        }

        /* form filed ui changes*/
        .form-floating-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating-custom .form-control {
            padding: 1rem 0.75rem 0.5rem 0.75rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-floating-custom .form-select {
            padding: 1rem 0.75rem 0.5rem 0.75rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            background: transparent;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgb(185, 178, 178);
            opacity: 1;
            /* Ensures color shows up */
        }

        /* For WebKit browsers (Chrome, Safari) */
        .form-control::-webkit-input-placeholder {
            color: #b9b2b2;
        }

        /* For Firefox */
        .form-control::-moz-placeholder {
            color: #b9b2b2;
        }

        /* For Internet Explorer */
        .form-control:-ms-input-placeholder {
            color: #b9b2b2;
        }

        /* For Microsoft Edge */
        .form-control::-ms-input-placeholder {
            color: #b9b2b2;
        }

        .form-floating-custom label {
            position: absolute;
            top: 0;
            left: 12px;
            transform: translateY(-50%);
            background: white;
            padding: 0 8px;
            color: #6c757d;
            font-size: 14px;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 1;
            font-weight: 500;
        }

        .form-floating-custom select.form-control {
            cursor: pointer;
        }

        .container-custom {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .form-section {

            padding: 2rem;
            border-radius: 8px;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .footer {
            background-color: #ffffff;
            color: #333333;
            padding: 20px 0;
            font-family: Arial, sans-serif;
        }

        .footer-content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .footer-section {
            margin: 10px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-link {
            color: white;
            font-size: 18px;
            transition: color 0.3s;
        }

        .social-link:hover {
            color: #ffffff;
        }

        .footer-text {

            padding-top: 10px;
            font-size: 12px;
            color: #999999;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                padding: 1rem;
                background-color: #fff;
            }

            .navbar-nav {
                flex-direction: column;
                align-items: start;
            }

            .nav-item {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        .vr {
            border-left: 2px solid #fff;
            height: 50px;
        }

        .company-span {
            color: #2EA9B9;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    {{-- <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('mobile.form') }}">
                <img src="{{ asset('logo3.png') }}" alt="Future Taikun" class="logo me-2" width="100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="background-color: 
            #2EA9B9;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <!-- Search Button -->
                    <li class="nav-item me-2">
                        <a href="{{ route('search') }}" style="color: black;">
                            <i class="fas fa-search me-1"></i>
                        </a>
                    </li>

                    <!-- Login Link -->
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('login') }}"><i class="fas fa-user me-1"></i></a>
                    </li>

                    <!-- Support Link -->
                    <li class="nav-item me-2">
                        <a class="nav-link text-black" href="{{ route('contact') }}" target="_blank">
                            Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}
    <!-- Debug info - बाद में remove कर देना -->

    <div class="sidebar" id="sidebar">
        <a href="#" class="close-btn" onclick="toggleSidebar()">×</a>
        <a href="{{ route('search') }}"><i class="fas fa-search me-1"></i> Search</a>
        @if (Auth::check())
            <a href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"><i
                    class="fas fa-sign-out-alt me-1"></i> Logout</a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @if (Auth::user()->role === 'entrepreneur')
                <a href="{{ route('entrepreneur.form', ['user_id' => Auth::id()]) }}"><i class="fas fa-user me-1"></i>
                    My Account</a>
            @elseif (Auth::user()->role === 'investor')
                <a href="{{ route('investor.form', ['user_id' => Auth::id()]) }}"><i class="fas fa-user me-1"></i> My
                    Account</a>
            @endif
        @else
            <a href="{{ route('login') }}"><i class="fas fa-user me-1"></i> Login</a>
        @endif
        <a href="{{ route('contact') }}" target="_blank">Support</a>
    </div>

    <div class="" id="">
        <nav class="navbar">
            <div class="container" id="">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('mobile.form') }}">
                    <img src="{{ asset('logo01.png') }}" alt="Future Taikun" class="logo me-2" width="100px">
                </a>
                <div class="navbar-links">
                    <a href="{{ route('search') }}" style="color: #2EA9B9; font-weight:bold;">Search</a>
                    @if (Auth::check())

                        @if (Auth::user()->role === 'entrepreneur')
                            <a href="{{ route('entrepreneur.form', ['user_id' => Auth::id()]) }}"
                                style="color: #2EA9B9; font-weight:bold;">My Account</a>
                        @elseif (Auth::user()->role === 'investor')
                            <a href="{{ route('investor.form', ['user_id' => Auth::id()]) }}"
                                style="color: #2EA9B9; font-weight:bold;">My Account</a>
                        @endif
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();"
                            style="color: #2EA9B9; font-weight:bold;">Logout</a>
                        <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" style="color: #2EA9B9; font-weight:bold;">Login</a>
                    @endif
                    <a href="{{ route('contact') }}" target="_blank"
                        style="color: #2EA9B9; font-weight:bold;">Support</a>
                </div>
                <button class="navbar-toggler" type="button" onclick="toggleSidebar()"
                    style="background-color: #2EA9B9; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                    <span class="navbar-toggler-icon" style="display: inline-block; width: 20px; height: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20"
                            fill="none" stroke="white" stroke-width="2">
                            <path d="M0 7h30M0 15h30M0 23h30" />
                        </svg>
                    </span>
                </button>
            </div>
        </nav>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer">
        <!-- Success Toast -->
        @if (session('success'))
            <div class="toast custom-toast success show" role="alert" data-auto-hide="5000">
                <div class="toast-header">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <div class="toast-progress success"></div>
            </div>
        @endif

        <!-- Error Toast -->
        @if (session('error'))
            <div class="toast custom-toast error show" role="alert" data-auto-hide="6000">
                <div class="toast-header">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <div class="toast-progress error"></div>
            </div>
        @endif

        <!-- OTP Sent Toast -->
        @if (session('otp_sent'))
            <div class="toast custom-toast info show" role="alert" data-auto-hide="5000">
                <div class="toast-header">
                    <i class="fas fa-sms me-2"></i>
                    <strong class="me-auto">OTP Sent</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('otp_sent') }}
                </div>
                <div class="toast-progress info"></div>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-fill">
        @yield('content')
    </main>
    @if (Route::currentRouteName() === 'policy' ||
            Route::currentRouteName() === 'mobile.form' ||
            Route::currentRouteName() === 'contact' ||
            Route::currentRouteName() === 'support' ||
            Route::currentRouteName() === 'service' ||
            Route::currentRouteName() === 'guidelines' ||
            Route::currentRouteName() === 'search')
        @include('layouts.footer')
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            sidebar.classList.toggle("open");
            // content.classList.toggle("open");
        }
        // Toast Auto-Hide Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.custom-toast[data-auto-hide]');

            toasts.forEach(toast => {
                const autoHideTime = parseInt(toast.getAttribute('data-auto-hide'));
                const progressBar = toast.querySelector('.toast-progress');

                // Start progress bar animation
                if (progressBar) {
                    progressBar.style.width = '100%';
                    progressBar.style.transition = `width ${autoHideTime}ms linear`;

                    // Trigger animation after a small delay
                    setTimeout(() => {
                        progressBar.style.width = '0%';
                    }, 100);
                }

                // Auto hide toast
                setTimeout(() => {
                    hideToast(toast);
                }, autoHideTime);

                // Manual close button
                const closeBtn = toast.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => hideToast(toast));
                }
            });
        });

        function hideToast(toast) {
            toast.classList.add('toast-hide');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        // Function to show custom toast (for JavaScript usage)
        function showToast(message, type = 'info', duration = 5000) {
            const toastContainer = document.getElementById('toastContainer');
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                info: 'fas fa-info-circle',
                warning: 'fas fa-exclamation-triangle'
            };

            const toastHtml = `
                <div class="toast custom-toast ${type} show" role="alert" data-auto-hide="${duration}">
                    <div class="toast-header">
                        <i class="${icons[type] || icons.info} me-2"></i>
                        <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                    <div class="toast-progress ${type}"></div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHtml);

            // Initialize the new toast
            const newToast = toastContainer.lastElementChild;
            const progressBar = newToast.querySelector('.toast-progress');

            if (progressBar) {
                progressBar.style.width = '100%';
                progressBar.style.transition = `width ${duration}ms linear`;
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 100);
            }

            setTimeout(() => hideToast(newToast), duration);

            newToast.querySelector('.btn-close').addEventListener('click', () => hideToast(newToast));
        }

        // Example usage (you can call this from anywhere in your JavaScript):
        // showToast('This is a success message!', 'success', 4000);
        // showToast('This is an error message!', 'error', 6000);
    </script>

    @yield('scripts')
</body>

</html>
