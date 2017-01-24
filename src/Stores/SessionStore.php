<?php

namespace Karriere\State\Stores;

use Karriere\State\State;
use Illuminate\Session\Store as Session;

class SessionStore extends Store
{
    /** @var Session */
    private $session;

    public function __construct($statePrefix, Session $session)
    {
        $this->session = $session;
        parent::__construct($statePrefix);
    }

    public function put(State $state)
    {
        $this->session->put(
            $this->getStoreKey($state->identifier()),
            [
                'name' => $state->name(),
                'data' => $state->raw(),
            ]
        );
    }

    public function get($identifier, $keepState = false)
    {
        $sessionData = $this->session->get($this->getStoreKey($identifier), ['name' => '', 'data' => []]);

        return new State($identifier, $sessionData['name'], $sessionData['data']);
    }
}
