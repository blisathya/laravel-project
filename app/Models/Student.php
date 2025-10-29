<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Nama tabel, jika tidak sesuai konvensi Laravel
    protected $table = 'students';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'email',
        'tahun_masuk', 
        // tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi ke Attendance (1 mahasiswa bisa punya banyak absensi)
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
