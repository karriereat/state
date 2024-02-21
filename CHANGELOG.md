# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.1.0] - 2024-02-27
### Added
- Support for PHP 8.3
- Support for `psr/cache` ^2.0 and ^3.0
- Support for `illuminate/support` v11
- Support for `illuminate/session` v11

### Updated
- `pestphp/pest` to v2

### Removed
- Support for PHP 8.0
- Support for `illuminate/support` v9
- Support for `illuminate/session` v9

## [3.0.0] - 2023-03-01
### Added
- Support for PHP 8.2.
- Support for `illuminate/support` and `illuminate/session` version `^10.0`
- Static analysis
- [BREAKING] Return types and type hint

### Changed
- Linting to `pint`
- Unit tests to `pest`

### Removed
- Support for PHP 7.4.
- Support for `illuminate/support` and `illuminate/session` version < `^9.0`

## [2.2.0] - 2022-03-24
### Added
- Support for `illuminate/support` and `illuminate/session` version `^9.0`

## [2.1.0] - 2021-10-20
### Added
- Support for PHP 8

## [2.0.0] - 2020-10-06
### Added
- support for Laravel 6, 7 & 8

### Changed
- unit tests to phpunit
- PHP CS fixer for linting and fixing

### Removed
- support for PHP 7.0 & 7.1

## [1.0.0] - 2017-07-31
### Added
- support for keepState flag on get

### Removed
- PHP 5.6 support
