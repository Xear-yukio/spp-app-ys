@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f5f7fb;
    }

    /* ===== ANIMATION ===== */
    .fade-up {
        animation: fadeUp .6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        border-radius: 24px;
        padding: 28px;
        color: #fff;
        box-shadow: 0 20px 40px rgba(37,99,235,.35);
        margin-bottom: 30px;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: rgba(255,255,255,.96);
        border-radius: 26px;
        border: none;
        box-shadow: 0 20px 45px rgba(0,0,0,.08);
        padding: 30px;
    }

    /* ===== FORM CONTROL ===== */
    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .form-control {
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        transition: .25s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 .2rem rgba(99,102,241,.15);
    }

    /* ===== BUTTON ===== */
    .btn-save {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        border-radius: 50px;
        padding: 10px 22px;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34,197,94,.4);
        color: #fff;
    }

    .btn-back {
        background: #f1f5f9;
        border-radius: 50px;
        padding: 10px 22px;
        color: #334155;
        font-weight: 600;
        border: none;
        transition: .3s;
    }

    .btn-back:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    /* ===== INVALID ===== */
    .invalid-feedback {
        font-size: 13px;
    }
</style>

<!-- ===== HEADER ===== -->
<div class="page-header fade-up">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-plus-circle"></i> Tambah Kelas
    </h3>
    <small class="opacity-75">
        Tambahkan data kelas baru ke sistem
    </small>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6 fade-up" style="animation-delay:.1s">
        <div class="form-card">

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                    <input type="text"
                           name="nama_kelas"
                           class="form-control @error('nama_kelas') is-invalid @enderror"
                           value="{{ old('nama_kelas') }}"
                           placeholder="Contoh: X, XI, XII"
                           required>
                    @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                    <input type="text"
                           name="jurusan"
                           class="form-control @error('jurusan') is-invalid @enderror"
                           value="{{ old('jurusan') }}"
                           placeholder="Contoh: IPA, IPS, RPL"
                           required>
                    @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('kelas.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-save"></i> Simpan Kelas
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
