<?php

namespace Karriere\State\Stores;

use Karriere\State\State;

abstract class Store
{
    public function __construct(protected string $statePrefix)
    {
    }

    /**
     * store the given state in the store.
     */
    abstract public function put(State $state): void;

    /**
     * get the stored state by its unique identifier.
     */
    abstract public function get(string $identifier, bool $keepState = false): State;

    /**
     * create store key for identifier.
     */
    protected function getStoreKey(string $identifier): string
    {
        return sprintf('%s/%s', $this->statePrefix, $identifier);
    }
}
