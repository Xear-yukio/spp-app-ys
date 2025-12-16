@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    /* Animation */
    .fade-up {
        animation: fadeUp .6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Card */
    .card-modern {
        border-radius: 22px;
        border: none;
        background: #fff;
        box-shadow: 0 18px 40px rgba(0,0,0,.1);
        overflow: hidden;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .page-header h2 {
        font-weight: 700;
        color: #111827;
    }

    /* Button */
    .btn-add {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,210,255,.35);
    }

    /* Table */
    .table-modern thead {
        background: #f3f4f6;
        font-size: 13px;
        text-transform: uppercase;
        color: #374151;
    }

    .table-modern th {
        padding: 14px 16px;
        border-bottom: 2px solid #e5e7eb;
    }

    .table-modern td {
        padding: 16px;
        border-bottom: 1px solid #f1f1f1;
        color: #4b5563;
        vertical-align: middle;
    }

    .table-modern tbody tr {
        transition: .25s;
    }

    .table-modern tbody tr:hover {
        background: #f0fdfa;
        transform: scale(1.01);
    }

    /* Action buttons */
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: .25s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #facc15;
        color: #fff;
    }

    .btn-edit:hover {
        background: #eab308;
    }

    .btn-delete {
        background: #ef4444;
        color: #fff;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* Empty */
    .empty-state {
        padding: 60px 0;
        color: #9ca3af;
    }
</style>

<!-- HEADER -->
<div class="page-header fade-up">
    <h2>
        <i class="bi bi-cash-stack me-1"></i> Data SPP
    </h2>

    <a href="{{ route('spp.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle"></i> Tambah SPP
    </a>
</div>

<!-- CARD -->
<div class="card-modern fade-up">
    <div class="table-responsive">
        <table class="table table-modern mb-0 align-middle">
            <thead>
                <tr>
                    <th width="120">Tahun</th>
                    <th>Nominal</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($spp as $s)
                <tr>
                    <td class="fw-semibold">{{ $s->tahun }}</td>
                    <td>Rp {{ number_format($s->nominal, 0, ',', '.') }}</td>

                    <td class="text-center">
                        <a href="{{ route('spp.edit', $s) }}"
                           class="btn-action btn-edit me-1"
                           title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form action="{{ route('spp.destroy', $s) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data SPP ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn-action btn-delete"
                                    title="Hapus">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="3" class="text-center empty-state">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Belum ada data SPP
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
