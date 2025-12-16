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

    .profile-card {
        background: #ffffff;
        border-radius: 28px;
        box-shadow: 0 22px 45px rgba(0,0,0,.12);
        border: none;
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #2563eb, #0ea5e9);
        padding: 36px;
        color: #ffffff;
        position: relative;
    }

    .avatar {
        width: 92px;
        height: 92px;
        background: rgba(255,255,255,.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        margin-bottom: 10px;
    }

    .profile-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .profile-header small {
        opacity: .85;
    }

    .profile-body {
        padding: 32px 40px;
    }

    .info-row {
        display: flex;
        padding: 14px 0;
        border-bottom: 1px dashed #e5e7eb;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        width: 160px;
        font-weight: 600;
        color: #374151;
    }

    .info-value {
        color: #111827;
        font-weight: 500;
    }

    .btn-back {
        background: #e5e7eb;
        color: #374151;
        border-radius: 14px;
        padding: 12px 24px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }
</style>

<div class="row justify-content-center fade-up">
    <div class="col-lg-8 col-xl-7">

        <div class="profile-card">
            <!-- HEADER -->
            <div class="profile-header text-center">
                <div class="avatar mx-auto">
                    <i class="bi bi-person"></i>
                </div>
                <h4>{{ $siswa->nama }}</h4>
                <small>NIS: {{ $siswa->nis }}</small>
            </div>

            <!-- BODY -->
            <div class="profile-body">

                <div class="info-row">
                    <div class="info-label">Kelas</div>
                    <div class="info-value">
                        {{ $siswa->kelas->nama_kelas }} — {{ $siswa->kelas->jurusan }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">SPP</div>
                    <div class="info-value">
                        Tahun {{ $siswa->spp->tahun }}  
                        (Rp {{ number_format($siswa->spp->nominal,0,',','.') }})
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-value">
                        {{ $siswa->no_telp ?? '-' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">
                        {{ $siswa->alamat ?? '-' }}
                    </div>
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('siswa.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
