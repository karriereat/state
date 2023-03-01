<?php

use Karriere\State\State;
use Karriere\State\Stores\CacheStore;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

beforeEach(function () {
    $this->cacheItemPool = Mockery::mock(CacheItemPoolInterface::class);
    $this->cacheStore = new CacheStore('prefix', $this->cacheItemPool, 100);
});

test('cache is empty', function () {
    $cacheItem = Mockery::mock(CacheItemInterface::class);

    $cacheItem
        ->shouldReceive('isHit')
        ->once()
        ->andReturn(false);

    $this->cacheItemPool
        ->shouldReceive('getItem')
        ->once()
        ->andReturn($cacheItem);

    expect($this->cacheStore->get('id'))
        ->isEmpty()->toBeTrue();
});

it('hits cache', function () {
    $cacheItem = Mockery::mock(CacheItemInterface::class);

    $cacheItem
        ->shouldReceive('isHit')
        ->once()
        ->andReturn(true);

    $cacheItem
        ->shouldReceive('get')
        ->once()
        ->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);

    $this->cacheItemPool
        ->shouldReceive('getItem')
        ->once()
        ->andReturn($cacheItem);

    $this->cacheItemPool
        ->shouldReceive('deleteItem')
        ->once()
        ->with('prefix/id');

    expect($this->cacheStore->get('id'))
        ->isEmpty()->toBeFalse()
        ->name()->toEqual('name');
});

it('hits cache without deleting it', function () {
    $cacheItem = Mockery::mock(CacheItemInterface::class);

    $cacheItem
        ->shouldReceive('isHit')
        ->once()
        ->andReturn(true);

    $cacheItem
        ->shouldReceive('get')
        ->once()
        ->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);

    $this->cacheItemPool
        ->shouldReceive('getItem')
        ->once()
        ->andReturn($cacheItem);

    $this->cacheItemPool
        ->shouldReceive('deleteItem')
        ->never();

    expect($this->cacheStore->get('id', true))
        ->isEmpty()->toBeFalse()
        ->name()->toEqual('name');
});

it('stores state', function () {
    $state = new State('id', 'name', [1, 2, 3]);
    $cacheItem = Mockery::mock(CacheItemInterface::class);

    $cacheItem
        ->shouldReceive('set')
        ->once();

    $cacheItem
        ->shouldReceive('expiresAfter')
        ->once()
        ->with(100);

    $this->cacheItemPool
        ->shouldReceive('getItem')
        ->with('prefix/id')
        ->once()
        ->andReturn($cacheItem);

    $this->cacheItemPool
        ->shouldReceive('save')
        ->with($cacheItem)
        ->once();

    $this->cacheItemPool
        ->shouldReceive('commit')
        ->once();

    $this->cacheStore->put($state);
});
