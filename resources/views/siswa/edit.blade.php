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
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: white;
        padding: 28px;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 700;
    }

    label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        transition: .3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.2);
    }

    textarea {
        resize: none;
    }

    .btn-update {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        padding: 12px 26px;
        border-radius: 14px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0,0,0,.2);
    }

    .btn-back {
        background: #e5e7eb;
        color: #374151;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }
</style>

<div class="row justify-content-center fade-up">
    <div class="col-lg-10 col-xl-9">

        <div class="form-card">
            <!-- HEADER -->
            <div class="form-header">
                <h4>
                    <i class="bi bi-pencil-square"></i> Edit Data Siswa
                </h4>
                <small class="opacity-75">
                    Perbarui informasi siswa dengan benar
                </small>
            </div>

            <!-- BODY -->
            <div class="p-4 p-md-5">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ROW 1 -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control"
                                value="{{ old('nis', $siswa->nis) }}"
                                placeholder="Nomor Induk Siswa" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ old('nama', $siswa->nama) }}"
                                placeholder="Nama siswa" required>
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Kelas</label>
                            <select name="kelas_id" class="form-select" required>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}"
                                    {{ $k->id == old('kelas_id', $siswa->kelas_id) ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }} - {{ $k->jurusan }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>SPP Tahun</label>
                            <select name="spp_id" class="form-select" required>
                                @foreach($spp as $s)
                                <option value="{{ $s->id }}"
                                    {{ $s->id == old('spp_id', $siswa->spp_id) ? 'selected' : '' }}>
                                    {{ $s->tahun }} — Rp {{ number_format($s->nominal,0,',','.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control"
                                value="{{ old('no_telp', $siswa->no_telp) }}"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control"
                                placeholder="Alamat lengkap siswa">{{ old('alamat', $siswa->alamat) }}</textarea>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('siswa.index') }}" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-update text-white">
                            <i class="bi bi-check-circle"></i> Update Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
