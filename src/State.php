<?php

namespace Fetzi\State;


use Illuminate\Support\Collection;

class State
{

    /** @var string */
    private $identifier;

    /** @var array */
    private $data;

    /**
     * State constructor.
     *
     * @param $identifier string the state's unique identifier
     * @param $data array the state data
     */
    public function __construct($identifier, $data)
    {
        $this->identifier = $identifier;
        $this->data = $data;
    }

    /**
     * @return string gets the unique identifier of the state
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * @param $data array the state data
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /**
     * check if the state is empty
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * retrieve the state's raw array data
     *
     * @return array
     */
    public function raw()
    {
        return $this->data;
    }

    /**
     * retrieve the state data in a collection
     *
     * @return Collection
     */
    public function collect()
    {
        return new Collection($this->data);
    }
}