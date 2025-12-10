@extends('layouts.app')

@section('content')
<h4><i class="bi bi-pencil"></i> Edit Data SPP</h4>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('spp.update', $spp) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $spp->tahun) }}" required min="2000" max="2100">
            </div>

            <div class="mb-3">
                <label>Nominal (Rp)</label>
                <input type="number" name="nominal" class="form-control" value="{{ old('nominal', $spp->nominal) }}" required min="0">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('spp.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection