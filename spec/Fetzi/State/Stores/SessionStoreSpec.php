<?php

namespace spec\Fetzi\State\Stores;

use Fetzi\State\State;
use Illuminate\Session\Store as Session;
use PhpSpec\ObjectBehavior;

class SessionStoreSpec extends ObjectBehavior
{

    function let(Session $session)
    {
        $this->beConstructedWith('prefix', $session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fetzi\State\Stores\SessionStore');
    }

    function it_should_return_empty_state_if_no_item_is_in_session(Session $session)
    {
        $session->get('prefix/id', ['name' => '', 'data' => []])->willReturn(['name' => '', 'data' => []])->shouldBeCalled();

        $response = $this->get('id');

        $response->shouldHaveType(State::class);
        $response->isEmpty()->shouldReturn(true);
    }

    function it_should_return_state_if_item_exists_in_session(Session $session)
    {
        $session->get('prefix/id', ['name' => '', 'data' => []])->willReturn(['name' => 'name', 'data' => [1, 2, 3]])->shouldBeCalled();

        $response = $this->get('id');

        $response->shouldHaveType(State::class);
        $response->isEmpty()->shouldReturn(false);
        $response->name()->shouldReturn('name');
        $rawArray = $response->raw();

        $rawArray->shouldBeArray();
        $rawArray->shouldHaveCount(3);
    }

    function it_should_store_state_in_session(Session $session)
    {
        $session->put('prefix/id', ['name' => 'name', 'data' => [1, 2, 3]])->shouldBeCalled();

        $state = new State('id', 'name', [1, 2, 3]);
        $this->put($state);
    }
}
