@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    /* Animation */
    .fade-up {
        animation: fadeUp .6s ease forwards;
        opacity: 0;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Card */
    .form-card {
        background: #fff;
        border-radius: 26px;
        border: none;
        box-shadow: 0 20px 45px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #2563eb, #0ea5e9);
        color: #fff;
        padding: 28px;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 700;
    }

    /* Inputs */
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
        box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #374151;
    }

    /* Info box */
    .info-box {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        border-radius: 16px;
        padding: 14px 18px;
        box-shadow: 0 10px 25px rgba(0,0,0,.15);
    }

    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, #2563eb, #0ea5e9);
        border: none;
        padding: 12px 22px;
        border-radius: 14px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0,0,0,.2);
    }

    .btn-back {
        background: #e5e7eb;
        color: #374151;
        border-radius: 14px;
        padding: 12px 20px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }
</style>

<div class="row justify-content-center fade-up">
    <div class="col-lg-9 col-xl-8">

        <div class="form-card">
            <!-- HEADER -->
            <div class="form-header">
                <h4>
                    <i class="bi bi-credit-card-2-front"></i> Input Pembayaran SPP
                </h4>
                <small class="opacity-75">Form pembayaran resmi siswa</small>
            </div>

            <!-- BODY -->
            <div class="p-4 p-md-5">
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf

                    <!-- SISWA -->
                    <div class="mb-4">
                        <label>Siswa</label>
                        <select name="siswa_id" id="siswa_id"
                            class="form-select @error('siswa_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                            <option value="{{ $s->id }}"
                                data-nominal="{{ $s->spp->nominal }}"
                                {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})
                            </option>
                            @endforeach
                        </select>
                        @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ROW -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar"
                                class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                            @error('tanggal_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Bulan Dibayar</label>
                            <select name="bulan_dibayar"
                                class="form-select @error('bulan_dibayar') is-invalid @enderror" required>
                                <option value="">-- Pilih Bulan --</option>
                                @foreach($bulan as $b)
                                <option value="{{ $b }}" {{ old('bulan_dibayar') == $b ? 'selected' : '' }}>
                                    {{ $b }}
                                </option>
                                @endforeach
                            </select>
                            @error('bulan_dibayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- ROW -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Tahun Dibayar</label>
                            <input type="number" name="tahun_dibayar"
                                class="form-control @error('tahun_dibayar') is-invalid @enderror"
                                value="{{ old('tahun_dibayar', date('Y')) }}" required>
                            @error('tahun_dibayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Jumlah Bayar (Rp)</label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar"
                                class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                placeholder="Otomatis sesuai SPP" required>
                            @error('jumlah_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- INFO -->
                    <div class="info-box mb-4">
                        <i class="bi bi-person-badge"></i>
                        Petugas: <strong>{{ auth()->user()->name }}</strong>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-primary-custom text-white">
                            <i class="bi bi-save"></i> Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('siswa_id').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    document.getElementById('jumlah_bayar').value = opt.getAttribute('data-nominal') || '';
});

window.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('siswa_id').value) {
        document.getElementById('siswa_id').dispatchEvent(new Event('change'));
    }
});
</script>

@endsection
