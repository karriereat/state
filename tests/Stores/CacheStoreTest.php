<?php

namespace Karriere\State\Tests\Stores;

use Karriere\State\State;
use Karriere\State\Stores\CacheStore;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheStoreTest extends TestCase
{
    /**
     * @var CacheStore
     */
    private $cacheStore;

    private $cacheItemPool;

    protected function setUp(): void
    {
        $this->cacheItemPool = Mockery::mock(CacheItemPoolInterface::class);
        $this->cacheStore    = new CacheStore('prefix', $this->cacheItemPool, 100);
    }

    public function testEmptyCache()
    {
        $cacheItem = Mockery::mock(CacheItemInterface::class);
        $cacheItem->shouldReceive('isHit')->andReturn(false);
        $this->cacheItemPool->shouldReceive('getItem')->andReturn($cacheItem);

        $state = $this->cacheStore->get('id');

        $this->assertTrue($state->isEmpty());
    }

    public function testCacheHit()
    {
        $cacheItem = Mockery::mock(CacheItemInterface::class);
        $cacheItem->shouldReceive('isHit')->andReturn(true);
        $cacheItem->shouldReceive('get')->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);

        $this->cacheItemPool->shouldReceive('getItem')->andReturn($cacheItem);
        $this->cacheItemPool->shouldReceive('deleteItem')->with('prefix/id');

        $state = $this->cacheStore->get('id');

        $this->assertFalse($state->isEmpty());
        $this->assertEquals('name', $state->name());
    }

    public function testCacheHitWithoutDelete()
    {
        $cacheItem = Mockery::mock(CacheItemInterface::class);
        $cacheItem->shouldReceive('isHit')->andReturn(true);
        $cacheItem->shouldReceive('get')->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);

        $this->cacheItemPool->shouldReceive('getItem')->andReturn($cacheItem);
        $this->cacheItemPool->shouldNotReceive('deleteItem');

        $state = $this->cacheStore->get('id');

        $this->assertFalse($state->isEmpty());
        $this->assertEquals('name', $state->name());
    }

    public function testCacheStoresState()
    {
        $this->expectNotToPerformAssertions();
        $state = new State('id', 'name', [1, 2, 3]);

        $cacheItem = Mockery::mock(CacheItemInterface::class);
        $cacheItem->shouldReceive('set');
        $cacheItem->shouldReceive('expiresAfter')->with(100);

        $this->cacheItemPool->shouldReceive('getItem')->with('prefix/id')->andReturn($cacheItem);
        $this->cacheItemPool->shouldReceive('save')->with($cacheItem);
        $this->cacheItemPool->shouldReceive('commit');

        $this->cacheStore->put($state);
    }
}
