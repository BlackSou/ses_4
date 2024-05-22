<?php

namespace App\Http\Controllers;

use App\Http\Payloads\Factories\SubscribeFactory;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Services\Subscriber\SubscriberServiceInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class SubscriberController extends BaseController
{
    public function __construct(private readonly SubscriberServiceInterface $subscriberService)
    {
    }

    #[OA\Post(
        path: '/api/subscribe',
        description: "The request checks whether the email is subscribe if it is not adds it",
        summary: "Subscribe the email to receive the current rate",
        tags: ["Subscribe"]
    )]
    #[OA\Parameter(
        name: "Accept",
        description: "header with Accept criteria, should be application/json",
        in: "header",
        required: true,
        example: 'application/json'
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                required: ['email'],
                properties: [
                    new OA\Property(property: 'email', description: "User email", type: "string", example: "user@example.com"),
                ]
            )
        )
    )]
    #[OA\Response(response: 200, description: 'Successfully, email added')]
    #[OA\Response(response: 409, description: 'Unsuccessfully, email is already in the subscribers')]
    #[OA\Response(response: 500, description: 'Server error')]
    public function store(
        SubscriberRequest $subscriberRequest,
        SubscribeFactory  $subscriberFactory,
    ): JsonResponse
    {
        try {
            $payload = $subscriberFactory->make($subscriberRequest);

            $subscriber = $this->subscriberService->create($payload);

            if (!$subscriber) {
                return $this->sendError('Unsuccessfully, email is already in the subscriber list', 409);
            }

            return $this->sendResponse(
                new SubscriberResource($subscriber),
                'Successfully, email added'
            );
        } catch (\Throwable $exception) {
            return $this->sendError('Server error', 500);
        }
    }
}
