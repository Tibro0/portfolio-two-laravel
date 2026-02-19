<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert([
            [
                'icon' => 'bi bi-filetype-php',
                'title' => 'PHP',
                'description' => 'PHP Development, Custom Web Applications, API Development, CMS Integration, E-commerce Solutions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-browser-edge',
                'title' => 'Laravel',
                'description' => 'Custom Laravel Development, API Integration, E-commerce Solutions, Web App Maintenance, Cloud Deployment.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-webcam',
                'title' => 'Web Design',
                'description' => 'Website Design & Development, UI/UX Design, Branding, Logo Design, Responsive Websites.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-browser-chrome',
                'title' => 'Web Development',
                'description' => 'Website Design & Development, E-commerce Solutions, SEO, UI/UX, Mobile-Responsive Websites.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-bootstrap',
                'title' => 'Bootstrap',
                'description' => 'Responsive web design with Bootstrap. Create beautiful, cross-browser compatible websites.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-filetype-js',
                'title' => 'jQuery',
                'description' => 'jQuery Development, AJAX Interactions, DOM Manipulation, Front-End Animations, Plugin Development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
