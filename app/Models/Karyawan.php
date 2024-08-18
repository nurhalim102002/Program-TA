<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'nik',
        'nama',
        'ttl',
        'id_jabatan',
        'tgl_masuk',
        'lama_bekerja',
        'jenis_kelamin',
        'pendidikan_terakhir',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,"id_jabatan");
    }

    public function penugasan()
    {
        return $this->hasOne(Penugasan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class);
    }

    public function suratPeringatan()
    {
        return $this->hasOne(SPeringatan::class);
    }

    public function profileMatching()
    {
        return $this->hasMany(ProfileMatching::class);
    }

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'id_karyawan');
    }
}
