<a href="https://www.karriere.at/" target="_blank"><img width="200" src="https://www.karriere.at/images/layout/katlogo.svg"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
[![Build Status](https://travis-ci.org/karriereat/state.svg?branch=master)](https://travis-ci.org/karriereat/state)
[![codecov](https://codecov.io/gh/karriereat/state/branch/master/graph/badge.svg)](https://codecov.io/gh/karriereat/state)
[![StyleCI](https://styleci.io/repos/74701405/shield?branch=master)](https://styleci.io/repos/74701405)

# State package for Laravel

This laravel package allows to store a certain application state in either the session or inside a cache.

## Installation

Run `composer require karriere/state` to install this package.

## Usage

To enable the package you need to reference the `StoreServiceProvider` class inside your `config/app.php` file in the `providers` section:
```php
'providers' => [
    ...
    Karriere\State\StateServiceProvider::class,
    ...
];
```

To store the application state you create a state object and store it:
```php
$state = $stateFactory->build('state-name', ['key' => 'value']);
$store->put($state);

// pass on $state->identifier()
```

In a later situation where you have the state identifier you can access the states data by:
```php
$state = $store->get($identifier);

if(!$state->isEmpty()) {
  // use either $state->collection() or $state->raw() to access the state data
}
```

## Configuration
To install the configuration file you simply use:
```
php artisan vendor:publish
```

### Options
* `storage`: session|cache
* `storage-prefix`: prefix that is added to the store identifier
* `expires-after`: defines the expires after time in seconds, only used for `CacheStore`

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.
