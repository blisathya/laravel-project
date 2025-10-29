<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total mahasiswa
        $totalStudents = Student::count();

        // Total absensi
        $totalAttendances = Attendance::count();

        // Absensi terbaru
        $recent = Attendance::latest()->take(5)->get();

        // Jurusan yang ingin ditampilkan
        $majors = ['Informatika', 'Ilmu Komunikasi', 'Pariwisata Budaya', 'Hukum', 'Kewirausahaan', 'Desain Komunikasi Visual (DKV)', 'Sains Informasi'];

        // Hitung mahasiswa per jurusan
        $studentsPerMajor = [];
        foreach ($majors as $major) {
            $studentsPerMajor[$major] = Student::where('jurusan', $major)->count();
        }

        return view('dashboard', compact('totalStudents', 'totalAttendances', 'recent', 'studentsPerMajor'));
    }
}
