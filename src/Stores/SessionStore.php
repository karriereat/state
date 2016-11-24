<?php

namespace Fetzi\State\Stores;


use Fetzi\State\State;

class SessionStore extends Store
{

    public function put(State $state)
    {
        session([$this->getStoreKey($state->identifier()) => $state->raw()]);
    }

    public function get($identifier)
    {
        $sessionData = session($this->getStoreKey($identifier), []);

        return new State($identifier, $sessionData);
    }
}