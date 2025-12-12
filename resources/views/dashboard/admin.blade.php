@extends('layouts.app')

@section('content')

<style>
    /* Animasi fade */
    .fade-in {
        animation: fadeIn 0.7s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* CARD STATISTIK MODERN */
    .stat-card {
        border-radius: 22px;
        padding: 28px;
        color: white;
        transition: 0.3s;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background-size: 180%;
        background-position: right;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        background-position: left;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .stat-icon {
        font-size: 3.5rem;
        opacity: 0.30;
    }

    /* Warna gradient */
    .bg-gradient-blue {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    }

    .bg-gradient-green {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .bg-gradient-purple {
        background: linear-gradient(135deg, #8e2de2, #4a00e0);
    }

    /* Modern Card Table */
    .modern-card {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .modern-card .card-header {
        background: #ffffff;
        padding: 22px;
        border-bottom: 1px solid #e9ecef;
    }

    /* Modern Table */
    .modern-table thead {
        background: #f3f4f6;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .modern-table thead th {
        padding: 14px;
        border-bottom: 2px solid #e5e7eb;
        color: #374151;
    }

    .modern-table tbody td {
        padding: 14px 16px;
        font-size: 14px;
        color: #4b5563;
        border-bottom: 1px solid #f1f1f1;
    }

    .modern-table tbody tr {
        transition: 0.25s ease;
    }

    .modern-table tbody tr:hover {
        background: #f0fdf4;
        box-shadow: inset 0 0 0 9999px rgba(16, 185, 129, 0.07);
        transform: scale(1.01);
    }
</style>


<h2 class="mb-4 fw-bold fade-in">
    <i class="bi bi-speedometer2"></i> Dashboard
    <small class="text-muted">| {{ ucfirst(auth()->user()->level) }}</small>
</h2>


{{-- STATISTIK CARD --}}
<div class="row g-4 mb-4 fade-in">

    <div class="col-md-4">
        <div class="stat-card bg-gradient-blue">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 opacity-75">Total Siswa</h6>
                    <h1 class="mt-2 fw-bold">{{ $totalSiswa }}</h1>
                </div>
                <i class="bi bi-people stat-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card bg-gradient-green">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 opacity-75">Total Pembayaran</h6>
                    <h2 class="mt-2 fw-bold">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h2>
                </div>
                <i class="bi bi-cash-stack stat-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 opacity-75">Pembayaran Bulan Ini</h6>
                    <h2 class="mt-2 fw-bold">Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}</h2>
                </div>
                <i class="bi bi-calendar-check stat-icon"></i>
            </div>
        </div>
    </div>

</div>


{{-- TABLE --}}
<div class="card modern-card fade-in">
    <div class="card-header">
        <h5 class="card-title fw-bold mb-0">
            <i class="bi bi-clock-history"></i> Pembayaran Terbaru
        </h5>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table modern-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Bulan/Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pembayaranTerakhir as $p)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</td>
                        <td class="fw-semibold">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $p->petugas->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada pembayaran 📭</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
