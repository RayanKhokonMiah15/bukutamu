<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_telepon',
        'keperluan',
        'waktu_datang',
        'foto_wajah'
    ];

    protected $casts = [
        'waktu_datang' => 'datetime',
    ];
}
