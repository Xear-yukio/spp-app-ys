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
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 24px;
        padding: 30px;
        color: #fff;
        box-shadow: 0 20px 40px rgba(37,99,235,.35);
        margin-bottom: 30px;
    }

    /* ===== INFO CARD ===== */
    .info-card {
        background: rgba(255,255,255,.95);
        border-radius: 24px;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,.08);
        padding: 26px;
    }

    .info-row td {
        padding: 10px 0;
        font-size: 15px;
    }

    .info-label {
        color: #64748b;
        font-weight: 600;
        width: 160px;
    }

    /* ===== STAT CARD ===== */
    .stat-card {
        border-radius: 24px;
        padding: 28px;
        color: white;
        transition: .35s ease;
        box-shadow: 0 15px 35px rgba(0,0,0,.15);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 45px rgba(0,0,0,.25);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
    }

    .stat-icon {
        font-size: 3.8rem;
        opacity: .25;
    }

    /* ===== TABLE CARD ===== */
    .table-card {
        background: #fff;
        border-radius: 24px;
        border: none;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,.08);
    }

    .table-card .card-header {
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
        background: #eff6ff;
        transform: scale(1.01);
        box-shadow: inset 0 0 0 9999px rgba(37,99,235,.05);
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

    /* ===== ALERT ===== */
    .alert-modern {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        border-radius: 18px;
        padding: 20px;
    }
</style>

<!-- ===== HEADER ===== -->
<div class="dashboard-header fade-up">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-person-circle"></i> Dashboard Siswa
    </h3>
    <small class="opacity-75">
        Informasi & Riwayat Pembayaran SPP
    </small>
</div>

@if($siswa)

<!-- ===== INFO & STAT ===== -->
<div class="row g-4 mb-4">
    <div class="col-lg-8 fade-up" style="animation-delay:.1s">
        <div class="info-card h-100">
            <h5 class="fw-bold mb-4">
                <i class="bi bi-card-list"></i> Informasi Siswa
            </h5>

            <table class="table table-borderless mb-0">
                <tr class="info-row">
                    <td class="info-label">NIS</td>
                    <td>{{ $siswa->nis }}</td>
                </tr>
                <tr class="info-row">
                    <td class="info-label">Nama</td>
                    <td class="fw-semibold">{{ $siswa->nama }}</td>
                </tr>
                <tr class="info-row">
                    <td class="info-label">Kelas</td>
                    <td>{{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->jurusan }}</td>
                </tr>
                <tr class="info-row">
                    <td class="info-label">SPP / Bulan</td>
                    <td class="fw-bold text-primary">
                        Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-lg-4 fade-up" style="animation-delay:.2s">
        <div class="stat-card bg-gradient-success text-center">
            <i class="bi bi-cash-stack stat-icon"></i>
            <h6 class="mt-3 opacity-75">Total Pembayaran</h6>
            <h2 class="fw-bold mt-2">
                Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </h2>
            <small>{{ $pembayaran->count() }} Transaksi</small>
        </div>
    </div>
</div>

<!-- ===== TABLE ===== -->
<div class="card table-card fade-up" style="animation-delay:.3s">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-receipt"></i> Riwayat Pembayaran SPP
        </h5>
        <span class="badge-soft">{{ $pembayaran->count() }} Data</span>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table modern-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->bulan_dibayar }}</td>
                        <td>{{ $p->tahun_dibayar }}</td>
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

@else

<div class="alert alert-modern fade-up">
    <i class="bi bi-exclamation-triangle"></i>
    Data siswa dengan NIS <strong>{{ auth()->user()->username }}</strong> tidak ditemukan.
    Silakan hubungi admin.
</div>

@endif

@endsection
