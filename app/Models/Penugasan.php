<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    protected $table = 'penugasans';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_karyawan',
        'periode_penugasan',
        'lokasi',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
