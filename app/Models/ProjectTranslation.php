<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'locale',
        'title',
        'slug',
        'description',
        'content',
        'seo_meta',
    ];

    protected $casts = [
        'seo_meta' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
