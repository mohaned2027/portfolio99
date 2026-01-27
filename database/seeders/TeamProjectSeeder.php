<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::query()->pluck('id');
        $projects = Project::all();

        if ($teams->isEmpty() || $projects->isEmpty()) {
            return;
        }

        foreach ($projects as $project) {
            $count = min(3, $teams->count());
            $ids = $teams->random(rand(1, $count))->values()->all();
            $project->teams()->syncWithoutDetaching($ids);
        }
    }
}
