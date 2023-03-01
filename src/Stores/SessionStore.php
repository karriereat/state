<?php

namespace Karriere\State\Stores;

use Illuminate\Session\Store as Session;
use Karriere\State\State;

class SessionStore extends Store
{
    public function __construct(string $statePrefix, private Session $session)
    {
        parent::__construct($statePrefix);
    }

    public function put(State $state): void
    {
        $this->session->put(
            $this->getStoreKey($state->identifier()),
            [
                'name' => $state->name(),
                'data' => $state->raw(),
            ]
        );
    }

    public function get(string $identifier, bool $keepState = false): State
    {
        $key = $this->getStoreKey($identifier);

        $name = '';
        $data = [];

        if ($this->session->has($key)) {
            $sessionData = $this->session->get($key);

            if (is_array($sessionData)) {
                extract($sessionData);
            }

            if (!$keepState) {
                $this->session->forget($key);
            }
        }

        return new State($identifier, $name, $data);
    }
}
