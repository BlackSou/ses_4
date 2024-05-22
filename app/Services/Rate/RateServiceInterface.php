<?php

namespace App\Services\Rate;

use App\DTO\RateDTO;

interface RateServiceInterface
{
    public function getRate(): RateDTO|bool;
}
