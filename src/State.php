<?php

namespace Karriere\State;

use Illuminate\Support\Collection;

class State
{
    /** @var string */
    private $identifier;

    /** @var string */
    private $name;

    /** @var array */
    private $data;

    /**
     * State constructor.
     *
     * @param $identifier string the state's unique identifier
     * @param $name string the state name
     * @param $data array the state data
     */
    public function __construct($identifier, $name, $data)
    {
        $this->identifier = $identifier;
        $this->name = $name;
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
     * @return string the state name
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * checks if the state has the given name.
     *
     * @param $name string the name to check
     *
     * @return bool true if the state has the name
     */
    public function hasName($name)
    {
        return strcmp($this->name, $name) == 0;
    }

    /**
     * @param $data array the state data
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /**
     * check if the state is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * retrieve the state's raw array data.
     *
     * @return array
     */
    public function raw()
    {
        return $this->data;
    }

    /**
     * retrieve the state data in a collection.
     *
     * @return Collection
     */
    public function collection()
    {
        return new Collection($this->data);
    }
}
