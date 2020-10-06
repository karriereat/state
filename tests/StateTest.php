<?php

namespace Karriere\State\Tests;

use Illuminate\Support\Collection;
use Karriere\State\State;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @var State
     */
    private $state;

    protected function setUp(): void
    {
        $this->state = new State('id', 'name', []);
    }

    public function testStateReturnsIdentifier()
    {
        $this->assertEquals('id', $this->state->identifier());
    }

    public function testStateReturnsName()
    {
        $this->assertEquals('name', $this->state->name());
    }

    public function testStateChecksName()
    {
        $this->assertTrue($this->state->hasName('name'));
        $this->assertFalse($this->state->hasName('foo'));
    }

    public function testStateSetData()
    {
        $this->assertTrue($this->state->isEmpty());
        $this->state->set(['key' => 'value']);
        $this->assertFalse($this->state->isEmpty());
    }

    public function testStateGetRawData()
    {
        $this->assertIsArray($this->state->raw());
    }

    public function testStateGetCollection()
    {
        $this->assertInstanceOf(Collection::class, $this->state->collection());
    }
}
