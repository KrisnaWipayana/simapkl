<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dospem extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'dospems';

    // Relasi many-to-many dengan Mahasiswa melalui tabel pembimbings
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'pembimbings')
                    ->withTimestamps();
    }
}