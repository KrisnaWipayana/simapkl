<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dospem extends Model
{
    protected $table = 'dospems';
    protected $fillable = [
        'nip',
        'nama',
        'email',
    ];
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'dospem_id', 'mahasiswa_id');
    }
    
}
