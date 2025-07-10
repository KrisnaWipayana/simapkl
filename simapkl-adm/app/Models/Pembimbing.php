<?php

namespace App\Models;

use App\Models\Dospem;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembimbing extends Model
{
    protected $table = 'pembimbings';
    protected $fillable = [
        'dospem_id',
        'mahasiswa_id',
    ];
    public function dospem(): BelongsTo
    {
        return $this->belongsTo(Dospem::class);
    }
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
