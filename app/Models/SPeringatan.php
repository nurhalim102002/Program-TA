<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speringatan extends Model
{
    protected $table = 'speringatans';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_karyawan',
        'sp_ke',
        'masa_berlaku',
        'perihal',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
