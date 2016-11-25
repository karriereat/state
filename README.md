# State package for Laravel

This laravel package allows to store a certain application state in either the session or inside a cache.

## Installation

You can install the package via composer
```
$ composer require fetzi/state
```

## Usage

To enable the package you need to reference the `StoreServiceProvider` class inside your `config/app.php` file in the `providers` section:
```
'providers' => [
    ...
    Fetzi\State\StateServiceProvider::class,
    ...
];
```

## Configuration
To install the configuration file you simply use:
```
$ php artisan vendor:publish
```

### Options
* `storage`: session|cache
* `storage-prefix`: prefix that is added to the store identifier
* `expires-after`: defines the expires after time in seconds, only used for `CacheStore`

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.