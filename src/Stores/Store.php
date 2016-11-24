<?php

namespace Fetzi\State\Stores;


use Fetzi\State\State;

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
     * store the given state in the store
     *
     * @param State $state the state to store
     */
    public abstract function put(State $state);

    /**
     * get the stored state by its unique identifier
     *
     * @param $identifier string
     * @return State
     */
    public abstract function get($identifier);

    /**
     * create store key for identifier
     *
     * @param $identifier string
     * @return string
     */
    protected function getStoreKey($identifier)
    {
        return sprintf("%s/%s", $this->statePrefix, $identifier);
    }
}