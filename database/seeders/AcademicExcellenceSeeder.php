<?php

namespace Database\Seeders;

use App\Models\AcademicExcellence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicExcellenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicExcellence::insert([
            [
                'year' => '2026',
                'title' => 'World University Of Bangladesh',
                'sub_title' => 'B.Sc. in Computer Science and Engineering (Running)',
                'description' => 'B.Sc. CSE: Design, develop, and integrate software & hardware systems. Core topics: programming, algorithms, AI.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => '2025',
                'title' => 'Dhaka Central Polytechnic Institute',
                'sub_title' => 'Diploma Engineering Computer Technology',
                'description' => 'Diploma in Computer Engineering from DCPI. Proficient in Laravel, PHP, and Wordpress. Strong foundation in computer hardware and software.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => '2018',
                'title' => 'Mission International School & Collage',
                'sub_title' => 'Secondary School Certificate',
                'description' => 'Secondary School Certificate from Mission International School & Collage. Proficient in English, Mathematics, Science. Eager to learn and grow.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => '2015',
                'title' => 'Mission International School & Collage',
                'sub_title' => 'Junior School Certificate',
                'description' => 'Junior School Certificate from Mission International School & Collage. Proficient in English, Mathematics, Science. Eager to learn and grow.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
