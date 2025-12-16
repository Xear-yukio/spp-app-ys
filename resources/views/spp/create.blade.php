@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    .fade-up {
        animation: fadeUp .6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-card {
        background: #ffffff;
        border-radius: 26px;
        border: none;
        box-shadow: 0 20px 45px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #6366f1, #3b82f6);
        color: #ffffff;
        padding: 28px 32px;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .form-body {
        padding: 32px 40px;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .form-control {
        border-radius: 14px;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99,102,241,.15);
    }

    .input-group-text {
        border-radius: 14px 0 0 14px;
        background: #eef2ff;
        border: 1px solid #d1d5db;
        font-weight: 600;
        color: #4338ca;
    }

    .btn-save {
        background: linear-gradient(135deg, #6366f1, #3b82f6);
        color: #fff;
        border-radius: 14px;
        padding: 12px 26px;
        font-weight: 600;
        border: none;
        transition: .3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59,130,246,.35);
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
        border-radius: 14px;
        padding: 12px 26px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #d1d5db;
    }
</style>

<div class="row justify-content-center fade-up">
    <div class="col-lg-6 col-xl-5">

        <div class="form-card">

            <!-- HEADER -->
            <div class="form-header">
                <h4>
                    <i class="bi bi-cash-stack me-1"></i> Tambah Data SPP
                </h4>
            </div>

            <!-- BODY -->
            <div class="form-body">
                <form action="{{ route('spp.store') }}" method="POST">
                    @csrf

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label class="form-label">Tahun SPP</label>
                        <input type="number" 
                               name="tahun"
                               class="form-control @error('tahun') is-invalid @enderror"
                               placeholder="Contoh: 2025"
                               value="{{ old('tahun') }}"
                               min="2000" max="2100"
                               required>
                        @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nominal -->
                    <div class="mb-4">
                        <label class="form-label">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number"
                                   name="nominal"
                                   class="form-control @error('nominal') is-invalid @enderror"
                                   placeholder="Masukkan nominal SPP"
                                   value="{{ old('nominal') }}"
                                   min="0"
                                   required>
                            @error('nominal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- ACTION -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('spp.index') }}" class="btn btn-cancel">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

@endsection
