<?php

namespace Karriere\State\Stores;

use Karriere\State\State;

abstract class Store
{
    /** @var string */
    protected $statePrefix;

    /**
     * Store constructor.
     *
     * @param $statePrefix string
     */
    public function __construct($statePrefix)
    {
        $this->statePrefix = $statePrefix;
    }

    /**
     * store the given state in the store.
     *
     * @param State $state the state to store
     */
    abstract public function put(State $state);

    /**
     * get the stored state by its unique identifier.
     *
     * @param $identifier string
     * @param $keepState bool indicates if the stored state should be kept in store
     *
     * @return State
     */
    abstract public function get($identifier, $keepState = false);

    /**
     * create store key for identifier.
     *
     * @param $identifier string
     *
     * @return string
     */
    protected function getStoreKey($identifier)
    {
        return sprintf('%s/%s', $this->statePrefix, $identifier);
    }
}
