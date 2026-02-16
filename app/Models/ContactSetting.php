<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_email',
        'success_message',
        'auto_reply_enabled',
        'auto_reply_message',
    ];

    // Helper to get the singleton instance
    public static function current()
    {
        return static::first() ?? static::create([
            'notification_email' => 'admin@example.com',
            'success_message' => 'Thank you for your message.',
        ]);
    }
}
