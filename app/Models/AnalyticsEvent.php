<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'event_type',
        'subject_type',
        'subject_id',
        'ip_hash',
        'user_agent',
    ];

    public function subject()
    {
        return $this->morphTo();
    }
}
