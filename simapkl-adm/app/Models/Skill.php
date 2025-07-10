<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function perusahaan() {
        return $this->belongsToMany(Perusahaan::class, 'lowongan_skills')->withTimeStamps();
    }
}
