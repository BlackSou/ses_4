<?php

namespace App\Services\Subscriber;

use App\DTO\RateDTO;
use App\Http\Payloads\SubscriberPayload;
use App\Models\Subscriber;
use App\Repositories\SubscriberRepository;
use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Log;

class SubscriberService implements SubscriberServiceInterface
{
    public function __construct(
        private readonly SubscriberRepository $subscriberRepository,
    )
    {
    }

    public function create(SubscriberPayload $payload): Subscriber|bool
    {
        try {
            if ($this->subscriberRepository->getByEmail($payload)) {
                return false;
            }

            return $this->subscriberRepository->create($payload);
        } catch (Throwable $exception) {
            Log::error('An error occurred while creating a subscription', ['exception' => $exception]);
            return false;
        }
    }
}
