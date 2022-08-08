<a href="https://www.karriere.at/" target="_blank"><img width="200" src="https://raw.githubusercontent.com/karriereat/.github/main/profile/logo.svg"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
![](https://github.com/karriereat/state/workflows/test/badge.svg)
![](https://github.com/karriereat/state/workflows/lint/badge.svg)
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
