<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPP App')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        /* ================= NAVBAR ================= */
        .navbar-glass {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            box-shadow: 0 8px 30px rgba(0,0,0,.18);
            position: relative;
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .5px;
        }

        .nav-link {
            color: rgba(255,255,255,.85) !important;
            padding: 8px 14px;
            border-radius: 10px;
            transition: .25s;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.15);
            color: #fff !important;
        }

        .nav-link.active {
            background: #fff;
            color: #2563eb !important;
            box-shadow: 0 6px 16px rgba(0,0,0,.2);
            font-weight: 600;
        }

        /* ================= DROPDOWN FIX ================= */
        .dropdown-menu {
            border-radius: 16px;
            border: none;
            padding: 10px;
            min-width: 220px;
            box-shadow: 0 20px 40px rgba(0,0,0,.25);
            z-index: 9999 !important;
            animation: dropdownFade .25s ease;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 500;
            transition: .2s;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
        }

        .dropdown-logout {
            color: #ef4444;
            font-weight: 600;
        }

        .dropdown-logout:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ================= ALERT ================= */
        .alert {
            border-radius: 14px;
            border: none;
            box-shadow: 0 6px 18px rgba(0,0,0,.1);
        }

        /* ================= CONTENT ================= */
        .content-wrapper {
            padding: 24px;
        }
    </style>
</head>
<body>

@auth
<nav class="navbar navbar-expand-lg navbar-dark navbar-glass">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="bi bi-wallet2 fs-4"></i> SPP App
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LEFT MENU -->
            <ul class="navbar-nav me-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                @if(auth()->user()->level === 'admin')
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

                @if(in_array(auth()->user()->level, ['admin','petugas']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}"
                       href="{{ route('pembayaran.index') }}">
                        <i class="bi bi-credit-card"></i> Pembayaran
                    </a>
                </li>
                @endif
            </ul>

            <!-- USER MENU -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5"></i>
                        {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li class="px-3 py-2 text-muted small">
                            Level: <strong>{{ ucfirst(auth()->user()->level) }}</strong>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item dropdown-logout">
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
@endauth

<!-- ================= CONTENT ================= -->
<div class="container-fluid content-wrapper">

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

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
