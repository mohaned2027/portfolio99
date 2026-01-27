<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            TeamSeeder::class,
            ProjectSeeder::class,
            TeamProjectSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            SkillSeeder::class,
            BlogSeeder::class,
            CertificationSeeder::class,
            ContactUsSeeder::class,
            ResumeOrderSeeder::class,
        ]);
    }
}
