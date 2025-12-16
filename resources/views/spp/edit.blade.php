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
        background: linear-gradient(135deg, #f59e0b, #f97316);
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
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245,158,11,.18);
    }

    .input-group-text {
        border-radius: 14px 0 0 14px;
        background: #fff7ed;
        border: 1px solid #d1d5db;
        font-weight: 600;
        color: #c2410c;
    }

    .btn-save {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        color: #fff;
        border-radius: 14px;
        padding: 12px 26px;
        font-weight: 600;
        border: none;
        transition: .3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(249,115,22,.35);
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

    .badge-edit {
        background: rgba(255,255,255,.2);
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<div class="row justify-content-center fade-up">
    <div class="col-lg-6 col-xl-5">

        <div class="form-card">

            <!-- HEADER -->
            <div class="form-header d-flex justify-content-between align-items-center">
                <h4>
                    <i class="bi bi-pencil-square me-1"></i> Edit Data SPP
                </h4>
                <span class="badge-edit">
                    Tahun {{ $spp->tahun }}
                </span>
            </div>

            <!-- BODY -->
            <div class="form-body">
                <form action="{{ route('spp.update', $spp) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label class="form-label">Tahun SPP</label>
                        <input type="number"
                               name="tahun"
                               class="form-control @error('tahun') is-invalid @enderror"
                               value="{{ old('tahun', $spp->tahun) }}"
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
                                   value="{{ old('nominal', $spp->nominal) }}"
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
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

@endsection
