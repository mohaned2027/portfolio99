<?php

namespace Database\Seeders;

use App\Models\ResumeOrder;
use Illuminate\Database\Seeder;

class ResumeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResumeOrder::create([
            'order' => [
                'experience',
                'education',
                'skills',

            ],
        ]);
    }
}
