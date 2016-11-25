<?php


namespace Fetzi\State\Test;


use Fetzi\State\State;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    public function testGetIdentifier()
    {
        $state = new State('id', 'name', []);

        $this->assertEquals('id', $state->identifier());
    }
}