<?php

namespace App\Http\Controllers;

use App\Http\Resources\RateResource;
use App\Services\Rate\RateServiceInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class RateController extends BaseController
{
    public function __construct(private readonly RateServiceInterface $rateService)
    {
    }

    #[OA\Get(
        path: '/api/rate',
        description: "The request should return the current USD to UAH exchange rate",
        summary: "Get the current USD to UAH exchange rate",
        tags: ["Rate"]
    )]
    #[OA\Parameter(
        name: "Accept",
        description: "Header with Accept criteria, should be application/json",
        in: "header",
        required: true,
        example: 'application/json'
    )]
    #[OA\Response(response: 200, description: 'Get current rate')]
    #[OA\Response(response: 404, description: 'Current rate not found')]
    #[OA\Response(response: 500, description: 'Server error')]
    public function getCurrentRate(): JsonResponse
    {
        try {
            $rate = $this->rateService->getRate();

            if (!$rate) {
                return $this->sendError('Current rate not found', 404);
            }

            return $this->sendResponse(
                new RateResource($rate),
                'Successfully retrieved current rate'
            );
        } catch (\Throwable $exception) {
            return $this->sendError('Server error', 500);
        }
    }
}
