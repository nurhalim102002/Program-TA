<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatans';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'jabatan',
    ];

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }
}
