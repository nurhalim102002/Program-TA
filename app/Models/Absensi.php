<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_karyawan',
        'mangkir',
        'izin_p1',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
