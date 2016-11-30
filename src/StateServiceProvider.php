<?php

namespace Fetzi\State;

use Fetzi\State\Stores\CacheStore;
use Fetzi\State\Stores\SessionStore;
use Fetzi\State\Stores\Store;
use Illuminate\Support\ServiceProvider;
use Psr\Cache\CacheItemPoolInterface;

class StateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/../config/state.php' => config_path('state.php'),
            ],
            'config'
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/state.php', 'state');

        $this->app->bind(Store::class, function () {
            $stateStoreType = config('state.storage');

            $store = null;

            switch ($stateStoreType) {
                case 'cache':
                    $store = new CacheStore(
                        config('state.storage-prefix'),
                        $this->app->make(CacheItemPoolInterface::class),
                        config('state.expires-after')
                    );
                    break;
                default:
                    $store = new SessionStore(
                        config('state.storage-prefix'),
                        $this->app->make(\Illuminate\Session\Store::class)
                    );
                    break;
            }

            return $store;
        });

        $this->app->alias(Store::class, 'store');
    }
}
