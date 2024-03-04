<?php

namespace App\Services\Api\v1;

use Illuminate\Support\Facades\Response;

class ResponseService
{
    public static function successResponse($message = '', $data = null, $status = 200)
    {
        $responseData = [
            'status' => 'success',
            'message' => $message,

        ];

        if ($data) {
            $responseData['data'] = $data;
        }
        return Response::json($responseData, $status);
    }

    public static function errorResponse($message = '', $status = 400)
    {
        return Response::json([
            'status' => 'error',
            'message' => $message,

        ], $status);
    }
}
