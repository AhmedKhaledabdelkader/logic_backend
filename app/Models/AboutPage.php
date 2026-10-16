<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'story_title',
        'story_paragraph',
        'story_image',
        'presence',
        'values',
    ];

    protected $casts = [
        'presence' => 'array',
        'values' => 'array',
    ];
}