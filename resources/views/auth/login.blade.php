@extends('layouts.app')

@section('content')

<style>
    /* ================= BASE ================= */
    body {
        background: #f5f7fb;
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    /* ================= LOGIN WRAPPER ================= */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ================= CARD ================= */
    .login-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 36px 32px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 25px 50px rgba(0,0,0,.08);
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= HEADER ================= */
    .login-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        margin: 0 auto 14px;
        box-shadow: 0 15px 30px rgba(59,130,246,.35);
    }

    .login-title {
        font-weight: 800;
        font-size: 22px;
        color: #1e293b;
        text-align: center;
        margin-bottom: 4px;
    }

    .login-sub {
        text-align: center;
        font-size: 13px;
        color: #64748b;
        margin-bottom: 28px;
    }

    /* ================= INPUT ================= */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .form-control {
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #e2e8f0;
        transition: .25s;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,.25);
    }

    /* ================= BUTTON ================= */
    .btn-login {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border: none;
        border-radius: 14px;
        padding: 12px;
        font-weight: 700;
        color: white;
        letter-spacing: .5px;
        transition: .3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(99,102,241,.4);
    }

    /* ================= FOOTER ================= */
    .login-footer {
        text-align: center;
        font-size: 13px;
        color: #64748b;
        margin-top: 22px;
    }

    .login-footer a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">

        <!-- HEADER -->
        <div class="login-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <div class="login-title">SPP App</div>
        <div class="login-sub">Sistem Pembayaran SPP Sekolah</div>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Masukkan username"
                       value="{{ old('username') }}"
                       required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>
            </div>

            <div class="d-grid">
                <button class="btn btn-login">
                    LOGIN
                </button>
            </div>
        </form>

        <!-- FOOTER -->
        <div class="login-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </div>

    </div>
</div>

@endsection
