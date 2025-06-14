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
                'email' => 'budi@pnb.ac.id',
                'password' => bcrypt('password'),
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198001012005011002',
                'nama' => 'Dr. Siti Aminah',
                'email' => 'siti@pnb.ac.id',
                'password' => bcrypt('password'),
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198001012005011003',
                'nama' => 'Dr. Andi Wijaya',
                'email' => 'andi@pnb.ac.id',
                'password' => bcrypt('password'),
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
