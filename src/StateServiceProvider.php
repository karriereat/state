<?php

namespace Karriere\State;

use Illuminate\Support\ServiceProvider;
use Karriere\State\Stores\CacheStore;
use Karriere\State\Stores\SessionStore;
use Karriere\State\Stores\Store;
use Psr\Cache\CacheItemPoolInterface;

class StateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/state.php' => config_path('state.php'),
            ],
            'config'
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/state.php', 'state');

        $this->app->bind(Store::class, function () {
            return match (config('state.storage')) {
                'cache' => new CacheStore(
                    config('state.storage-prefix'),
                    $this->app->make(CacheItemPoolInterface::class),
                    config('state.expires-after')
                ),
                default => new SessionStore(
                    config('state.storage-prefix'),
                    $this->app->make(\Illuminate\Session\Store::class)
                ),
            };
        });

        $this->app->alias(Store::class, 'store');
    }
}
