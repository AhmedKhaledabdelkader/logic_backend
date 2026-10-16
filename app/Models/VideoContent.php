<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'youtube_url',
    ];
}