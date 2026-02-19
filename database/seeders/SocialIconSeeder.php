<?php

namespace Database\Seeders;

use App\Models\SocialIcon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialIcon::insert([
            [
                'icon' => 'bi bi-github',
                'url' => 'https://github.com/tibro0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-facebook',
                'url' => 'https://www.facebook.com/faysaltibro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-linkedin',
                'url' => 'https://www.linkedin.com/in/md-faysal-hossain-tibro-1aa622226/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-whatsapp',
                'url' => 'https://api.whatsapp.com/send/?phone=8801575827988&text=Hello&type=phone_number&app_absent=0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
