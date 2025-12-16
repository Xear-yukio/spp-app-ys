@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f7fb;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 24px;
        padding: 35px;
        color: #1f2937;
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card h3 {
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1e293b;
    }

    .register-card small {
        color: #64748b;
    }

    label {
        font-weight: 500;
        margin-bottom: 6px;
        color: #334155;
    }

    .form-control {
        background: #f1f5f9;
        border: 2px solid transparent;
        border-radius: 14px;
        color: #1e293b;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
        color: #1e293b;
    }

    .btn-modern {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border: none;
        border-radius: 16px;
        padding: 12px;
        font-weight: 600;
        color: #ffffff;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(79,70,229,0.4);
    }

    .divider {
        height: 1px;
        background: #e2e8f0;
        margin: 20px 0;
    }

    a {
        text-decoration: none;
        color: #6366f1;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-wrapper">
    <div class="register-card">
        <div class="text-center mb-4">
            <h3>Register</h3>
            <small>Buat akun baru untuk melanjutkan</small>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Nama lengkap"
                    value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control"
                    placeholder="Username"
                    value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    placeholder="email@example.com"
                    value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="********" required>
            </div>

            <div class="mb-4">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="********" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-modern">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="divider"></div>

        <div class="text-center">
            <small>
                Sudah punya akun?
                <a href="{{ route('login') }}" class="fw-bold">Login di sini</a>
            </small>
        </div>
    </div>
</div>
@endsection
