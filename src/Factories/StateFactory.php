<?php

namespace Fetzi\State\Factories;

use Fetzi\State\State;

class StateFactory
{
    public function build($name, $data)
    {
        $identifier = md5(uniqid(''));

        return new State($identifier, $name, $data);
    }
}
