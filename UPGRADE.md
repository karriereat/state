# Upgrade Guide

## v2 to v3
Most likely this new major version does not contain any breaking changes. Only potential for breaking changes
are return types and type hints.

### Constructor signature changes

#### State.php
```php
// Before
public function __construct($identifier, $name, $data) {}

// After
public function __construct(private string $identifier, private string $name, private array $data) {}
```

#### Stores/CacheStore.php
```php
// Before
public function __construct($statePrefix, CacheItemPoolInterface $cacheItemPool, $expiresAfter = 300) {}

// After
public function __construct(
    string $statePrefix,
    private CacheItemPoolInterface $cacheItemPool,
    private int $expiresAfter = 300,
) {}
```

#### Stores/SessionStore.php
```php
// Before
public function __construct($statePrefix, Session $session) {}

// After
public function __construct(string $statePrefix, private Session $session) {}
```

#### Stores/Store.php
```php
// Before
public function __construct($statePrefix) {}

// After
public function __construct(protected string $statePrefix) {}
```

### Signature changes of public methods

#### Factories/StateFactory.php
```php
// Before
public function build($name, $data) {}

// After
public function build(string $name, array $data): State {}
```

#### State.php
```php
// Before
public function identifier() {}
public function name() {}
public function hasName($name) {}
public function set($data) {}
public function isEmpty() {}
public function raw() {}
public function collection() {}

// After
public function identifier(): string {}
public function name(): string {}
public function hasName(string $name): bool {}
public function set(array $data): void {}
public function isEmpty(): bool {}
public function raw(): array {}
public function collection(): Collection {}
```

#### All "Store classes" (`Stores/*Store.php`)
```php
// Before
public function put(State $state) {}
public function get($identifier, $keepState = false) {}
protected function getStoreKey($identifier) {}

// After
public function put(State $state): void {}
public function get(string $identifier, bool $keepState = false): State {}
protected function getStoreKey(string $identifier): string {}
```