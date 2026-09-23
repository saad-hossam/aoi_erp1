<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Str;
trait ImageUploadTrait
{

    /**
     * Save uploaded image to a folder and return the filename.
     */
    public function saveImage(?UploadedFile $image, string $folder, ?string $oldImage = null): ?string
    {
        if(!$image) return $oldImage; // return old image if no new upload

        // Delete old image
        if($oldImage && file_exists(public_path("$folder/$oldImage"))){
            unlink(public_path("$folder/$oldImage"));
        }

        $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
        $image->move(public_path($folder), $filename);

        return $filename;
    }
}
