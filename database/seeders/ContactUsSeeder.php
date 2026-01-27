<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 0; $i < 6; $i++) {
            ContactUs::create([
                'name' => $faker->name(),
                'email' => $faker->safeEmail(),
                'subject' => $faker->sentence(4),
                'message' => $faker->paragraph(3),
                'read' => $faker->boolean(),
            ]);
        }
    }
}
