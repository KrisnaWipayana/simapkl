<?php

namespace App\Models;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'password',
        'prodi_id',
        'jurusan_id',
        // 'perusahaan_id',
        // 'lowongan_id',
    ];
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }
    public function dospem()
    {
        return $this->belongsToMany(Dospem::class, 'pembimbings', 'mahasiswa_id', 'dospem_id');
    }
}
