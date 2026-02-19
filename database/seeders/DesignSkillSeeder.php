<?php

namespace Database\Seeders;

use App\Models\DesignSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DesignSkill::insert([
            [
                'title' => 'Figma',
                'percentage' => '95',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Photoshop',
                'percentage' => '96',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Illustrator',
                'percentage' => '94',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
