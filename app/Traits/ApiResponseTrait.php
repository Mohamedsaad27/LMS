<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public function errorResponse($error, $message, $code)
{
    return response()->json([
        'success' => false,
        'error' => $error,
        'message' => $message,
    ], $code);
}
}
