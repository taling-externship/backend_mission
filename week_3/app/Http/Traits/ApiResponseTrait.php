<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponseTrait
{
    public function response(string $message, JsonResource| null $data, int $statusCode, bool $success = true): JsonResponse
    {
        if (!$message) {
            return response()->json(['message', '메세지가 없습니다..', 203]);
        }

        return response()->json(['message' => $message, 'error' => !$success, 'code' => $statusCode, 'results' => $data], $statusCode);
    }

    public function success(string $message, JsonResource $data, int $statusCode = 200): JsonResponse
    {
        return $this->response($message, $data, $statusCode);
    }

    public function error(string $message, int $statusCode = 500): JsonResponse
    {
        return $this->response($message, null, $statusCode, false);
    }
}
