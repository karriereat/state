<?php

use Illuminate\Support\Collection;
use Karriere\State\State;

beforeEach(function () {
    $this->state = new State('id', 'name', []);
});

test('getters', function () {
    expect($this->state)
        ->identifier()->toEqual('id')
        ->name()->toEqual('name')
        ->raw()->toBeArray()
        ->collection()->toBeInstanceOf(Collection::class);
});

it('sets data', function () {
    expect($this->state)->isEmpty()->toBeTrue();

    $this->state->set(['key' => 'value']);

    expect($this->state)->isEmpty()->toBeFalse();
});

it('sets data2', function () {
    expect($this->state)->identifier()->toEqual('id');

    $this->state->set(['key' => 'value']);

    expect($this->state)->isEmpty()->toBeFalse();
});

it('checks for name', function () {
    expect($this->state)->hasName('name')->toBeTrue();
    expect($this->state)->hasName('foo')->toBeFalse();
});
