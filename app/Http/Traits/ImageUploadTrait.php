<?php

namespace App\Http\Traits;

use App\Helpers\FileUploadHelper;

trait ImageUploadTrait
{

    public function uploadImageWithCompress($file, $path)
    {
        $imageName = FileUploadHelper::compress_file($file, $path);
        return $imageName;
    }
}
