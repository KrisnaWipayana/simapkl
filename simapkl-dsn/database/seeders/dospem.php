<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dospem extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('dospems')->insert([
        [
            'nip' => '198001012005011001',
            'nama' => 'Dr. Budi Santoso',
            'password' => bcrypt('password'),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nip' => '198001012005011002',
            'nama' => 'Dr. Siti Aminah',
            'password' => bcrypt('password'),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nip' => '198001012005011003',
            'nama' => 'Dr. Andi Wijaya',
            'password' => bcrypt('password'),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    }
}
