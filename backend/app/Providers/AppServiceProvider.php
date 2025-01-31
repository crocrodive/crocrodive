<?php

namespace App\Providers;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\EvaluationApiResource;
use App\OpenApi\UserOpenApiDecorator;
use App\Policies\ApiEvaluationPolicy;
use App\State\CourseProvider;
use App\State\EvaluationProvider;
use App\State\RatingProvider;
use Illuminate\Support\Facades\Gate;
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

        self::registerAPIProvider(
            CourseProvider::class,
            static function () {
                return new CourseProvider();
            }
        );

        self::registerAPIProvider(
            EvaluationProvider::class,
            static function () {
                return new EvaluationProvider();
            }
        );

        self::registerAPIProvider(
            RatingProvider::class,
            static function () {
                return new RatingProvider();
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(EvaluationApiResource::class, ApiEvaluationPolicy::class);
    }

    /**
     * Register a State Provider for API Platform
     *
     * (see https://api-platform.com/docs/core/state-providers/)
     * @param string $providerClassName
     * @param callable $callback
     * @return void
     */
    private function registerAPIProvider(string $providerClassName, callable $callback): void{
        $this->app->singleton($providerClassName, $callback);

        $this->app->tag([$providerClassName], ProviderInterface::class);

		$this->app->tag(CourseProvider::class, ProviderInterface::class);
    }
}
