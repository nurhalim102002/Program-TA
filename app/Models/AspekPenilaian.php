<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPenilaian extends Model
{
    use HasFactory;

    protected $table = 'aspek_penilaians'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key, jika tidak standard (id) bisa diubah disini
    protected $fillable = [
        'id',
        'id_penugasan',
        'id_absensi',
        'id_speringatan',
        'id_evaluasi',
    ];

    // Relasi ke tabel Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi ke tabel Penugasan
    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'id_penugasan');
    }

    // Relasi ke tabel Absensi
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi');
    }

    // Relasi ke tabel SPeringatan
    public function speringatan()
    {
        return $this->belongsTo(Speringatan::class, 'id_speringatan');
    }

    // Relasi ke tabel Evaluasi
    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class, 'id_evaluasi');
    }
}
