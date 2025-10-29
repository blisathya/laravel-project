@extends('layouts.app')
@section('title', 'Edit Data Absensi')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container mt-4 d-flex justify-content-center">
    <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 600px;">
        <div class="card-header bg-warning text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-pencil-square me-2"></i>Edit Data Absensi
            </h5>
            <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm fw-semibold shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body px-4 py-4">
            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mahasiswa</label>
                    <div class="input-group shadow-sm">
                        <select name="student_id" class="form-select select2" required>
                            <option value="">-- Cari atau Pilih Mahasiswa --</option>
                            @foreach ($students as $s)
                            <option value="{{ $s->id }}" {{ $attendance->student_id == $s->id ? 'selected' : '' }}>
                                {{ $s->nama }} ({{ $s->nim }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-calendar-event text-secondary"></i></span>
                        <input type="date" name="tanggal" class="form-control" value="{{ $attendance->tanggal }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Kehadiran</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-check2-circle text-secondary"></i></span>
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir" {{ $attendance->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Izin" {{ $attendance->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Sakit" {{ $attendance->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Alpha" {{ $attendance->status == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-chat-text text-secondary"></i></span>
                        <textarea name="keterangan" rows="3" class="form-control" placeholder="Tulis keterangan jika ada">{{ $attendance->keterangan }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning text-white px-4 me-2 shadow-sm">
                        <i class="bi bi-save2-fill"></i> Perbarui Data
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Select2 -->
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
        border-color: #ffc107;
        box-shadow: 0 0 8px rgba(255, 193, 7, 0.3);
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        font-size: 1rem;
    }

    .card:hover {
        box-shadow: 0 0 18px rgba(255, 193, 7, 0.15);
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