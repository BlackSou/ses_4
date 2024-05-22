<?php

namespace App\Providers;

use App\Services\Subscriber\SubscriberService;
use App\Services\Subscriber\SubscriberServiceInterface;
use App\Services\Rate\RateService;
use App\Services\Rate\RateServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RateServiceInterface::class, function ($app) {
            return new RateService(config('services.rate_api_url'));
        });
        $this->app->singleton(SubscriberServiceInterface::class, SubscriberService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
