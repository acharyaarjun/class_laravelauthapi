<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Success ko lagi response
     */
    public function sendSuccessResponse($data, $message)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    /**
     * Error ko lagi response
     */
    public function sendErrorResponse($errorMessages = [], $message, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
