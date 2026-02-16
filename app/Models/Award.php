<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'award_date',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'award_date' => 'date',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
