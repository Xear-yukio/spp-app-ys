<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPP App')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Modern Navbar */
        .navbar {
            border-bottom: 3px solid #0d6efd;
        }

        .shadow-nav {
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-nav .nav-link.active {
            background-color: #ffffff;
            color: #0d6efd !important;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .dropdown-menu {
            border-radius: 10px;
        }

        .dropdown-item:hover {
            background-color: #e9ecef;
        }

        .min-vh-100 {
            min-height: 100vh;
        }
    </style>
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-nav">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="bi bi-wallet2 me-2"></i> SPP App
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- Left Menu -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>

                    @if(auth()->user()->level == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kelas.*') ? 'active' : '' }}" 
                           href="{{ route('kelas.index') }}">
                            <i class="bi bi-door-open"></i> Kelas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('spp.*') ? 'active' : '' }}" 
                           href="{{ route('spp.index') }}">
                            <i class="bi bi-cash-stack"></i> SPP
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}" 
                           href="{{ route('siswa.index') }}">
                            <i class="bi bi-people"></i> Siswa
                        </a>
                    </li>
                    @endif

                    @if(in_array(auth()->user()->level, ['admin', 'petugas']))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}" 
                           href="{{ route('pembayaran.index') }}">
                            <i class="bi bi-credit-card"></i> Pembayaran
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Right Menu / User -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" 
                           href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> 
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text">
                                    <small>Level: {{ ucfirst(auth()->user()->level) }}</small>
                                </span>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    @else

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-nav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-wallet2 me-2"></i> SPP App
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" 
                           href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" 
                           href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    @endauth

    <!-- ===================== MAIN CONTENT ===================== -->
    <div class="@auth container-fluid @else container @endauth mt-4">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
