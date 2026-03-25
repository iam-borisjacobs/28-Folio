<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'blocks',
        'theme_layout',
        'description',
    ];

    protected $casts = [
        'blocks' => 'array',
    ];
}
