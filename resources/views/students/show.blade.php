@extends('layouts.app')
@section('title','Detail Mahasiswa')
@section('content')

<div class="container mt-2" style="max-width: 1200px;">
    <div class="row g-4">

        {{-- Profil Mahasiswa --}}
        <div class="col-lg-4 col-md-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body text-center p-4">
                    <div class="position-relative mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->nama) }}&background=0d6efd&color=fff&size=120"
                            alt="Avatar" class="rounded-circle shadow-sm border border-3 border-light">
                    </div>
                    <h5 class="fw-bold text-primary mb-1">{{ $student->nama }}</h5>
                    <p class="text-muted small mb-3">{{ $student->nim }}</p>

                    <div class="list-group list-group-flush mb-3 text-start shadow-sm rounded-3 overflow-hidden">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-envelope text-primary me-2"></i>
                            <span><strong>Email:</strong> {{ $student->email ?? '-' }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-journal-bookmark text-primary me-2"></i>
                            <span><strong>Jurusan:</strong> {{ $student->jurusan }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-calendar3 text-primary me-2"></i>
                            <span><strong>Tahun Masuk:</strong> {{ $student->tahun_masuk }}</span>
                        </div>
                    </div>

                    <div class="d-grid gap-1">
                        <a href="{{ route('attendances.create', ['student_id' => $student->id]) }}"
                            class="btn btn-success fw-semibold shadow-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Absensi
                        </a>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary fw-semibold shadow-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Absensi --}}
        <div class="col-lg-8 col-md-7">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient bg-primary text-white rounded-top-4 fw-semibold d-flex align-items-center">
                    <i class="bi bi-clipboard-check me-2"></i> Absensi {{ $student->nama }}
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $a)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration + ($attendances->currentPage()-1)*$attendances->perPage() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        @if($a->status == 'Hadir')
                                        <span class="badge bg-success px-3 py-2">Hadir</span>
                                        @elseif($a->status == 'Izin')
                                        <span class="badge bg-warning text-dark px-3 py-2">Izin</span>
                                        @elseif($a->status == 'Sakit')
                                        <span class="badge bg-info text-dark px-3 py-2">Sakit</span>
                                        @else
                                        <span class="badge bg-danger px-3 py-2">Alpha</span>
                                        @endif
                                    </td>
                                    <td>{{ $a->keterangan ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('attendances.edit', $a) }}" class="btn btn-sm btn-outline-primary me-1 shadow-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('attendances.destroy', $a) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus absensi?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger shadow-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-emoji-frown"></i> Belum ada data absensi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($attendances->hasPages())
                    <div class="d-flex justify-content-between align-items-center px-3 py-3">
                        <small class="text-muted">
                            Menampilkan <strong>{{ $attendances->firstItem() }}</strong>–<strong>{{ $attendances->lastItem() }}</strong>
                            dari <strong>{{ $attendances->total() }}</strong> data
                        </small>
                        <div>
                            {{ $attendances->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0 20px rgba(13, 110, 253, 0.15);
    }

    .list-group-item {
        font-size: 0.9rem;
        border: none;
        border-bottom: 1px solid #f0f0f0;
        background-color: #fff;
        transition: background 0.2s ease;
    }

    .list-group-item:hover {
        background-color: #f8faff;
    }

    .table-hover tbody tr:hover {
        background-color: #f9fbff;
        transition: background 0.2s ease;
    }

    .card-header {
        font-size: 1rem;
        border: none;
    }

    .pagination .page-item .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        background-color: #fff;
        font-size: 0.875rem;
        padding: 5px 10px;
        transition: all 0.2s;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 6px rgba(13, 110, 253, 0.4);
    }

    .pagination .page-item .page-link:hover {
        background-color: #e9f0ff;
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection