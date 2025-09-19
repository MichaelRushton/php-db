## SQLite Driver

#### Lazily connect to an SQLite database

```php
use MichaelRushton\DB\Drivers\SQLiteDriver;

$driver = new SQLiteDriver([
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$connection = $driver->connection();
```

#### Settings

```php
$driver->database($database);
```
