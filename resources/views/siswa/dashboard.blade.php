@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    /* ===== HEADER ===== */
    .dashboard-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 18px;
        padding: 26px;
        margin-bottom: 28px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
    }

    /* ===== CARD ===== */
    .glass-card {
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    .glass-card .card-header {
        background: transparent;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        padding: 16px 22px;
    }

    .glass-card .card-body {
        padding: 20px;
    }

    /* ===== BADGE ===== */
    .badge-tagihan {
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
        color: white;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
    }

    .badge-history {
        background: #eef3ff;
        color: #3b5bfd;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
    }

    /* ===== BUTTON ===== */
    .btn-pay {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        border: none;
        color: white;
        border-radius: 50px;
        padding: 6px 18px;
        font-size: 13px;
        transition: .3s;
    }

    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,114,255,.4);
        color: #fff;
    }

    /* ===== TABLE ===== */
    table thead {
        font-size: 12px;
        text-transform: uppercase;
        color: #6c757d;
    }

    table tbody tr:hover {
        background: #f1f5ff;
    }
</style>

<!-- ===== HEADER ===== -->
<div class="dashboard-header">
    <h4 class="mb-1">👋 Halo, {{ auth()->user()->name }}</h4>
    <small>Dashboard Pembayaran SPP Siswa</small>
</div>

<div class="row g-4">

    <!-- ===== TAGIHAN BELUM DIBAYAR ===== -->
    <div class="col-lg-6">
        <div class="card glass-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>💳 Tagihan Belum Dibayar</span>
                <span class="badge-tagihan">{{ count($tagihan) }} Tagihan</span>
            </div>

            <div class="card-body p-0">
                <table class="table table-borderless mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Bulan / Tahun</th>
                            <th>Nominal</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $t)
                        <tr>
                            <td>
                                <strong>{{ $t['bulan'] }}</strong>
                                <div class="text-muted small">{{ $t['tahun'] }}</div>
                            </td>
                            <td>
                                Rp {{ number_format($t['nominal'], 0, ',', '.') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('pembayaran.create', [
                                    'siswa_id' => $siswa->id,
                                    'bulan' => $t['bulan'],
                                    'tahun' => $t['tahun']
                                ]) }}" class="btn btn-pay">
                                    <i class="bi bi-credit-card"></i> Bayar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                🎉 Semua tagihan sudah lunas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===== HISTORI PEMBAYARAN ===== -->
    <div class="col-lg-6">
        <div class="card glass-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>🕒 Histori Pembayaran</span>
                <span class="badge-history">{{ count($histori) }} Transaksi</span>
            </div>

            <div class="card-body p-0">
                <table class="table table-borderless mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histori as $h)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($h->tanggal_bayar)) }}</td>
                            <td>{{ $h->bulan_dibayar }} {{ $h->tahun_dibayar }}</td>
                            <td>
                                Rp {{ number_format($h->jumlah_bayar, 0, ',', '.') }}
                            </td>
                            <td>{{ $h->petugas->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada pembayaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
