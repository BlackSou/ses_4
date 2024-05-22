<?php

namespace App\Http\Payloads\Factories;

use App\Http\Payloads\SubscriberPayload;
use App\Http\Requests\SubscriberRequest;

class SubscribeFactory
{
    public function make(
        SubscriberRequest $emailRequest,
        int|null          $id = null,
    ): SubscriberPayload
    {
        $payload = $emailRequest->all();

        return $this->createObject($id, $payload);
    }

    private function createObject(int|null $id, array $payload): SubscriberPayload
    {
        return new SubscriberPayload(
            $id,
            email: $payload['email']
        );
    }
}
