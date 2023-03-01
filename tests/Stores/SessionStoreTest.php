<?php

use Illuminate\Session\Store;
use Karriere\State\State;
use Karriere\State\Stores\SessionStore;

beforeEach(function () {
    $this->store = Mockery::mock(Store::class);
    $this->sessionStore = new SessionStore('prefix', $this->store);
});

it('does not find session', function () {
    $this->store
        ->shouldReceive('has')
        ->once()
        ->andReturn(false);

    expect($this->sessionStore->get('id'))->isEmpty()->toBeTrue();
});

it('finds state in session', function () {
    $this->store
        ->shouldReceive('has')
        ->once()
        ->andReturn(true);

    $this->store
        ->shouldReceive('get')
        ->once()
        ->andReturn(['name' => 'name', 'data' => [1, 2, 3]]);

    $this->store
        ->shouldReceive('forget')
        ->once();

    expect($this->sessionStore->get('id'))
        ->isEmpty()->toBeFalse()
        ->name()->toEqual('name');
});

it('stores state in session', function () {
    $this->store
        ->shouldReceive('put')
        ->with('prefix/id', ['name' => 'name', 'data' => [1, 2, 3]])
        ->once();

    $this->sessionStore->put(new State('id', 'name', [1, 2, 3]));
});
