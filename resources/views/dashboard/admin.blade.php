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
    .dashboard-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 24px;
        padding: 30px;
        color: #fff;
        box-shadow: 0 20px 40px rgba(99,102,241,.35);
        margin-bottom: 30px;
    }

    /* ===== STAT CARD ===== */
    .stat-card {
        border-radius: 24px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: .35s ease;
        box-shadow: 0 15px 35px rgba(0,0,0,.15);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,.35), transparent 60%);
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,.25);
    }

    .stat-icon {
        font-size: 4rem;
        opacity: .25;
    }

    /* ===== GRADIENTS ===== */
    .bg-blue {
        background: linear-gradient(135deg, #3b82f6, #06b6d4);
    }

    .bg-green {
        background: linear-gradient(135deg, #22c55e, #16a34a);
    }

    .bg-purple {
        background: linear-gradient(135deg, #a855f7, #6366f1);
    }

    /* ===== CARD TABLE ===== */
    .modern-card {
        background: rgba(255,255,255,.95);
        border-radius: 24px;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .modern-card .card-header {
        background: transparent;
        padding: 22px 26px;
        border-bottom: 1px solid #eef2f7;
    }

    /* ===== TABLE ===== */
    .modern-table thead th {
        background: #f9fafb;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: .6px;
        color: #6b7280;
        padding: 16px;
        border-bottom: 2px solid #e5e7eb;
    }

    .modern-table tbody td {
        padding: 16px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .modern-table tbody tr {
        transition: .25s ease;
    }

    .modern-table tbody tr:hover {
        background: #f0f9ff;
        transform: scale(1.01);
        box-shadow: inset 0 0 0 9999px rgba(59,130,246,.06);
    }

    /* ===== BADGE ===== */
    .badge-soft {
        background: #eef2ff;
        color: #4f46e5;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<!-- ===== HEADER ===== -->
<div class="dashboard-header fade-up">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-speedometer2"></i> Dashboard
    </h3>
    <small class="opacity-75">
        {{ ucfirst(auth()->user()->level) }} Panel · Sistem Pembayaran SPP
    </small>
</div>

<!-- ===== STATISTIC ===== -->
<div class="row g-4 mb-4">
    <div class="col-lg-4 fade-up" style="animation-delay:.1s">
        <div class="stat-card bg-blue">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Total Siswa</small>
                    <h1 class="fw-bold mt-2">{{ $totalSiswa }}</h1>
                </div>
                <i class="bi bi-people stat-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 fade-up" style="animation-delay:.2s">
        <div class="stat-card bg-green">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Total Pembayaran</small>
                    <h2 class="fw-bold mt-2">
                        Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                    </h2>
                </div>
                <i class="bi bi-cash-stack stat-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 fade-up" style="animation-delay:.3s">
        <div class="stat-card bg-purple">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Pembayaran Bulan Ini</small>
                    <h2 class="fw-bold mt-2">
                        Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}
                    </h2>
                </div>
                <i class="bi bi-calendar-check stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<!-- ===== TABLE ===== -->
<div class="card modern-card fade-up" style="animation-delay:.4s">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-clock-history"></i> Pembayaran Terbaru
        </h5>
        <span class="badge-soft">{{ count($pembayaranTerakhir) }} Data</span>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table modern-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaranTerakhir as $p)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td class="fw-semibold">{{ $p->siswa->nama }}</td>
                        <td>{{ $p->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</td>
                        <td class="fw-bold text-primary">
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>
                        <td>{{ $p->petugas->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            📭 Belum ada pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
