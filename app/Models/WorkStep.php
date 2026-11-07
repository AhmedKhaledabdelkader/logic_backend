<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkStep extends Model
{
    protected $fillable = [
        'title',
        'description',
        'outcome',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
