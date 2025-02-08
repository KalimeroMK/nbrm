<?php

namespace Kalimeromk\Nbrm;

use Illuminate\Support\ServiceProvider;

class NBRMExchangeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/nbrm.php' => config_path('nbrm.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge configuration file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nbrm.php', 'nbrm'
        );

        // Bind the service
        $this->app->singleton(NBRMExchangeService::class, function (): NBRMExchangeService {
            return new NBRMExchangeService();
        });
    }
}
