<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswas')->insert([
            [
            'nim' => '210001001',
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => bcrypt('password'),
            'foto' => null,
            'prodi_id' => 1,
            'jurusan_id' => 1,
            'perusahaan_id' => 1,
            'lowongan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nim' => '210001002',
            'nama' => 'Wiliam Sander',
            'email' => 'wil@example.com',
            'password' => bcrypt('password'),
            'foto' => null,
            'prodi_id' => 1,
            'jurusan_id' => 1,
            'perusahaan_id' => null,
            'lowongan_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nim' => '210001003',
            'nama' => 'Alberto Krisjona',
            'email' => 'alb@example.com',
            'password' => bcrypt('password'),
            'foto' => null,
            'prodi_id' => 2,
            'jurusan_id' => 2,
            'perusahaan_id' => null,
            'lowongan_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
            ]
        ]);
    }
}
