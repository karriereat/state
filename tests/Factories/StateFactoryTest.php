<?php

use Karriere\State\Factories\StateFactory;

beforeEach(function () {
    $this->stateFactory = new StateFactory();
});

it('creates unique identifier', function () {
    expect($this->stateFactory->build('name', []))
        ->identifier()->not->toBeEmpty()
        ->identifier()->toBeString();
});

it('assigns name', function () {
    expect($this->stateFactory->build('name', []))
        ->name()->toEqual('name');
});

it('assigns data', function () {
    expect($this->stateFactory->build('name', [1, 2, 3]))
        ->raw()->toEqual([1, 2, 3]);
});
