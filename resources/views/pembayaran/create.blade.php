@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Input Pembayaran SPP
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Siswa <span class="text-danger">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                            <option value="{{ $s->id }}" 
                                    data-nominal="{{ $s->spp->nominal }}"
                                    {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})
                            </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Bayar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" 
                                   value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                            @error('tanggal_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bulan Dibayar <span class="text-danger">*</span></label>
                            <select name="bulan_dibayar" class="form-select @error('bulan_dibayar') is-invalid @enderror" required>
                                <option value="">-- Pilih Bulan --</option>
                                @foreach($bulan as $b)
                                <option value="{{ $b }}" {{ old('bulan_dibayar') == $b ? 'selected' : '' }}>
                                    {{ $b }}
                                </option>
                                @endforeach
                            </select>
                            @error('bulan_dibayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Dibayar <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_dibayar" class="form-control @error('tahun_dibayar') is-invalid @enderror" 
                                   value="{{ old('tahun_dibayar', date('Y')) }}" required>
                            @error('tahun_dibayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Bayar (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" 
                                   class="form-control @error('jumlah_bayar') is-invalid @enderror" 
                                   value="{{ old('jumlah_bayar') }}" placeholder="Nominal akan otomatis terisi" required>
                            @error('jumlah_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> 
                        <strong>Petugas:</strong> {{ auth()->user()->name }}
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Pembayaran
                        </button>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('siswa_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const nominal = selectedOption.getAttribute('data-nominal');
    document.getElementById('jumlah_bayar').value = nominal || '';
});

// Auto-fill jika sudah ada old value
window.addEventListener('DOMContentLoaded', function() {
    const siswaSelect = document.getElementById('siswa_id');
    if (siswaSelect.value) {
        const event = new Event('change');
        siswaSelect.dispatchEvent(event);
    }
});
</script>
@endsection