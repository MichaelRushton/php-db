## PostgreSQL Driver

#### Lazily connect to a PostgreSQL database

```php
use MichaelRushton\DB\Drivers\PostgreSQLDriver;

$driver = new PostgreSQLDriver([
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$connection = $driver->connection();
```

#### Settings

```php
$driver->username($username);
$driver->password($password);
$driver->database($database);
$driver->host($host);
$driver->port($port);
$driver->sslmode($sslmode);
```
