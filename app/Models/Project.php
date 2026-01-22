<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

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
        'team_id',
        'service_id',
    ];

    protected $casts = [
        'images' => 'array',
        'technologies' => 'array',
        'status' => 'boolean',
        'team_id' => 'integer',
        'service_id' => 'integer',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
