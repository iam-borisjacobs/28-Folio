<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project; // Added for the relationship
use Illuminate\Support\Str; // Added for slug generation

class ProjectTag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tag');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }
}
