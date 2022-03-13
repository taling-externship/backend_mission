<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param null $result
     * @param null $message
     * @param int $status
     * @param array|null $meta
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result = null, $message = null, $status = 200, $meta = null)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }

    /**
     * return error response.
     *
     * @param string $error
     * @param null $errorMessage
     * @param int $status
     * @param array|null $meta
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error = 'error', $errorMessage = null, $status = 404, $meta = null)
    {
        $response = [
            'success' => false,
            'data' => $errorMessage,
            'message' => $error,
        ];

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }
}
