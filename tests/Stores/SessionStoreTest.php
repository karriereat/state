<?php

namespace Karriere\State\Tests\Stores;

use Illuminate\Session\Store;
use Karriere\State\State;
use Karriere\State\Stores\SessionStore;
use Mockery;
use PHPUnit\Framework\TestCase;

class SessionStoreTest extends TestCase
{
    /**
     * @var SessionStore
     */
    private $sessionStore;

    private $store;

    protected function setUp(): void
    {
        $this->store        = Mockery::mock(Store::class);
        $this->sessionStore = new SessionStore('prefix', $this->store);
    }

    public function testSessionNotFound()
    {
        $this->store->shouldReceive('has')->andReturn(false);
        $state = $this->sessionStore->get('id');

        $this->assertTrue($state->isEmpty());
    }

    public function testStateFoundInSession()
    {
        $this->store->shouldReceive('has')->andReturn(true);
        $this->store->shouldReceive('get')->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);
        $this->store->shouldReceive('forget');

        $state = $this->sessionStore->get('id');

        $this->assertFalse($state->isEmpty());
        $this->assertEquals('name', $state->name());
    }

    public function testStoresStateInSession()
    {
        $this->expectNotToPerformAssertions();

        $this->store->shouldReceive('put')->with('prefix/id', ['name' => 'name', 'data' => [1, 2, 3]]);

        $state = new State('id', 'name', [1, 2, 3]);
        $this->sessionStore->put($state);
    }
}
