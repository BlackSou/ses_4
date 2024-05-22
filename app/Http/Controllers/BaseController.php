<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as AbstractController;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

#[
    OA\Info(version: "1.0.0", description: "Get the current USD to UAH exchange rate", title: "GSES USD application API"),
]
class BaseController extends AbstractController
{
    use AuthorizesRequests, ValidatesRequests;
    public function sendResponse($data, $message, $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];


        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
