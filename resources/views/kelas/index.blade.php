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

    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        border-radius: 26px;
        padding: 30px;
        color: white;
        box-shadow: 0 20px 45px rgba(37,99,235,.35);
        margin-bottom: 30px;
    }

    /* ===== CARD ===== */
    .table-card {
        background: rgba(255,255,255,.97);
        border-radius: 26px;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,.08);
        overflow: hidden;
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

    /* ===== ACTION BUTTON ===== */
    .btn-circle {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: .3s;
        color: #fff;
    }

    .btn-circle:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,.2);
    }

    .btn-edit {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    /* ===== ADD BUTTON ===== */
    .btn-add {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50px;
        padding: 12px 22px;
        color: white;
        font-weight: 600;
        border: none;
        transition: .3s;
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(34,197,94,.45);
        color: #fff;
    }
</style>

<!-- ===== HEADER ===== -->
<div class="page-header fade-up">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-door-open"></i> Data Kelas
            </h3>
            <small class="opacity-75">
                Manajemen kelas & jurusan sekolah
            </small>
        </div>

        <a href="{{ route('kelas.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Kelas
        </a>
    </div>
</div>

<!-- ===== TABLE ===== -->
<div class="card table-card fade-up" style="animation-delay:.1s">
    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table modern-table align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Nama Kelas</th>
                        <th>Jurusan</th>
                        <th width="130" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kelas as $i => $k)
                    <tr>
                        <td class="fw-semibold">{{ $i + 1 }}</td>
                        <td class="fw-bold">{{ $k->nama_kelas }}</td>
                        <td>{{ $k->jurusan }}</td>

                        <td class="text-center">
                            <a href="{{ route('kelas.edit', $k->id) }}"
                               class="btn-circle btn-edit me-2">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('kelas.destroy', $k->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-circle btn-delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data kelas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
