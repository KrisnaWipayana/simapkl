<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class perusahaan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaans')->insert([
            [
            'nama' => 'PT. Maju Jaya',
            'email' => 'hrd@majujaya.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Merdeka No. 1',
            'koordinat' => null,
            'no_telp' => '0211234567',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama' => 'PT. Maju Mundur',
            'email' => 'hrd@majumundur.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Merdeka No. 2',
            'koordinat' => null,
            'no_telp' => '0211234568',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama' => 'PT. Jaya Jaya',
            'email' => 'hrd@jayajaya.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Merdeka No. 3',
            'koordinat' => null,
            'no_telp' => '0211234569',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
