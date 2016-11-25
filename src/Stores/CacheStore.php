<?php


namespace Fetzi\State\Stores;


use Fetzi\State\State;
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

    public function get($identifier)
    {
        $cacheItem = $this->cacheItemPool->getItem($this->getStoreKey($identifier));

        $data = $cacheItem->isHit() ? $cacheItem->get() : ['name' => '', 'data' => []];

        return new State($identifier, $data['name'], $data['data']);
    }
}