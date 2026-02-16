<?php

namespace App\Services;

use App\Models\Media;
use App\Models\MediaFolder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaService
{
    protected $disk = 'public';

    /**
     * Upload a file to the media library.
     *
     * @param UploadedFile $file
     * @param int|null $folderId
     * @return Media
     */
    public function upload(UploadedFile $file, ?int $folderId = null): Media
    {
        $filename = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();
        
        // Generate secure filename
        $hash = Str::uuid()->toString();
        $extension = $file->getClientOriginalExtension();
        $storedFilename = "{$hash}.{$extension}";
        $path = "media/{$storedFilename}";

        // Handle Image Optimization
        if (str_starts_with($mimeType, 'image/') && $mimeType !== 'image/svg+xml') {
            $this->storeOptimizedImage($file, $path);
        } else {
            // Store raw file
            Storage::disk($this->disk)->putFileAs('media', $file, $storedFilename);
        }

        // Create DB record
        $media = Media::create([
            'filename' => $filename, // Original name
            'path' => $path,
            'mime_type' => $mimeType,
            'size' => $size, // We store original size, or we could update with optimized size
            'disk' => $this->disk,
            'folder_id' => $folderId,
        ]);

        // Log activity
        if (function_exists('activity')) {
            activity()
                ->performedOn($media)
                ->causedBy(auth()->user())
                ->log('uploaded media');
        }

        return $media;
    }

    /**
     * Delete a media item.
     *
     * @param Media $media
     * @return bool
     */
    public function delete(Media $media): bool
    {
        // Delete from storage
        if (Storage::disk($media->disk)->exists($media->path)) {
            Storage::disk($media->disk)->delete($media->path);
        }

        // Log activity
        if (function_exists('activity')) {
            activity()
                ->performedOn($media)
                ->causedBy(auth()->user())
                ->log('deleted media');
        }

        return $media->delete();
    }

    /**
     * Store an optimized version of the image.
     *
     * @param UploadedFile $file
     * @param string $path
     * @return void
     */
    protected function storeOptimizedImage(UploadedFile $file, string $path): void
    {
        // Use Intervention Image to resize
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        // Resize if wider than 2000px
        if ($image->width() > 2000) {
            $image->scale(width: 2000);
        }

        // Encode based on mime type
        $mime = $file->getMimeType();
        
        $encoded = match ($mime) {
            'image/jpeg', 'image/jpg' => $image->toJpeg(),
            'image/png' => $image->toPng(),
            'image/webp' => $image->toWebp(),
            'image/gif' => $image->toGif(),
            default => $image->toPng(), // Fallback
        };

        Storage::disk($this->disk)->put($path, (string) $encoded);
    }
}
