<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadTrait
{
    public function uploadFile(UploadedFile $uploadedFile,
                                            $folder = null,
                                            $disk = 'public',
                                            $filename = null): bool|string
    {
        if (is_null($filename)) {
            $filename = Str::random(25);
        }
        return $uploadedFile->storeAs($folder, $filename.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
    }
}
