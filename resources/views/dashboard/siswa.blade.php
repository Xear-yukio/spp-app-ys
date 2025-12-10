@extends('layouts.app')

@section('content')
<h2 class="mb-4">
    <i class="bi bi-person-circle"></i> Dashboard Siswa
</h2>

@if($siswa)
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Siswa</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="150">NIS</td>
                        <td>: {{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>: {{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->jurusan }}</td>
                    </tr>
                    <tr>
                        <td>SPP/Bulan</td>
                        <td>: Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h6>Total Pembayaran</h6>
                <h2>Rp {{ number_format($totalBayar, 0, ',', '.') }}</h2>
                <small>{{ $pembayaran->count() }} Transaksi</small>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">
            <i class="bi bi-receipt"></i> Riwayat Pembayaran SPP
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan Dibayar</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->bulan_dibayar }}</td>
                        <td>{{ $p->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $p->petugas->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle"></i> Data siswa dengan NIS <strong>{{ auth()->user()->username }}</strong> tidak ditemukan. 
    Silakan hubungi admin.
</div>
@endif
@endsection