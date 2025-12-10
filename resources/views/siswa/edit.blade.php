@extends('layouts.app')

@section('content')
<h4><i class="bi bi-pencil"></i> Edit Siswa</h4>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('siswa.update', $siswa) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ old('nis', $siswa->nis) }}" required>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $siswa->nama) }}" required>
            </div>

            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ $k->id == old('kelas_id', $siswa->kelas_id) ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} - {{ $k->jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>SPP Tahun</label>
                <select name="spp_id" class="form-select" required>
                    @foreach($spp as $s)
                        <option value="{{ $s->id }}" {{ $s->id == old('spp_id', $siswa->spp_id) ? 'selected' : '' }}>
                            {{ $s->tahun }} (Rp {{ number_format($s->nominal, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $siswa->no_telp) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection