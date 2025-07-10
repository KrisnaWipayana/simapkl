<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaans';
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'no_telp',
    ];

    public function skill() {
        return $this->belongsToMany(Skill::class, 'lowongan_skills')->withTimeStamps();
    }
}
