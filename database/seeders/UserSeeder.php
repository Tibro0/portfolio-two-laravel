<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'=> 'MD. Faysal Hossain Tibro',
                'email'=> 'faysaltibro@gmail.com',
                'phone_one'=> '+8801575827988',
                'address_line_one'=> 'House No : 101, Maowlana Vashani Road,',
                'address_line_two'=> 'Tongi East, Banomala Road.',
                'short_description'=> 'Full-stack developer skilled in Laravel, PHP, JavaScript, and modern frameworks. Adept at building dynamic web apps, problem-solving, and clear team collaboration. Dedicated to delivering high-quality, user-focused solutions.',
                'email_verified_at'=> now(),
                'password'=> Hash::make('password'),
                'remember_token'=> Str::random(10),
                'created_at'=> now(),
                'updated_at'=> now(),
            ]
        ]);
    }
}
