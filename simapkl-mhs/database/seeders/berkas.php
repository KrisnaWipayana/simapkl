<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class berkas extends Seeder
{  
    public function run(): void
    {
        // Laporan Mingguan
        DB::table('laporan_mingguan')->insert([
            'mahasiswa_id' => 1,
            'judul_laporan' => 'Laporan Mingguan 1',
            'deskripsi_laporan' => 'Deskripsi laporan mingguan pertama.',
            'status_laporan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Laporan Akhir
        DB::table('laporan_akhir')->insert([
            'mahasiswa_id' => 1,
            'judul_laporan' => 'Laporan Akhir PKL',
            'deskripsi_laporan' => 'Deskripsi laporan akhir PKL.',
            'file_laporan' => 'laporan_akhir_1.pdf',
            'status_laporan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // CV
        DB::table('cv')->insert([
            'mahasiswa_id' => 1,
            'file_cv' => 'cv_andi.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}