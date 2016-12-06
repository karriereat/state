<?php

namespace spec\Fetzi\State;

use Fetzi\State\State;
use Illuminate\Support\Collection;
use PhpSpec\ObjectBehavior;

class StateSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('id', 'name', []);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(State::class);
    }

    public function it_should_return_the_identifier()
    {
        $this->identifier()->shouldReturn('id');
    }

    public function it_should_return_the_name()
    {
        $this->name()->shouldReturn('name');
    }

    public function it_should_check_for_the_correct_name()
    {
        $this->hasName('foo')->shouldReturn(false);
        $this->hasName('name')->shouldReturn(true);
    }

    public function it_should_allow_to_set_data()
    {
        $this->isEmpty()->shouldReturn(true);
        $this->set(['key' => 'value']);
        $this->isEmpty()->shouldReturn(false);
    }

    public function it_should_return_raw_array_data()
    {
        $this->raw()->shouldBeArray();
    }

    public function it_should_return_collection()
    {
        $this->collection()->shouldHaveType(Collection::class);
    }
}
