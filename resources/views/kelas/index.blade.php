@extends('layouts.app')

@section('content')

<style>
    /* Animasi fade */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Modern Card */
    .modern-card {
        border-radius: 18px;
        border: none;
        background: #ffffff;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* Modern table */
    .modern-table thead {
        background: #f3f4f6;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .modern-table thead th {
        padding: 14px;
        border-bottom: 2px solid #e5e7eb;
    }

    .modern-table tbody td {
        padding: 14px 16px;
        color: #4b5563;
        border-bottom: 1px solid #f1f1f1;
    }

    .modern-table tbody tr {
        transition: 0.25s;
    }

    .modern-table tbody tr:hover {
        background: #eefdfc;
        transform: scale(1.01);
        box-shadow: inset 0 0 0 9999px rgba(0, 194, 203, 0.06);
    }

    /* Button aksi */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        transition: .2s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #facc15;
        color: white;
    }

    .btn-edit:hover {
        background: #eab308;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* Button Tambah */
    .btn-primary-custom {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        transition: .3s;
    }

    .btn-primary-custom:hover {
        background-position: right;
        transform: translateY(-2px);
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in">
    <h2 class="fw-bold"><i class="bi bi-door-open"></i> Data Kelas</h2>

    <a href="{{ route('kelas.create') }}" class="btn btn-primary-custom text-white">
        <i class="bi bi-plus-circle"></i> Tambah Kelas
    </a>
</div>

<div class="card modern-card fade-in">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Jurusan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $k->nama_kelas }}</td>
                        <td>{{ $k->jurusan }}</td>
                        <td>

                            {{-- Tombol edit --}}
                            <a href="{{ route('kelas.edit', $k->id) }}" 
                               class="btn-action btn-edit me-1">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            {{-- Tombol delete --}}
                            <form action="{{ route('kelas.destroy', $k->id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus kelas ini?')">
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
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data kelas 📭
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
