@extends('layouts.app')

@section('content')

<style>
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Inter', system-ui, sans-serif;
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
}

/* ===== FLEX LAYOUT ===== */
.dashboard-grid {
    display: flex;
    gap: 28px;
    min-height: 100vh;
    padding: 24px;
    box-sizing: border-box;
}

@media(max-width: 992px) {
    .dashboard-grid {
        flex-direction: column;
    }
}

/* ===== GLASS CARD ===== */
.glass {
    background: rgba(255,255,255,.88);
    backdrop-filter: blur(14px);
    border-radius: 26px;
    box-shadow: 0 30px 70px rgba(0,0,0,.08);
}

/* ===== SUMMARY PANEL (SIDEBAR) ===== */
.summary-panel {
    width: 320px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    flex-shrink: 0;
    padding: 24px;
}

/* Judul sidebar */
.summary-title {
    font-weight: 700;
    font-size: 20px;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

/* Card modern */
.summary-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 20px;
    padding: 20px 24px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

/* Icon kiri */
.summary-card i {
    font-size: 36px;
    opacity: 0.3;
}

/* Text kanan */
.summary-card-content {
    display: flex;
    flex-direction: column;
    text-align: right;
}

.summary-card-content small {
    font-size: 13px;
    opacity: 0.8;
}

.summary-card-content h2,
.summary-card-content h4 {
    margin: 0;
    font-weight: 700;
}

/* Warna card */
.bg-blue { background: linear-gradient(135deg, #2563eb, #38bdf8); }
.bg-green { background: linear-gradient(135deg, #16a34a, #4ade80); }
.bg-purple { background: linear-gradient(135deg, #7c3aed, #818cf8); }

/* ===== MAIN PANEL ===== */
.main-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 26px;
    min-height: 0;
}

.main-header {
    padding: 34px;
    color: #fff;
    border-radius: 30px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    box-shadow: 0 35px 80px rgba(99,102,241,.45);
}

.main-header h3 { font-weight: 800; margin-bottom: 8px; }
.main-header small { opacity: .85; }

/* ===== TABLE CARD ===== */
.table-card {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.table-card-header {
    padding: 22px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

.table-card-header h6 { font-weight: 700; color: #1e293b; }

.table-responsive {
    flex: 1;
    overflow-y: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

thead th {
    padding: 12px 16px;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: #64748b;
    border-bottom: 2px solid #e5e7eb;
    background: #f8fafc;
    position: sticky;
    top: 0;
    z-index: 1;
}

tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
}

tbody tr:hover {
    background: #f0f9ff;
    transform: scale(1.01);
    transition: 0.2s;
}

.badge-soft {
    background: #eef2ff;
    color: #4f46e5;
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
}

.badge-status-paid { background: #16a34a; color: #fff; }
.badge-status-unpaid { background: #f59e0b; color: #fff; }

.empty-state {
    padding: 60px;
    color: #94a3b8;
    font-size: 15px;
    text-align: center;
}

</style>

<div class="dashboard-grid">

    <!-- ===== SUMMARY PANEL ===== -->
    <div class="glass summary-panel">
        <div class="summary-title">
            <i class="bi bi-bar-chart"></i> Ringkasan
        </div>

        <div class="summary-card bg-blue">
            <i class="bi bi-people-fill"></i>
            <div class="summary-card-content">
                <small>Total Siswa</small>
                <h2>{{ $totalSiswa }}</h2>
            </div>
        </div>

        <div class="summary-card bg-green">
            <i class="bi bi-cash-stack"></i>
            <div class="summary-card-content">
                <small>Pembayaran Bulan Ini</small>
                <h4>Rp {{ number_format($pembayaranBulanIni,0,',','.') }}</h4>
            </div>
        </div>

        <div class="summary-card bg-purple">
            <i class="bi bi-wallet2"></i>
            <div class="summary-card-content">
                <small>Total Pembayaran</small>
                <h4>Rp {{ number_format($totalPembayaran,0,',','.') }}</h4>
            </div>
        </div>
    </div>

    <!-- ===== MAIN PANEL ===== -->
    <div class="main-panel">

        <div class="main-header">
            <h3><i class="bi bi-speedometer2"></i> Dashboard</h3>
            <small>{{ ucfirst(auth()->user()->level) }} Panel · Sistem Pembayaran SPP</small>
        </div>

        <div class="glass table-card">
            <div class="table-card-header">
                <h6><i class="bi bi-clock-history"></i> Pembayaran Terbaru</h6>
                <span class="badge-soft">{{ count($pembayaranTerakhir) }} Data</span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
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
                            <td class="fw-bold text-primary">Rp {{ number_format($p->jumlah_bayar,0,',','.') }}</td>
                            <td>
                                @if($p->status_bayar == 'Lunas')
                                    <span class="badge-status-paid">Lunas</span>
                                @else
                                    <span class="badge-status-unpaid">Belum Lunas</span>
                                @endif
                            </td>
                            <td>{{ $p->petugas->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty-state">📭 Belum ada data pembayaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
