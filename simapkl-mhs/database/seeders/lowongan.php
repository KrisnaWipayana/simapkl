<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class lowongan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lowongans')->insert([
            [
            'perusahaan_id' => 1,
            'judul' => 'Web Developer Internship',
            'deskripsi' => 'Magang pengembangan aplikasi web.',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'perusahaan_id' => 2,
            'judul' => 'Head Resource Internship',
            'deskripsi' => 'Magang HR anjay.',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'perusahaan_id' => 1,
            'judul' => 'UI UX Internship',
            'deskripsi' => 'Magang design web.',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
