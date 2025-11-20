<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portfolio::insert([
            [
                'category_id' => '1',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-1.png',
                'frontend_title' => 'Multi Vendor E-commerce Website',
                'frontend_description' => 'Multi-Vendor E-Commerce Hub',
                'preview_title' => 'Multi Vendor E-commerce Website',
                'preview_description' => 'Language : Laravel, PHP, Bootstrap, HTML5, CSS3, JavaScript, jQuery.',
                'live_link' => 'https://ecommerce.devtibro.com/',
                'github_link' => 'https://github.com/Tibro0/sazao-laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '1',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-2.png',
                'frontend_title' => 'Restaurant Management Website',
                'frontend_description' => 'All-in-one restaurant management platform.',
                'preview_title' => 'Restaurant Management Website',
                'preview_description' => 'Language : Laravel, PHP, Bootstrap, HTML5, CSS3, JavaScript, jQuery.',
                'live_link' => 'https://food-park.devtibro.com/',
                'github_link' => 'https://github.com/Tibro0/food-park-laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '3',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-3.png',
                'frontend_title' => 'Learning Management System',
                'frontend_description' => 'Learn. Track. Succeed. All-in-One.',
                'preview_title' => 'Learning Management System',
                'preview_description' => 'Language : Laravel, PHP, Bootstrap, HTML5, CSS3, JavaScript, jQuery.',
                'live_link' => 'https://lms.devtibro.com/',
                'github_link' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '2',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-4.png',
                'frontend_title' => 'Construction Company',
                'frontend_description' => 'Crafting Digital Excellence',
                'preview_title' => 'Construction Company',
                'preview_description' => 'Language : HTML5, CSS3, Bootstrap, JavaScript, jQuery.',
                'live_link' => 'https://tibro0.github.io/Buildx/',
                'github_link' => 'https://github.com/Tibro0/Buildx',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '2',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-5.png',
                'frontend_title' => 'Charite Website',
                'frontend_description' => "Europe's leading research hospital.",
                'preview_title' => 'Charite Website',
                'preview_description' => 'Language : HTML5, CSS3, Bootstrap, JavaScript, jQuery.',
                'live_link' => 'https://tibro0.github.io/chariteam/',
                'github_link' => 'https://github.com/Tibro0/chariteam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '2',
                'thumb_image' => 'frontend/assets/img/portfolio/portfolio-6.png',
                'frontend_title' => 'Frontend Project',
                'frontend_description' => 'Interactive Web App Builder',
                'preview_title' => 'Frontend Project',
                'preview_description' => 'Language : HTML5, CSS3, Bootstrap, JavaScript, jQuery.',
                'live_link' => 'https://tibro0.github.io/Securex/',
                'github_link' => 'https://github.com/Tibro0/Securex',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
