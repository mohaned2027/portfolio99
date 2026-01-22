<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManager
{
    /**
     * Create a new class instance.
     */
    public function uploadSingleImage($request, $path, $disk)
    {
        if ($request) {
            $this->deleteImageFromLocal($request);
            $newImageName = $this->generateName($request, $path, $disk);

            return $newImageName;
        }

        return false;
    }

    private function generateName($image, $path, $disk)
    {
        $file = Str::uuid().time().'.'.$image->getClientOriginalExtension();
        dd([
            public_path('/'),
            is_dir(public_path('/')),
            is_writable(public_path('/')),
        ]);

        $newPath = $image->storeAs("uploads/$path", $file, ['disk' => $disk]);

        return $newPath;
    }

    private function deleteImageFromLocal($image)
    {
        if (File::exists($image)) {
            File::delete($image);
        }
    }
}
