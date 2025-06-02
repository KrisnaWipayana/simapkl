<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dospem extends Authenticatable implements HasName
{
    protected $table = 'dospems';

    protected $fillable = [
        'nip',
        'password',
        // tambahkan kolom lain jika perlu
    ];

    protected $hidden = [
        'password',
    ];

    public function getFilamentName(): string
    {
        return $this->getAttributeValue('nama'); // Ganti dengan $this->nama jika ada kolom 'nama'
    }
}
