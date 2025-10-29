@extends('layouts.app')
@section('title', isset($student) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')
@section('content')

<div class="container mt-4 d-flex justify-content-center">
    <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-person-vcard me-2"></i>
                {{ isset($student) ? 'Edit Data Mahasiswa' : 'Tambah Data Mahasiswa' }}
            </h5>
            <a href="{{ route('students.index') }}" class="btn btn-light btn-sm fw-semibold shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body px-4 py-4">
            <form method="POST"
                action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}"
                class="needs-validation" novalidate>
                @csrf
                @if(isset($student)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIM</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-card-list"></i></span>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM"
                            value="{{ old('nim', $student->nim ?? '') }}">
                    </div>
                    @error('nim')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap"
                            value="{{ old('nama', $student->nama ?? '') }}">
                    </div>
                    @error('nama')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif"
                            value="{{ old('email', $student->email ?? '') }}">
                    </div>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-book"></i></span>
                        <input type="text" name="jurusan" class="form-control" placeholder="Contoh: Informatika"
                            value="{{ old('jurusan', $student->jurusan ?? '') }}">
                    </div>
                    @error('jurusan')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Tahun Masuk</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                        <input type="number" name="tahun_masuk" class="form-control" placeholder="Contoh: 2024"
                            value="{{ old('tahun_masuk', $student->tahun_masuk ?? '') }}">
                    </div>
                    @error('tahun_masuk')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 me-2 shadow-sm">
                        <i class="bi bi-save2-fill"></i> {{ isset($student) ? 'Update Data' : 'Simpan Data' }}
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control {
        border-radius: 8px;
        font-size: 0.9rem;
        padding: 8px 12px;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        font-size: 1rem;
    }

    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0 18px rgba(13, 110, 253, 0.12);
    }

    .card-header h5 {
        font-size: 1rem;
        letter-spacing: 0.3px;
    }

    button.btn i {
        vertical-align: middle;
        margin-right: 4px;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection