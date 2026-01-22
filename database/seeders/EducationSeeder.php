<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date();
        for ($i = 0; $i < 10; $i++) {
            Education::create([
                'title' => fake()->jobTitle(),
                'description' => fake()->text(),
                'start_date' => $date,
                'end_date' => fake()->dateTimeBetween($date, 'now'),

            ]);
        }
    }
}
