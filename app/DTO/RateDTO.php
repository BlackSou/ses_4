<?php

namespace App\DTO;

class RateDTO
{
    public function __construct(
        public readonly float|null $rate = null,
        public readonly string|null $currency = null,
    )
    {
    }
}
