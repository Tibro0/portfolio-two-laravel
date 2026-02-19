<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SectionTitleSeeder::class,
            AnimationTextSeeder::class,
            TagSeeder::class,
            SocialIconSeeder::class,
            CounterSeeder::class,
            AboutSeeder::class,
            SkillCardTitleSeeder::class,
            FrontendSkillSeeder::class,
            BackendSkillSeeder::class,
            DesignSkillSeeder::class,
            CloudSkillSeeder::class,
            CertificationSeeder::class,
            ProfessionalJourneySeeder::class,
            AcademicExcellenceSeeder::class,
            ServiceSeeder::class,
            CategorySeeder::class,
            PortfolioSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            SubscriberSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
