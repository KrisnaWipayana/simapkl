<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            jurusan::class,
            prodi::class,
            dospem::class,
            perusahaan::class,
            lowongan::class,
            mahasiswa::class,
            skill::class,   
            berkas::class,
            pembimbing::class,
        ]);
    }
}
