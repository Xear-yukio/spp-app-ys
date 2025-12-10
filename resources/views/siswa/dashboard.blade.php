@extends('layouts.app')

@section('content')
<h4><i class="bi bi-person"></i> Halo, {{ auth()->user()->name }} (Siswa)</h4>

<!-- ===== TAGIHAN BELUM DIBAYAR ===== -->
<div class="card border-danger mb-4">
    <div class="card-header bg-danger text-white">
        <i class="bi bi-wallet2"></i> Tagihan Belum Dibayar
    </div>
    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Bulan / Tahun</th>
                    <th>Nominal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tagihan as $t)
                <tr>
                    <td>{{ $t['bulan'] }} {{ $t['tahun'] }}</td>
                    <td>Rp {{ number_format($t['nominal'], 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('pembayaran.create', ['siswa_id' => $siswa->id, 'bulan' => $t['bulan'], 'tahun' => $t['tahun']]) }}"
                    >
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Semua tagihan sudah lunas 🎉</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ===== HISTORI PEMBAYARAN ===== -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0"><i class="bi bi-clock-history"></i> Histori Pembayaran</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Bulan / Tahun</th>
                    <th>Jumlah</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histori as $h)
                <tr>
                    <td>{{ date('d/m/Y', strtotime($h->tanggal_bayar)) }}</td>
                    <td>{{ $h->bulan_dibayar }} {{ $h->tahun_dibayar }}</td>
                    <td>Rp {{ number_format($h->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ $h->petugas->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection