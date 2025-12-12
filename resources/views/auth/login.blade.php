@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #3a7bd5, #3a6073);
        background-size: cover;
        min-height: 100vh;
    }

    .login-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .login-card input {
        border-radius: 12px;
    }

    .btn-modern {
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    .header-text {
        font-weight: 700;
        letter-spacing: 1px;
    }
</style>

<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
        <div class="card login-card shadow-lg p-4">
            <div class="text-center text-white mb-3">
                <h3 class="header-text"><i class="bi bi-box-arrow-in-right"></i> Login</h3>
                <small>Silakan masuk untuk melanjutkan</small>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               value="{{ old('username') }}" 
                               required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control" 
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-light btn-modern">
                            Login
                        </button>
                    </div>
                </form>

                <hr class="text-white">

                <div class="text-center text-white">
                    <small>Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-white fw-bold">Daftar di sini</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
