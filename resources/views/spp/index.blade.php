@extends('layouts.app')

@section('content')
<h4><i class="bi bi-cash-stack"></i> Data SPP</h4>

<div class="card mt-4">
    <div class="card-header">
        <a href="{{ route('spp.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah SPP
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spp as $s)
                <tr>
                    <td>{{ $s->tahun }}</td>
                    <td>Rp {{ number_format($s->nominal, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('spp.edit', $s) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('spp.destroy', $s) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection