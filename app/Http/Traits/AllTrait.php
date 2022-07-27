<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait AllTrait
{
    /**
     * Check if the authenticated user is following this user.
     *
     * @return bool
     */

    public function uploads($file)
    {
        if ($file) {
            $fileName   = time() . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            // Storage::disk('public')->put($fileName,File::get($file));
            $file_name  = $file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $filePath   = 'images/'.$fileName;

            return $file = [
                'fileName' => $file_name,
                'fileType' => $file_type,
                'filePath' => $filePath,
                // 'fileSize' => $this->fileSize($file)
            ];
        }
    }

    public function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
