@extends('layouts.app')
@section('title','Data Absensi Mahasiswa')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0 fw-semibold">
                <i class="bi bi-calendar-check-fill me-2"></i>Data Absensi Mahasiswa
            </h4>
            <a href="{{ route('attendances.create') }}" class="btn btn-light text-primary fw-semibold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i>Tambah Absensi
            </a>
        </div>

        <div class="card-body bg-light">
            {{-- Pencarian --}}
            <form method="GET" action="{{ route('attendances.index') }}" class="mb-4">
                <div class="input-group shadow-sm" style="max-width: 400px;">
                    <input name="q" class="form-control border-0 rounded-start-pill" placeholder="Cari nama mahasiswa..." value="{{ $q ?? '' }}">
                    <button class="btn btn-primary rounded-end-pill px-4">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Tabel Data --}}
            <div class="table-responsive rounded-3 shadow-sm">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $absen)
                        <tr>
                            <td>{{ $loop->iteration + ($attendances->currentPage()-1)*$attendances->perPage() }}</td>
                            <td class="fw-semibold">{{ $absen->student->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>
                                @switch($absen->status)
                                @case('Hadir')
                                <span class="badge bg-success px-3 py-2">Hadir</span>
                                @break
                                @case('Izin')
                                <span class="badge bg-warning text-dark px-3 py-2">Izin</span>
                                @break
                                @case('Sakit')
                                <span class="badge bg-info text-dark px-3 py-2">Sakit</span>
                                @break
                                @default
                                <span class="badge bg-danger px-3 py-2">Alpha</span>
                                @endswitch
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($absen->keterangan ?? '-', 30, '...') }}</td>
                            <td>
                                <a href="{{ route('attendances.edit', $absen->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('attendances.destroy', $absen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-emoji-frown"></i> Belum ada data absensi ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($attendances->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="text-muted small mb-2 mb-md-0">
                    Menampilkan <strong>{{ $attendances->firstItem() }}</strong>–<strong>{{ $attendances->lastItem() }}</strong>
                    dari <strong>{{ $attendances->total() }}</strong> data
                </div>
                <div class="pagination-box">
                    @if ($attendances->onFirstPage())
                    <span class="btn btn-outline-secondary btn-sm disabled"><i class="bi bi-chevron-left"></i></span>
                    @else
                    <a href="{{ $attendances->previousPageUrl() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-left"></i></a>
                    @endif

                    <span class="btn btn-primary btn-sm mx-1 disabled">{{ $attendances->currentPage() }}</span>

                    @if ($attendances->hasMorePages())
                    <a href="{{ $attendances->nextPageUrl() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-right"></i></a>
                    @else
                    <span class="btn btn-outline-secondary btn-sm disabled"><i class="bi bi-chevron-right"></i></span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #e8f0ff, #ffffff);
        font-family: 'Poppins', sans-serif;
    }

    .table thead {
        background: #007bff;
    }

    .table tbody tr:hover {
        background-color: #f1f7ff;
        transition: 0.2s;
    }

    .badge {
        font-size: 0.85rem;
        border-radius: 12px;
    }

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    .pagination-box {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pagination-box .btn {
        border-radius: 8px;
        padding: 5px 10px;
        min-width: 38px;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        h4 {
            font-size: 1rem;
        }

        .btn {
            font-size: 0.85rem;
        }
    }
</style>

@endsection