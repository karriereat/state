<?php

namespace Karriere\State;

use Illuminate\Support\Collection;

class State
{
    /**
     * @param array<int|string, mixed> $data
     */
    public function __construct(private string $identifier, private string $name, private array $data)
    {
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function hasName(string $name): bool
    {
        return strcmp($this->name, $name) == 0;
    }

    /**
     * @param array<int|string,mixed>  $data
     */
    public function set(array $data): void
    {
        $this->data = $data;
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * @return array<int|string,mixed>
     */
    public function raw(): array
    {
        return $this->data;
    }

    public function collection(): Collection
    {
        return new Collection($this->data);
    }
}
