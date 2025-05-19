<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dospem extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'password',
        'foto',
        'prodi_id',
        'jurusan_id',
    ];

    protected $hidden = [
        'password',
    ];
}
