<?php

namespace App\Http\Payloads;

class SubscriberPayload
{
    public function __construct(
        public readonly int|null    $id,
        public readonly string|null $email,
    )
    {
    }
}
