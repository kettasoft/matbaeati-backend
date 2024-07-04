<?php

namespace App\Helpers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiTrait
{
    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message, $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * @param $error
     * @param array $errorMessage
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, array $errorMessage = [], int $code = 200): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }

    /**
     * @param $successMessage
     * @param int $code
     * @return JsonResponse
     */
    public function sendSuccess($successMessage, int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $successMessage,
        ];
        return response()->json($response, $code);
    }

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendErrorData($result, $message): JsonResponse
    {
        $response = [
            'success' => false,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendUnauthorized()
    {
        $response = [
            'success' => false,
            'message' => 'Unauthorized',
        ];

        return response()->json($response, Response::HTTP_UNAUTHORIZED);
    }
}
