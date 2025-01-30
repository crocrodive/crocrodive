<?php

namespace App\Providers;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use App\OpenApi\UserOpenApiDecorator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend(OpenApiFactoryInterface::class, function (OpenApiFactoryInterface $factory) {
            return new UserOpenApiDecorator($factory);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
