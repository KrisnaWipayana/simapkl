<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'kooridinat',
        'no_telp',
        // 'logo', neks apdet
    ];

    protected $hidden = [
        'password',
    ];
}
