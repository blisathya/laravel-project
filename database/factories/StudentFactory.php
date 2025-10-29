<?php
namespace Database\Factories;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory {
    protected $model = Student::class;
    public function definition() {
        return [
            'nim' => $this->faker->unique()->numerify('23132310##'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'jurusan' => $this->faker->randomElement(['Informatika','DKV','Hukum','Sains Informasi', 'Ilmu Komunikasi', 'Pariwisata Budaya', 'Hukum Hindu']),
            'tahun_masuk' => $this->faker->numberBetween(2023,2025),
        ];
    }
}
