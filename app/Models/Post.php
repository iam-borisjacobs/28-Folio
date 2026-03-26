<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'reading_time',
        'seo_meta',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'reading_time' => 'integer',
        'seo_meta' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            $post->calculateReadingTime();
        });

        static::updating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            $post->calculateReadingTime();
        });
    }

    public function calculateReadingTime()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        $this->reading_time = max(1, $minutes);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category');
    }

    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_post_tag');
    }

    public function translations()
    {
        return $this->hasMany(PostTranslation::class);
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
        // For reading time, if not in translation, maybe recalculate or use main?
        // Reading time is not in translation table currently, it's on main post.
        // But content is translated, so reading time should ideally be calculated per translation.
        // For now, return main attribute if not found in translation object (which implies attribute must exist in translation model).
        // PostTranslation has: title, slug, excerpt, content, seo_meta.
        // reading_time is not in PostTranslation.
        return $translation && $translation->$attribute ? $translation->$attribute : $this->$attribute;
    }
}
