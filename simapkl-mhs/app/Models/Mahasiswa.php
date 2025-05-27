<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Authenticatable
{

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'password',
        'foto',
        'prodi_id',
        'jurusan_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'mahasiswas';

    public function cv()
{
    return $this->hasOne(CV::class);
}

public function skills()
{
    return $this->belongsToMany(\App\Models\Skill::class, 'mahasiswa_skill', 'mahasiswa_id', 'skill_id');
}
}
