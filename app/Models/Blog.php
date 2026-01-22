<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'date',
        'image',
        'excerpt',
        'content',
        'link',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
