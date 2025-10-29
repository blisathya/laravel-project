<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FakerController;
use App\Models\Student;
use App\Models\Attendance;

// Dashboard Route

Route::get('/dashboard', function () {
    // Total mahasiswa dan absensi
    $totalStudents = Student::count();
    $totalAttendances = Attendance::count();

    // 5 absensi terbaru
    $recent = Attendance::latest()->take(10)->get();

    // Daftar jurusan
    $majors = [
        'Ilmu Komunikasi',
        'Pariwisata Budaya',
        'Hukum',
        'Kewirausahaan',
        'Informatika',
        'Sains Informasi',
        'Desain Komunikasi Visual (DKV)'
    ];

    // Hitung jumlah mahasiswa per jurusan
    $studentsPerMajor = [];
    foreach ($majors as $major) {
        $studentsPerMajor[$major] = Student::where('jurusan', $major)->count();
    }

    // Kirim ke view dashboard
    return view('dashboard', compact(
        'totalStudents',
        'totalAttendances',
        'recent',
        'studentsPerMajor'
    ));
})->name('dashboard'); // Penting: beri nama route supaya route('dashboard') di sidebar tidak error

// Root Redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Resource Routes
Route::resource('students', StudentController::class);
Route::resource('attendances', AttendanceController::class)
    ->parameters(['attendances' => 'attendance']);

// Faker Data Route
Route::get('/faker-data', [FakerController::class, 'index'])->name('faker.index');
