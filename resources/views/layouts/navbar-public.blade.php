<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="bi bi-mortarboard-fill"></i> Kursus Online
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                    <ul class="dropdown-menu">
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

<style>
    .navbar-custom {
        background: white !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08) !important;
        padding: 15px 0 !important;
        z-index: 1000 !important;
    }

    .navbar-brand {
        font-weight: 700 !important;
        color: #4f46e5 !important;
        font-size: 1.5rem !important;
    }

    .nav-link-custom {
        color: #4b5563 !important;
        font-weight: 500 !important;
        margin: 0 10px !important;
        transition: color 0.3s !important;
    }

    .nav-link-custom:hover {
        color: #4f46e5 !important;
    }

    .btn-register {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
        border: none !important;
        color: white !important;
        padding: 10px 24px !important;
        border-radius: 10px !important;
        transition: all 0.3s !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3) !important;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6b21a8 100%) !important;
        color: white !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.5) !important;
    }

    body {
        padding-top: 80px !important;
    }
</style>