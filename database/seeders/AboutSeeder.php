<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::insert([
            'signature' => 'frontend/assets/img/misc/signature-1.webp',
            'signature_description' => 'Building meaningful digital experiences through creative code.',
            'description' => 'Full-Stack Developer skilled in building and maintaining dynamic web applications. Proficient in Laravel, PHP, HTML, CSS, Bootstrap, JavaScript and jQuery. Adept at problem-solving and collaborating effectively within a team. Possesses strong communication skills, enabling clear and concise interaction with both technical and non-technical stakeholders. Dedicated to delivering high-quality, user-focused solutions while continuously expanding my technical expertise. Seeking a challenging role where I can leverage my full-stack capabilities and contribute to a collaborative environment.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
