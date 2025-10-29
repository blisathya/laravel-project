<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

class FakerController extends Controller
{
    public function index()
    {
        $faker = Faker::create('id_ID');

        // Membuat 10 data acak mahasiswa
        $fakeStudents = [];
        for ($i = 1; $i <= 10; $i++) {
            $fakeStudents[] = [
                'nim' => $faker->unique()->numerify('23########'),
                'nama' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'jurusan' => $faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi']),
                'tahun_masuk' => $faker->numberBetween(2020, 2025),
            ];
        }

        return view('faker.index', compact('fakeStudents'));
    }
}
