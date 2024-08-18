<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evaluasis';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_karyawan',
        'kemampuan',
        'tanggung_jawab',
        'prestasi_kerja',
        'kejujuran',
        'disiplin',
        'loyalitas',
        'kerja_keras',
        'rasa_memiliki',
        'rata_rata',
        'tanggal_penilaian',
        'periode'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
