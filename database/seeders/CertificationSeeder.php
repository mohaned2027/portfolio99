<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 1; $i <= 6; $i++) {
            Certification::create([
                'name' => $faker->sentence(3),
                'image' => $faker->imageUrl(700, 500, 'business'),
                'text' => $faker->paragraph(4),
                'date' => $faker->date(),
                'order' => $i,
            ]);
        }
    }
}
