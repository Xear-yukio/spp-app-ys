@extends('layouts.app')

@section('content')

{{-- ANIMASI CUSTOM --}}
<style>
    /* Fade-in untuk card */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Row animasi saat hover */
    .table-hover tbody tr:hover {
        transform: scale(1.01);
        transition: 0.2s ease;
        background-color: #f3f8ff !important;
    }

    /* Smooth button hover */
    .btn {
        transition: 0.2s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in">
    <h2 class="fw-bold">
        <i class="bi bi-people"></i> Daftar Siswa
    </h2>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle"></i> Tambah Siswa
    </a>
</div>

<div class="card shadow-sm border-0 fade-in" style="animation-delay: .1s;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                    <tr style="transition: all .2s;">
                        <td class="fw-semibold">{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $s->kelas->nama_kelas }}
                            </span>
                            <span class="badge bg-secondary">
                                {{ $s->kelas->jurusan }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('siswa.show', $s) }}" 
                               class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('siswa.edit', $s) }}" 
                               class="btn btn-sm btn-warning text-dark">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('siswa.destroy', $s) }}" 
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data siswa ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block"></i>
                            Belum ada data siswa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
