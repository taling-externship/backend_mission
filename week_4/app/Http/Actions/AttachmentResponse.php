<?php

namespace App\Http\Actions;

use App\Models\Attachment;
use App\Services\AttachmentService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttachmentResponse
{
    public function __construct(private AttachmentService $service)
    {
    }

    public function __invoke(Attachment $attachment, string $_): StreamedResponse
    {
        return $this->service->show($attachment);
    }
}
