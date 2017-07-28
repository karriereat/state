<?php

namespace Karriere\State\Stores;

use Karriere\State\State;
use Psr\Cache\CacheItemPoolInterface;

class CacheStore extends Store
{
    /** @var CacheItemPoolInterface */
    private $cacheItemPool;

    /** @var int */
    private $expiresAfter;

    public function __construct($statePrefix, CacheItemPoolInterface $cacheItemPool, $expiresAfter = 300)
    {
        parent::__construct($statePrefix);

        $this->cacheItemPool = $cacheItemPool;
        $this->expiresAfter = $expiresAfter;
    }

    public function put(State $state)
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

    public function get($identifier, $keepState = false)
    {
        $key = $this->getStoreKey($identifier);

        $name = '';
        $data = [];

        $cacheItem = $this->cacheItemPool->getItem($key);

        if ($cacheItem->isHit()) {
            extract($cacheItem->get());

            if (!$keepState) {
                $this->cacheItemPool->deleteItem($key);
            }
        }

        return new State($identifier, $name, $data);
    }
}
