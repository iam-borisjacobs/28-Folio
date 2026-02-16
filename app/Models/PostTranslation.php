<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'locale',
        'title',
        'slug',
        'excerpt',
        'content',
        'seo_meta',
    ];

    protected $casts = [
        'seo_meta' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
