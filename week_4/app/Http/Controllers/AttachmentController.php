<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Attachment;
use App\Services\AttachmentService;

class AttachmentController extends Controller
{
    public function __construct(private AttachmentService $service)
    {
    }

    public function __invoke(Article $article, Attachment $attachment, string $name)
    {
        return $this->service->show($attachment);
    }
}
