<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'short_desc',
        'desc',
        'image_cover',
        'images',
        'link',
        'github',
        'technologies',
        'status',
        'service_id',
    ];

    protected $casts = [
        'images' => 'array',
        'technologies' => 'array',
        'status' => 'boolean',
        'service_id' => 'integer',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class , 'team_projects' , 'project_id' , 'team_id');
    }



    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
