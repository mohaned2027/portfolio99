<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'track',
        'logo',
        'url',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class , 'team_projects' , 'team_id' , 'project_id');
    }
}
