@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0f172a, #020617);
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, sans-serif;
        overflow: hidden;
    }

    /* Soft yellow glow */
    .glow {
        position: absolute;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(250,204,21,0.35), transparent 70%);
        filter: blur(100px);
        animation: float 12s infinite alternate ease-in-out;
    }

    .glow.one { top: 15%; left: 12%; }
    .glow.two { bottom: 12%; right: 15%; animation-delay: 3s; }

    @keyframes float {
        from { transform: translateY(0); }
        to { transform: translateY(-40px); }
    }

    /* Card */
    .login-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(16px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.15);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        animation: fadeUp .7s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Header */
    .login-title {
        font-weight: 800;
        letter-spacing: 1px;
        color: #facc15;
    }

    .login-sub {
        font-size: 13px;
        color: #cbd5f5;
    }

    /* Input */
    .form-control {
        background: rgba(255,255,255,0.9);
        border: none;
        border-radius: 16px;
        padding: 12px 14px;
        transition: .25s;
    }

    .form-control:focus {
        background: white;
        box-shadow: 0 0 0 3px rgba(250,204,21,.45);
    }

    /* Button */
    .btn-login {
        background: linear-gradient(135deg, #facc15, #fde047);
        border: none;
        border-radius: 16px;
        padding: 12px;
        font-weight: 700;
        color: #020617;
        transition: .3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(250,204,21,.45);
    }

    /* Footer link */
    .login-link {
        color: #fde047;
        font-weight: 600;
        text-decoration: none;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>

<!-- BACKGROUND GLOW -->
<div class="glow one"></div>
<div class="glow two"></div>

<div class="container min-vh-100 d-flex align-items-center justify-content-center position-relative">
    <div class="col-md-4 col-sm-10">

        <div class="login-card p-4 text-white">

            <!-- HEADER -->
            <div class="text-center mb-4">
                <i class="bi bi-mortarboard-fill fs-1 text-warning"></i>
                <h3 class="login-title mt-2">SPP SEKOLAH</h3>
                <div class="login-sub">Sistem Pembayaran Pendidikan</div>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-light">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Masukkan username"
                           value="{{ old('username') }}"
                           required autofocus>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>

                <div class="d-grid mb-3">
                    <button class="btn btn-login">
                        LOGIN
                    </button>
                </div>
            </form>

            <!-- FOOTER -->
            <div class="text-center">
                <small class="text-light">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="login-link">Daftar</a>
                </small>
            </div>

        </div>

    </div>
</div>

@endsection
