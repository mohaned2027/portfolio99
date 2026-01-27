<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        User::create([
            'name' => $faker->name(),
            'title' => $faker->jobTitle(),
            'avatar' => $faker->imageUrl(300, 300, 'people'),
            'email' => "mo@g.c",
            'phone' => $faker->phoneNumber(),
            'password' => '12345678',
            'birthday' => $faker->date(),
            'location' => $faker->city(),
            'about' => $faker->paragraph(),
            'map_embed' => $faker->url(),
            'social_links' => [
                'facebook' => $faker->url(),
                'linkedin' => $faker->url(),
                'github' => $faker->url(),
            ],
            'contact_email' => $faker->unique()->safeEmail(),
        ]);
    }
}
