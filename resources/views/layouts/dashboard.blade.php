<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - Kursus Online')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            padding-top: 80px;
        }

        .navbar-custom {
            background: white !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: #4f46e5 !important;
            font-size: 1.5rem;
        }

        .nav-link-custom {
            color: #4b5563 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link-custom:hover {
            color: #4f46e5 !important;
        }

        .btn-register {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            color: white !important;
            padding: 10px 24px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6b21a8 100%);
            transform: translateY(-2px);
        }

        /* Dashboard Cards */
        .stat-card {
            border-radius: 16px;
            padding: 24px;
            color: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.indigo {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        }

        .stat-card.green {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }

        .stat-card.orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }

        .welcome-card {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #4c1d95 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .course-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
        }

        .progress {
            height: 10px;
            border-radius: 5px;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-mortarboard-fill"></i> Kursus Online
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('pengajar.index') }}">
                            <i class="bi bi-person-badge"></i> Pengajar
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('kursus.index') }}">
                            <i class="bi bi-book"></i> Kursus
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('peserta.index') }}">
                            <i class="bi bi-people"></i> Peserta
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Daftar
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>