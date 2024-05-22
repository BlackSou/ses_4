<?php

namespace App\Repositories;

use App\Http\Payloads\SubscriberPayload;
use App\Models\Subscriber;

class SubscriberRepository
{
    public function getId(string $id): Subscriber
    {
        return Subscriber::findOrFail($id);
    }

    public function getByEmail(SubscriberPayload $payload): ?Subscriber
    {
        return Subscriber::where('email', $payload->email)->first();
    }

    public function create(SubscriberPayload $payload): ?Subscriber
    {
        $subscriber = new Subscriber();

        $subscriber->email = $payload->email;
        $subscriber->save();

        return $subscriber;
    }
}
