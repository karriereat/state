<?php

namespace Karriere\State\Tests\Factories;

use Karriere\State\Factories\StateFactory;
use PHPUnit\Framework\TestCase;

class StateFactoryTest extends TestCase
{
    /**
     * @var StateFactory
     */
    private $stateFactory;

    protected function setUp(): void
    {
        $this->stateFactory = new StateFactory();
    }

    public function testFactoryShouldCreateUniqueIdentifier()
    {
        $state = $this->stateFactory->build('name', []);

        $this->assertNotEmpty($state->identifier());
        $this->assertIsString($state->identifier());
    }

    public function testFactoryAssignsName()
    {
        $state = $this->stateFactory->build('name', []);

        $this->assertEquals('name', $state->name());
    }

    public function testFactoryAssignsData()
    {
        $state = $this->stateFactory->build('name', [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $state->raw());
    }
}
