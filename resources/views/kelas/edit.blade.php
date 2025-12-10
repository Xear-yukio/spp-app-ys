@extends('layouts.app')

@section('content')
<h4><i class="bi bi-pencil"></i> Edit Kelas</h4>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('kelas.update', $kela) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kela->nama_kelas) }}" required>
            </div>

            <div class="mb-3">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $kela->jurusan) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection