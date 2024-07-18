<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class ImageUploadHelper
{
    /**
     * Upload a file and return its URL.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string|false
     */
    public static function uploadImage($file, $fileName, $directory)
    {
        if (!$file->isValid()) {
            return false;
        }
        // Store the file in the 'public' disk
        $file->storeAs($directory, $fileName, 'public');

        // Generate the full file path including the directory and file name
        $filePath = $directory . '/' . $fileName;
        // Generate the full URL including the domain
        return asset('storage/' . $filePath);
    }
}
