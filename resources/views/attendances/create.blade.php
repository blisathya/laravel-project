@extends('layouts.app')
@section('title', 'Tambah Data Absensi')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container mt-4 d-flex justify-content-center">
    <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 600px;">
        <div class="card-header bg-success text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-calendar-check me-2"></i>Tambah Data Absensi
            </h5>
            <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm fw-semibold shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body px-4 py-4">
            <form action="{{ route('attendances.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mahasiswa</label>
                    <div class="input-group shadow-sm">
                        <select name="student_id" class="form-select select2" required>
                            <option value="">-- Cari atau Pilih Mahasiswa --</option>
                            @foreach ($students as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nim }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-calendar-event text-secondary"></i></span>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Kehadiran</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-check2-circle text-secondary"></i></span>
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-chat-text text-secondary"></i></span>
                        <textarea name="keterangan" rows="3" class="form-control" placeholder="Tulis keterangan jika ada"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4 me-2 shadow-sm">
                        <i class="bi bi-save2-fill"></i> Simpan Data
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan script Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Cari atau Pilih Mahasiswa --",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<style>
    body {
        background: #f5f6fa;
        font-family: 'Poppins', sans-serif;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        font-size: 0.9rem;
        padding: 8px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 8px rgba(25, 135, 84, 0.25);
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        font-size: 1rem;
    }

    .card:hover {
        box-shadow: 0 0 18px rgba(25, 135, 84, 0.12);
    }

    .select2-container .select2-selection--single {
        height: 40px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        display: flex;
        align-items: center;
        padding-left: 8px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px;
        right: 10px;
    }
</style>
@endsection