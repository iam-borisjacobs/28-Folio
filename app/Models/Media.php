<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'mime_type',
        'size',
        'disk',
        'folder_id',
    ];

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    // Helper to get full URL
    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }
    
    // Helper to check if it's an image
    public function getIsImageAttribute()
    {
        return str_starts_with($this->mime_type, 'image/');
    }
}
