<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanMingguan extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'judul_laporan',
        'deskripsi_laporan',
        'status_laporan'
    ];
}
