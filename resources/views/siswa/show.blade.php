@extends('layouts.app')

@section('content')
<h4><i class="bi bi-person-lines-fill"></i> Detail Siswa</h4>

<div class="card mt-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <td width="150">NIS</td>
                <td>: {{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->jurusan }}</td>
            </tr>
            <tr>
                <td>SPP</td>
                <td>: Tahun {{ $siswa->spp->tahun }} (Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }})</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>: {{ $siswa->no_telp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $siswa->alamat ?? '-' }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection