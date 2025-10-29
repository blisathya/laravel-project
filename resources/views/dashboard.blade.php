@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-2" style="max-width: 1200px;">

    {{-- 3 Kartu Utama --}}
    <div class="row g-3 justify-content-center align-items-stretch">
        {{-- Total Mahasiswa --}}
        <div class="col-lg-4 col-md-6 col-12 d-flex">
            <a href="{{ url('/students') }}" class="w-100 text-decoration-none">
                <div class="card-stat bg-primary text-white p-3 text-center w-100 h-100">
                    <div class="icon-circle bg-white bg-opacity-25 mx-auto mb-2">
                        <i class="bi bi-people-fill fs-2"></i>
                    </div>
                    <h6 class="text-uppercase opacity-75 mb-1">Total Mahasiswa</h6>
                    <h3 class="fw-bold mt-1">{{ $totalStudents }}</h3>
                </div>
            </a>
        </div>

        {{-- Total Absensi --}}
        <div class="col-lg-4 col-md-6 col-12 d-flex">
            <a href="{{ url('/attendances') }}" class="w-100 text-decoration-none">
                <div class="card-stat bg-success text-white p-3 text-center w-100 h-100">
                    <div class="icon-circle bg-white bg-opacity-25 mx-auto mb-2">
                        <i class="bi bi-calendar-check-fill fs-2"></i>
                    </div>
                    <h6 class="text-uppercase opacity-75 mb-1">Total Absensi</h6>
                    <h3 class="fw-bold mt-1">{{ $totalAttendances }}</h3>
                </div>
            </a>
        </div>

        {{-- Waktu --}}
        <div class="col-lg-4 col-md-12 col-12 d-flex">
            <div class="card-stat bg-warning text-dark p-3 text-center w-100 h-100">
                <div class="icon-circle mx-auto mb-2 bg-dark bg-opacity-25">
                    <i class="bi bi-clock-history fs-2"></i>
                </div>
                <h6 class="text-uppercase opacity-75 mb-2">Waktu Indonesia</h6>

                <div class="d-flex justify-content-around flex-wrap small fw-semibold">
                    <div>
                        <div>WIB</div>
                        <div id="time-wib" class="fw-bold fs-6"></div>
                    </div>
                    <div>
                        <div>WITA</div>
                        <div id="time-wita" class="fw-bold fs-6"></div>
                    </div>
                    <div>
                        <div>WIT</div>
                        <div id="time-wit" class="fw-bold fs-6"></div>
                    </div>
                </div>

                <div id="current-date" class="opacity-75 mt-2 small"></div>
            </div>
        </div>
    </div>

    {{-- Mahasiswa per Jurusan --}}
    <div class="row g-4 mt-4 justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow rounded-4 p-4 bg-dark-subtle text-dark text-center">
                <h6 class="fw-semibold mb-4 text-primary">
                    <i class="bi bi-bar-chart-fill me-2"></i>Jumlah Mahasiswa per Jurusan
                </h6>

                @php
                $majorColors = [
                'Informatika' => 'bg-primary text-white',
                'Ilmu Komunikasi' => 'bg-success text-white',
                'Pariwisata Budaya' => 'bg-warning text-dark',
                'Hukum' => 'bg-secondary text-white',
                'Kewirausahaan' => 'bg-purple text-white',
                'Desain Komunikasi Visual (DKV)' => 'bg-danger text-white',
                'Sains Informasi' => 'bg-info text-white'
                ];

                $chunks = array_chunk($studentsPerMajor, 3, true);
                @endphp

                <div class="d-flex flex-column align-items-center">
                    @foreach($chunks as $row)
                    <div class="d-flex justify-content-center flex-wrap gap-3 mb-3">
                        @foreach($row as $major => $count)
                        <div class="rounded-4 p-3 px-4 text-center shadow-sm {{ $majorColors[$major] ?? 'bg-light text-dark' }}" style="min-width: 220px;">
                            <h6 class="mb-1">{{ $major }}</h6>
                            <h4 class="fw-bold mb-0">{{ $count }}</h4>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Absensi Terbaru --}}
    <div class="card shadow border-0 rounded-4 mt-4 bg-white">
        <div class="card-header bg-primary text-white fw-semibold rounded-top-4">
            <i class="bi bi-clipboard-check me-2"></i>Absensi Terakhir
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent as $index => $a)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $a->student->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>
                                <span class="badge 
                                    @if($a->status == 'Hadir') bg-success 
                                    @elseif($a->status == 'Izin') bg-warning text-dark
                                    @elseif($a->status == 'Sakit') bg-info text-dark
                                    @else bg-danger 
                                    @endif
                                    px-3 py-2 rounded-pill">
                                    {{ $a->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">
                                <i class="bi bi-exclamation-circle me-1"></i>Belum ada data absensi terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #f5f6fa;
        font-family: 'Poppins', sans-serif;
    }

    .card-stat {
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-stat:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-purple {
        background: linear-gradient(135deg, #8e2de2, #4a00e0);
    }

    @media (max-width: 768px) {
        .icon-circle {
            width: 45px;
            height: 45px;
        }

        .fs-2 {
            font-size: 1.5rem !important;
        }
    }
</style>

<script>
    function updateTimes() {
        const now = new Date();
        const wib = now.toLocaleTimeString('id-ID', {
            timeZone: 'Asia/Jakarta',
            hour12: false
        });
        const wita = now.toLocaleTimeString('id-ID', {
            timeZone: 'Asia/Makassar',
            hour12: false
        });
        const wit = now.toLocaleTimeString('id-ID', {
            timeZone: 'Asia/Jayapura',
            hour12: false
        });
        document.getElementById('time-wib').textContent = wib;
        document.getElementById('time-wita').textContent = wita;
        document.getElementById('time-wit').textContent = wit;
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
    }
    setInterval(updateTimes, 1000);
    updateTimes();
</script>
@endsection