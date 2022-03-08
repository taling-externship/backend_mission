<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentService
{
    public function show(Attachment $attachment)
    {

        return Storage::download('attachment' . $attachment->stored_name, $attachment->original_name, [
            'Content-Disposition' => 'inline',
            'Content-Type' => 'image/' . $attachment->extension,
        ]);
    }
}
