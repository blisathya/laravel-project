<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Attendance;

class DatabaseSeeder extends Seeder {
    public function run() {
        // buat 10 mahasiswa
        Student::factory(10)->create()->each(function($student) {
            // tiap mahasiswa punya 1-5 data absensi
            Attendance::factory(rand(1,5))->create([
                'student_id' => $student->id
            ]);
        });
    }
}
