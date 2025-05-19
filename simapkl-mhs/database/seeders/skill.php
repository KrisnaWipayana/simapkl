<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class skill extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            ['nama' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'React', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('mahasiswa_skill')->insert([
            ['mahasiswa_id' => 1, 'skill_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['mahasiswa_id' => 1, 'skill_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mahasiswa_id' => 2, 'skill_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['mahasiswa_id' => 3, 'skill_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('lowongan_skill')->insert([
            ['lowongan_id' => 1, 'skill_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lowongan_id' => 2, 'skill_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['lowongan_id' => 3, 'skill_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
