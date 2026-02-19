<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Counter::insert([
            [
                'icon' => 'bi bi-trophy',
                'number' => '1',
                'title' => 'Years Experience',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-diagram-3',
                'number' => '5',
                'title' => 'Projects Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'bi bi-people',
                'number' => '5',
                'title' => 'Happy Clients',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
