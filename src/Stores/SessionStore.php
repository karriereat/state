<?php

namespace Fetzi\State\Stores;


use Fetzi\State\State;

class SessionStore extends Store
{

    public function put(State $state)
    {
        session(
            [
                $this->getStoreKey($state->identifier()) => [
                    'name' => $state->name(),
                    'data' => $state->raw(),
                ]
            ]
        );
    }

    public function get($identifier)
    {
        $sessionData = session($this->getStoreKey($identifier), ['name' => '', 'data' => []]);

        return new State($identifier, $sessionData['name'], $sessionData['data']);
    }
}