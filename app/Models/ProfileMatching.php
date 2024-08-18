<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatching extends Model
{
    protected $table = 'profile_matchings';
    protected $primaryKey = 'id';
    
    public $timestamps = false;
    protected $fillable = [
        'id',
        'tanggal_penilaian',
        'periode',
        'id_karyawan',
        'id_evaluasi',
        'nilai_evaluasi',
        'nilai_penugasan',
        'nilai_absensi',
        'nilai_peringatan',
        'nilai_akhir',
        'rekomendasi',
        'status_validasi',

    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class, 'id_evaluasi');
    }
}
