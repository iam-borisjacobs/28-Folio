<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Award;

class ResumeService
{
    /**
     * Get all resume data formatted for the public view.
     *
     * @return array
     */
    public function getResumeData(): array
    {
        return [
            'experience' => Experience::ordered()->get(),
            'education' => Education::ordered()->get(),
            'skills' => Skill::ordered()->get()->groupBy('category'),
            'certifications' => Certification::ordered()->get(),
            'awards' => Award::ordered()->get(),
        ];
    }
}
