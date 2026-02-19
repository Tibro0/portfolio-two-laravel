<?php

namespace Database\Seeders;

use App\Models\CloudSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CloudSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CloudSkill::insert([
            [
                'title' => 'Git',
                'percentage' => '99',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'AWS',
                'percentage' => '98',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'cPanel ',
                'percentage' => '98',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
