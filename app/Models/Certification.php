<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name',
        'issuer',
        'issue_date',
        'credential_url',
        'sort_order',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
