<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 0; $i < 6; $i++) {
            Team::create([
                'name' => $faker->company(),
                'track' => $faker->jobTitle(),
                'logo' => $faker->imageUrl(120, 120, 'business'),
                'url' => $faker->url(),
            ]);
        }
    }
}
