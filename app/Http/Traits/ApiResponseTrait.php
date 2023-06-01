<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function success($message, $data, $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function error($message, $statusCode): JsonResponse
    {
        return response()->json(['message' => $message], $statusCode);
    }
}
