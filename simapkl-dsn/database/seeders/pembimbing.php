<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pembimbing extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembimbings')->insert([
            [
                'dospem_id' => 1,
                'mahasiswa_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dospem_id' => 2,
                'mahasiswa_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dospem_id' => 3,
                'mahasiswa_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}