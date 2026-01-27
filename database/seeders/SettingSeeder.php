<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        Setting::create([
            'company' => $faker->company(),
            'logo' => $faker->imageUrl(200, 200, 'business'),
            'favicon' => $faker->imageUrl(64, 64, 'business'),
            'cv' => $faker->url(),
        ]);
    }
}
