<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date();
        for ($i = 0; $i < 10; $i++) {
            Experience::create([
                'title' => fake()->jobTitle(),
                'description' => fake()->text(),
                'start_date' => $date,
                'end_date' => fake()->dateTimeBetween($date, 'now'),

            ]);
        }
    }
}
