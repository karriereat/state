<?php

namespace Karriere\State\Factories;

use Karriere\State\State;

class StateFactory
{
    /**
     * @param array<int|string, mixed> $data
     */
    public function build(string $name, array $data): State
    {
        return new State(md5(uniqid()), $name, $data);
    }
}
