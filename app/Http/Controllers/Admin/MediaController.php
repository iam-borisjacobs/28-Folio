<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\MediaFolder;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $folderId = $request->get('folder_id');
        $currentFolder = $folderId ? MediaFolder::findOrFail($folderId) : null;
        
        $folders = MediaFolder::where('parent_id', $folderId)->orderBy('name')->get();
        $files = Media::where('folder_id', $folderId)->latest()->get();

        // Breadcrumbs logic could be added here
        $breadcrumbs = [];
        $temp = $currentFolder;
        while ($temp) {
            array_unshift($breadcrumbs, $temp);
            $temp = $temp->parent;
        }

        if ($request->wantsJson()) {
            $files->each(function($file) {
                $file->append('url');
            });

            return response()->json([
                'folders' => $folders,
                'files' => $files,
            ]);
        }

        return view('admin.media.index', compact('folders', 'files', 'currentFolder', 'breadcrumbs'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,svg,pdf,mp4|max:10240', // 10MB
            'folder_id' => 'nullable|exists:media_folders,id',
        ]);

        $media = $this->mediaService->upload($request->file('file'), $request->input('folder_id'));

        return response()->json([
            'success' => true,
            'media' => $media,
            'url' => $media->url
        ]);
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:media_folders,id',
        ]);

        MediaFolder::create($request->only('name', 'parent_id'));

        return back()->with('success', 'Folder created.');
    }

    public function destroy(Media $media)
    {
        $this->mediaService->delete($media);
        return back()->with('success', 'File deleted.');
    }

    public function destroyFolder(MediaFolder $folder)
    {
        if ($folder->media()->count() > 0 || $folder->subFolders()->count() > 0) {
            return back()->with('error', 'Folder is not empty.');
        }

        $folder->delete();
        return back()->with('success', 'Folder deleted.');
    }
}
