<a href="https://www.karriere.at/" target="_blank"><img width="200" src="http://www.karriere.at/images/layout/katlogo.svg"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
[![Build Status](https://img.shields.io/travis/karriereat/state.svg?style=flat-square)](https://travis-ci.org/karriereat/state)
[![Codecov](https://img.shields.io/codecov/c/github/karriereat/state.svg?style=flat-square)](https://codecov.io/gh/karriereat/state)
[![StyleCI](https://styleci.io/repos/74701405/shield?branch=master)](https://styleci.io/repos/74701405)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/d6fab7b5-18d3-43f3-a9c5-f3088a3f874a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/d6fab7b5-18d3-43f3-a9c5-f3088a3f874a)
[![Packagist](https://img.shields.io/packagist/v/karriere/state.svg?style=flat-square)](https://packagist.org/packages/karriere/state)
[![Packagist Downloads](https://img.shields.io/packagist/dt/karriere/state.svg?style=flat-square)](https://packagist.org/packages/karriere/state)

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

Apache License 2.0 Please see [LICENSE](LICENSE) for more information.
