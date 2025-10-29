<?php
namespace Database\Factories;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory {
    protected $model = Attendance::class;
    public function definition() {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 years','now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Hadir','Izin','Sakit','Alpha']),
            'keterangan' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}
