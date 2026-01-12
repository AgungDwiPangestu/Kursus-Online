<!-- Navbar Bootstrap - Same as Homepage -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background: white !important; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08); padding: 15px 0; z-index: 1000;">
    <div class="container">
        <a class="navbar-brand" href="/" style="font-weight: 700; color: #4f46e5 !important; font-size: 1.5rem;">
            <i class="bi bi-mortarboard-fill"></i> Kursus Online
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavApp">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse show" id="navbarNavApp">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                @auth
                @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengajar.index') }}" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
                        <i class="bi bi-person-badge"></i> Pengajar
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kursus.index') }}" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
                        <i class="bi bi-book"></i> Kursus
                    </a>
                </li>
                @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peserta.index') }}" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
                        <i class="bi bi-people"></i> Peserta
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
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
                    <a class="nav-link" href="{{ route('login') }}" style="color: #4b5563 !important; font-weight: 500; margin: 0 10px;">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn" href="{{ route('register') }}" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; color: white !important; padding: 10px 24px; border-radius: 10px; font-weight: 600;">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    body {
        padding-top: 80px !important;
    }

    /* Force navbar items to be visible */
    #navbarNavApp {
        display: flex !important;
    }

    #navbarNavApp .navbar-nav {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
    }

    #navbarNavApp .nav-item {
        display: block !important;
    }

    #navbarNavApp .nav-link {
        display: block !important;
    }

    /* Mobile responsive */
    @media (max-width: 991px) {
        #navbarNavApp {
            flex-direction: column !important;
        }

        #navbarNavApp .navbar-nav {
            flex-direction: column !important;
        }
    }
</style>