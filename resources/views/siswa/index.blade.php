@extends('layouts.app')

@section('content')
<h4><i class="bi bi-people"></i> Daftar Siswa</h4>

<div class="card mt-4">
    <div class="card-header">
        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Siswa
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $s)
                <tr>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas->nama_kelas }} - {{ $s->kelas->jurusan }}</td>
                    <td class="text-center">
                        <a href="{{ route('siswa.show', $s) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('siswa.edit', $s) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('siswa.destroy', $s) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection