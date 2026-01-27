<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 0; $i < 6; $i++) {
            Blog::create([
                'title' => $faker->sentence(4),
                'category' => $faker->word(),
                'date' => $faker->date(),
                'image' => $faker->imageUrl(900, 600, 'business'),
                'excerpt' => $faker->sentence(12),
                'content' => $faker->paragraph(2),
                'link' => $faker->url(),
            ]);
        }
    }
}
