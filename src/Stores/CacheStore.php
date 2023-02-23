<?php

namespace Karriere\State\Stores;

use Karriere\State\State;
use Psr\Cache\CacheItemPoolInterface;

class CacheStore extends Store
{
    public function __construct(
        string $statePrefix,
        private CacheItemPoolInterface $cacheItemPool,
        private int $expiresAfter = 300
    ) {
        parent::__construct($statePrefix);

        $this->cacheItemPool = $cacheItemPool;
        $this->expiresAfter  = $expiresAfter;
    }

    public function put(State $state): void
    {
        $cacheItem = $this->cacheItemPool->getItem($this->getStoreKey($state->identifier()));

        $cacheItem->set([
            'name' => $state->name(),
            'data' => $state->raw(),
        ]);
        $cacheItem->expiresAfter($this->expiresAfter);

        $this->cacheItemPool->save($cacheItem);
        $this->cacheItemPool->commit();
    }

    public function get(string $identifier, bool $keepState = false): State
    {
        $key = $this->getStoreKey($identifier);

        $name = '';
        $data = [];

        $cacheItem = $this->cacheItemPool->getItem($key);

        if ($cacheItem->isHit()) {
            $cacheItemData = $cacheItem->get();

            if (is_array($cacheItemData)) {
                extract($cacheItemData);
            }

            if (!$keepState) {
                $this->cacheItemPool->deleteItem($key);
            }
        }

        return new State($identifier, $name, $data);
    }
}
