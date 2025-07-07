<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta property="og:SITE_NAME" content="Future Taikun" />
    <meta property="og:title" content="Future Taikun" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:description" content="FutureTaikun | Fundraising Platform  for Startups" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo01.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #F5F6FA;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Prevent horizontal scroll on body */
        }

        .sidebar {
            position: fixed;
            /* Make sidebar sticky */
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            /* Fixed width */
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            z-index: 1000;
            overflow-y: auto;
            /* Allow sidebar to scroll if content is too long */
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #f0f0f0;
            font-weight: 600;
        }

        .main-content {
            margin-left: 250px;
            /* Match sidebar width */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            border-bottom: 1px solid #dee2e6;
            background-color: #fff;
            position: sticky;
            /* Make navbar sticky */
            top: 0;
            z-index: 999;
        }

        .content-area {
            flex: 1;
            padding: 20px;
            overflow-x: auto;
            /* Allow horizontal scroll only in content area */
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                z-index: 1030;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Table responsive improvements */
        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-container table {
            min-width: 1200px;
            /* Minimum width to prevent cramping */
        }

        .form-floating-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating-custom .form-control {
            padding: 1rem 0.75rem 0.5rem 0.75rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            background: transparent;
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
            color: #b9b2b2;
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
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar p-3" id="sidebar">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('/logo01.png') }}" alt="Logo" class="img-fluid" width="100px">
            </a>
        </div>

        @if (session('selected_role') === 'investor')
            <a href="{{ route('admin.entrepreneurs') }}"
                class="{{ request()->is('admin/entrepreneurs*') ? 'active' : '' }}">
                Entrepreneur
            </a>
            <a href="{{ route('change.password') }}" class="{{ request()->is('change-password') ? 'active' : '' }}">
                Change Password
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-5">
                @csrf
                <button class="btn btn-outline-danger btn-sm" style="width: -webkit-fill-available;">Logout</button>
            </form>
        @endif

        @if (session('selected_role') === 'admin')
            <a href="{{ route('admin.investors') }}" class="{{ request()->is('admin/investors*') ? 'active' : '' }}">
                Investor
            </a>
            <a href="{{ route('admin.entrepreneurs') }}"
                class="{{ request()->is('admin/entrepreneurs*') ? 'active' : '' }}">
                Entrepreneur
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                Users
            </a>
            <a href="{{ route('change.password') }}" class="{{ request()->is('change-password') ? 'active' : '' }}">
                Change Password
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-5">
                @csrf
                <button class="btn btn-outline-danger btn-sm" style="width: -webkit-fill-available;">Logout</button>
            </form>
        @endif

        @if (session('selected_role') === 'entrepreneur')
            <a href="{{ route('entrepreneur.edit') }}"
                class="{{ request()->is('entrepreneur/edit*') ? 'active' : '' }}">
                Profile Update
            </a><br>
            <a href="{{ route('my.companies') }}" class="{{ request()->is('my-companies') ? 'active' : '' }}">
                My Companies
            </a><br>
            <a href="{{ route('change.password') }}" class="{{ request()->is('change-password') ? 'active' : '' }}">
                Change Password
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm" style="width: -webkit-fill-available;">Logout</button>
            </form>
        @endif
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        {{-- Top Navbar --}}
        <nav class="navbar navbar-expand-lg px-4" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary me-3 mobile-menu-btn" type="button"
                        onclick="toggleSidebar()">
                        ☰
                    </button>
                    <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3">{{ Auth::user()->name }}</span>
                    {{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm">Logout</button>
                    </form> --}}
                </div>
            </div>
        </nav>

        {{-- Content Area --}}
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.querySelector('.mobile-menu-btn');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !mobileBtn.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
