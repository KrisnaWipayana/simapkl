<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jurusan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusans')->insert([
            [
                'nama' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sistem Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknik Komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
