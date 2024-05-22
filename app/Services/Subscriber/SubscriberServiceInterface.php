<?php

namespace App\Services\Subscriber;

use App\Http\Payloads\SubscriberPayload;
use App\Models\Subscriber;

interface SubscriberServiceInterface
{
    public function create(SubscriberPayload $payload): Subscriber|bool;
}
