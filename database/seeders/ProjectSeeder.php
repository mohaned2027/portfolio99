<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();
        $serviceIds = Service::query()->pluck('id');

        for ($i = 0; $i < 8; $i++) {
            $title = $faker->sentence(3);
            $serviceId = $serviceIds->isEmpty() ? null : $serviceIds->random();

            Project::create([
                'title' => $title,
                'slug' => Str::slug($title . '-' . $i),
                'short_desc' => $faker->sentence(12),
                'desc' => $faker->paragraph(4),
                'image_cover' => $faker->imageUrl(800, 600, 'tech'),
                'images' => [
                    $faker->imageUrl(800, 600, 'tech'),
                    $faker->imageUrl(800, 600, 'tech'),
                ],
                'link' => $faker->url(),
                'github' => $faker->url(),
                'technologies' => [
                    'Laravel',
                    'Vue',
                    'MySQL',
                ],
                'status' => $faker->boolean(85),
                'service_id' => $serviceId,
            ]);
        }
    }
}
