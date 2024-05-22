<?php

namespace App\Services\Rate;

use App\DTO\RateDTO;
use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Log;

class RateService implements RateServiceInterface
{
    public function __construct(private readonly string $rateApiUrl)
    {
    }

    public function getRate(): RateDTO|bool
    {
        try {
            $currency = 'USD';
            $url = $this->rateApiUrl . $currency;

            $response = Http::get($url);

            if ($response->failed()) {
                return false;
            }

            $data = $response->json();

            if (!isset($data[0]['rate'])) {
                return false;
            }

            return new RateDTO(
                rate: (float) $data[0]['rate'],
                currency: (string) $data[0]['cc']
            );
        } catch (Throwable $exception) {
            Log::error('An error occurred while getting rate', ['exception' => $exception]);
            return false;
        }
    }
}
