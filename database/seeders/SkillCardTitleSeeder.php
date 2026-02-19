<?php

namespace Database\Seeders;

use App\Models\SkillCardTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillCardTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillCardTitle::insert([
            [
                'icon' => 'bi bi-code-slash',
                'title' => 'Frontend Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-server',
                'title' => 'Backend Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-palette',
                'title' => 'Design & Tools',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-cloud',
                'title' => 'Cloud & DevOps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
