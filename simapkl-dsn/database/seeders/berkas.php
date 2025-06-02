<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Berkas extends Seeder
{  
    public function run(): void
    {
        // Laporan Mingguan
        DB::table('laporan_mingguans')->insert([
            [
            'mahasiswa_id' => 1,
            'judul_laporan' => 'Laporan Mingguan 1',
            'deskripsi_laporan' => 'Deskripsi laporan mingguan pertama.',
            'status_laporan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 1,
            'judul_laporan' => 'Laporan Mingguan 2',
            'deskripsi_laporan' => 'Deskripsi laporan mingguan kedua.',
            'status_laporan' => 'Menunggu',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 2,
            'judul_laporan' => 'Laporan Mingguan 1',
            'deskripsi_laporan' => 'Deskripsi laporan mingguan pertama.',
            'status_laporan' => 'Menunggu',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 2,
            'judul_laporan' => 'Laporan Mingguan 2',
            'deskripsi_laporan' => 'Deskripsi laporan mingguan kedua.',
            'status_laporan' => 'Menunggu',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);

        // Laporan Akhir
        DB::table('laporan_akhirs')->insert([
            [
            'mahasiswa_id' => 1,
            'judul_laporan' => 'Laporan Akhir PKL',
            'deskripsi_laporan' => 'Laporan akhir PKL di Timedoor.',
            'file_laporan' => 'laporan_akhir_1.pdf',
            'status_laporan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 2,
            'judul_laporan' => 'Laporan Akhir PKL',
            'deskripsi_laporan' => 'Laporan akhir PKL di Djoin.',
            'file_laporan' => 'laporan_akhir_2.pdf',
            'status_laporan' => 'Revisi',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 3,
            'judul_laporan' => 'Laporan Akhir PKL',
            'deskripsi_laporan' => 'Laporan akhir PKL di Jinom.',
            'file_laporan' => 'laporan_akhir_4.pdf',
            'status_laporan' => 'Revisi',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);

        // CV
        DB::table('cvs')->insert([
            [
            'mahasiswa_id' => 1,
            'file_cv' => 'cv_andi.pdf',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 2,
            'file_cv' => 'cv_saya.pdf',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'mahasiswa_id' => 1,
            'file_cv' => 'cvRevisi.pdf',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}