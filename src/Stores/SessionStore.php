<?php

namespace Karriere\State\Stores;

use Illuminate\Session\Store as Session;
use Karriere\State\State;

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
        $key = $this->getStoreKey($identifier);

        $name = '';
        $data = [];

        if ($this->session->has($key)) {
            extract($this->session->get($key));

            if (!$keepState) {
                $this->session->forget($key);
            }
        }

        return new State($identifier, $name, $data);
    }
}
