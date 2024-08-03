<?php

namespace App\Helpers;

class ApiResponse {

    public static function success($data, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'status_code' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }

    public static function error($message, $errors = [], $statusCode = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
