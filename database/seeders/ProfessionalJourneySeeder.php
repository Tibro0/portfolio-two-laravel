<?php

namespace Database\Seeders;

use App\Models\ProfessionalJourney;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionalJourneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfessionalJourney::insert([
            [
                'year'=> '2025 June - 2025 August',
                'title'=> 'SoClose Dhaka Limited',
                'sub_title'=> 'Full Stack Web Developer (Php & Laravel)',
                'description'=> 'Delivering cutting-edge web solutions for businesses of all sizes. From design and development to digital marketing, we drive online success.',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'year'=> '2025 January - 2025 May',
                'title'=> 'Udemy Online Courses - Laravel',
                'sub_title'=> 'Web Solution US',
                'description'=> 'Delivering cutting-edge web solutions for businesses of all sizes. From design and development to digital marketing, we drive online success.',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'year'=> '2024 January - 2024 December',
                'title'=> 'Shikhbe Shobai',
                'sub_title'=> 'Full Stack Web Development - PHP Laravel',
                'description'=> "Shikhbe Shobai: Bangladesh's premier IT training institute. Learn in-demand skills: web development, programming, digital marketing, and more.",
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'year'=> '2023 January - 2023 December',
                'title'=> 'Shikhbe Shobai',
                'sub_title'=> 'Full Stack Web Development - Wordpress',
                'description'=> "Shikhbe Shobai: Bangladesh's premier IT training institute. Learn in-demand skills: web development, programming, digital marketing, and more.",
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
