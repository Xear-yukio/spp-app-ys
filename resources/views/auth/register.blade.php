@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #3a7bd5, #3a6073);
        background-size: cover;
        min-height: 100vh;
    }

    .register-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .register-card input {
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
        <div class="card register-card shadow-lg p-4">
            <div class="text-center text-white mb-3">
                <h3 class="header-text"><i class="bi bi-person-plus"></i> Register</h3>
                <small>Silakan buat akun baru</small>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-white">Nama Lengkap</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control" 
                               value="{{ old('name') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               value="{{ old('username') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control" 
                               value="{{ old('email') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-white">Konfirmasi Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="form-control" 
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-light btn-modern">
                            Daftar
                        </button>
                    </div>
                </form>

                <hr class="text-white">

                <div class="text-center text-white">
                    <small>Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-white fw-bold">Login di sini</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
