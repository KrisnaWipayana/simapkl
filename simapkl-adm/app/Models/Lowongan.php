<?php

namespace App\Models;

use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lowongan extends Model
{
    protected $table = 'lowongans';
    protected $fillable = [
        'perusahaan_id',
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
