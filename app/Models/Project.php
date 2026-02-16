<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'featured_image',
        'project_url',
        'is_featured',
        'status',
        'published_at',
        'seo_meta',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'seo_meta' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
             if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function categories()
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_category');
    }

    public function tags()
    {
        return $this->belongsToMany(ProjectTag::class, 'project_tag');
    }

    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations->where('locale', $locale)->first();
    }

    public function translated($attribute, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $translation = $this->translations->where('locale', $locale)->first();
        return $translation ? $translation->$attribute : $this->$attribute;
    }
}
