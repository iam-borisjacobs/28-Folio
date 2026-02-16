<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    /**
     * Get featured projects.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function featured(int $limit = 3)
    {
        return Project::where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at')
            ->take($limit)
            ->get();
    }
}
