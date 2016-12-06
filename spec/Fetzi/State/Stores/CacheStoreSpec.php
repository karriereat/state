<?php

namespace spec\Fetzi\State\Stores;

use Fetzi\State\State;
use PhpSpec\ObjectBehavior;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheStoreSpec extends ObjectBehavior
{
    public function let(CacheItemPoolInterface $cacheItemPool)
    {
        $this->beConstructedWith('prefix', $cacheItemPool, 100);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Fetzi\State\Stores\CacheStore');
    }

    public function it_should_return_empty_state_if_no_data_is_in_cache(CacheItemPoolInterface $cacheItemPool, CacheItemInterface $cacheItem)
    {
        $cacheItemPool->getItem('prefix/id')->willReturn($cacheItem)->shouldBeCalled();
        $cacheItem->isHit()->willReturn(false)->shouldBeCalled();

        $response = $this->get('id');

        $response->shouldHaveType(State::class);
        $response->isEmpty()->shouldReturn(true);
    }

    public function it_should_return_state_if_cache_is_hit(CacheItemPoolInterface $cacheItemPool, CacheItemInterface $cacheItem)
    {
        $cacheItemPool->getItem('prefix/id')->willReturn($cacheItem)->shouldBeCalled();
        $cacheItem->isHit()->willReturn(true)->shouldBeCalled();
        $cacheItem->get()->willReturn(['name' => 'name', 'data' => [1, 2, 3]])->shouldBeCalled();

        $response = $this->get('id');

        $response->shouldHaveType(State::class);
        $response->isEmpty()->shouldReturn(false);
        $response->name()->shouldReturn('name');
        $response->raw()->shouldBeArray();
    }

    public function it_should_store_state_in_cache(CacheItemPoolInterface $cacheItemPool, CacheItemInterface $cacheItem)
    {
        $cacheItemPool->getItem('prefix/id')->willReturn($cacheItem)->shouldBeCalled();
        $cacheItem->set(['name' => 'name', 'data' => [1, 2, 3]])->shouldBeCalled();
        $cacheItem->expiresAfter(100)->shouldBeCalled();

        $cacheItemPool->save($cacheItem)->shouldBeCalled();
        $cacheItemPool->commit()->shouldBeCalled();

        $state = new State('id', 'name', [1, 2, 3]);

        $this->put($state);
    }
}
