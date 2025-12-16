@extends('layouts.app')

@section('content')

<style>
    /* Fade animation */
    .fade-in {
        animation: fadeIn .6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Modern card */
    .modern-card {
        border-radius: 18px;
        border: none;
        background: white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .modern-card .card-header {
        background: white;
        border-bottom: none;
        padding: 18px 20px;
        border-radius: 18px 18px 0 0;
    }

    /* Modern button */
    .btn-primary-custom {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        border: none;
        padding: 9px 16px;
        border-radius: 10px;
        transition: .3s;
    }

    .btn-primary-custom:hover {
        background-position: right;
        transform: translateY(-2px);
    }

    /* Action buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        transition: .25s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-delete { background: #ef4444; color: white; }
    .btn-delete:hover { background: #dc2626; }

    /* Modern Table */
    .modern-table thead {
        background: #f3f4f6;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .modern-table thead th {
        padding: 13px;
        border-bottom: 2px solid #e5e7eb;
    }

    .modern-table tbody td {
        padding: 14px 16px;
        color: #4b5563;
        border-bottom: 1px solid #f1f1f1;
    }

    .modern-table tbody tr:hover {
        background: #eefdfc !important;
        transition: .25s;
        transform: scale(1.01);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in">
    <h2 class="fw-bold">
        <i class="bi bi-receipt"></i> Data Pembayaran
    </h2>

    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary-custom text-white">
        <i class="bi bi-plus-circle"></i> Input Pembayaran
    </a>
</div>

<div class="card modern-card fade-in">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table modern-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Periode</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                        <th class="text-center" width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->siswa->nis }}</td>
                        <td class="fw-semibold">{{ $p->siswa->nama }}</td>
                        <td>{{ $p->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</td>
                        <td><strong>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</strong></td>
                        <td>{{ $p->petugas->name }}</td>

                        <td class="text-center">
                            <form action="{{ route('pembayaran.destroy', $p->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus pembayaran ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-action btn-delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Belum ada data pembayaran 📭
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
