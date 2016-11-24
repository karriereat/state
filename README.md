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

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.