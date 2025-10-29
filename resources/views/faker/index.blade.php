@extends('layouts.app')
@section('title','Data Faker')
@section('content')

<div class="container">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-database-fill me-2"></i> Data Faker (10 Data Dummy)
            </h5>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="🔍 Cari nama atau jurusan..." style="width: 220px;">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Tahun Masuk</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        @foreach($fakeStudents as $index => $student)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $student['nim'] }}</td>
                            <td>{{ $student['nama'] }}</td>
                            <td>{{ $student['email'] }}</td>
                            <td>{{ $student['jurusan'] }}</td>
                            <td class="text-center">{{ $student['tahun_masuk'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info -->
        <div class="card-footer bg-light text-center rounded-bottom-4 py-3">
            <small class="text-muted">
                <i class="bi bi-info-circle"></i> Data ini hanya bersifat dummy (contoh hasil generate Faker).
            </small>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff !important;
        color: white !important;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f7ff;
        transition: background-color 0.2s;
    }

    #searchInput:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.3);
    }
</style>

<script>
    const rows = document.querySelectorAll('#dataTable tr');

    // Semua data (10) ditampilkan langsung tanpa pagination
    function showAllRows() {
        rows.forEach(row => row.style.display = '');
        document.getElementById('pageInfo')?.remove();
        document.getElementById('prevBtn')?.remove();
        document.getElementById('nextBtn')?.remove();
    }

    // Fitur pencarian tetap aktif
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    showAllRows();
</script>
@endsection
