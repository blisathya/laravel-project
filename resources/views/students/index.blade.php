@extends('layouts.app')
@section('title','Data Mahasiswa')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0 fw-semibold">
                <i class="bi bi-mortarboard-fill me-2"></i>Data Mahasiswa
            </h4>
            <a href="{{ route('students.create') }}" class="btn btn-light text-primary fw-semibold shadow-sm">
                <i class="bi bi-person-plus me-1"></i>Tambah Mahasiswa
            </a>
        </div>

        <div class="card-body bg-light">
            <form method="GET" action="{{ route('students.index') }}" class="mb-4">
                <div class="input-group shadow-sm" style="max-width: 400px;">
                    <input name="q" class="form-control border-0 rounded-start-pill" placeholder="Cari nama / NIM / jurusan..." value="{{ $q ?? '' }}">
                    <button class="btn btn-primary rounded-end-pill px-4">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <div class="table-responsive rounded-3 shadow-sm">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Tahun Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $s)
                        <tr>
                            <td>{{ $loop->iteration + ($students->currentPage()-1)*$students->perPage() }}</td>
                            <td>{{ $s->nim }}</td>
                            <td>
                                <a href="{{ route('students.show',$s) }}" class="fw-semibold text-decoration-none text-dark hover-link">
                                    {{ $s->nama }}
                                </a>
                            </td>
                            <td><span class="text-dark px-3 py-2">{{ $s->jurusan }}</span></td>
                            <td>{{ $s->tahun_masuk }}</td>
                            <td>
                                <a href="{{ route('students.edit',$s) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('students.destroy',$s) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                <i class="bi bi-emoji-frown"></i> Tidak ada data mahasiswa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="text-muted small mb-2 mb-md-0">
                    Menampilkan <strong>{{ $students->firstItem() }}</strong>–<strong>{{ $students->lastItem() }}</strong>
                    dari <strong>{{ $students->total() }}</strong> data
                </div>
                <div class="pagination-box">
                    @if ($students->onFirstPage())
                    <span class="btn btn-outline-secondary btn-sm disabled"><i class="bi bi-chevron-left"></i></span>
                    @else
                    <a href="{{ $students->previousPageUrl() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-left"></i></a>
                    @endif

                    <span class="btn btn-primary btn-sm mx-1 disabled">{{ $students->currentPage() }}</span>

                    @if ($students->hasMorePages())
                    <a href="{{ $students->nextPageUrl() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-right"></i></a>
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

    .hover-link:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    .table thead {
        background: #007bff;
    }

    .table tbody tr:hover {
        background-color: #f1f7ff;
        transition: 0.2s;
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

    .badge {
        font-size: 0.8rem;
        border-radius: 12px;
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