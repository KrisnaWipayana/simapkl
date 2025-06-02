<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class skill extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IT Skills
        $itSkills = [
            'Laravel',
            'React',
            'Vue.js',
            'Angular',
            'Node.js',
            'Python',
            'Django',
            'Flask',
            'Java',
            'Spring Boot',
            'PHP',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'RESTful API',
            'Git',
            'Docker',
            'AWS',
            'Azure',
            'Google Cloud Platform',
            'HTML',
            'CSS',
            'JavaScript',
            'TypeScript',
            'UI/UX Design',
            'Figma',
            'SQL',
            'Data Analysis',
            'Machine Learning',
            'Cybersecurity',
            'Networking',
            'Linux',
            'WordPress',
            'SEO',
            'Mobile Development',
            'Flutter',
            'React Native',
            'Swift',
            'Kotlin',
            'DevOps',
            'CI/CD',
            'Kubernetes',
            'Scrum',
            'Agile',
            'Problem Solving',
            'Communication',
        ];

        $skillIds = [];
        foreach ($itSkills as $skillName) {
            DB::table('skills')->insert([
                'nama' => $skillName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $skillIds[] = DB::getPdo()->lastInsertId(); // Get the ID of the last inserted skill
        }

        // Mahasiswa Skills (mahasiswa_id up to 3)
        $mahasiswaSkills = [];
        $maxMahasiswaId = 3;
        for ($i = 1; $i <= $maxMahasiswaId; $i++) {
            // Assign 2-5 random skills to each student
            $numSkills = rand(2, 5);
            $randomSkills = (array) array_rand($skillIds, $numSkills); // Get random skill indexes
            foreach ($randomSkills as $index) {
                $mahasiswaSkills[] = [
                    'mahasiswa_id' => $i,
                    'skill_id' => $skillIds[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('mahasiswa_skill')->insert($mahasiswaSkills);


        // Lowongan Skills (lowongan_id up to 20)
        $lowonganSkills = [];
        $maxLowonganId = 20;
        for ($i = 1; $i <= $maxLowonganId; $i++) {
            // Assign 3-7 random skills to each job posting
            $numSkills = rand(3, 7);
            $randomSkills = (array) array_rand($skillIds, $numSkills); // Get random skill indexes
            foreach ($randomSkills as $index) {
                $lowonganSkills[] = [
                    'lowongan_id' => $i,
                    'skill_id' => $skillIds[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('lowongan_skill')->insert($lowonganSkills);
    }
}