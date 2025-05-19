<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembimbing extends Model
{
    protected $fillable = [

        'nip',
        'nama',
        'password',
        'foto',
        '',
    ];

    protected $hidden = [
        'password',
    ];
}
