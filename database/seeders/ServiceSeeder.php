<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['title' => 'Web Development', 'description' => 'Modern web applications and APIs.', 'icon' => 'web'],
            ['title' => 'Backend Systems', 'description' => 'Reliable services and integrations.', 'icon' => 'backend'],
            ['title' => 'Frontend UI', 'description' => 'Responsive interfaces and UX.', 'icon' => 'frontend'],
            ['title' => 'Databases', 'description' => 'Designing scalable data models.', 'icon' => 'database'],
            ['title' => 'Mobile Apps', 'description' => 'Cross-platform mobile solutions.', 'icon' => 'mobile'],
            ['title' => 'IoT Solutions', 'description' => 'Connected devices and automation.', 'icon' => 'iot'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
