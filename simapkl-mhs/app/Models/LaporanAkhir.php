<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    protected $table = 'laporan_akhirs';

    protected $fillable = [
        'mahasiswa_id',
        'judul_laporan',
        'deskripsi_laporan',
        'file_laporan',
        'file_revisi',
        'status_laporan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
