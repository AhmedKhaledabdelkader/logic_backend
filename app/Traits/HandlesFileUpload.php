<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUpload
{
    protected function storeFile(
        UploadedFile $file,
        string $directory,
        string $disk = 'private'
    ): string {
        return $file->store($directory, $disk);
    }

    protected function deleteFile(
        ?string $path,
        string $disk = 'private'
    ): void {
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}