<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManager
{
    /**
     * Create a new class instance.
     */
    public function uploadSingleImage($file, $path, $disk, $oldPath = null)
    {
        if ($file) {
            if ($oldPath) {
                $this->deleteImageFromLocal($oldPath);
            }
            $newImageName = $this->generateName($file, $path, $disk);

            return $newImageName;
        }

        return false;
    }

    private function generateName($image, $path, $disk)
    {
        $file = Str::uuid().time().'.'.$image->getClientOriginalExtension();

        return $image->storeAs("uploads/$path", $file, ['disk' => $disk]);



    }

    public function deleteImageFromLocal($imagePath)
    {
        if ( File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }
}
