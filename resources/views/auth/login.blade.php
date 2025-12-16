@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f5f7fb;
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ================= CARD ================= */
    .login-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 38px 34px;
        width: 100%;
        max-width: 420px;
        box-shadow:
            0 40px 80px rgba(15,23,42,.08),
            0 10px 25px rgba(15,23,42,.05);
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= HEADER ================= */
    .login-icon {
        width: 68px;
        height: 68px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 30px;
        margin: 0 auto 16px;
        box-shadow: 0 20px 40px rgba(99,102,241,.35);
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
        margin-bottom: 30px;
    }

    /* ================= INPUT ================= */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 16px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        transition: .25s;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99,102,241,.18);
    }

    /* ================= MODERN BUTTON ================= */
    .btn-login {
        position: relative;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border: none;
        border-radius: 18px;
        padding: 14px;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: 1px;
        color: white;
        overflow: hidden;
        transition: .35s ease;
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.35),
            0 18px 35px rgba(99,102,241,.45);
    }

    /* glossy layer */
    .btn-login::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(255,255,255,.35),
            rgba(255,255,255,0)
        );
        opacity: .6;
    }

    /* hover */
    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.35),
            0 25px 50px rgba(99,102,241,.55);
    }

    /* active (pressed) */
    .btn-login:active {
        transform: translateY(0);
        box-shadow:
            inset 0 4px 8px rgba(0,0,0,.25),
            0 10px 20px rgba(99,102,241,.35);
    }

    /* ================= FOOTER ================= */
    .login-footer {
        text-align: center;
        font-size: 13px;
        color: #64748b;
        margin-top: 24px;
    }

    .login-footer a {
        color: #4f46e5;
        font-weight: 700;
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

        <div class="login-title">SPP APP</div>
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
