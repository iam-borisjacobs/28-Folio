<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'value' => 'json' // Removed JSON cast for now to keep it simple text/string unless configured otherwise, or handle in service.
        // Actually, let's keep it raw text and handle parsing in Service if needed, or stick to text.
    ];
}
